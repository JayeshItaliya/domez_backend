<?php

namespace App\Http\Controllers\api;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Domes;
use App\Models\Booking;
use App\Models\League;
use App\Models\Review;
use App\Models\SetPricesDaysSlots;
use App\Models\Transaction;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class BookingController extends Controller
{
    public function booking_list(Request $request)
    {
        if (in_array($request->user_id, [0, ''])) {
            return response()->json(["status" => 0, "message" => "Please Enter User ID"], 200);
        }
        if ($request->is_active == "") {
            return response()->json(["status" => 0, "message" => "Please Enter Booking Type"], 200);
        }
        $data = Booking::with('league_info', 'dome_info', 'dome_info.dome_image')->where('user_id', $request->user_id)->orderByDesc('created_at')->paginate(10);
        $bookinglist = [];
        foreach ($data as $booking) {
            $start_date_time = Carbon::createFromFormat('Y-m-d h:i A', $booking->start_date . ' ' . date('h:i A', strtotime($booking->end_time)));
            $now = Carbon::now();
            $current_date_time = $now->format('Y-m-d h:i A');
            if ($request->is_active == 1) {
                if ($start_date_time->lessThan($current_date_time) == false && $booking->booking_status != 3) {
                    $bookinglist[] = $this->bookinglistobject($booking);
                }
            } else {
                if ($start_date_time->lessThan($current_date_time) == true || $booking->booking_status == 3) {
                    $bookinglist[] = $this->bookinglistobject($booking);
                }
            }
        }
        return response()->json(["status" => 1, "message" => "Success", 'bookings_list' => $bookinglist, "last_page" => $data->toArray()['last_page']], 200);
    }
    public function bookinglistobject($data)
    {
        $arr = [
            "booking_id" => $data->id,
            "type" => $data->type,
            "field" => $data->field_id,
            "dome_name" => $data->dome_info->name,
            "league_name" => $data->league_info != '' ? $data->league_info->name : '',
            "date" => $data->type != 2 ? date('d M', strtotime($data->start_date)) : date('d M', strtotime($data->start_date)) . ' To ' . date('d M', strtotime($data->end_date)),
            "price" => $data->total_amount,
            'image' => $data->dome_info->dome_image->image,
            'payment_type' => $data->payment_type,
            'time' => Carbon::parse($data->start_time)->setTimezone(config('app.timezone'))->format('h:i A') . ' - ' . Carbon::parse($data->end_time)->setTimezone(config('app.timezone'))->format('h:i A'),
            'created_at' => Carbon::parse($data->created_at)->setTimezone(config('app.timezone'))->toDateTimeString(),
        ];
        return $arr;
    }
    public function booking_details(Request $request)
    {
        $booking = Booking::find($request->id);
        if (empty($booking)) {
            return response()->json(["status" => 0, "message" => "Booking Not Found"], 200);
        }
        $dome = Domes::with('dome_image')->where('id', $booking->dome_id)->where('is_deleted', 2)->first();
        if ($booking->league_id != '') {
            $league = League::find($booking->league_id);
            $datetime1 = new DateTime($league->start_date);
            $datetime2 = new DateTime($league->end_date);
            $interval = $datetime1->diff($datetime2);
            $startDate2 = new DateTime(date('m/d'));
            $endDate2 = new DateTime(date('m/d', strtotime("+7 day")));
            for ($date = $startDate2; $date < $endDate2; $date->modify('+1 day')) {
                $daylist[] = $date->format('D');
            }
        }
        $defaultimagebaseurl = url('storage/app/public/admin/images/profiles');
        $gettransaction = Transaction::leftJoin('users AS user', function ($query) {
            $query->on('transactions.user_id', '=', 'user.id');
        })
            ->where('transactions.booking_id', $booking->booking_id)->select(
                'transactions.user_id',
                'transactions.contributor_name',
                'transactions.amount',
                DB::raw("CASE WHEN transactions.user_id IS NULL THEN 0 ELSE transactions.user_id END as user_id"),
                DB::raw("CASE WHEN transactions.contributor_name IS NULL THEN '' ELSE transactions.contributor_name END as contributor_name"),
                DB::raw("CASE WHEN transactions.user_id IS NULL THEN '{$defaultimagebaseurl}/default.png' ELSE '' END as contributor_image_url"),
                DB::raw("CASE WHEN transactions.user_id IS NOT NULL THEN '{$defaultimagebaseurl}/user.image' ELSE '' END as user_image"),
            )->get()->toArray();

        $is_ratting_exist = Review::where('dome_id', $booking->dome_id)->where('user_id', $booking->user_id)->first();

        $now = Carbon::now();
        $current_date_time = $now->format('Y-m-d h:i A');
        $start_date_time = Carbon::createFromFormat('Y-m-d h:i A', $booking->start_date . ' ' . date('h:i A', strtotime($booking->end_time)));

        $booking_details = [
            "id" => $booking->id,
            "type" => $booking->type,
            "field" => $booking->fields_name(),
            "dome_name" => $dome->name,
            "league_name" => $booking->league_id != '' ? $league->name : '',
            "days" => $booking->league_id != '' ? implode(' | ', $daylist) : '',
            "total_games" => $booking->league_id != '' ? $interval->format('%a') : '',
            "date" => $booking->type != 2 ? date('M d,Y', strtotime($booking->start_date)) : date('M d', strtotime($booking->start_date)) . ' To ' . date('M d', strtotime($booking->end_date)),
            "time" => date('h:i A', strtotime($booking->start_time)) . ' To ' . date('h:i A', strtotime($booking->end_time)),
            "players" => $booking->players,
            "address" => $dome->address,
            "city" => $dome->city,
            "state" => $dome->state,
            "sub_total" => $booking->sub_total,
            "service_fee" => $booking->service_fee,
            "hst" => $booking->hst,
            "total_amount" => $booking->total_amount,
            "paid_amount" => $booking->paid_amount,
            "due_amount" => $booking->due_amount,
            "booking_status" => $booking->booking_status == 3 ? 'Cancelled' : '',
            "image" => $dome->dome_image->image,
            "payment_status" => $booking->payment_status == 1 ? 'Paid' : 'In Progress',
            "booking_created_at" => Carbon::parse($booking->created_at)->setTimezone(config('app.timezone'))->toDateTimeString(),
            "current_time" => Carbon::now()->setTimezone(config('app.timezone'))->toDateTimeString(),
            "user_info" => $booking->user_info,
            "payment_link" => URL::to('/payment/' . $booking->token),
            "other_contributors" => $gettransaction,
            "start_date" => $booking->start_date ?? "",
            "end_date" => $booking->end_date ?? "",
            "dome_id" => $booking->dome_id,
            "dome_images" => $dome->dome_images,
            "is_ratting_exist" => !empty($is_ratting_exist) ? 1 : 0,
            "is_active" => $start_date_time->lessThan($current_date_time) == true ? 2 : 1,
        ];
        return response()->json(["status" => 1, "message" => "Success", 'booking_details' => $booking_details], 200);
    }
    public function cancelbooking(Request $request)
    {
        $checkbooking = Booking::find($request->booking_id);

        if (empty($checkbooking)) {
            return response()->json(["status" => 0, "message" => "Booking Not Found"], 200);
        }

        if ($checkbooking->booking_status == 3) {
            return response()->json(["status" => 0, "message" => "Invalid Request!!"], 200);
        }

        try {
            $refund = Helper::refund_cancel_booking($checkbooking->id);

            if ($refund == 1) {

                $checkbooking->cancelled_by = 3;
                $checkbooking->cancellation_reason = $request->cancellation_reason ?? '';
                $checkbooking->save();
                foreach (explode(',', $checkbooking->slots) as $key => $slot) {
                    $start_time = date('H:i', strtotime(explode(' - ', $slot)[0]));
                    $end_time = date('H:i', strtotime(explode(' - ', $slot)[1]));
                    SetPricesDaysSlots::where('start_time', $start_time)->where('end_time', $end_time)->where('sport_id', $checkbooking->sport_id)->whereDate('date', date('Y-m-d', strtotime($checkbooking->start_date)))->update(['status' => 1]);
                }
                $title = 'Booking Cancellation Confirmation';
                $description = "We're sorry to hear that you have cancelled your booking. Here are the details of your cancellation:";
                Helper::booking_cancelled_email($title, $description, $checkbooking, 3);

                return response()->json(['status' => 1, 'message' => 'Booking Has Been Successfully Cancelled'], 200);
            } else {
                return response()->json(['status' => 0, 'message' => 'Something Went Wrong..!!'], 200);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, 'message' => 'Something Went Wrong..!!'], 200);
        }
    }
}
