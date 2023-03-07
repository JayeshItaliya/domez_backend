<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Domes;
use App\Models\SetPrices;
use App\Models\SetPricesDaysSlots;
use Illuminate\Http\Request;

class DomesPriceController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.set_prices.index');
    }
    public function add(Request $request)
    {
        $getdomeslist = Domes::where('vendor_id', auth()->user()->id)->where('is_deleted', 2)->orderByDesc('id')->get();
        return view('admin.set_prices.add',compact('getdomeslist'));
    }
    public function store(Request $request)
    {
        $set_prices = new SetPrices();
        $set_prices->dome_id = $request->dome;
        $set_prices->sport_id = $request->sport;
        $set_prices->start_date = $request->start_date;
        $set_prices->end_date = $request->end_date;
        $set_prices->price_type = 2;
        $set_prices->price = 0;
        $set_prices->save();

        foreach ($request->daynames as $daynamekey => $dayname) {

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
                $slots = new SetPricesDaysSlots();
                $slots->set_prices_id = $set_prices->id;
                $slots->start_time = $data;
                $slots->end_time = $endtimearray[$key];
                $slots->day = $dayname;
                $slots->price = $pricearay[$key];
                $slots->save();
            }
        }

        return view('admin.set_prices.add',compact('getdomeslist'));
    }
    public function edit(Request $request)
    {
        return view('admin.set_prices.edit');
    }
    public function dome_price_details(Request $request)
    {
        return view('admin.set_prices.view');
    }
}
