<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BookingSlots;
use App\Models\Domes;
use App\Models\SetPrices;
use App\Models\SetPricesDaysSlots;
use App\Models\Sports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class DomesPriceController extends Controller
{
    public function index(Request $request)
    {
        $getsetpriceslist = SetPrices::where('vendor_id', auth()->user()->type == 2 ? auth()->user()->id : auth()->user()->vendor_id)->where('price_type', 2)->orderByDesc('id')->get();
        return view('admin.set_prices.index', compact('getsetpriceslist'));
    }
    public function add(Request $request)
    {
        $getdomeslist = Domes::where('vendor_id', auth()->user()->type == 2 ? auth()->user()->id : auth()->user()->vendor_id)->where('is_deleted', 2)->orderByDesc('id')->get();
        return view('admin.set_prices.add', compact('getdomeslist'));
    }
    public function store(Request $request)
    {

        // SetPricesDaysSlots == status == 1 == Available (Full)
        // SetPricesDaysSlots == status == 2 == occupied
        // SetPricesDaysSlots == status == 3 == Half Available

        try {
            if ($request->has('id') && $request->id != "") {
                SetPricesDaysSlots::where('set_prices_id', $request->id)->delete();
                $set_prices = SetPrices::find($request->id);
            } else {
                $set_prices = new SetPrices();
                $set_prices->vendor_id = auth()->user()->type == 2 ? auth()->user()->id : auth()->user()->vendor_id;
                $set_prices->price_type = 2;
            }
            $set_prices->dome_id = $request->dome;
            $set_prices->sport_id = $request->sport;
            $set_prices->start_date = $request->start_date;
            $set_prices->end_date = $request->end_date;
            $set_prices->save();

            $start_date = Carbon::parse($request->start_date);
            $end_date = Carbon::parse($request->end_date);
            for ($date = $start_date; $date->lte($end_date); $date->addDay()) {
                foreach ($request->daynames as $daynamekey => $dayname) {
                    if ($dayname == strtolower($date->format('l'))) {
                        $starttimearray = $endtimearray = $pricearay = [];
                        foreach ($request->start_time[$dayname] as $starttimekey => $starttime) {
                            $starttimearray[] = $starttime;
                        }
                        foreach ($request->end_time[$dayname] as $endtimekey => $endtime) {
                            $endtimearray[] = $endtime;
                        }
                        foreach ($request->price[$dayname] as $pricekey => $price) {
                            $pricearay[] = $price;
                        }
                        foreach ($starttimearray as $key => $data) {
                            $checkexist = SetPricesDaysSlots::where('dome_id', $request->dome)->where('sport_id', $request->sport)->whereDate('date', date('Y-m-d', strtotime($request->date)))->count();
                            if ($checkexist == 0) {
                                $slots = new SetPricesDaysSlots();
                                $slots->set_prices_id = $set_prices->id;
                                $slots->dome_id = $request->dome;
                                $slots->sport_id = $request->sport;
                                $slots->date = $date->format('Y-m-d');
                                $slots->start_time = Carbon::createFromFormat('h:i A', $data)->format('H:i');
                                $slots->end_time = Carbon::createFromFormat('h:i A', $endtimearray[$key])->format('H:i');
                                $slots->day = $dayname;
                                $slots->price = $pricearay[$key];
                                $slots->status = 1;
                                $slots->save();
                            }
                        }
                    }
                }
            }

            return redirect('admin/set-prices')->with('success', trans('messages.success'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', trans('messages.wrong'));
        }
    }
    public function getsportslist(Request $request)
    {
        try {
            $getdomedata = Domes::where('id', $request->id)->where('vendor_id', auth()->user()->type == 2 ? auth()->user()->id : auth()->user()->vendor_id)->where('is_deleted', 2)->first();
            if (!empty($getdomedata)) {
                $getexists = SetPrices::where('dome_id', $request->id)->where('price_type', 2)->select('sport_id')->get()->toArray();
                $sports = Sports::whereIn('id', explode(',', $getdomedata->sport_id));
                // if ($request->has('type') && $request->type == 'add') {
                //     $sports = $sports->whereNotIn('id', $getexists);
                // }
                $sports = $sports->where('is_available', 1)->where('is_deleted', 2)->orderByDesc('id')->get();
                return response()->json(['status' => 1, 'message' => trans('messages.success'), 'sportsdata' => $sports], 200);
            }
            return response()->json(['status' => 0, 'message' => trans('messages.invalid_dome')], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
        }
    }
    public function edit(Request $request)
    {
        $getslotpricedata = SetPrices::find($request->id);
        $getdomeslist = Domes::where('vendor_id', auth()->user()->type == 2 ? auth()->user()->id : auth()->user()->vendor_id)->where('is_deleted', 2)->orderByDesc('id')->get();
        $getslots = SetPricesDaysSlots::where('set_prices_id', $request->id)->select('day')->groupBy(DB::raw('day'))->orderBy('id')->get();
        $getdaysslots = [];
        foreach ($getslots as $key => $day) {
            $slots = SetPricesDaysSlots::select('id', 'start_time', 'end_time', 'price')->where('set_prices_id', $request->id)->where('day', $day->day)->orderBy('id')->get();
            $getdaysslots[] = [
                'day' => $day->day,
                'slots' => $slots,
            ];
        }
        return view('admin.set_prices.edit', compact('getslotpricedata', 'getdaysslots', 'getdomeslist'));
    }
    public function validate_start_end_time(Request $request)
    {
        if ($request->dome_id == "") {
            return response()->json(["status" => 0, "message" => trans('messages.select_dome')], 200);
        }
        $checkdome = Domes::where('id', $request->dome_id)->where('is_deleted', 2)->first();
        if (!empty($checkdome)) {
            if ($request->has('validate_start_time') && $request->validate_start_time == 1) {
                $validator = Validator::make($request->input(), [
                    'start_time' => 'required|date_format:h:i A|after_or_equal:' . $checkdome->start_time,
                ], [
                    'start_time.required' => trans('messages.start_time_required'),
                    'start_time.date_format' => trans('messages.valid_time_format'),
                    'start_time.after_or_equal' => trans('messages.start_time_afterequal_dome_start_time') . ' : ' . $checkdome->start_time,
                ]);
                foreach ($validator->errors()->toArray() as $key => $error) {
                    return response()->json(["status" => 0, "message" => $error[0]], 200);
                    if ($key == 0)
                        break;
                }
            } else {
                $validator = Validator::make($request->input(), [
                    'start_time' => 'required|date_format:h:i A',
                    'end_time' => 'required|date_format:h:i A|after:start_time|before:' . $checkdome->end_time,
                ], [
                    'start_time.required' => trans('messages.start_time_required'),
                    'end_time.required' => trans('messages.end_time_required'),
                    'start_time.date_format' => trans('messages.valid_time_format'),
                    'end_time.date_format' => trans('messages.valid_time_format'),
                    'end_time.after' => trans('messages.end_time_must_after_start_time'),
                    'end_time.before' => trans('messages.end_time_must_before_dome_end') . ' : ' . $checkdome->end_time,
                ]);
                foreach ($validator->errors()->toArray() as $key => $error) {
                    return response()->json(["status" => 0, "message" => $error[0]], 200);
                    if ($key == 0)
                        break;
                }
            }
        } else {
            return response()->json(["status" => 0, "message" => trans('messages.invalid_dome')], 200);
        }
        return response()->json(["status" => 1, "message" => trans('messages.success')], 200);
    }
    public function deleteslot(Request $request)
    {
        try {
            SetPricesDaysSlots::find($request->id)->delete();
            return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
        }
    }
    public function deletesetprice(Request $request)
    {
        try {
            SetPrices::find($request->id)->delete();
            SetPricesDaysSlots::where('set_prices_id', $request->id)->delete();
            return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
        }
    }
}
