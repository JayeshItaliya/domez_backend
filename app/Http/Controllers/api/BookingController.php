<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Domes;
use App\Models\Booking;
use App\Models\Field;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{

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
            // dd($out);   //array out

            // dd($getdomedata->start_time,$getdomedata->end_time);

            $period = new CarbonPeriod(date('h:i A', strtotime($getdomedata->start_time)), '60 minutes', date('h:i A', strtotime($getdomedata->end_time))); // for create use 24 hours format later change format
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
                    'price' => rand(111,999),
                    'status' => $status,
                ];
            }
            // dd($slots);

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
        $available_fields = Field::select('id', 'vendor_id', 'dome_id', 'sport_id', 'name', 'area', 'min_person', 'max_person', DB::raw("CONCAT('" . url('storage/app/public/admin/images/fields') . "/', image) AS image"))->where('dome_id', $request->dome_id)->whereRaw("find_in_set('" . $request->sport_id . "',sport_id)")->whereRaw('? between min_person and max_person', [$request->players])->where('is_available', 1)->where('is_deleted', 2);

        $bookedfield = Booking::where('dome_id', $request->dome_id)->where('sport_id', $request->sport_id)->where('booking_date', $request->date)->where('slots', $request->slots)->where('booking_status', 1)->select('field_id')->get()->pluck('field_id')->toArray();
        if (!empty($bookedfield)) {
            $available_fields = $available_fields->whereNotIn('id', $bookedfield);
        }
        $available_fields = $available_fields->get();
        return response()->json(["status" => 0, "message" => "Successful", 'fields' => $available_fields], 200);
    }
}
