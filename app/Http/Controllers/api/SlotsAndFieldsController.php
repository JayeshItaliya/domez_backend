<?php

namespace App\Http\Controllers\api;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Domes;
use App\Models\Field;
use App\Models\League;
use App\Models\SetPricesDaysSlots;
use App\Models\Sports;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SlotsAndFieldsController extends Controller
{
    public function timeslots(Request $request)
    {
        if ($request->dome_id == "") {
            return response()->json(["status" => 0, "message" => 'Please Enter Dome ID'], 200);
        }
        $getdomedata = Domes::where('id', $request->dome_id)->where('is_deleted', 2)->first();
        if (empty($getdomedata)) {
            return response()->json(["status" => 0, "message" => 'Dome Not Found'], 200);
        }
        if ($request->date == "") {
            return response()->json(["status" => 0, "message" => 'Please Enter Date'], 200);
        }
        if ($request->sport_id == "") {
            return response()->json(["status" => 0, "message" => 'Please Enter Sport ID'], 200);
        }
        if (Carbon::createFromFormat('Y-m-d', $request->date)->isPast() && $request->date != Carbon::today()->format('Y-m-d')) {
            return response()->json(["status" => 0, "message" => 'Select Current or Future Date Only'], 200);
        }
        $checksport = Sports::where('id', $request->sport_id)->where('is_available', 1)->where('is_deleted', 2)->first();
        if (empty($checksport) || !in_array($request->sport_id, explode(',', $getdomedata->sport_id))) {
            return response()->json(["status" => 0, "message" => 'Invalid Sport'], 200);
        }
        $my_interval = Helper::get_slot_duration($getdomedata->id);
        $gettotlaslots = SetPricesDaysSlots::where('dome_id', $getdomedata->id)->where('sport_id', $request->sport_id)->whereDate('date', date('Y-m-d', strtotime($request->date)))->count();
        if ($gettotlaslots == 0) {
            $start_time__ = $getdomedata->day_working_hours($request->date)->open_time;
            $end_time__ = $getdomedata->day_working_hours($request->date)->close_time;
            $period = new CarbonPeriod(date('h:i A', strtotime($start_time__)), $my_interval . ' minutes', date("h:i A", strtotime("-$my_interval minutes", strtotime($end_time__))));
            foreach ($period as $item) {
                $new = new SetPricesDaysSlots();
                $new->dome_id = $getdomedata->id;
                $new->date = date('Y-m-d', strtotime($request->date));
                $new->start_time = $item->format("H:i");
                $new->sport_id = $request->sport_id;
                $new->end_time = $item->addMinutes($my_interval)->format("H:i");
                $new->day = strtolower(date('l', strtotime($request->date)));
                $new->price = Helper::get_dome_price($request->dome_id, $request->sport_id);
                $new->status = 1;
                $new->save();
            }
            $data1 = SetPricesDaysSlots::where('dome_id', $getdomedata->id)->where('sport_id', $request->sport_id)->whereDate('date', date('Y-m-d', strtotime($request->date)))->orderByDesc('id')->first();

            $end_time__ = $getdomedata->day_working_hours($request->date)->close_time;
            $working_end_time = Carbon::parse($end_time__);
            $last_slot_end_time = Carbon::parse($data1->end_time);

            if ($last_slot_end_time->lt($working_end_time)) {
                $new = new SetPricesDaysSlots();
                $new->dome_id = $getdomedata->id;
                $new->date = date('Y-m-d', strtotime($request->date));
                $new->start_time = $last_slot_end_time->format("H:i");
                $new->end_time = $working_end_time->format("H:i");
                $new->sport_id = $request->sport_id;
                $new->day = strtolower(date('l', strtotime($request->date)));
                $new->price = Helper::get_dome_price($request->dome_id, $request->sport_id);
                $new->status = 1;
                $new->save();
            }
        }
        $data = SetPricesDaysSlots::where('dome_id', $getdomedata->id)->where('sport_id', $request->sport_id)->whereDate('date', date('Y-m-d', strtotime($request->date)))->get();
        $req_date = Carbon::parse($request->date);
        $slots = [];

        foreach ($data as $key => $slot) {
            $new_slot = date('h:i A', strtotime($slot->start_time)) . ' - ' . date('h:i A', strtotime($slot->end_time));

            $status = $slot->status;

            $arr = [];
            $maintenancefields = Field::where('in_maintenance', 1)
                ->where('dome_id', $request->dome_id)
                ->whereRaw("find_in_set('" . $request->sport_id . "',sport_id)")
                ->where('in_maintenance', 1)
                ->whereDate('maintenance_date', '=', date('Y-m-d', strtotime($request->date)))
                ->pluck('id')->toArray();
            if (count($maintenancefields) > 0) {
                array_push($arr, $maintenancefields);
            }

            $fields_booked = Booking::where('dome_id', $request->dome_id)
                ->where('sport_id', $request->sport_id)
                ->whereDate('start_date', date('Y-m-d', strtotime($request->date)))
                ->whereRaw("find_in_set('" . $new_slot . "',slots)")
                ->where('booking_status', '!=', 3)
                ->pluck('field_id')->toArray();

            foreach ($fields_booked as $key => $fields) {
                foreach (explode(',', $fields) as $key => $field_id) {
                    $arr[] = $field_id;
                }
            }


            $getdata = League::select('name', 'start_date', 'end_date', 'start_time', 'end_time', 'field_id')
                ->where('dome_id', $getdomedata->id)
                ->where('sport_id', $request->sport_id)
                ->where('is_deleted', 2)
                ->whereRaw('? BETWEEN start_date AND end_date', [date('Y-m-d', strtotime($request->date))])
                ->whereRaw("FIND_IN_SET(?, REPLACE(days, ' | ', ','))", [$req_date->format('D')])
                ->get();
            foreach ($getdata as $key => $league) {
                $league_start_time = Carbon::parse(date('H:i', strtotime($league->start_time)));
                $league_end_time = Carbon::parse(date('H:i', strtotime($league->end_time)));
                $slot_start_time = Carbon::parse($slot->start_time);
                $slot_end_time = Carbon::parse($slot->end_time);
                if ($slot_start_time->between($league_start_time, $league_end_time) || $slot_end_time->between($league_start_time, $league_end_time)) {
                    if (($slot_start_time->gt($league_start_time) && $slot_start_time->lt($league_end_time)) || ($slot_end_time->gt($league_start_time) && $slot_end_time->lt($league_end_time))) {
                        foreach (explode(',', $league->field_id) as $key => $field_id) {
                            $arr[] = $field_id;
                        }
                    }
                }
            }

            $total_fields = Field::where('dome_id', $request->dome_id)
                ->whereNotIn('id', $arr)
                ->whereRaw("find_in_set('" . $request->sport_id . "',sport_id)")
                ->where('is_available', 1)
                ->where('is_deleted', 2)
                ->count();

            if ($total_fields <= 0) {
                $status = 0;
            }

            $slots[] = [
                'slot' => $new_slot,
                'price' => $slot->price,
                'status' => $status,
                'current_time' => Carbon::now()->setTimezone(env('SET_TIMEZONE'))->toDateTimeString(),
            ];
        }
        return response()->json(["status" => 1, "message" => "Successful", 'data' => $slots], 200);
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
        $bookedfields = $leaguefields = [];
        $req_date = Carbon::parse($request->date);
        foreach (explode(',', $request->slots) as $new_slot) {

            $fields_booked = Booking::where('dome_id', $request->dome_id)
                ->where('sport_id', $request->sport_id)
                ->whereDate('start_date', date('Y-m-d', strtotime($request->date)))
                ->whereRaw("find_in_set('" . $new_slot . "',slots)")
                ->where('booking_status', '!=', 3)
                ->pluck('field_id')->toArray();
            foreach ($fields_booked as $key => $fields) {
                foreach (explode(',', $fields) as $key => $field_id) {
                    $bookedfields[] = $field_id;
                }
            }

            $getdata = League::select('name', 'start_date', 'end_date', 'start_time', 'end_time', 'field_id')
                ->where('dome_id', $request->dome_id)
                ->where('sport_id', $request->sport_id)
                ->where('is_deleted', 2)
                ->whereRaw('? BETWEEN start_date AND end_date', [date('Y-m-d', strtotime($request->date))])
                ->whereRaw("FIND_IN_SET(?, REPLACE(days, ' | ', ','))", [$req_date->format('D')])
                ->get();
            foreach ($getdata as $key => $league) {
                $league_start_time = Carbon::parse(date('H:i', strtotime($league->start_time)));
                $league_end_time = Carbon::parse(date('H:i', strtotime($league->end_time)));
                $slot_start_time = Carbon::parse(explode(' - ', $new_slot)[0]);
                $slot_end_time = Carbon::parse(explode(' - ', $new_slot)[1]);
                if ($slot_start_time->between($league_start_time, $league_end_time) || $slot_end_time->between($league_start_time, $league_end_time)) {
                    if (($slot_start_time->gt($league_start_time) && $slot_start_time->lt($league_end_time)) || ($slot_end_time->gt($league_start_time) && $slot_end_time->lt($league_end_time))) {
                        foreach (explode(',', $league->field_id) as $key => $field_id) {
                            $leaguefields[] = $field_id;
                        }
                    }
                }
            }
        }
        $maintenancefields = Field::where('in_maintenance', 1)
            ->where('dome_id', $request->dome_id)
            ->whereRaw("find_in_set('" . $request->sport_id . "',sport_id)")
            ->where('in_maintenance', 1)
            ->whereDate('maintenance_date', '=', date('Y-m-d', strtotime($request->date)))
            ->pluck('id')->toArray();
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
        if (count($leaguefields) > 0) {
            $available_fields = $available_fields->whereNotIn('id', $leaguefields);
        }
        if (count($maintenancefields) > 0) {
            $available_fields = $available_fields->whereNotIn('id', $maintenancefields);
        }
        $available_fields = $available_fields->get();
        return response()->json(["status" => 1, "message" => "Successful", 'fields' => $available_fields], 200);
    }
}
