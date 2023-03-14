<?php

namespace App\Http\Controllers\admin;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Transaction;
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
    public function dashboard(Request $request)
    {
        $now = CarbonImmutable::today();
        $weekStartDate = $now->startOfWeek();
        $weekEndDate = $now->endOfWeek();



        $total_income_data = Transaction::where('type', 1)->orderBy('created_at');
        $total_revenue_data = Transaction::where('type', 1)->orderBy('created_at');
        if (Auth::user()->type == 2) {
            $total_income_data = $total_income_data->where('vendor_id', Auth::user()->id);
            $total_revenue_data = $total_revenue_data->where('vendor_id', Auth::user()->id);
        }

        if ($request->filtertype == "this_month") {
            // For Income Chart
            $total_income_data_sum = Transaction::where('type', 1)->whereMonth('created_at', Carbon::now()->month)->sum('amount');
            $total_income_data = $total_income_data->whereMonth('created_at', Carbon::now()->month)->select(DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as titles'), DB::raw('SUM(amount) as amount'))->groupBy('titles')->pluck('amount', 'titles');
            // For Booking Chart
            $total_bookings = Booking::whereMonth('booking_date', Carbon::now()->month);
            $total_bookings_count = $total_bookings->count();
            $total_bookings_data = $total_bookings->select(DB::raw('DATE(booking_date) as date'), DB::raw('count(*) as bookings'))->groupBy('date')->pluck('bookings', 'date');
            // For Revenue Chart
            $total_revenue_data_sum = $total_revenue_data->whereMonth('created_at', Carbon::now()->month)->sum('amount') * 12 / 100;
            $total_revenue_data = $total_revenue_data->whereMonth('created_at', Carbon::now()->month)->select(DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as titles'), DB::raw('SUM(amount*12/100) as amount'))->groupBy('titles')->pluck('titles', 'amount');
        } elseif ($request->filtertype == "this_year") {
            // For Income Chart
            $total_income_data_sum = Transaction::where('type', 1)->whereYear('created_at', Carbon::now()->year)->sum('amount');
            $total_income_data = $total_income_data->whereYear('created_at', Carbon::now()->year)->select(DB::raw("MONTHNAME(created_at) as titles"), DB::raw('SUM(amount) as amount'))->groupBy('titles')->groupBy('titles')->pluck('amount', 'titles');
            // For Booking Chart
            $total_bookings = Booking::whereYear('booking_date', Carbon::now()->year);
            $total_bookings_count = $total_bookings->count();
            $total_bookings_data = $total_bookings->select(DB::raw("MONTHNAME(booking_date) as date"), DB::raw('count(*) as bookings'))->groupBy('date')->pluck('bookings', 'date');
            // For Revenue Chart
            $total_revenue_data_sum = $total_revenue_data->where('type', 1)->whereYear('created_at', Carbon::now()->year)->sum('amount') * 12 / 100;
            $total_revenue_data = $total_revenue_data->whereYear('created_at', Carbon::now()->year)->select(DB::raw("MONTHNAME(created_at) as titles"), DB::raw('SUM(amount*12/100) as amount'))->groupBy('titles')->pluck('titles', 'amount');
        } elseif ($request->filtertype == "custom_date") {
            $weekStartDate = explode(' to ', $request->filterdates)[0];
            $weekEndDate = explode(' to ', $request->filterdates)[1];
            // For Income Chart
            $total_income_data_sum = Transaction::where('type', 1)->whereBetween('created_at', [$weekStartDate, $weekEndDate])->sum('amount');
            $total_income_data = $total_income_data->whereBetween('created_at', [$weekStartDate, $weekEndDate])->select(DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as titles'), DB::raw('SUM(amount) as amount'))->pluck('amount', 'titles');
            // For Booking Chart
            $total_bookings = Booking::whereBetween('booking_date', [$weekStartDate, $weekEndDate]);
            $total_bookings_count = $total_bookings->count();
            $total_bookings_data = $total_bookings->select(DB::raw('DATE(booking_date) as date'), DB::raw('count(*) as bookings'))->groupBy('date')->pluck('bookings', 'date');
            // For Revenue Chart
            $total_revenue_data_sum = $total_revenue_data->whereBetween('created_at', [$weekStartDate, $weekEndDate])->sum('amount') * 12 / 100;
            $total_revenue_data = $total_revenue_data->whereBetween('created_at', [$weekStartDate, $weekEndDate])->select(DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as titles'), DB::raw('SUM(amount*12/100) as amount'))->groupBy('titles')->pluck('titles', 'amount');
        } else {
            // For Income Chart
            $total_income_data_sum = Transaction::where('type', 1)->whereBetween('created_at', [$weekStartDate, $weekEndDate])->sum('amount');
            $total_income_data = $total_income_data->whereBetween('created_at', [$weekStartDate, $weekEndDate])->select(DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as titles'), DB::raw('SUM(amount) as amount'))->groupBy('titles')->pluck('amount', 'titles');
            // For Booking Chart
            $total_bookings = Booking::whereBetween('booking_date', [$weekStartDate, $weekEndDate]);
            $total_bookings_count = $total_bookings->count();
            $total_bookings_data = $total_bookings->select(DB::raw('DATE(booking_date) as date'), DB::raw('count(*) as bookings'))->groupBy('date')->pluck('bookings', 'date');
            // For Revenue Chart
            $total_revenue_data_sum = $total_revenue_data->whereBetween('created_at', [$weekStartDate, $weekEndDate])->sum('amount') * 12 / 100;
            $total_revenue_data = $total_revenue_data->whereBetween('created_at', [$weekStartDate, $weekEndDate])->select(DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as titles'), DB::raw('SUM(amount*12/100) as amount'))->groupBy('titles')->pluck('titles', 'amount');
        }
        $income_labels = $total_income_data->keys();
        $income_data = $total_income_data->values();
        $booking_labels = $total_bookings_data->keys();
        $booking_data = $total_bookings_data->values();
        $revenue_labels = $total_revenue_data->values();
        $revenue_data = $total_revenue_data->keys();
        if ($request->ajax()) {
            return response()->json(['total_income_data_sum' => Helper::currency_format($total_income_data_sum), 'income_labels' => $income_labels, 'income_data' => $income_data, 'total_bookings_count' => $total_bookings_count, 'booking_labels' => $booking_labels, 'booking_data' => $booking_data, 'total_revenue_data_sum' => Helper::currency_format($total_revenue_data_sum), 'revenue_labels' => $revenue_labels, 'revenue_data' => $revenue_data]);
        } else {
            return view('admin.dashboard.index', compact('total_income_data_sum', 'income_labels', 'income_data', 'total_bookings_count', 'booking_labels', 'booking_data', 'total_revenue_data_sum', 'revenue_labels', 'revenue_data'));
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
