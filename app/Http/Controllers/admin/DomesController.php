<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Helper\Helper;
use App\Models\Booking;
use App\Models\Sports;
use Illuminate\Http\Request;
use App\Models\Domes;
use App\Models\DomeImages;
use App\Models\Enquiries;
use App\Models\Favourite;
use App\Models\Field;
use App\Models\League;
use App\Models\SetPrices;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use App\Models\DomeDiscounts;
use App\Models\DomeFieldDiscounts;
use App\Models\WorkingHours;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class DomesController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->type == 1) {
            $domes = Domes::with('dome_image', 'dome_owner')->NotDeleted()->get();
            $domes_count = 0;
        } else {
            $domes = Domes::with('dome_image')->where('vendor_id', auth()->user()->type == 2 ? auth()->user()->id : auth()->user()->vendor_id)->NotDeleted()->get();
            $domes_count = Domes::where('vendor_id', auth()->user()->type == 2 ? auth()->user()->id : auth()->user()->vendor_id)->count();
        }
        $sports = Sports::Available()->NotDeleted()->get();
        return view('admin.domes.index', compact('domes', 'sports', 'domes_count'));
    }
    public function add(Request $request)
    {
        if (Domes::where('vendor_id', auth()->user()->id)->count() < auth()->user()->dome_limit) {
            $getsportslist = Sports::Available()->NotDeleted()->get();
            return view('admin.domes.add', compact('getsportslist'));
        } else {
            return redirect('admin/domes')->with('error', trans('messages.invalid_request'));
        }
    }
    public function store(Request $request)
    {
        if (Domes::where('vendor_id', auth()->user()->id)->count() >= auth()->user()->dome_limit) {
            return response()->json(['status' => 0, 'message' => trans('messages.dome_limit_exceeded'),], 200);
        }

        $validator = Validator::make($request->input(), [
            'sport_id' => 'required',
            'dome_name' => 'required',
            'dome_hst' => 'required',
            'dome_price' => 'required',
            'description' => 'required',
            'address' => 'required',
            'benefits' => 'array',
            'benefits.*' => 'in:Free Wifi,Changing Room,Parking,Pool,Others',
        ], [
            'sport_id.required' => trans('messages.select_sport'),
            'dome_name.required' => trans('messages.name_required'),
            'dome_hst.required' => trans('messages.hst_required'),
            'dome_price.required' => trans('messages.price_required'),
            'description.required' => trans('messages.description_required'),
            'address.required' => trans('messages.address_required'),
        ]);
        foreach ($validator->errors()->toArray() as $key => $error) {
            return response()->json(["status" => 0, "message" => $error[0]], 200);
            if ($key == 0)
                break;
        }
        DB::beginTransaction();
        try {
            $dome = new Domes();
            $dome->vendor_id = auth()->user()->id;
            $dome->sport_id = implode(",", $request->sport_id);
            $dome->name = $request->dome_name;
            $dome->hst = $request->dome_hst;
            $dome->price = 0;
            $dome->address = $request->address;
            $dome->description = $request->description;
            $dome->lat = $request->lat;
            $dome->lng = $request->lng;
            $dome->pin_code = $request->pin_code;
            $dome->city = $request->city;
            $dome->state = $request->state;
            $dome->country = $request->country;
            $dome->slot_duration = $request->slot_duration;
            $dome->benefits = $request->benefits != '' ? implode("|", $request->benefits) : '';
            $dome->benefits_description = $request->benefits_description;

            // $dome->multiple_fields_selection = $request->multiple_fields_selection;
            // $dome->fields_discount = $request->fields_discount;
            // $dome->fields_discount_type = $request->fields_discount_type;

            $dome->booking_mode = $request->booking_mode ?? 1;
            $dome->policies_rules = $request->policies_rules;
            $dome->save();
            foreach ($request->day as $key => $dayname) {
                $wh = new WorkingHours();
                $wh->vendor_id = auth()->user()->id;
                $wh->dome_id = $dome->id;
                $wh->day = strtolower($dayname);
                $wh->open_time = $request->open_time[$key];
                $wh->close_time = $request->close_time[$key];
                $wh->is_closed = $request->is_closed[$key];
                $wh->save();
            }
            if ($request->has('dome_images')) {
                $validator = Validator::make($request->input(), [
                    'dome_images.*' => 'mimes:png,jpg,jpeg,svg|max:7168',
                ], [
                    'dome_images.image' => trans('messages.valid_image'),
                    'dome_images.mimes' => trans('messages.valid_image_type'),
                    'dome_images.max' => trans('messages.valid_image_size'),
                ]);
                foreach ($validator->errors()->toArray() as $key => $error) {
                    return response()->json(["status" => 0, "message" => $error[0]], 200);
                    if ($key == 0)
                        break;
                }
                foreach ($request->file('dome_images') as $img) {
                    $domeimage = new DomeImages();
                    $image = 'dome-' . uniqid() . '.' . $img->getClientOriginalExtension();
                    $img->move('storage/app/public/admin/images/domes', $image);
                    $domeimage->dome_id = $dome->id;
                    $domeimage->images = $image;
                    $domeimage->save();
                }
            }
            foreach ($request->sport_id as $key => $sport) {
                $checksportexist =  SetPrices::where('dome_id', $dome->id)->where('sport_id', $sport)->where('price_type', 1)->first();
                if (empty($checksportexist)) {
                    $checksportexist = new SetPrices();
                    $checksportexist->vendor_id = auth()->user()->id;
                    $checksportexist->price_type = 1;
                }
                $checksportexist->price = $request->dome_price[$key];
                $checksportexist->dome_id = $dome->id;
                $checksportexist->sport_id = $sport;
                $checksportexist->start_date = null;
                $checksportexist->end_date = null;
                $checksportexist->save();
            }

            foreach ($request->discount_sport as $key => $sport) {
                if ((isset($request->number_of_fields[$key]) && $request->number_of_fields[$key] != "") && (isset($request->fields_discount[$key]) && $request->fields_discount[$key] != "") && (isset($request->fields_discount_type[$key]) && $request->fields_discount_type[$key] != "")) {
                    $dfd = new DomeFieldDiscounts();
                    $dfd->dome_id = $dome->id;
                    $dfd->sport_id = $sport;
                    $dfd->number_of_fields = $request->number_of_fields[$key];
                    $dfd->discount = $request->fields_discount[$key];
                    $dfd->discount_type = $request->fields_discount_type[$key];
                    $dfd->save();
                }
            }

            foreach ($request->from_age as $key => $from_age) {
                if ((isset($request->age_sport[$key]) && !empty($request->age_sport[$key])) && (isset($request->to_age[$key]) && !empty($request->to_age[$key]))  &&  (isset($request->age_discounts[$key]) && !empty($request->age_discounts[$key]))  &&  (isset($request->discount_type[$key]) && !empty($request->discount_type[$key]))) {
                    $dome_discounts = new DomeDiscounts();
                    $dome_discounts->dome_id = $dome->id;
                    $dome_discounts->sport_id = $request->age_sport[$key];
                    $dome_discounts->from_age = $from_age;
                    $dome_discounts->to_age = $request->to_age[$key];
                    $dome_discounts->age_discounts = $request->age_discounts[$key];
                    $dome_discounts->discount_type = $request->discount_type[$key];
                    $dome_discounts->save();
                }
            }
            DB::commit();
            return response()->json(['status' => 1, 'message' => trans('messages.success'), 'url' => URL::to('admin/domes')], 200);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['status' => 0, 'message' => trans('messages.wrong'),], 200);
        }
    }
    public function dome_details(Request $request)
    {
        $getdomedata = Domes::find($request->id);
        $now = CarbonImmutable::today();
        $weekStartDate = $now->startOfWeek();
        $weekEndDate = $now->endOfWeek();
        $confirmed_bookings = trans('labels.confirmed_bookings');
        $pending_bookings = trans('labels.pending_bookings');
        $cancelled_bookings = trans('labels.cancelled_bookings');
        if ($request->filtertype == "this_month") {
            // For Dome Revenue Chart
            $dome_revenue = Booking::where('dome_id', @$getdomedata->id)->where('booking_status', 1)->orderBy('created_at')->whereMonth('created_at', Carbon::now()->month)->sum('paid_amount') * 88 / 100;
            $dome_revenue_data = Booking::where('dome_id', @$getdomedata->id)->where('booking_status', 1)->orderBy('created_at')->whereMonth('created_at', Carbon::now()->month)->select(DB::raw('MONTHNAME(created_at) as titles'), DB::raw('SUM(paid_amount*88/100) as amount'))->groupBy('titles')->pluck('titles', 'amount');
            // For Bookings Overview Chart
            $total_bookings = Booking::where('dome_id', @$getdomedata->id)->whereMonth('created_at', Carbon::now()->month)->count();
            $total_bookings_data = Booking::where('dome_id', @$getdomedata->id)->selectRaw("
            CASE
                WHEN booking_status = '1' THEN '{$confirmed_bookings}'
                WHEN booking_status = '2' THEN '{$pending_bookings}'
                WHEN booking_status = '3' THEN '{$cancelled_bookings}'
            END as status,
            CASE
                WHEN booking_status = '1' THEN 'primary_color'
                WHEN booking_status = '2' THEN 'secondary_color'
                WHEN booking_status = '3' THEN 'danger_color'
            END as colors,
            COUNT(*) as total")->whereMonth('created_at', Carbon::now()->month)->groupBy('booking_status')->orderBy('booking_status')->get();
            $bokingschartdata = [];
            foreach ($total_bookings_data as $d) {
                $bokingschartdata[] = [
                    'name' => $d->status,
                    'data' => $d->total,
                    'colors' => $d->colors
                ];
            }
        } elseif ($request->filtertype == "this_year") {
            // For Dome Revenue Chart
            $dome_revenue = Booking::where('dome_id', @$getdomedata->id)->where('booking_status', 1)->orderBy('created_at')->whereYear('created_at', Carbon::now()->year)->sum('paid_amount') * 88 / 100;
            $dome_revenue_data = Booking::where('dome_id', @$getdomedata->id)->where('booking_status', 1)->orderBy('created_at')->whereYear('created_at', Carbon::now()->year)->select(DB::raw("MONTHNAME(created_at) as titles"), DB::raw('SUM(paid_amount*88/100) as amount'))->groupBy('titles')->pluck('titles', 'amount');
            // For Bookings Overview Chart
            $total_bookings = Booking::where('dome_id', @$getdomedata->id)->whereYear('created_at', Carbon::now()->year)->count();
            $total_bookings_data = Booking::where('dome_id', @$getdomedata->id)->selectRaw("
            CASE
                WHEN booking_status = '1' THEN '{$confirmed_bookings}'
                WHEN booking_status = '2' THEN '{$pending_bookings}'
                WHEN booking_status = '3' THEN '{$cancelled_bookings}'
            END as status,
            CASE
                WHEN booking_status = '1' THEN 'primary_color'
                WHEN booking_status = '2' THEN 'secondary_color'
                WHEN booking_status = '3' THEN 'danger_color'
            END as colors,
            COUNT(*) as total")->whereYear('created_at', Carbon::now()->year)->groupBy('booking_status')->orderBy('booking_status')->get();
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
            // For Dome Revenue Chart
            $dome_revenue = Booking::where('dome_id', @$getdomedata->id)->where('booking_status', 1)->orderBy('created_at')->whereBetween('created_at', [$weekStartDate, $weekEndDate])->sum('paid_amount') * 88 / 100;
            $dome_revenue_data = Booking::where('dome_id', @$getdomedata->id)->where('booking_status', 1)->orderBy('created_at')->whereBetween('created_at', [$weekStartDate, $weekEndDate])->select(DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as titles'), DB::raw('SUM(paid_amount*88/100) as amount'))->groupBy('titles')->pluck('titles', 'amount');
            // For Bookings Overview Chart
            $total_bookings = Booking::where('dome_id', @$getdomedata->id)->whereBetween('created_at', [$weekStartDate, $weekEndDate])->count();
            $total_bookings_data = Booking::where('dome_id', @$getdomedata->id)->selectRaw("
            CASE
                WHEN booking_status = '1' THEN '{$confirmed_bookings}'
                WHEN booking_status = '2' THEN '{$pending_bookings}'
                WHEN booking_status = '3' THEN '{$cancelled_bookings}'
            END as status,
            CASE
                WHEN booking_status = '1' THEN 'primary_color'
                WHEN booking_status = '2' THEN 'secondary_color'
                WHEN booking_status = '3' THEN 'danger_color'
            END as colors,
            COUNT(*) as total")->whereBetween('created_at', [$weekStartDate, $weekEndDate])->groupBy('booking_status')->orderBy('booking_status')->get();
            $bokingschartdata = [];
            foreach ($total_bookings_data as $d) {
                $bokingschartdata[] = [
                    'name' => $d->status,
                    'data' => $d->total,
                    'colors' => $d->colors
                ];
            }
        } else {
            // For Dome Revenue Chart
            $dome_revenue = Booking::where('dome_id', @$getdomedata->id)->where('booking_status', 1)->orderBy('created_at')->whereBetween('created_at', [$weekStartDate, $weekEndDate])->sum('paid_amount') * 88 / 100;
            $dome_revenue_data = Booking::where('dome_id', @$getdomedata->id)->where('booking_status', 1)->orderBy('created_at')->whereBetween('created_at', [$weekStartDate, $weekEndDate])->select(DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as titles'), DB::raw('SUM(paid_amount*88/100) as amount'))->groupBy('titles')->pluck('amount', 'titles');

            // For Bookings Overview Chart
            $total_bookings = Booking::where('dome_id', @$getdomedata->id)->whereBetween('created_at', [$weekStartDate, $weekEndDate])->count();
            $total_bookings_data = Booking::where('dome_id', @$getdomedata->id)->selectRaw("
            CASE
                WHEN booking_status = '1' THEN '{$confirmed_bookings}'
                WHEN booking_status = '2' THEN '{$pending_bookings}'
                WHEN booking_status = '3' THEN '{$cancelled_bookings}'
            END as status,
            CASE
                WHEN booking_status = '1' THEN 'primary_color'
                WHEN booking_status = '2' THEN 'secondary_color'
                WHEN booking_status = '3' THEN 'danger_color'
            END as colors,
            COUNT(*) as total")->whereBetween('created_at', [$weekStartDate, $weekEndDate])->groupBy('booking_status')->orderBy('booking_status')->get();
            $bokingschartdata = [];
            foreach ($total_bookings_data as $d) {
                $bokingschartdata[] = [
                    'name' => $d->status,
                    'data' => $d->total,
                    'colors' => $d->colors
                ];
            }
        }
        $dome_revenue_labels = $dome_revenue_data->keys();
        $dome_revenue_data = $dome_revenue_data->values();

        $bookings_labels = collect($bokingschartdata)->pluck('name');
        $bookings_data = collect($bokingschartdata)->pluck('data');
        $bookings_data_colors = collect($bokingschartdata)->pluck('colors');
        if (!empty($getdomedata)) {
            if ($request->ajax()) {
                return response()->json(['total_bookings' => $total_bookings, 'bookings_labels' => $bookings_labels, 'bookings_data' => $bookings_data, 'bookings_data_colors' => $bookings_data_colors, 'dome_revenue' => Helper::currency_format($dome_revenue), 'dome_revenue_labels' => $dome_revenue_labels, 'dome_revenue_data' => $dome_revenue_data]);
            } else {
                $getsportslist = Sports::whereIn('id', explode(',', @$getdomedata->sport_id))->Available()->NotDeleted()->get();
                return view('admin.domes.view', compact('getdomedata', 'getsportslist', 'total_bookings', 'bookings_labels', 'bookings_data', 'bookings_data_colors', 'dome_revenue', 'dome_revenue_labels', 'dome_revenue_data'));
            }
        }
        return redirect('admin/domes');
    }
    public function edit(Request $request)
    {
        $dome = Domes::with(['dome_images', 'dome_discounts', 'dome_field_discounts'])->find($request->id);
        abort_if(empty($dome), 404);
        $getsportslist = Sports::Available()->NotDeleted()->get();
        return view('admin.domes.edit', compact('dome', 'getsportslist'));
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->input(), [
            'sport_id' => 'required',
            'dome_name' => 'required',
            'dome_hst' => 'required',
            'dome_price' => 'required',
            'description' => 'required',
            'address' => 'required',
        ], [
            'sport_id.required' => trans('messages.select_sport'),
            'dome_name.required' => trans('messages.name_required'),
            'dome_hst.required' => trans('messages.hst_required'),
            'dome_price.required' => trans('messages.price_required'),
            'description.required' => trans('messages.description_required'),
            'address.required' => trans('messages.address_required'),
        ]);
        foreach ($validator->errors()->toArray() as $key => $error) {
            return response()->json(["status" => 0, "message" => $error[0]], 200);
            if ($key == 0)
                break;
        }
        DB::beginTransaction();
        try {
            $dome = Domes::find($request->id);
            $dome->sport_id = implode(",", $request->sport_id);
            $dome->name = $request->dome_name;
            $dome->hst = $request->dome_hst;
            $dome->price = $request->dome_price;
            $dome->address = $request->address;
            $dome->pin_code = $request->pin_code;
            $dome->city = $request->city;
            $dome->state = $request->state;
            $dome->country = $request->country;
            $dome->slot_duration = $request->slot_duration;
            $dome->description = $request->description;
            $dome->lat = $request->lat;
            $dome->lng = $request->lng;
            $dome->benefits = $request->benefits != '' ? implode("|", $request->benefits) : '';
            $dome->benefits_description = $request->benefits_description;

            // $dome->multiple_fields_selection = $request->multiple_fields_selection ?? 0;
            // $dome->fields_discount = $request->fields_discount ?? 0;
            // $dome->fields_discount_type = $request->fields_discount_type;

            $dome->booking_mode = $request->booking_mode ?? 1;
            $dome->policies_rules = $request->policies_rules;
            $dome->save();
            if ($request->has('dome_images')) {
                $validator = Validator::make($request->input(), [
                    'dome_images.*' => 'mimes:png,jpg,jpeg,svg|max:7168',
                ], [
                    'dome_images.image' => trans('messages.valid_image'),
                    'dome_images.mimes' => trans('messages.valid_image_type'),
                    'dome_images.max' => trans('messages.valid_image_size'),
                ]);
                foreach ($validator->errors()->toArray() as $key => $error) {
                    return response()->json(["status" => 0, "message" => $error[0]], 200);
                    if ($key == 0)
                        break;
                }
                foreach ($request->file('dome_images') as $img) {
                    $domeimage = new DomeImages();
                    $image = 'dome-' . uniqid() . '.' . $img->getClientOriginalExtension();
                    $img->move('storage/app/public/admin/images/domes', $image);
                    $domeimage->dome_id = $dome->id;
                    $domeimage->images = $image;
                    $domeimage->save();
                }
            }
            foreach ($request->sport_id as $key => $sport) {
                $checksportexist =  SetPrices::where('dome_id', $dome->id)->where('sport_id', $sport)->where('price_type', 1)->first();
                if (empty($checksportexist)) {
                    $checksportexist = new SetPrices();
                    $checksportexist->vendor_id = auth()->user()->id;
                    $checksportexist->price_type = 1;
                    $checksportexist->start_date = null;
                    $checksportexist->end_date = null;
                    $checksportexist->dome_id = $dome->id;
                    $checksportexist->sport_id = $sport;
                }
                $checksportexist->price = $request->dome_price[$key];
                $checksportexist->save();
            }


            if (isset($request->edit_discount_fields)) {
                foreach ($request->edit_discount_fields as $key => $did) {
                    if ((isset($request->edit_discount_sport[$key]) && $request->edit_discount_sport[$key] != "") && (isset($request->edit_number_of_fields[$key]) && $request->edit_number_of_fields[$key] != "") && (isset($request->edit_fields_discount[$key]) && $request->edit_fields_discount[$key] != "") && (isset($request->edit_fields_discount_type[$key]) && $request->edit_fields_discount_type[$key] != "")) {
                        $dfd = DomeFieldDiscounts::find($did);
                        if (!empty($dfd)) {
                            $dfd->sport_id = $request->edit_discount_sport[$key];
                            $dfd->number_of_fields = $request->edit_number_of_fields[$key];
                            $dfd->discount = $request->edit_fields_discount[$key];
                            $dfd->discount_type = $request->edit_fields_discount_type[$key];
                            $dfd->save();
                        }
                    }
                }
            }

            if (isset($request->discount_sport) && $request->filled('discount_sport')) {
                foreach ($request->discount_sport as $key => $sport) {
                    if ((isset($request->number_of_fields[$key]) && $request->number_of_fields[$key] != "") && (isset($request->fields_discount[$key]) && $request->fields_discount[$key] != "") && (isset($request->fields_discount_type[$key]) && $request->fields_discount_type[$key] != "")) {
                        $dfd = new DomeFieldDiscounts();
                        $dfd->dome_id = $dome->id;
                        $dfd->sport_id = $sport;
                        $dfd->number_of_fields = $request->number_of_fields[$key];
                        $dfd->discount = $request->fields_discount[$key];
                        $dfd->discount_type = $request->fields_discount_type[$key];
                        $dfd->save();
                    }
                }
            }


            if (isset($request->edit_discounts)) {
                foreach ($request->edit_discounts as $key => $did) {
                    if ((isset($request->edit_age_sport[$key]) && !empty($request->edit_age_sport[$key])) && (isset($request->edit_to_age[$key]) && !empty($request->edit_to_age[$key]))  &&  (isset($request->edit_age_discounts[$key]) && !empty($request->edit_age_discounts[$key]))  &&  (isset($request->edit_discount_type[$key]) && !empty($request->edit_discount_type[$key]))) {
                        $dome_discounts = DomeDiscounts::find($did);
                        if (!empty($dome_discounts)) {
                            $dome_discounts->from_age = $request->edit_from_age[$key];
                            $dome_discounts->sport_id = $request->edit_age_sport[$key];
                            $dome_discounts->to_age = $request->edit_to_age[$key];
                            $dome_discounts->age_discounts = $request->edit_age_discounts[$key];
                            $dome_discounts->discount_type = $request->edit_discount_type[$key];
                            $dome_discounts->save();
                        }
                    }
                }
            }

            if (isset($request->from_age)) {
                foreach ($request->from_age as $key => $from_age) {
                    if ((isset($request->age_sport[$key]) && !empty($request->age_sport[$key])) && (isset($request->to_age[$key]) && !empty($request->to_age[$key]))  &&  (isset($request->age_discounts[$key]) && !empty($request->age_discounts[$key]))  &&  (isset($request->discount_type[$key]) && !empty($request->discount_type[$key]))) {
                        $dome_discounts = new DomeDiscounts;
                        $dome_discounts->dome_id = $dome->id;
                        $dome_discounts->sport_id = $request->age_sport[$key];
                        $dome_discounts->from_age = $from_age;
                        $dome_discounts->to_age = $request->to_age[$key];
                        $dome_discounts->age_discounts = $request->age_discounts[$key];
                        $dome_discounts->discount_type = $request->discount_type[$key];
                        $dome_discounts->save();
                    }
                }
            }
            DB::commit();
            return response()->json(['status' => 1, 'message' => trans('messages.success'), 'url' => URL::to('admin/domes')], 200);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['status' => 0, 'message' => trans('messages.wrong'),], 200);
        }
    }
    public function delete(Request $request)
    {
        try {
            $checkdome = Domes::find($request->id);
            if (!empty($checkdome)) {
                $checkdome->is_deleted = 1;
                $checkdome->save();
                Favourite::where('dome_id', $checkdome->id)->delete();
                League::where('dome_id', $checkdome->id)->update(['is_deleted' => 1]);
                Field::where('dome_id', $checkdome->id)->update(['is_available' => 2, 'is_deleted' => 1]);
                DomeDiscounts::where('dome_id', $checkdome->id)->delete();
                return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
            }
            return response()->json(['status' => 0, 'message' => trans('messages.invalid_dome')], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
        }
    }
    public function image_delete(Request $request)
    {
        try {
            $image = DomeImages::find($request->id);
            if (file_exists('storage/app/public/admin/images/domes/' . $image->images)) {
                unlink('storage/app/public/admin/images/domes/' . $image->images);
            }
            $image->delete();
            return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
        }
    }
    public function discount_delete(Request $request)
    {
        try {
            DomeDiscounts::where('id', $request->id)->delete();
            return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
        }
    }
    public function fdiscount_delete(Request $request)
    {
        try {
            DomeFieldDiscounts::where('id', $request->id)->delete();
            return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
        }
    }
    public function managetime(Request $request)
    {
        try {
            $dome = Domes::find($request->id);
            if (count($dome['working_hours']) == 0) {
                foreach ($request->day as $key => $dayname) {
                    $wh = new WorkingHours();
                    $wh->vendor_id = auth()->user()->id;
                    $wh->dome_id = $dome->id;
                    $wh->day = strtolower($dayname);
                    $wh->open_time = $request->open_time[$key];
                    $wh->close_time = $request->close_time[$key];
                    $wh->is_closed = $request->is_closed[$key];
                    $wh->save();
                }
            } else {
                foreach ($request->day as $key => $dayname) {
                    $wh = WorkingHours::find($dayname);
                    if ($request->is_closed[$key] == 1) {
                        $dayy = Carbon::parse($wh->day);
                        $checkleague = League::where('dome_id', $dome->id)->whereRaw("FIND_IN_SET(?, REPLACE(days, ' | ', ','))", [$dayy->format('D')])->whereDate('end_date', '>', date('Y-m-d'))->first();
                        if (!empty($checkleague)) {
                            if ($request->update_ != 1) {
                                return response()->json(['status' => 2, 'message' => 'League is running on some days. Are you sure to update working hours!'], 200);
                            }
                        }
                    }
                    $wh->open_time = $request->open_time[$key];
                    $wh->close_time = $request->close_time[$key];
                    $wh->is_closed = $request->is_closed[$key];
                    $wh->save();
                }
            }
            return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
        }
    }
    public function new_request(Request $request)
    {
        try {
            $enquiry = new Enquiries();
            $enquiry->vendor_id = auth()->user()->id;
            $enquiry->type = 3;
            $enquiry->name = auth()->user()->name;
            $enquiry->email = auth()->user()->email;
            $enquiry->phone = auth()->user()->phone;
            $enquiry->dome_name = $request->dome_name;
            $enquiry->venue_address = $request->dome_address;
            $enquiry->dome_zipcode = $request->dome_zipcode;
            $enquiry->dome_city = $request->dome_city;
            $enquiry->dome_state = $request->dome_state;
            $enquiry->dome_country = $request->dome_country;
            $enquiry->is_exist = 1;
            $enquiry->save();
            $user_data = ['title' => 'New Dome Request', 'admin' => Helper::admin_data()->name, 'enquirydata' => $enquiry];
            Mail::send('email.request_new_dome', $user_data, function ($message) use ($user_data) {
                $message->from(env('MAIL_USERNAME'))->subject($user_data['title']);
                $message->to(Helper::admin_data()->email);
            });
            $data = ['title' => 'New Dome Request', 'email' => $enquiry->email, 'name' => $enquiry->name];
            Mail::send('email.new_dome_enquiry', $data, function ($message) use ($data) {
                $message->from(env('MAIL_USERNAME'))->subject($data['title']);
                $message->to($data['email']);
            });
            return redirect()->back()->with('success', trans('messages.success'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', trans('messages.wrong'));
        }
    }
    public function dome_settings()
    {
        return view('admin.dome_settings.index');
    }
}
