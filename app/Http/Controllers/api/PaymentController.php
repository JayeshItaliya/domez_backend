<?php

namespace App\Http\Controllers\api;

use App\Helper\Helper;
use Stripe;
use App\Http\Controllers\Controller;
use App\Models\Domes;
use App\Models\Transaction;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        if ($request->vendor_id == "") {
            return response()->json(["status" => 0, "message" => "Please Enter Vendor ID"], 200);
        }
        if ($request->dome_id == "") {
            return response()->json(["status" => 0, "message" => "Please Enter Dome ID"], 200);
        }
        if ($request->field_id == "") {
            return response()->json(["status" => 0, "message" => "Please Enter Field ID"], 200);
        }
        if ($request->user_id == "") {
            return response()->json(["status" => 0, "message" => "Please Enter Login User ID"], 200);
        }
        if ($request->payment_type == "") {
            return response()->json(["status" => 0, "message" => "Please Enter Payment type"], 200);
        }
        if ($request->amount == "") {
            return response()->json(["status" => 0, "message" => "Please Enter Amount"], 200);
        }
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
                    "amount" => $request->amount * 100,
                    "currency" => "USD",
                    "source" => $gettoken->id,
                    "description" => "Domez Payment",
                ]);
                $dome = Domes::find($request->dome_id);
                $transaction_id = $payment->id;
                // Payment Type = 1=Card, 2=Apple Pay, 3=Google Pay
                $transaction = new Transaction;
                $transaction->vendor_id = $dome->vendor_id;
                $transaction->dome_id = $request->dome_id;
                $transaction->field_id = $request->field_id;
                $transaction->user_id = $request->user_id;
                $transaction->payment_type = $request->payment_type;
                $transaction->transaction_id = $transaction_id;
                $transaction->amount = $request->amount;
                $transaction->save();

                return response()->json(['status' => 1, "message" => "Successful", "transaction_details" => $transaction], 200);
            } catch (\Throwable $th) {
                return response()->json(['status' => 0, "message" => "Payment Failed"], 200);
            }
        }

    }
}
