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
use Illuminate\Support\Facades\Hash;
use Stripe;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->type == 1) {
            $bookings = Booking::get();
        } else {
            $bookings = Booking::where('vendor_id', Auth::user()->id)->get();
        }
        return view('admin.bookings.index', compact('bookings'));
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
        if ($request->booking_date == "") {
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
        $transaction->vendor_id = $request->vendor_id;
        $transaction->dome_id = $request->dome_id;
        $transaction->field_id = $request->field_id;
        $transaction->user_id = $request->user_id;
        $transaction->payment_type = $request->payment_type;
        $transaction->transaction_id = $transaction_id;
        $transaction->amount = $request->amount;
        $transaction->save();
    }
    public function check_booking(Request $request)
    {
        $checkbooking = Booking::where('booking_date', $request->booking_date)->where('start_time', '!=', $request->start_time)->where('end_time', '!=', $request->end_time)->get();
        return response()->json($checkbooking, 200);
    }
    public function split_payment(Request $request)
    {
        dd($request->token);
        $checkbooking = Booking::where('token', $request->token)->first();
        if (!empty($checkbooking)) {
            dd($checkbooking);
        } else {
            abort(404);
        }
    }
    public function details(Request $request)
    {
        return view('admin.bookings.details');
    }
}
