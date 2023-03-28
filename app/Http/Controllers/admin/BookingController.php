<?php

namespace App\Http\Controllers\admin;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Domes;
use App\Models\Field;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Stripe;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use DateTime;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $now = CarbonImmutable::today();
        $weekStartDate = $now->startOfWeek();
        $weekEndDate = $now->endOfWeek();

        $getbookingslist = Booking::select('*');
        if (in_array(auth()->user()->type, [2, 4])) {
            $getbookingslist = $getbookingslist->where('vendor_id', auth()->user()->type == 2 ? auth()->user()->id : auth()->user()->vendor_id);
        }
        if ($request->has('type') && in_array($request->type, ['domes', 'leagues'])) {
            if ($request->type == 'domes') {
                $getbookingslist = $getbookingslist->where('dome_id', '!=', '');
            }
            if ($request->type == 'leagues') {
                $getbookingslist = $getbookingslist->where('league_id', '!=', '');
            }
        }
        if ($request->has('filter') && $request->filter != "") {
            if ($request->filter == 'this-month') {
                $getbookingslist = $getbookingslist->whereMonth('start_date', Carbon::now()->month);
            } else if ($request->filter == 'this-year') {
                $getbookingslist = $getbookingslist->whereYear('start_date', Carbon::now()->year);
            } else if ($request->filter == 'custom-date') {
                $weekStartDate = @explode(' to ', $request->dates)[0];
                $weekEndDate = @explode(' to ', $request->dates)[1];
                if ($weekStartDate != "" && $weekEndDate != "") {
                    $getbookingslist = $getbookingslist->whereBetween('start_date', [$weekStartDate, $weekEndDate]);
                } else {
                    $getbookingslist = $getbookingslist->whereDate('start_date', $weekStartDate);
                }
            } else {
                $getbookingslist = $getbookingslist->whereBetween('start_date', [$weekStartDate, $weekEndDate]);
            }
        }
        $getbookingslist = $getbookingslist->orderByDesc('id')->get();
        return view('admin.bookings.index', compact('getbookingslist'));
    }
    public function calendar(Request $request)
    {
        if (auth()->user()->type == 1) {
            $getbookingslist = Booking::orderByDesc('id')->get();
        } else {
            $getbookingslist = Booking::where('vendor_id', auth()->user()->type == 2 ? auth()->user()->id : auth()->user()->vendor_id)->orderByDesc('id')->get();
        }
        // $data = [];
        // foreach ($getbookingslist as $key => $booking) {
        //     $data[] = [
        //         "title" => $booking->booking_id . ' - ' . $booking->dome_name->name,
        //         "start" => $booking->start_date,
        //         "url" => URL::to('admin/bookings/details-' . $booking->booking_id),
        //     ];
        // }
        // $getbookingslist = json_encode($data,true);
        return view('admin.bookings.calendar', compact('getbookingslist'));
    }
    public function details(Request $request)
    {
        $bookingdata = Booking::where('booking_id', $request->booking_id)->first();
        return view('admin.bookings.details', compact('bookingdata'));
    }
    public function booking(Request $request)
    {
        if ($request->user_id == "") {
            return response()->json(['status' => 0, 'message' => 'Enter Login User ID'], 200);
        }
        if ($request->field_id == "") {
            return response()->json(['status' => 0, 'message' => 'Enter Field ID'], 200);
        }
        if ($request->customer_name == "") {
            return response()->json(['status' => 0, 'message' => 'Enter Customer Name'], 200);
        }
        if ($request->customer_email == "") {
            return response()->json(['status' => 0, 'message' => 'Enter Customer Email'], 200);
        }
        if ($request->customer_mobile == "") {
            return response()->json(['status' => 0, 'message' => 'Enter Customer Mobile'], 200);
        }
        if ($request->players == "") {
            return response()->json(['status' => 0, 'message' => 'Enter Players'], 200);
        }
        if ($request->start_date == "") {
            return response()->json(['status' => 0, 'message' => 'Select Booking Date'], 200);
        }
        if ($request->start_time == "") {
            return response()->json(['status' => 0, 'message' => 'Enter Start Time'], 200);
        }
        if ($request->end_time == "") {
            return response()->json(['status' => 0, 'message' => 'Enter End Time'], 200);
        }
        if ($request->total_amount == "") {
            return response()->json(['status' => 0, 'message' => 'Enter Booking Total Amount'], 200);
        }
        if ($request->payment_type == "") {
            return response()->json(['status' => 0, 'message' => 'Select Payment Type'], 200);
        }

        $checkfield = Field::find($request->field_id);
        if (empty($checkfield)) {
            return response()->json(['status' => 0, 'message' => 'Field Not Found'], 200);
        }
        $checkdome = Domes::find($checkfield->dome_id);
        if (empty($checkdome)) {
            return response()->json(['status' => 0, 'message' => 'Invalid Dome ID'], 200);
        }
        $checkvendor = User::find($checkdome->vendor_id);
        if (empty($checkvendor)) {
            return response()->json(['status' => 0, 'message' => 'Invalid Dome Vendor ID'], 200);
        }
        $checkuser = User::find($request->user_id);
        if (empty($checkuser)) {
            return response()->json(['status' => 0, 'message' => 'User Not Found'], 200);
        }

        if ($request->payment_type == 1) {
            if ($request->payment_method == 1) {
                if ($request->card_number == "") {
                    return response()->json(["status" => 0, "message" => "Please Enter Card Number"], 200);
                }
                if ($request->card_exp_month == "") {
                    return response()->json(["status" => 0, "message" => "Please Enter Card Expire Month"], 200);
                }
                if ($request->card_exp_year == "") {
                    return response()->json(["status" => 0, "message" => "Please Enter Card Expire Year"], 200);
                }
                if ($request->card_cvv == "") {
                    return response()->json(["status" => 0, "message" => "Please Enter Card CVV"], 200);
                }
                // Payment Type = 1=Card, 2=Apple Pay, 3=Google Pay
                if ($request->payment_type == 1) {
                    try {
                        $stripekey = Helper::stripe_data()->secret_key;
                        $stripe = new \Stripe\StripeClient($stripekey);
                        $gettoken = $stripe->tokens->create([
                            'card' => [
                                'number' => $request->card_number,
                                'exp_month' => $request->card_exp_month,
                                'exp_year' => $request->card_exp_year,
                                'cvc' => $request->card_cvv,
                            ],
                        ]);
                        Stripe\Stripe::setApiKey($stripekey);
                        $payment = Stripe\Charge::create([
                            "amount" => $request->total_amount * 100,
                            "currency" => "CAD",
                            "source" => $gettoken->id,
                            "description" => "Domez Payment",
                        ]);
                        $transaction_id = $payment->id;
                    } catch (\Throwable $th) {
                        return response()->json(['status' => 0, 'message' => "Payment Failed"], 200);
                    }
                }
            }
        }
        if ($request->payment_type == 2) {
            if ($request->partial_amount == "") {
                return response()->json(["status" => 0, "message" => "Enter Partial Amount"], 200);
            }
            if ($request->payment_method == 1) {
                if ($request->card_number == "") {
                    return response()->json(["status" => 0, "message" => "Please Enter Card Number"], 200);
                }
                if ($request->card_exp_month == "") {
                    return response()->json(["status" => 0, "message" => "Please Enter Card Expire Month"], 200);
                }
                if ($request->card_exp_year == "") {
                    return response()->json(["status" => 0, "message" => "Please Enter Card Expire Year"], 200);
                }
                if ($request->card_cvv == "") {
                    return response()->json(["status" => 0, "message" => "Please Enter Card CVV"], 200);
                }
                // Payment Type = 1=Card, 2=Apple Pay, 3=Google Pay
                if ($request->payment_type == 1) {
                    try {
                        $stripekey = Helper::stripe_data()->secret_key;
                        $stripe = new \Stripe\StripeClient($stripekey);
                        $gettoken = $stripe->tokens->create([
                            'card' => [
                                'number' => $request->card_number,
                                'exp_month' => $request->card_exp_month,
                                'exp_year' => $request->card_exp_year,
                                'cvc' => $request->card_cvv,
                            ],
                        ]);
                        Stripe\Stripe::setApiKey($stripekey);
                        $payment = Stripe\Charge::create([
                            "amount" => $request->partial_amount * 100,
                            "currency" => "CAD",
                            "source" => $gettoken->id,
                            "description" => "Domez Payment",
                        ]);
                        $transaction_id = $payment->id;
                    } catch (\Throwable $th) {
                        return response()->json(['status' => 0, 'message' => "Payment Failed"], 200);
                    }
                }
            }
        }
        // Payment Type = 1=Card, 2=Apple Pay, 3=Google Pay
        $transaction = new Transaction;
        $transaction->type = 1;
        $transaction->vendor_id = $request->vendor_id;
        $transaction->dome_id = $request->dome_id;
        $transaction->user_id = $request->user_id;
        $transaction->payment_type = $request->payment_type;
        $transaction->transaction_id = $transaction_id;
        $transaction->amount = $request->amount;
        $transaction->save();
    }
    public function check_booking(Request $request)
    {
        $checkbooking = Booking::where('start_date', $request->start_date)->where('start_time', '!=', $request->start_time)->where('end_time', '!=', $request->end_time)->get();
        return response()->json($checkbooking, 200);
    }
    public function split_payment(Request $request)
    {
        $checkbooking = Booking::where('token', $request->token)->first();
        if (!empty($checkbooking)) {
            $page_url = URL::to('/payment/' . $request->token);
            $booking_token = $request->token;
            if ($request->ajax()) {
                if ($checkbooking->due_amount > 0) {

                    \Stripe\Stripe::setApiKey(Helper::stripe_data()->secret_key);
                    $intent = \Stripe\PaymentIntent::create([
                        'amount' => $request->amount * 100,
                        'currency' => 'cad',
                        'payment_method_types' => [
                            'card',
                            // 'bancontact',
                            // 'eps',
                            // 'giropay',
                            // 'ideal',
                            // 'p24',
                            // 'sepa_debit',
                            // 'sofort',
                        ],
                    ]);
                    return response()->json(['client_secret' => $intent->client_secret]);
                } else {
                    return response()->json(['status' => 0, 'message' => 'All Payment has been successfully paid'], 200);
                }
            }
            return view('landing.split_payment', compact('checkbooking', 'page_url', 'booking_token'));
        } else {
            abort(404);
        }
    }
    public function split_payment_process(Request $request)
    {
        try {
            $checktransaction = Transaction::where('transaction_id', $request->transaction_id)->first();
            if (empty($checktransaction)) {

                $checkbooking = Booking::where('token', $request->booking_token)->first();
                $checkbooking->due_amount -= $request->amount;
                $checkbooking->paid_amount += $request->amount;
                $checkbooking->save();

                $newcheckbooking = Booking::where('token', $request->booking_token)->first();
                if ($newcheckbooking->due_amount == 0) {
                    $newcheckbooking->booking_status = 1;
                    $newcheckbooking->payment_status = 1;
                    $newcheckbooking->save();
                }

                $checkbooking1 = Booking::where('token', $request->booking_token)->first();

                $transaction = new Transaction();
                $transaction->type = 1;
                $transaction->vendor_id = $checkbooking1->vendor_id;
                $transaction->dome_id = $checkbooking1->dome_id;
                $transaction->league_id = $checkbooking1->league_id;
                $transaction->booking_id = $checkbooking1->booking_id;
                $transaction->contributor_name = $request->contributor_name;
                $transaction->payment_method = 1;
                $transaction->transaction_id = $request->transaction_id;
                $transaction->amount = $request->amount;
                $transaction->save();
            }
            return response()->json(['status' => 1, 'message' => 'Payment Successfull'], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
        }
    }
    public function deletedata(Request $request)
    {
        try {
            $checkbooking = Booking::find($request->id);
            $checkbooking->booking_status = 3;
            $checkbooking->save();
            return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
        }
    }
}
