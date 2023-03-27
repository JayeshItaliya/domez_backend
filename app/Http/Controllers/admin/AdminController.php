<?php

namespace App\Http\Controllers\admin;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function login_dev(Request $request)
    {
        if (Auth::user()->type == 1) {
            Auth::loginUsingId(2);
        } else {
            Auth::loginUsingId(1);
        }
        return redirect('admin/dashboard')->with('success', trans('messages.success'));
    }
    public function login_emp(Request $request)
    {
        Auth::login(User::where('type', 4)->where('is_available', 1)->where('is_deleted', 2)->first());
        return redirect('admin/dashboard')->with('success', trans('messages.success'));
    }
    public function dashboard(Request $request)
    {
        $now = CarbonImmutable::today();
        $weekStartDate = $now->startOfWeek();
        $weekEndDate = $now->endOfWeek();

        $bookings = Booking::whereDate('start_date', '>=', $now)->orderByDesc('id');

        $total_income_data = Transaction::where('type', 1)->orderBy('created_at');
        $total_revenue_data = Transaction::where('type', 1)->orderBy('created_at');
        $total_users_data = User::where('type', 3);
        $total_dome_owners_data = User::where('type', 2);
        if (Auth::user()->type == 1) {
            $getbookingslist = $bookings->get();
        } else {
            $total_income_data = $total_income_data->where('vendor_id', Auth::user()->type == 2 ? Auth::user()->id : Auth::user()->vendor_id);
            $total_revenue_data = $total_revenue_data->where('vendor_id', Auth::user()->type == 2 ? Auth::user()->id : Auth::user()->vendor_id);
            $getbookingslist = $bookings->where('vendor_id', Auth::user()->type == 2 ? Auth::user()->id : Auth::user()->vendor_id)->get();
        }

        if ($request->filtertype == "this_month") {

            // For Income Chart
            $total_income_data_sum = Transaction::where('type', 1)->whereMonth('created_at', Carbon::now()->month)->sum('amount');
            $total_income_data = $total_income_data->whereMonth('created_at', Carbon::now()->month)->select(DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as titles'), DB::raw('SUM(amount) as amount'))->groupBy('titles')->pluck('amount', 'titles');

            // For Booking Chart
            $total_bookings = Booking::whereMonth('created_at', Carbon::now()->month);
            $total_bookings_count = $total_bookings->count();
            $total_bookings_data = $total_bookings->select(DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as titles'), DB::raw('count(*) as bookings'))->groupBy('titles')->pluck('bookings', 'titles');

            // For Revenue Chart
            $total_revenue_data_sum = $total_revenue_data->whereMonth('created_at', Carbon::now()->month)->sum('amount') * 12 / 100;
            $total_revenue_data = $total_revenue_data->whereMonth('created_at', Carbon::now()->month)->select(DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as titles'), DB::raw('SUM(amount*12/100) as amount'))->groupBy('titles')->pluck('titles', 'amount');

            // For Users Chart
            $total_users_data_sum = $total_users_data->whereMonth('created_at', Carbon::now()->month)->count();
            $total_users_data = $total_users_data->whereMonth('created_at', Carbon::now()->month)->select(DB::raw('MONTHNAME(created_at) as titles'), DB::raw('COUNT(*) as users'))
                ->pluck('titles', 'users');

            // For Dome Owners Chart
            $total_dome_owners_data_sum = $total_dome_owners_data->whereMonth('created_at', Carbon::now()->month)->count();
            $total_dome_owners_data = $total_dome_owners_data->whereMonth('created_at', Carbon::now()->month)->select(DB::raw('MONTHNAME(created_at) as titles'), DB::raw('COUNT(*) as users'))->groupBy(DB::raw('DATE_FORMAT(created_at,"%d-%-m-Y")'))->pluck('titles', 'users');
        } elseif ($request->filtertype == "this_year") {

            // For Income Chart
            $total_income_data_sum = Transaction::where('type', 1)->whereYear('created_at', Carbon::now()->year)->sum('amount');
            $total_income_data = $total_income_data->whereYear('created_at', Carbon::now()->year)->select(DB::raw("MONTHNAME(created_at) as titles"), DB::raw('SUM(amount) as amount'))->groupBy('titles')->groupBy('titles')->pluck('amount', 'titles');

            // For Booking Chart
            $total_bookings = Booking::whereYear('created_at', Carbon::now()->year);
            $total_bookings_count = $total_bookings->count();
            $total_bookings_data = $total_bookings->select(DB::raw("MONTHNAME(created_at) as month_name"), DB::raw('count(*) as bookings'))->orderBy('created_at')->groupBy('month_name')->pluck('bookings', 'month_name');

            // For Revenue Chart
            $total_revenue_data_sum = $total_revenue_data->where('type', 1)->whereYear('created_at', Carbon::now()->year)->sum('amount') * 12 / 100;
            $total_revenue_data = $total_revenue_data->whereYear('created_at', Carbon::now()->year)->select(DB::raw("MONTHNAME(created_at) as titles"), DB::raw('SUM(amount*12/100) as amount'))->groupBy('titles')->pluck('titles', 'amount');

            // For Users Chart
            $total_users_data_sum = $total_users_data->whereYear('created_at', Carbon::now()->year)->count();
            $total_users_data = $total_users_data->whereYear('created_at', Carbon::now()->year)->select(DB::raw('MONTHNAME(created_at) as titles'), DB::raw('COUNT(id) as users'))->groupBy('titles')->pluck('titles', 'users');

            // For Dome Owners Chart
            $total_dome_owners_data_sum = $total_dome_owners_data->whereYear('created_at', Carbon::now()->year)->count();
            $total_dome_owners_data = $total_dome_owners_data->whereYear('created_at', Carbon::now()->year)->select(DB::raw('MONTHNAME(created_at) as titles'), DB::raw('COUNT(id) as users'))->groupBy('titles')->pluck('titles', 'users');
        } elseif ($request->filtertype == "custom_date") {

            $weekStartDate = explode(' to ', $request->filterdates)[0];
            $weekEndDate = explode(' to ', $request->filterdates)[1];

            // For Income Chart
            $total_income_data_sum = Transaction::where('type', 1)->whereBetween('created_at', [$weekStartDate, $weekEndDate])->sum('amount');
            $total_income_data = $total_income_data->whereBetween('created_at', [$weekStartDate, $weekEndDate])->select(DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as titles'), DB::raw('SUM(amount) as amount'))->pluck('amount', 'titles');

            // For Booking Chart
            $total_bookings = Booking::whereBetween('created_at', [$weekStartDate, $weekEndDate]);
            $total_bookings_count = $total_bookings->count();
            $total_bookings_data = $total_bookings->select(DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as titles'), DB::raw('count(*) as bookings'))->groupBy('titles')->pluck('bookings', 'start_date');

            // For Revenue Chart
            $total_revenue_data_sum = $total_revenue_data->whereBetween('created_at', [$weekStartDate, $weekEndDate])->sum('amount') * 12 / 100;
            $total_revenue_data = $total_revenue_data->whereBetween('created_at', [$weekStartDate, $weekEndDate])->select(DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as titles'), DB::raw('SUM(amount*12/100) as amount'))->groupBy('titles')->pluck('titles', 'amount');

            // For Users Chart
            $total_users_data_sum = $total_users_data->whereBetween('created_at', [$weekStartDate, $weekEndDate])->count();
            $total_users_data = $total_users_data->whereBetween('created_at', [$weekStartDate, $weekEndDate])->select(DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as titles'), DB::raw('COUNT(id) as users'))->groupBy('created_at')->get();
            $otherformatforusers = 1;

            // For Dome Owners Chart
            $total_dome_owners_data_sum = $total_dome_owners_data->whereBetween('created_at', [$weekStartDate, $weekEndDate])->count();
            $total_dome_owners_data = $total_dome_owners_data->whereBetween('created_at', [$weekStartDate, $weekEndDate])->select(DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as titles'), DB::raw('COUNT(id) as users'))->groupBy('created_at')->get();
            $otherformatfordomez = 1;
        } else {

            // For Income Chart
            $total_income_data_sum = Transaction::where('type', 1)->whereBetween('created_at', [$weekStartDate, $weekEndDate])->sum('amount');
            $total_income_data = $total_income_data->whereBetween('created_at', [$weekStartDate, $weekEndDate])->select(DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as titles'), DB::raw('SUM(amount) as amount'))->groupBy('titles')->pluck('amount', 'titles');

            // For Booking Chart
            $total_bookings = Booking::whereBetween('created_at', [$weekStartDate, $weekEndDate]);
            $total_bookings_count = $total_bookings->count();
            $total_bookings_data = $total_bookings->select(DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as created_at'), DB::raw('count(*) as bookings'))->groupBy('created_at')->pluck('bookings', 'created_at');

            // For Revenue Chart
            $total_revenue_data_sum = $total_revenue_data->whereBetween('created_at', [$weekStartDate, $weekEndDate])->sum('amount') * 12 / 100;
            $total_revenue_data = $total_revenue_data->whereBetween('created_at', [$weekStartDate, $weekEndDate])->select(DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as titles'), DB::raw('SUM(amount*12/100) as amount'))->groupBy('titles')->pluck('titles', 'amount');

            // For Users Chart
            $total_users_data_sum = $total_users_data->whereBetween('created_at', [$weekStartDate, $weekEndDate])->count();
            $total_users_data = $total_users_data->whereBetween('created_at', [$weekStartDate, $weekEndDate])->select(DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as titles'), DB::raw('COUNT(id) as users'))->groupBy('created_at')->get();
            $otherformatforusers = 1;

            // For Dome Owners Chart
            $total_dome_owners_data_sum = $total_dome_owners_data->whereBetween('created_at', [$weekStartDate, $weekEndDate])->count();
            $total_dome_owners_data = $total_dome_owners_data->whereBetween('created_at', [$weekStartDate, $weekEndDate])->select(DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as titles'), DB::raw('COUNT(id) as users'))->groupBy('created_at')->get();
            $otherformatfordomez = 1;

            // For Bookings Overview Chart
            $total_bookings_overview = Booking::whereBetween('created_at', [$weekStartDate, $weekEndDate])->count();
            $total_bookings_overview_data = Booking::selectRaw('CASE WHEN booking_status = "1" THEN "Confirmed Bookings" WHEN booking_status = "2" THEN "Pending Bookings" WHEN booking_status = "3" THEN "Cancelled Bookings" ELSE "Unknown" END as status, COUNT(*) as total')->whereBetween('created_at', [$weekStartDate, $weekEndDate])->groupBy('booking_status')->orderBy('booking_status')->get();
            $bokingsoverviewchartdata = [];
            foreach ($total_bookings_overview_data as $d) {
                $bokingsoverviewchartdata[] = [
                    'name' => $d->status,
                    'data' => $d->total
                ];
            }
        }

        $income_labels = $total_income_data->keys();
        $income_data = $total_income_data->values();

        $booking_labels = $total_bookings_data->keys();
        $booking_data = $total_bookings_data->values();

        $revenue_labels = $total_revenue_data->values();
        $revenue_data = $total_revenue_data->keys();

        $users_labels =  @$otherformatforusers == 1 ? collect($total_users_data)->pluck('titles') : $total_users_data->values();
        $users_data =  @$otherformatforusers == 1 ? collect($total_users_data)->pluck('users') : $total_users_data->keys();

        $dome_owners_labels = @$otherformatfordomez == 1 ? collect($total_dome_owners_data)->pluck('titles') : $total_dome_owners_data->values();
        $dome_owners_data = @$otherformatfordomez == 1 ? collect($total_dome_owners_data)->pluck('users') : $total_dome_owners_data->keys();

        $bookings_overview_labels = collect($bokingsoverviewchartdata)->pluck('name');
        $bookings_overview_data = collect($bokingsoverviewchartdata)->pluck('data');

        if ($request->ajax()) {
            return response()->json(['total_income_data_sum' => Helper::currency_format($total_income_data_sum), 'income_labels' => $income_labels, 'income_data' => $income_data, 'total_bookings_count' => $total_bookings_count, 'booking_labels' => $booking_labels, 'booking_data' => $booking_data, 'total_revenue_data_sum' => Helper::currency_format($total_revenue_data_sum), 'revenue_labels' => $revenue_labels, 'revenue_data' => $revenue_data, 'total_users_data_sum' => $total_users_data_sum, 'users_labels' => $users_labels, 'users_data' => $users_data, 'total_dome_owners_data_sum' => $total_dome_owners_data_sum, 'dome_owners_labels' => $dome_owners_labels, 'dome_owners_data' => $dome_owners_data, 'total_bookings_overview' => $total_bookings_overview, 'bookings_overview_labels' => $bookings_overview_labels, 'bookings_overview_data' => $bookings_overview_data]);
        } else {
            return view('admin.dashboard.index', compact('getbookingslist', 'total_income_data_sum', 'income_labels', 'income_data', 'total_bookings_count', 'booking_labels', 'booking_data', 'total_revenue_data_sum', 'revenue_labels', 'revenue_data', 'total_users_data_sum', 'users_labels', 'users_data', 'total_dome_owners_data_sum', 'dome_owners_labels', 'dome_owners_data', 'total_bookings_overview','bookings_overview_labels', 'bookings_overview_data'));
        }
    }
    public function landing(Request $request)
    {
        return view('landing.index');
    }
    public function contact(Request $request)
    {
        return view('landing.contact');
    }
    public function privacy_policy(Request $request)
    {
        return view('landing.privacy_policy');
    }
    public function terms_conditions(Request $request)
    {
        return view('landing.terms_conditions');
    }
}
