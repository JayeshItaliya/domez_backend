<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Domes;
use App\Models\Booking;
use App\Models\Field;
use App\Models\League;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class BookingController extends Controller
{
    public function booking_list(Request $request)
    {
        if ($request->user_id == "") {
            return response()->json(["status" => 0, "message" => "Please Enter User ID"], 200);
        }
        if ($request->is_active == "") {
            return response()->json(["status" => 0, "message" => "Please Enter Booking Type"], 200);
        }
        $bookings_list = Booking::where('user_id', $request->user_id)->orderByDesc('booking_date');

        if ($request->is_active == 1) {
            $bookings_list = $bookings_list->where('end_date', '>=', Carbon::today()->format('Y-m-d'));
        }
        if ($request->is_active == 2) {
            $bookings_list = $bookings_list->where('end_date', '<=', Carbon::today()->format('Y-m-d'));
        }
        $bookinglist = [];
        foreach ($bookings_list->get() as $booking) {
            $dome = Domes::with('dome_image')->where('id', $booking->dome_id)->first();
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
        return response()->json(["status" => 1, "message" => "Success", 'bookings_list' => $bookinglist], 200);
    }
    public function booking_details(Request $request)
    {
        $booking = Booking::find($request->id);
        if (!empty($booking)) {
            $dome = Domes::with('dome_image')->where('id', $booking->dome_id)->first();
            if ($booking->league_id != '') {
                $league = League::find($booking->league_id);
            }
            $datetime1 = new DateTime($league->start_date);
            $datetime2 = new DateTime($league->end_date);
            $interval = $datetime1->diff($datetime2);
            $startDate2 = new \DateTime(date('m/d'));
            $endDate2 = new \DateTime(date('m/d', strtotime("+7 day")));
            for ($date = $startDate2; $date < $endDate2; $date->modify('+1 day')) {
                $daylist[] = $date->format('D');
            }

            $gettransaction = Transaction::leftJoin('users AS user', function ($query) {
                $query->on('transactions.user_id', '=', 'user.id');
                // ->where('user_id','!=','')->where('user_id','>',0);
            })
            ->where('transactions.booking_id', $booking->booking_id)->select('transactions.user_id','transactions.contributor_name','transactions.amount', DB::raw('(CASE WHEN transactions.user_id IS NULL THEN "https://via.placeholder.com/150" ELSE "" END) AS contributor_image_url'),
            DB::raw("CONCAT('" . url('storage/app/public/admin/images/users') . "/', user.image) AS user_image")
            )->get()->toArray();

            $booking_details = [
                "type" => $booking->type,
                "field" => $booking->field_id,
                "dome_name" => $dome->name,
                "league_name" => $booking->league_id != '' ? $league->name : '',
                "days" => implode(' | ', $daylist),
                "total_games" => $interval->format('%a'),
                "date" => $booking->type != 2 ? date('d M, Y', strtotime($booking->start_date)) : date('d M', strtotime($booking->start_date)) . ' To ' . date('d M', strtotime($booking->end_date)),
                "time" => date('h A', strtotime($booking->start_time)) . ' To ' . date('h A', strtotime($booking->end_time)),
                "players" => $booking->players,
                "address" => $dome->address,
                "city" => $dome->city,
                "state" => $dome->state,
                "sub_total" => $booking->total_amount,
                "service_fee" => $booking->total_amount * 5 / 100,
                "hst" => $booking->total_amount * $dome->hst / 100,
                "total_amount" => $booking->total_amount + $booking->total_amount * 5 / 100 + $booking->total_amount * $dome->hst / 100,
                "image" => $dome->dome_image->image,
                "payment_status" => $booking->payment_status == 1 ? 'Paid' : 'Pending',
                "booking_created_at" => $booking->created_at,
                "user_info" => $booking->user_info,
                "payment_link" => URL::to('/payment/' . $booking->token),
                "other_contributors" => $gettransaction,

            ];
            return response()->json(["status" => 1, "message" => "Success", 'booking_details' => $booking_details], 200);
        } else {
            return response()->json(["status" => 0, "message" => "Booking Not Found"], 200);
        }
    }
    public function timeslots(Request $request)
    {
        if ($request->date == "") {
            return response()->json(["status" => 0, "message" => 'Please Enter Date'], 200);
        }
        if ($request->sport_id == "") {
            return response()->json(["status" => 0, "message" => 'Please Enter Sport ID'], 200);
        }
        if ($request->dome_id == "") {
            return response()->json(["status" => 0, "message" => 'Please Enter Dome ID'], 200);
        }
        $getdomedata = Domes::where('id', $request->dome_id)->where('is_deleted', 2)->first();
        if (!empty($getdomedata)) {

            date_default_timezone_set('Asia/Kolkata');

            // $start_time = $getdomedata->start_time;  //start time as string
            // $end_time = $getdomedata->end_time;  //end time as string
            // $booked = array('12:20-12:40','13:00-13:20');    //booked slots as arrays
            // $start = DateTime::createFromFormat('Y-m-d H:i:s',$start_time);  //create date time objects
            // $end = DateTime::createFromFormat('Y-m-d H:i:s',$end_time);  //create date time objects
            // $count = 0;  //number of slots
            // $out = array();   //array of slots
            // for($i = $start; $i<$end;)  //for loop
            // {
            //     $avoid = false;   //booked slot?
            //     $time1 = $i->format('H:i');   //take hour and minute
            //     $i->modify("+20 minutes");      //add 20 minutes
            //     $time2 = $i->format('H:i');     //take hour and minute
            //     $slot = $time1."-".$time2;      //create a format 12:40-13:00 etc
            //     for($k=0;$k<sizeof($booked);$k++)  //if booked hour
            //     {
            //         if($booked[$k] == $slot)  //check
            //         $avoid = true;   //yes. booked
            //     }
            //     if(!$avoid && $i<$end)  //if not booked and less than end time
            //     {
            //         $count++;           //add count
            //         $slots = ['start'=>$time1, 'stop'=>$time2];         //add count
            //         array_push($out,$slots); //add slot to array
            //     }
            // }

            // for create use 24 hours format later change format
            $period = new CarbonPeriod(date('h:i A', strtotime($getdomedata->start_time)), '60 minutes', date('h:i A', strtotime($getdomedata->end_time)));
            $slots = [];
            foreach ($period as $item) {

                $slot = $item->format("h:i A") . ' - ' . $item->addMinutes(60)->format("h:i A");

                $today =  Carbon::now(new \DateTimeZone('Asia/Kolkata'));
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

                $checkslotexist = Booking::where('dome_id', $request->dome_id)->where('sport_id', $request->sport_id)->where('booking_date', date('Y-m-d', strtotime($request->date)))->whereRaw("find_in_set('" . $slot . "',slots)")->first();
                if (!empty($checkslotexist)) {
                    $status = 0;
                }

                $slots[] = [
                    'slot' => $slot,
                    'price' => rand(111, 999),
                    'status' => $status,
                ];
            }

            return response()->json(["status" => 1, "message" => "Successful", 'data' => $slots], 200);
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
        // if($request->start_time == ""){
        //     return response()->json(["status" => 0, "message" => 'Please Enter Start Time'], 200);
        // }
        // if($request->end_time == ""){
        //     return response()->json(["status" => 0, "message" => 'Please Enter End Time'], 200);
        // }
        if ($request->players == "") {
            return response()->json(["status" => 0, "message" => 'Please Enter Number Of Players'], 200);
        }
        if (Carbon::createFromFormat('Y-m-d', $request->date)->isPast() && $request->date != Carbon::today()->format('Y-m-d')) {
            return response()->json(["status" => 0, "message" => 'Select Current or Future Date Only'], 200);
        }
        $available_fields = Field::with('sport_data')->select('id', 'dome_id', 'sport_id', 'name', 'min_person', 'max_person', DB::raw("CONCAT('" . url('storage/app/public/admin/images/fields') . "/', image) AS image"))->where('dome_id', $request->dome_id)->whereRaw("find_in_set('" . $request->sport_id . "',sport_id)")->whereRaw($request->players . ' between min_person and max_person')->where('is_available', 1)->where('is_deleted', 2);

        $bookedfield = Booking::where('dome_id', $request->dome_id)->where('sport_id', $request->sport_id)->where('booking_date', $request->date)->where('slots', $request->slots)->where('booking_status', 1)->select('field_id')->get()->pluck('field_id')->toArray();
        if (!empty($bookedfield)) {
            $available_fields = $available_fields->whereNotIn('id', $bookedfield);
        }
        $available_fields = $available_fields->get()->makeHidden(['sport_id', 'dome_id']);

        return response()->json(["status" => 1, "message" => "Successful", 'fields' => $available_fields], 200);
    }
}
