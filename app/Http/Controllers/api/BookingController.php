<?php

namespace App\Http\Controllers\api;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Domes;
use App\Models\Booking;
use App\Models\Field;
use App\Models\League;
use App\Models\SetPrices;
use App\Models\Review;
use App\Models\SetPricesDaysSlots;
use App\Models\Transaction;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
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
        $bookings_list = Booking::where('user_id', $request->user_id)->orderByDesc('created_at')->get();
        // if ($request->is_active == 1) {
        //     $bookings_list = $bookings_list->whereDate('start_date','>=',Carbon::today()->format('Y-m-d'));
        // }
        // if ($request->is_active == 2) {
        //     $bookings_list = $bookings_list->whereDate('start_date','<=',Carbon::today()->format('Y-m-d'));
        // }
        $bookinglist = [];
        foreach ($bookings_list as $booking) {

            $start_date_time = Carbon::createFromFormat('Y-m-d h:i A', $booking->start_date . ' ' . date('h:i A', strtotime($booking->end_time)));
            $now = Carbon::now();
            $current_date_time = $now->format('Y-m-d h:i A');
            // $start_date_time->lessThan($current_date_time) == true ? 2 : 1;

            if ($request->is_active == 1) {
                if ($start_date_time->lessThan($current_date_time) == false) {
                    $dome = Domes::with('dome_image')->where('id', $booking->dome_id)->where('is_deleted', 2)->first();
                    if ($booking->league_id != '') {
                        $league = League::find($booking->league_id);
                    }
                    $bookinglist[] = [
                        "booking_id" => $booking->id,
                        "type" => $booking->type,
                        "field" => $booking->field_id,
                        "dome_name" => $dome->name,
                        "league_name" => $booking->league_id != '' ? $league->name : '',
                        "date" => $booking->type != 2 ? date('d M', strtotime($booking->start_date)) : date('d M', strtotime($booking->start_date)) . ' To ' . date('d M', strtotime($booking->end_date)),
                        "price" => $booking->total_amount,
                        'image' => $dome->dome_image->image,
                        'payment_type' => $booking->payment_type,
                        'created_at' => $booking->created_at,
                    ];
                }
            } else {
                if ($start_date_time->lessThan($current_date_time) == true) {
                    $dome = Domes::with('dome_image')->where('id', $booking->dome_id)->where('is_deleted', 2)->first();
                    if ($booking->league_id != '') {
                        $league = League::find($booking->league_id);
                    }
                    $bookinglist[] = [
                        "booking_id" => $booking->id,
                        "type" => $booking->type,
                        "field" => $booking->field_id,
                        "dome_name" => $dome->name,
                        "league_name" => $booking->league_id != '' ? $league->name : '',
                        "date" => $booking->type != 2 ? date('d M', strtotime($booking->start_date)) : date('d M', strtotime($booking->start_date)) . ' To ' . date('d M', strtotime($booking->end_date)),
                        "price" => $booking->total_amount,
                        'image' => $dome->dome_image->image,
                        'payment_type' => $booking->payment_type,
                    ];
                }
            }
        }
        return response()->json(["status" => 1, "message" => "Success", 'bookings_list' => $bookinglist], 200);
    }
    public function booking_details(Request $request)
    {
        $booking = Booking::find($request->id);
        if (!empty($booking)) {
            $dome = Domes::with('dome_image')->where('id', $booking->dome_id)->where('is_deleted', 2)->first();
            if ($booking->league_id != '') {
                $league = League::find($booking->league_id);
                $datetime1 = new DateTime($league->start_date);
                $datetime2 = new DateTime($league->end_date);
                $interval = $datetime1->diff($datetime2);
                $startDate2 = new \DateTime(date('m/d'));
                $endDate2 = new \DateTime(date('m/d', strtotime("+7 day")));
                for ($date = $startDate2; $date < $endDate2; $date->modify('+1 day')) {
                    $daylist[] = $date->format('D');
                }
            }

            $defaultimagebaseurl = url('storage/app/public/admin/images/profiles');
            $gettransaction = Transaction::leftJoin('users AS user', function ($query) {
                $query->on('transactions.user_id', '=', 'user.id');
                // ->where('user_id','!=','')->where('user_id','>',0);
            })
                ->where('transactions.booking_id', $booking->booking_id)->select(
                    'transactions.user_id',
                    'transactions.contributor_name',
                    'transactions.amount',
                    DB::raw("CASE WHEN transactions.user_id IS NULL THEN 0 ELSE transactions.user_id END as user_id"),
                    DB::raw("CASE WHEN transactions.contributor_name IS NULL THEN '' ELSE transactions.contributor_name END as contributor_name"),
                    DB::raw("CASE WHEN transactions.user_id IS NULL THEN '{$defaultimagebaseurl}/default.png' ELSE '' END as contributor_image_url"),
                    DB::raw("CASE WHEN transactions.user_id IS NOT NULL THEN '{$defaultimagebaseurl}/user.image' ELSE '' END as user_image"),
                    // DB::raw("CONCAT('" . url('storage/app/public/admin/images/profiles') . "/',user.image) AS user_image")
                )->get()->toArray();


            $is_ratting_exist = Review::where('dome_id', $booking->dome_id)->where('user_id', $booking->user_id)->first();

            $booking_details = [
                "id" => $booking->id,
                "type" => $booking->type,
                "field" => $booking->field_id,
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
                "booking_created_at" => $booking->created_at,
                "user_info" => $booking->user_info,
                "payment_link" => URL::to('/payment/' . $booking->token),
                "other_contributors" => $gettransaction,
                "start_date" => $booking->start_date ?? "",
                "end_date" => $booking->end_date ?? "",
                "dome_id" => $booking->dome_id,
                "is_ratting_exist" => !empty($is_ratting_exist) ? 1 : 0,
            ];
            return response()->json(["status" => 1, "message" => "Success", 'booking_details' => $booking_details], 200);
        } else {
            return response()->json(["status" => 0, "message" => "Booking Not Found"], 200);
        }
    }
    public function timeslots(Request $request)
    {
        if ($request->dome_id == "") {
            return response()->json(["status" => 0, "message" => 'Please Enter Dome ID'], 200);
        }
        $getdomedata = Domes::where('id', $request->dome_id)->where('is_deleted', 2)->first();
        if (!empty($getdomedata)) {
            $my_interval = Helper::get_slot_duration($getdomedata->id);
            if ($request->date == "") {
                return response()->json(["status" => 0, "message" => 'Please Enter Date'], 200);
            }
            if ($request->sport_id == "") {
                return response()->json(["status" => 0, "message" => 'Please Enter Sport ID'], 200);
            }

            $getsetprices = SetPrices::where('dome_id', $getdomedata->id)->where('sport_id', $request->sport_id)->count();
            if ($getsetprices > 1) {
                $dateToCheck = date('Y-m-d', strtotime($request->date));
                $checkpricetype = SetPrices::where('dome_id', $getdomedata->id)->where('sport_id', $request->sport_id)->whereRaw('? BETWEEN start_date AND end_date', [$dateToCheck])->first();
                if (empty($checkpricetype)) {
                    $checkpricetype = SetPrices::where('dome_id', $getdomedata->id)->where('sport_id', $request->sport_id)->where('price_type', 1)->first();
                }
            } else {
                $checkpricetype = SetPrices::where('dome_id', $getdomedata->id)->where('sport_id', $request->sport_id)->where('price_type', 1)->first();
            }

            $slots = [];
            if ($checkpricetype->price_type == 1) {
                $period = new CarbonPeriod(date('h:i A', strtotime($getdomedata->start_time)), $my_interval . ' minutes', date("h:i A", strtotime("-$my_interval minutes", strtotime($getdomedata->end_time))));
                foreach ($period as $item) {
                    $slot = $item->format("h:i A") . ' - ' . $item->addMinutes($my_interval)->format("h:i A");
                    $today = Carbon::now(new \DateTimeZone('Asia/Kolkata'));
                    $last = Carbon::parse($item->format("h:i A"));
                    if (date('Y-m-d') == date('Y-m-d', strtotime($request->date))) {
                        if ($today->lt($last)) {
                            $status = 1;
                        } else {
                            $status = 0;
                            // $slot = '';
                        }
                    } elseif (date('Y-m-d', strtotime($request->date)) < date('Y-m-d')) {
                        $status = 0;
                    } else {
                        $status = 1;
                    }
                    $checkslotexist = Booking::where('dome_id', $request->dome_id)->where('sport_id', $request->sport_id)->whereDate('start_date', date('Y-m-d', strtotime($request->date)))->whereRaw("find_in_set('" . $slot . "',slots)")->where('booking_status', '!=', 3)->first();
                    if (!empty($checkslotexist)) {
                        $status = 0;
                    }
                    $slots[] = [
                        'slot' => $slot,
                        'price' => $checkpricetype->price,
                        'status' => $status,
                    ];
                }
                return response()->json(["status" => 1, "message" => "Successful", 'data' => $slots], 200);
            } else {
                // Get Day's all slots
                $data = SetPricesDaysSlots::where('set_prices_id', $checkpricetype->id)->whereDate('date', date('Y-m-d', strtotime($request->date)))->get();
                foreach ($data as $key => $slot) {
                    $new_slot = date('h:i A', strtotime($slot->start_time)) . ' - ' . date('h:i A', strtotime($slot->end_time));
                    $today =  Carbon::now(new \DateTimeZone('Asia/Kolkata'));
                    $last = Carbon::parse(date('h:i A', strtotime($slot->start_time)));
                    $status = $slot->status;
                    $slots[] = [
                        'slot' => $new_slot,
                        'price' => $slot->price,
                        'status' => $status,
                    ];
                }
                return response()->json(["status" => 1, "message" => "Successful", 'data' => $slots], 200);
            }
        }
        return response()->json(["status" => 0, "message" => 'Dome Not Found'], 200);
    }
    public function avl_fields(Request $request)
    {
        if ($request->dome_id == "") {
            return response()->json(["status" => 0, "message" => 'Please Enter Dome ID'], 200);
        }
        if ($request->sport_id == "") {
            return response()->json(["status" => 0, "message" => 'Please Enter Sport ID'], 200);
        }
        if ($request->date == "") {
            return response()->json(["status" => 0, "message" => 'Please Enter Date'], 200);
        }
        if ($request->slots == "") {
            return response()->json(["status" => 0, "message" => 'Please Enter Slots'], 200);
        }
        if ($request->players == "") {
            return response()->json(["status" => 0, "message" => 'Please Enter Number Of Players'], 200);
        }
        if (Carbon::createFromFormat('Y-m-d', $request->date)->isPast() && $request->date != Carbon::today()->format('Y-m-d')) {
            return response()->json(["status" => 0, "message" => 'Select Current or Future Date Only'], 200);
        }

        $bookedfields = [];
        foreach (explode(',', $request->slots) as $slot) {
            $checkslotexist = Booking::where('dome_id', $request->dome_id)
                ->where('sport_id', $request->sport_id)
                ->whereDate('start_date', date('Y-m-d', strtotime($request->date)))
                ->whereRaw("find_in_set('" . $slot . "',slots)")
                ->where('booking_status', '!=', 3)
                // ->whereRaw("find_in_set('" . $request->field_id . "',field_id)")
                ->first();
            if (!empty($checkslotexist)) {
                foreach (explode(',', $checkslotexist->field_id) as $key => $field_id) {
                    $bookedfields[] = $field_id;
                }
            }
        }
        $maintenancefields = Field::where('in_maintenance', 1)->whereNotNull('maintenance_date')->whereDate('maintenance_date', '=', date('Y-m-d', strtotime($request->date)))->get();
        $available_fields = Field::with('sport_data')
            ->select('id', 'dome_id', 'sport_id', 'name', 'min_person', 'max_person', DB::raw("CONCAT('" . url('storage/app/public/admin/images/fields') . "/',image) AS image"))
            ->where('dome_id', $request->dome_id)
            ->whereRaw("find_in_set('" . $request->sport_id . "',sport_id)")
            ->whereRaw('? BETWEEN min_person AND max_person', [$request->players])
            ->where('is_available', 1)
            ->where('is_deleted', 2);
        if (count($bookedfields) > 0) {
            $available_fields = $available_fields->whereNotIn('id', $bookedfields);
        }
        if (count($maintenancefields) > 0) {
            $available_fields = $available_fields->whereNotIn('id', $maintenancefields);
        }
        $available_fields = $available_fields->get();

        return response()->json(["status" => 1, "message" => "Successful", 'fields' => $available_fields], 200);
    }
    public function cancelbooking(Request $request)
    {
        // -------------------- NOTE ---------------------- //
        // -------- cancellation fees will be 3.50% ------- //
        // ------------------------------------------------ //

        if ($request->booking_id == "") {
            return response()->json(["status" => 0, "message" => "Booking ID Required"], 200);
        }
        $checkbooking = Booking::find($request->booking_id);
        if (!empty($checkbooking)) {
            if ($checkbooking->booking_status == 3) {
                return response()->json(["status" => 0, "message" => "Invalid Request!!"], 200);
            }
            try {
                $refund = Helper::refund_cancel_booking($checkbooking->id);
                if ($refund == 1) {
                    $checkbooking->cancellation_reason = $request->cancellation_reason ?? '';
                    $checkbooking->save();
                    return response()->json(['status' => 1, 'message' => 'Booking Has Been Successfully Cancelled'], 200);
                } else {
                    return response()->json(['status' => 0, 'message' => 'Something Went Wrong..!!'], 200);
                }
            } catch (\Throwable $th) {
                return response()->json(['status' => 0, 'message' => 'Something Went Wrong..!!'], 200);
            }
        } else {
            return response()->json(["status" => 0, "message" => "Booking Not Found"], 200);
        }
    }
}
