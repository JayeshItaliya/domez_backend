<?php

namespace App\Http\Controllers\admin;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Domes;
use App\Models\Transaction;
use App\Models\User;
use App\Models\PaymentGateway;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\OAuth;

class AdminController extends Controller
{
    public function login_dev(Request $request)
    {
        if (auth()->user()->type == 1) {
            $uid = @User::DomeOwner()->first()->id;
            if ($uid) {
                Auth::loginUsingId($uid);
            }
        } else {
            Auth::loginUsingId(1);
        }
        return redirect('admin/dashboard')->with('success', trans('messages.success'));
    }
    public function connects(Request $request)
    {
        if ($request->has('code') && $request->code != "") {
            Stripe::setApiKey(Helper::stripe_data()->secret_key);
            try {
                $token = OAuth::token([
                    'grant_type' => 'authorization_code',
                    'code' => $request->code,
                    'client_id' => env('STRIPE_CLIENT_ID'),
                    'client_secret' => Helper::stripe_data()->secret_key,
                ]);
                $connectedAccountId = $token->stripe_user_id;
                $stripe = PaymentGateway::where('type', 1)->where('vendor_id', auth()->user()->id)->first();
                if (empty($stripe)) {
                    $stripe = new PaymentGateway();
                    $stripe->type = 1;
                }
                $stripe->vendor_id = auth()->user()->id;
                $stripe->account_id = $connectedAccountId;
                $stripe->save();
                return redirect('admin/settings/stripe-setting')->with('success', trans('messages.success'));
            } catch (\Throwable $th) {
                return redirect('admin/settings/stripe-setting')->with('error', trans('messages.wrong'));
            }
        }
        return redirect('admin/settings/stripe-setting');
    }
    public function login_emp(Request $request)
    {
        try {
            Auth::login(User::where('type', 4)->Available()->NotDeleted()->first());
            return redirect('admin/dashboard')->with('success', trans('messages.success'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Employee not available');
        }
    }
    public function dashboard(Request $request)
    {
        $now = CarbonImmutable::today();
        $weekStartDate = $now->startOfWeek();
        $weekEndDate = $now->endOfWeek();
        $percentage = auth()->user()->type == 1 ? 12 : 88;

        $domelist = Domes::NotDeleted()
            ->when(auth()->user()->type != 1, function ($query) {
                return $query->where('vendor_id', auth()->user()->type == 2 ? auth()->user()->id : auth()->user()->vendor_id);
            })
            ->get();

        $bookings = Booking::whereDate('start_date', '>=', $now)->orderByDesc('id');
        $total_income_data = Transaction::where('type', 1)->orderBy('created_at');
        $total_revenue_data = Booking::where('booking_status', 1)->orderBy('created_at');
        $paidAmtQuery_RevChart = auth()->user()->type == 1 ? DB::raw('SUM(paid_amount*12/100) as amount') : DB::raw('SUM(paid_amount*88/100) as amount');
        $total_users_data = User::where('type', 3);
        $total_dome_owners_data = User::DomeOwner();
        $getbookingsforsmallchart = Booking::whereIn('type', [1, 2]);
        $getbookingsforoverviewchart = Booking::whereIn('type', [1, 2]);
        $confirmed_bookings = trans('labels.confirmed_bookings');
        $pending_bookings = trans('labels.pending_bookings');
        $cancelled_bookings = trans('labels.cancelled_bookings');
        $total_bookings_overview_data = Booking::selectRaw("
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
            COUNT(*) as total");
        if (auth()->user()->type == 1) {
            $getbookingslist = $bookings->get();
        } else {
            $vendor_id = auth()->user()->type == 2 ? auth()->user()->id : auth()->user()->vendor_id;
            $total_income_data = $total_income_data->where('vendor_id', $vendor_id);
            $total_revenue_data = $total_revenue_data->where('vendor_id', $vendor_id);
            $getbookingslist = $bookings->where('vendor_id', $vendor_id)->get();
            $getbookingsforsmallchart = $getbookingsforsmallchart->where('vendor_id', $vendor_id);
            $getbookingsforsmallchart = $getbookingsforsmallchart->where('vendor_id', $vendor_id);
            $getbookingsforoverviewchart = $getbookingsforoverviewchart->where('vendor_id', $vendor_id);
            $total_bookings_overview_data = $total_bookings_overview_data->where('vendor_id', $vendor_id);
        }
        if ($request->filtertype == "this_month") {
            // For Income Chart
            $total_income_data_sum = $total_income_data->whereMonth('created_at', Carbon::now()->month)->sum('amount');
            $total_income_data = $total_income_data->whereMonth('created_at', Carbon::now()->month)->select(DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as titles'), DB::raw('SUM(amount) as amount'))->groupBy('titles')->pluck('amount', 'titles');
            // For Booking Chart
            $total_bookings_count = $getbookingsforsmallchart->whereMonth('created_at', Carbon::now()->month)->count();
            $total_bookings_data = $getbookingsforsmallchart->select(DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as titles'), DB::raw('count(*) as bookings'))->groupBy('titles')->pluck('bookings', 'titles');
            // For Revenue Chart
            $total_revenue_data_sum = $total_revenue_data->whereMonth('created_at', Carbon::now()->month)->sum('paid_amount') * $percentage / 100;
            $total_revenue_data = $total_revenue_data->whereMonth('created_at', Carbon::now()->month)->select(DB::raw('MONTHNAME(created_at) as titles'), $paidAmtQuery_RevChart)->groupBy('titles')->pluck('amount', 'titles');
            // For Users Chart
            $total_users_data_sum = $total_users_data->whereMonth('created_at', Carbon::now()->month)->count();
            $total_users_data = $total_users_data->whereMonth('created_at', Carbon::now()->month)->select(DB::raw('MONTHNAME(created_at) as titles'), DB::raw('COUNT(*) as users'))->pluck('titles', 'users');
            // For Dome Owners Chart
            $total_dome_owners_data_sum = $total_dome_owners_data->whereMonth('created_at', Carbon::now()->month)->count();
            $total_dome_owners_data = $total_dome_owners_data->whereMonth('created_at', Carbon::now()->month)->select(DB::raw('MONTHNAME(created_at) as titles'), DB::raw('COUNT(*) as users'))->pluck('titles', 'users');
            // For Bookings Overview Chart
            $total_bookings_overview = $getbookingsforoverviewchart->whereMonth('created_at', Carbon::now()->month)->count();
            $total_bookings_overview_data = $total_bookings_overview_data->whereMonth('created_at', Carbon::now()->month);
        } elseif ($request->filtertype == "this_year") {
            // For Income Chart
            $total_income_data_sum = $total_income_data->whereYear('created_at', Carbon::now()->year)->sum('amount');
            $total_income_data = $total_income_data->whereYear('created_at', Carbon::now()->year)->select(DB::raw("MONTHNAME(created_at) as titles"), DB::raw('SUM(amount) as amount'))->groupBy('titles')->groupBy('titles')->pluck('amount', 'titles');
            // For Booking Chart
            $total_bookings_count = $getbookingsforsmallchart->whereYear('created_at', Carbon::now()->year)->count();
            $total_bookings_data = $getbookingsforsmallchart->select(DB::raw("MONTHNAME(created_at) as month_name"), DB::raw('count(*) as bookings'))->orderBy('created_at')->groupBy('month_name')->pluck('bookings', 'month_name');
            // For Revenue Chart
            $total_revenue_data_sum = $total_revenue_data->whereYear('created_at', Carbon::now()->year)->sum('paid_amount') * $percentage / 100;
            $total_revenue_data = $total_revenue_data->whereYear('created_at', Carbon::now()->year)->select(DB::raw("MONTHNAME(created_at) as titles"), $paidAmtQuery_RevChart)->groupBy('titles')->pluck('amount', 'titles');
            // For Users Chart
            $otherformatforusers = 1;
            $total_users_data_sum = $total_users_data->whereYear('created_at', Carbon::now()->year)->count();
            $total_users_data = $total_users_data->whereYear('created_at', Carbon::now()->year)->select(DB::raw('MONTHNAME(created_at) as titles'), DB::raw('COUNT(id) as users'))->groupBy('titles')->orderBy('created_at')->get();
            // For Dome Owners Chart
            $otherformatfordomez = 1;
            $total_dome_owners_data_sum = $total_dome_owners_data->whereYear('created_at', Carbon::now()->year)->count();
            $total_dome_owners_data = $total_dome_owners_data->whereYear('created_at', Carbon::now()->year)->select(DB::raw('MONTHNAME(created_at) as titles'), DB::raw('COUNT(id) as users'))->groupBy('titles')->orderBy('created_at')->get();
            // For Bookings Overview Chart
            $total_bookings_overview = $getbookingsforoverviewchart->whereYear('created_at', Carbon::now()->year)->count();
            $total_bookings_overview_data = $total_bookings_overview_data->whereYear('created_at', Carbon::now()->year);
        } elseif ($request->filtertype == "custom_date") {
            $weekStartDate = explode(' to ', $request->filterdates)[0];
            $weekEndDate = explode(' to ', $request->filterdates)[1];
            // For Income Chart
            $total_income_data_sum = $total_income_data->whereBetween('created_at', [$weekStartDate, $weekEndDate])->sum('amount');
            $total_income_data = $total_income_data->whereBetween('created_at', [$weekStartDate, $weekEndDate])->select(DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as titles'), DB::raw('SUM(amount) as amount'))->pluck('amount', 'titles');
            // For Booking Chart
            $total_bookings_count = $getbookingsforsmallchart->whereBetween('created_at', [$weekStartDate, $weekEndDate])->count();
            $total_bookings_data = $getbookingsforsmallchart->select(DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as titles'), DB::raw('count(*) as bookings'))->groupBy('titles')->pluck('bookings', 'titles');
            // For Revenue Chart
            $total_revenue_data_sum = $total_revenue_data->whereBetween('created_at', [$weekStartDate, $weekEndDate])->sum('paid_amount') * $percentage / 100;
            $total_revenue_data = $total_revenue_data->whereBetween('created_at', [$weekStartDate, $weekEndDate])->select(DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as titles'), $paidAmtQuery_RevChart)->groupBy('titles')->pluck('amount', 'titles');
            // For Users Chart
            $total_users_data_sum = $total_users_data->whereBetween('created_at', [$weekStartDate, $weekEndDate])->count();
            $total_users_data = $total_users_data->whereBetween('created_at', [$weekStartDate, $weekEndDate])->select(DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as titles'), DB::raw('COUNT(id) as users'))->groupBy('created_at')->get();
            $otherformatforusers = 1;
            // For Dome Owners Chart
            $total_dome_owners_data_sum = $total_dome_owners_data->whereBetween('created_at', [$weekStartDate, $weekEndDate])->count();
            $total_dome_owners_data = $total_dome_owners_data->whereBetween('created_at', [$weekStartDate, $weekEndDate])->select(DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as titles'), DB::raw('COUNT(id) as users'))->groupBy('created_at')->get();
            $otherformatfordomez = 1;
            // For Bookings Overview Chart
            $total_bookings_overview = $getbookingsforoverviewchart->whereBetween('created_at', [$weekStartDate, $weekEndDate])->count();
            $total_bookings_overview_data = $total_bookings_overview_data->whereBetween('created_at', [$weekStartDate, $weekEndDate]);
        } else {
            // For Income Chart
            $total_income_data_sum = $total_income_data->whereBetween('created_at', [$weekStartDate, $weekEndDate])->sum('amount');
            $total_income_data = $total_income_data->whereBetween('created_at', [$weekStartDate, $weekEndDate])->select(DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as titles'), DB::raw('SUM(amount) as amount'))->groupBy('titles')->pluck('amount', 'titles');
            // For Booking Chart
            $total_bookings_count = $getbookingsforsmallchart->whereBetween('created_at', [$weekStartDate, $weekEndDate])->count();
            $total_bookings_data = $getbookingsforsmallchart->select(DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as titles'), DB::raw('count(*) as bookings'))->groupBy(DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y")'))->get();
            $otherformatforbookingsmallchart = 1;
            // For Revenue Chart
            $total_revenue_data_sum = $total_revenue_data->whereBetween('created_at', [$weekStartDate, $weekEndDate])->sum('paid_amount') * $percentage / 100;
            $total_revenue_data = $total_revenue_data->whereBetween('created_at', [$weekStartDate, $weekEndDate])->select(DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as titles'), $paidAmtQuery_RevChart)->groupBy('titles')->pluck('amount', 'titles');
            // For Users Chart
            $total_users_data_sum = $total_users_data->whereBetween('created_at', [$weekStartDate, $weekEndDate])->count();
            $total_users_data = $total_users_data->whereBetween('created_at', [$weekStartDate, $weekEndDate])->select(DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as titles'), DB::raw('COUNT(id) as users'))->groupBy(DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y")'))->get();
            $otherformatforusers = 1;
            // For Dome Owners Chart
            $total_dome_owners_data_sum = $total_dome_owners_data->whereBetween('created_at', [$weekStartDate, $weekEndDate])->count();
            $total_dome_owners_data = $total_dome_owners_data->whereBetween('created_at', [$weekStartDate, $weekEndDate])->select(DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y") as titles'), DB::raw('COUNT(id) as users'))->groupBy('created_at')->get();
            $otherformatfordomez = 1;
            // For Bookings Overview Chart
            $total_bookings_overview = $getbookingsforoverviewchart->whereBetween('created_at', [$weekStartDate, $weekEndDate])->count();
            $total_bookings_overview_data = $total_bookings_overview_data->whereBetween('created_at', [$weekStartDate, $weekEndDate]);
        }
        $bokingsoverviewchartdata = [];
        $total_bookings_overview_data = $total_bookings_overview_data->groupBy('booking_status')->orderBy('booking_status')->get();
        foreach ($total_bookings_overview_data as $checkd) {
            $bokingsoverviewchartdata[] = [
                'name' => $checkd->status,
                'data' => $checkd->total,
                'colors' => $checkd->colors
            ];
        }
        $bookings_overview_labels = collect($bokingsoverviewchartdata)->pluck('name');
        $bookings_overview_data = collect($bokingsoverviewchartdata)->pluck('data');
        $bookings_data_colors = collect($bokingsoverviewchartdata)->pluck('colors');

        $income_labels = $total_revenue_data->keys();
        $income_data = $total_revenue_data->values();
        $booking_labels =  @$otherformatforbookingsmallchart == 1 ? collect($total_bookings_data)->pluck('titles') : $total_bookings_data->keys();
        $booking_data =  @$otherformatforbookingsmallchart == 1 ? collect($total_bookings_data)->pluck('bookings') : $total_bookings_data->values();
        $revenue_labels = $total_revenue_data->keys();
        $revenue_data = $total_revenue_data->values();
        $users_labels =  @$otherformatforusers == 1 ? collect($total_users_data)->pluck('titles') : $total_users_data->values();
        $users_data =  @$otherformatforusers == 1 ? collect($total_users_data)->pluck('users') : $total_users_data->keys();
        $dome_owners_labels = @$otherformatfordomez == 1 ? collect($total_dome_owners_data)->pluck('titles') : $total_dome_owners_data->values();
        $dome_owners_data = @$otherformatfordomez == 1 ? collect($total_dome_owners_data)->pluck('users') : $total_dome_owners_data->keys();
        if ($request->ajax()) {
            return response()->json(['total_income_data_sum' => Helper::currency_format($total_revenue_data_sum), 'income_labels' => $income_labels, 'income_data' => $income_data, 'total_bookings_count' => $total_bookings_count, 'booking_labels' => $booking_labels, 'booking_data' => $booking_data, 'total_revenue_data_sum' => Helper::currency_format($total_revenue_data_sum), 'revenue_labels' => $revenue_labels, 'revenue_data' => $revenue_data, 'total_users_data_sum' => $total_users_data_sum, 'users_labels' => $users_labels, 'users_data' => $users_data, 'total_dome_owners_data_sum' => $total_dome_owners_data_sum, 'dome_owners_labels' => $dome_owners_labels, 'dome_owners_data' => $dome_owners_data, 'total_bookings_overview' => $total_bookings_overview, 'bookings_overview_labels' => $bookings_overview_labels, 'bookings_overview_data' => $bookings_overview_data, 'bookings_data_colors' => $bookings_data_colors]);
        } else {
            return view('admin.dashboard.index', compact('domelist','getbookingslist', 'total_income_data_sum', 'income_labels', 'income_data', 'total_bookings_count', 'booking_labels', 'booking_data', 'total_revenue_data_sum', 'revenue_labels', 'revenue_data', 'total_users_data_sum', 'users_labels', 'users_data', 'total_dome_owners_data_sum', 'dome_owners_labels', 'dome_owners_data', 'total_bookings_overview', 'bookings_overview_labels', 'bookings_overview_data', 'bookings_data_colors'));
        }
    }
}
