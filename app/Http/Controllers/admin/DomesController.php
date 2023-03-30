<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Sports;
use Illuminate\Http\Request;
use App\Models\Domes;
use App\Models\DomeImages;
use App\Models\Enquiries;
use App\Models\SetPrices;
use Carbon\Carbon;
use Carbon\CarbonImmutable;

class DomesController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->type == 1) {
            $domes = Domes::with('dome_image', 'dome_owner')->where('is_deleted', 2)->get();
            $domes_count = 0;
        } else {
            $domes = Domes::with('dome_image')->where('vendor_id', auth()->user()->type == 2 ? auth()->user()->id : auth()->user()->vendor_id)->where('is_deleted', 2)->get();
            $domes_count = Domes::where('vendor_id', auth()->user()->type == 2 ? auth()->user()->id : auth()->user()->vendor_id)->count();
        }
        $sports = Sports::where('is_available', 1)->where('is_deleted', 2)->get();
        return view('admin.domes.index', compact('domes', 'sports', 'domes_count'));
    }

    public function add(Request $request)
    {
        $getsportslist = Sports::where('is_available', 1)->where('is_deleted', 2)->get();
        return view('admin.domes.add', compact('getsportslist'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sport_id' => 'required',
            'dome_name' => 'required',
            'dome_price' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'description' => 'required',
            'address' => 'required',
            // 'lat' => 'required',
            // 'lng' => 'required',
            // 'pin_code' => 'required',
            // 'city' => 'required',
            // 'state' => 'required',
            // 'country' => 'required',
        ], [
            'sport_id.required' => trans('messages.select_sport'),
            'dome_name.required' => trans('messages.name_required'),
            'dome_price.required' => trans('messages.price_required'),
            'start_time.required' => trans('messages.start_time_required'),
            'end_time.required' => trans('messages.end_time_required'),
            'description.required' => trans('messages.description_required'),
            'address.required' => trans('messages.address_required'),
            // 'lat.required' => 'Please Choose Dome Location',
            // 'lng.required' => 'Please Choose Dome Location',
            // 'pin_code.required' => 'Please Enter Pin Code',
            // 'city.required' => 'Please Enter City',
            // 'state.required' => 'Please Enter State',
            // 'country.required' => 'Please Enter Country',
        ]);

        $dome = new Domes();
        $dome->vendor_id = auth()->user()->id;
        $dome->sport_id = implode(",", $request->sport_id);
        $dome->name = $request->dome_name;
        $dome->price = 0;
        $dome->address = $request->address;
        $dome->start_time = $request->start_time;
        $dome->end_time = $request->end_time;
        $dome->description = $request->description;
        $dome->lat = $request->lat;
        $dome->lng = $request->lng;
        $dome->pin_code = $request->pin_code;
        $dome->city = $request->city;
        $dome->state = $request->state;
        $dome->country = $request->country;
        $dome->benefits = implode("|", $request->benefits);
        $dome->benefits_description = $request->benefits_description;
        $dome->save();

        if ($request->has('dome_images')) {
            $request->validate([
                'dome_images.*' => 'mimes:png,jpg,jpeg,svg',
            ], [
                'dome_images.mimes' => trans('messages.valid_image_type'),
            ]);
            foreach ($request->file('dome_images') as $img) {
                $domeimage = new DomeImages;
                $image = 'dome-' . uniqid() . '.' . $img->getClientOriginalExtension();
                $img->move('storage/app/public/admin/images/domes', $image);
                $domeimage->vendor_id = auth()->user()->id;
                $domeimage->dome_id = $dome->id;
                $domeimage->images = $image;
                $domeimage->save();
            }
        }
        foreach ($request->sport_id as $key => $sport) {
            $checksportexist =  SetPrices::where('dome_id', $dome->id)->where('sport_id', $sport)->first();
            if (empty($checksportexist)) {
                $setprice = new SetPrices();
                $setprice->vendor_id = auth()->user()->id;
            }
            $setprice->price_type = 1;
            $setprice->price = $request->dome_price[$key];
            $setprice->dome_id = $dome->id;
            $setprice->sport_id = $sport;
            $setprice->start_date = '';
            $setprice->end_date = '';
            $setprice->save();
        }
        return redirect('admin/domes')->with('success', trans('messages.success'));
    }

    public function dome_details(Request $request)
    {
        $getdomedata = Domes::find($request->id);
        $now = CarbonImmutable::today();
        $weekStartDate = $now->startOfWeek();
        $weekEndDate = $now->endOfWeek();

        if ($request->filtertype == "this_month") {
            // For Bookings Overview Chart
            $total_bookings = Booking::where('dome_id', $getdomedata->id)->whereMonth('created_at', Carbon::now()->month)->count();
            $total_bookings_data = Booking::where('dome_id', $getdomedata->id)->selectRaw('
            CASE
                WHEN booking_status = "1" THEN "Confirmed Bookings"
                WHEN booking_status = "2" THEN "Pending Bookings"
                WHEN booking_status = "3" THEN "Cancelled Bookings"
            END as status,
            CASE
                WHEN booking_status = "1" THEN "primary_color"
                WHEN booking_status = "2" THEN "secondary_color"
                WHEN booking_status = "3" THEN "danger_color"
            END as colors,
            COUNT(*) as total')->whereMonth('created_at', Carbon::now()->month)->groupBy('booking_status')->orderBy('booking_status')->get();
            $bokingschartdata = [];
            foreach ($total_bookings_data as $d) {
                $bokingschartdata[] = [
                    'name' => $d->status,
                    'data' => $d->total,
                    'colors' => $d->colors
                ];
            }
        } elseif ($request->filtertype == "this_year") {
            // For Bookings Overview Chart
            $total_bookings = Booking::where('dome_id', $getdomedata->id)->whereYear('created_at', Carbon::now()->year)->count();
            $total_bookings_data = Booking::where('dome_id', $getdomedata->id)->selectRaw('
            CASE
                WHEN booking_status = "1" THEN "Confirmed Bookings"
                WHEN booking_status = "2" THEN "Pending Bookings"
                WHEN booking_status = "3" THEN "Cancelled Bookings"
            END as status,
            CASE
                WHEN booking_status = "1" THEN "primary_color"
                WHEN booking_status = "2" THEN "secondary_color"
                WHEN booking_status = "3" THEN "danger_color"
            END as colors,
            COUNT(*) as total')->whereYear('created_at', Carbon::now()->year)->groupBy('booking_status')->orderBy('booking_status')->get();
            $bokingschartdata = [];
            foreach ($total_bookings_data as $d) {
                $bokingschartdata[] = [
                    'name' => $d->status,
                    'data' => $d->total,
                    'colors' => $d->colors
                ];
            }
        } elseif ($request->filtertype == "custom_date") {
            $weekStartDate = explode(' to ', $request->filterdates)[0];
            $weekEndDate = explode(' to ', $request->filterdates)[1];
            // For Bookings Overview Chart
            $total_bookings = Booking::where('dome_id', $getdomedata->id)->whereBetween('created_at', [$weekStartDate, $weekEndDate])->count();
            $total_bookings_data = Booking::where('dome_id', $getdomedata->id)->selectRaw('
            CASE
                WHEN booking_status = "1" THEN "Confirmed Bookings"
                WHEN booking_status = "2" THEN "Pending Bookings"
                WHEN booking_status = "3" THEN "Cancelled Bookings"
            END as status,
            CASE
                WHEN booking_status = "1" THEN "primary_color"
                WHEN booking_status = "2" THEN "secondary_color"
                WHEN booking_status = "3" THEN "danger_color"
            END as colors,
            COUNT(*) as total')->whereBetween('created_at', [$weekStartDate, $weekEndDate])->groupBy('booking_status')->orderBy('booking_status')->get();
            $bokingschartdata = [];
            foreach ($total_bookings_data as $d) {
                $bokingschartdata[] = [
                    'name' => $d->status,
                    'data' => $d->total,
                    'colors' => $d->colors
                ];
            }
        } else {
            // For Bookings Overview Chart
            $total_bookings = Booking::where('dome_id', $getdomedata->id)->whereBetween('created_at', [$weekStartDate, $weekEndDate])->count();
            $total_bookings_data = Booking::where('dome_id', $getdomedata->id)->selectRaw('
            CASE
                WHEN booking_status = "1" THEN "Confirmed Bookings"
                WHEN booking_status = "2" THEN "Pending Bookings"
                WHEN booking_status = "3" THEN "Cancelled Bookings"
            END as status,
            CASE
                WHEN booking_status = "1" THEN "primary_color"
                WHEN booking_status = "2" THEN "secondary_color"
                WHEN booking_status = "3" THEN "danger_color"
            END as colors,
            COUNT(*) as total')->whereBetween('created_at', [$weekStartDate, $weekEndDate])->groupBy('booking_status')->orderBy('booking_status')->get();
            $bokingschartdata = [];
            foreach ($total_bookings_data as $d) {
                $bokingschartdata[] = [
                    'name' => $d->status,
                    'data' => $d->total,
                    'colors' => $d->colors
                ];
            }
        }
        $bookings_labels = collect($bokingschartdata)->pluck('name');
        $bookings_data = collect($bokingschartdata)->pluck('data');
        $bookings_data_colors = collect($bokingschartdata)->pluck('colors');
        if (!empty($getdomedata)) {
            if ($request->ajax()) {
                return response()->json(['total_bookings' => $total_bookings, 'bookings_labels' => $bookings_labels, 'bookings_data' => $bookings_data, 'bookings_data_colors' => $bookings_data_colors]);
            } else {
                $getsportslist = Sports::whereIn('id', explode(',', $getdomedata->sport_id))->where('is_available', 1)->where('is_deleted', 2)->get();
                return view('admin.domes.view', compact('getdomedata', 'getsportslist', 'total_bookings', 'bookings_labels', 'bookings_data', 'bookings_data_colors'));
            }
        }
        return redirect('/admin/domes');
    }

    public function edit(Request $request)
    {
        $dome = Domes::with('dome_images')->find($request->id);
        $getsportslist = Sports::where('is_available', 1)->where('is_deleted', 2)->get();
        return view('admin.domes.edit', compact('dome', 'getsportslist'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'sport_id' => 'required',
            'dome_name' => 'required',
            'dome_price' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'description' => 'required',
            'address' => 'required',
            // 'lat' => 'required',
            // 'lng' => 'required',
            // 'pin_code' => 'required',
            // 'city' => 'required',
            // 'state' => 'required',
            // 'country' => 'required',
        ], [
            'sport_id.required' => trans('messages.select_sport'),
            'dome_name.required' => trans('messages.name_required'),
            'dome_price.required' => trans('messages.price_required'),
            'start_time.required' => trans('messages.start_time_required'),
            'end_time.required' => trans('messages.end_time_required'),
            'description.required' => trans('messages.description_required'),
            'address.required' => trans('messages.address_required'),
            // 'lat.required' => 'Please Choose Dome Location',
            // 'lng.required' => 'Please Choose Dome Location',
            // 'pin_code.required' => 'Please Enter Pin Code',
            // 'city.required' => 'Please Enter City',
            // 'state.required' => 'Please Enter State',
            // 'country.required' => 'Please Enter Country',
        ]);

        $dome = Domes::find($request->id);
        $dome->sport_id = implode(",", $request->sport_id);
        $dome->name = $request->dome_name;
        $dome->price = $request->dome_price;
        $dome->address = $request->address;
        $dome->pin_code = $request->pin_code;
        $dome->city = $request->city;
        $dome->state = $request->state;
        $dome->country = $request->country;
        $dome->start_time = $request->start_time;
        $dome->end_time = $request->end_time;
        $dome->description = $request->description;
        $dome->lat = $request->lat;
        $dome->lng = $request->lng;
        $dome->benefits = implode("|", $request->benefits);
        $dome->benefits_description    = $request->benefits_description;
        $dome->save();

        if ($request->has('dome_images')) {
            $request->validate([
                'dome_images.*' => 'image|mimes:png,jpg,jpeg,svg',
            ], [
                'dome_images.image' => trans('messages.valid_image'),
                'dome_images.mimes' => trans('messages.valid_image_type'),
            ]);
            foreach ($request->file('dome_images') as $img) {
                $domeimage = new DomeImages;
                $image = 'dome-' . uniqid() . '.' . $img->getClientOriginalExtension();
                $img->move('storage/app/public/admin/images/domes', $image);
                $domeimage->vendor_id = auth()->user()->id;
                $domeimage->dome_id = $dome->id;
                $domeimage->images = $image;
                $domeimage->save();
            }
        }
        return redirect('admin/domes')->with('success', trans('messages.success'));
    }

    public function delete(Request $request)
    {
        try {
            $checkdome = Domes::find($request->id);
            $checkdome->is_deleted = 1;
            $checkdome->save();
            return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
        }
    }

    public function image_delete(Request $request)
    {
        $image = DomeImages::find($request->id);
        unlink('storage/app/public/admin/images/domes/' . $image->images);
        $image->delete();
        return 1;
    }
    public function new_request(Request $request)
    {
        try {
            $enquiry = new Enquiries;
            $enquiry->type = 3;
            $enquiry->name = auth()->user()->name;
            $enquiry->email = auth()->user()->email;
            $enquiry->phone = auth()->user()->phone;
            $enquiry->dome_name = $request->dome_name;
            $enquiry->dome_zipcode = $request->dome_zipcode;
            $enquiry->dome_city = $request->dome_city;
            $enquiry->dome_state = $request->dome_state;
            $enquiry->dome_country = $request->dome_country;
            $enquiry->save();
            return redirect()->back()->with('success', trans('messages.success'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', trans('messages.error'));
        }
    }
}
