<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Domes;
use App\Models\Sports;
use Illuminate\Http\Request;

use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
    public function index(Request $request)
    {
        $vendors = User::where('type', 2)->where('is_deleted', 2)->orderBy('created_at', 'desc')->get();
        return view('admin.vendors.index', compact('vendors'));
    }

    public function add(Request $request)
    {
        return view('admin.vendors.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ], [
            'name.required' => trans('messages.name_required'),
            'email.required' => trans('messages.email_required'),
            'email.email' => trans('messages.valid_email'),
            'email.unique' => trans('messages.email_exist'),
            'password.required' => trans('messages.password_required'),
            'password.min' => trans('messages.password_min_length'),
        ]);

        if ($request->has('profile')) {
            $request->validate(
                [
                    'profile' => 'mimes:png,jpg,jpeg,svg|max:500',
                ],
                [
                    'profile.mimes' => trans('messages.valid_image_type'),
                    'profile.max' => trans('messages.valid_image_size'),
                ]
            );
            $new_name = 'profiles-' . uniqid() . '.' . $request->profile->getClientOriginalExtension();
            $path = storage_path('app\public\admin\images\profiles');
            $request->profile->move($path, $new_name);
        }

        $vendor = new User;
        $vendor->type = 2;
        $vendor->login_type = 1;
        $vendor->name = $request->name;
        $vendor->email = $request->email;
        $vendor->password = Hash::make($request->password);
        if ($request->has('profile')) {
            $vendor->image = $new_name;
        }
        $vendor->save();

        return redirect('admin/vendors')->with('success', trans('messages.success'));
    }

    public function dome_owner_detail(Request $request)
    {
        $dome_owner = User::find($request->id);
        abort_if(empty($dome_owner), 404);
        $domes = Domes::with('dome_images')->where('vendor_id', $dome_owner->id)->get();
        $sports = Sports::where('is_available', 1)->where('is_deleted', 2)->get();


        $now = CarbonImmutable::today();
        $weekStartDate = $now->startOfWeek();
        $weekEndDate = $now->endOfWeek();

        $confirmed_bookings = trans('labels.confirmed_bookings');
        $pending_bookings = trans('labels.pending_bookings');
        $cancelled_bookings = trans('labels.cancelled_bookings');

        if ($request->filtertype == "this_month") {
            // For Dome Revenue Chart
            $dome_revenue = Booking::whereIn('dome_id', $domes->pluck('id'))->where('booking_status', 1)->orderBy('created_at')->whereMonth('created_at', Carbon::now()->month)->sum('paid_amount') * 88 / 100;
            $dome_revenue_data = Booking::whereIn('dome_id', $domes->pluck('id'))->where('booking_status', 1)->orderBy('created_at')->whereMonth('created_at', Carbon::now()->month)->select(DB::raw('MONTHNAME(created_at) as titles'), DB::raw('SUM(paid_amount*88/100) as amount'))->groupBy('titles')->pluck('titles', 'amount');
            // For Bookings Overview Chart
            $total_bookings = Booking::whereIn('dome_id', $domes->pluck('id'))->whereMonth('created_at', Carbon::now()->month)->count();
            $total_bookings_data = Booking::whereIn('dome_id', $domes->pluck('id'))->selectRaw("
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
            $dome_revenue = Booking::whereIn('dome_id', $domes->pluck('id'))->where('booking_status', 1)->orderBy('created_at')->whereYear('created_at', Carbon::now()->year)->sum('paid_amount') * 88 / 100;
            $dome_revenue_data = Booking::whereIn('dome_id', $domes->pluck('id'))->where('booking_status', 1)->orderBy('created_at')->whereYear('created_at', Carbon::now()->year)->select(DB::raw("MONTHNAME(created_at) as titles"), DB::raw('SUM(paid_amount*88/100) as amount'))->groupBy('titles')->pluck('titles', 'amount');

            // For Bookings Overview Chart
            $total_bookings = Booking::whereIn('dome_id', $domes->pluck('id'))->whereYear('created_at', Carbon::now()->year)->count();
            $total_bookings_data = Booking::whereIn('dome_id', $domes->pluck('id'))->selectRaw("
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
            $dome_revenue = Booking::whereIn('dome_id', $domes->pluck('id'))->where('booking_status', 1)->orderBy('created_at')->whereBetween('created_at', [$weekStartDate, $weekEndDate])->sum('paid_amount') * 88 / 100;
            $dome_revenue_data = Booking::whereIn('dome_id', $domes->pluck('id'))->where('booking_status', 1)->orderBy('created_at')->whereBetween('created_at', [$weekStartDate, $weekEndDate])->select(DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as titles'), DB::raw('SUM(paid_amount*88/100) as amount'))->groupBy('titles')->pluck('titles', 'amount');

            // For Bookings Overview Chart
            $total_bookings = Booking::whereIn('dome_id', $domes->pluck('id'))->whereBetween('created_at', [$weekStartDate, $weekEndDate])->count();
            $total_bookings_data = Booking::whereIn('dome_id', $domes->pluck('id'))->selectRaw("
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
            $dome_revenue = Booking::whereIn('dome_id', $domes->pluck('id'))->where('booking_status', 1)->orderBy('created_at')->whereBetween('created_at', [$weekStartDate, $weekEndDate])->sum('paid_amount') * 88 / 100;
            $dome_revenue_data = Booking::whereIn('dome_id', $domes->pluck('id'))->where('booking_status', 1)->orderBy('created_at')->whereBetween('created_at', [$weekStartDate, $weekEndDate])->select(DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as titles'), DB::raw('SUM(paid_amount*88/100) as amount'))->groupBy('titles')->pluck('titles', 'amount');



            // For Bookings Overview Chart
            $total_bookings = Booking::whereIn('dome_id', $domes->pluck('id'))->whereBetween('created_at', [$weekStartDate, $weekEndDate])->count();
            $total_bookings_data = Booking::whereIn('dome_id', $domes->pluck('id'))->selectRaw("
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

        $dome_revenue_labels = $dome_revenue_data->values();
        $dome_revenue_data = $dome_revenue_data->keys();

        $bookings_labels = collect($bokingschartdata)->pluck('name');
        $bookings_data = collect($bokingschartdata)->pluck('data');
        $bookings_data_colors = collect($bokingschartdata)->pluck('colors');

        if (!empty($domes)) {
            if ($request->ajax()) {
                return response()->json(['total_bookings' => $total_bookings, 'bookings_labels' => $bookings_labels, 'bookings_data' => $bookings_data, 'bookings_data_colors' => $bookings_data_colors, 'dome_revenue' => $dome_revenue, 'dome_revenue_labels' => $dome_revenue_labels, 'dome_revenue_data' => $dome_revenue_data]);
            } else {
                return view('admin.vendors.view', compact('domes', 'dome_owner', 'sports', 'total_bookings', 'bookings_labels', 'bookings_data', 'bookings_data_colors', 'dome_revenue', 'dome_revenue_labels', 'dome_revenue_data'));
            }
        }
        return redirect('admin/vendors');
    }

    public function edit(Request $request)
    {
        $user = User::find($request->id);
        abort_if(empty($user), 404);
        return view('admin.vendors.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $vendor = User::find($request->id);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $request->id,
        ], [
            'name.required' => trans('messages.name_required'),
            'email.required' => trans('messages.email_required'),
            'email.email' => trans('messages.valid_email'),
            'email.unique' => trans('messages.email_exist'),
        ]);

        if ($request->has('profile')) {
            $request->validate(
                [
                    'profile' => 'mimes:png,jpg,jpeg,svg|max:500'
                ],
                [
                    'profile.mimes' => trans('messages.valid_image_type'),
                    'profile.max' => trans('messages.valid_image_size'),
                ]
            );
            if ($vendor->image != 'default.png' && file_exists('storage/app/public/admin/images/profiles/' . $vendor->image)) {
                unlink('storage/app/public/admin/images/profiles/' . $vendor->image);
            }
            $new_name = 'profile-' . uniqid() . '.' . $request->profile->getClientOriginalExtension();
            $path = storage_path('app\public\admin\images\profiles');
            $request->profile->move($path, $new_name);
        }

        $vendor->name = $request->name;
        $vendor->email = $request->email;
        if ($request->has('profile')) {
            $vendor->image = $new_name;
        }
        $vendor->save();

        return redirect('admin/vendors')->with('success', trans('messages.success'));
    }

    public function delete(Request $request)
    {
        $user = User::find($request->id);
        $user->is_deleted = $request->status;
        $user->save();

        return 1;
    }
    public function change_status(Request $request)
    {
        $user = User::find($request->id);
        $user->is_available = $request->status;
        $user->save();

        return 1;
    }
}
