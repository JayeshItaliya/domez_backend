<?php

namespace App\Http\Controllers\api;

use App\Helper\Helper;
use Stripe;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Domes;
use App\Models\League;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function stripe_key(Request $request)
    {
        return response()->json(["status" => 1, "message" => "Successfull", 'data' => Helper::stripe_data()], 200);
    }
    public function payment(Request $request)
    {
        if ($request->booking_type == "") {
            return response()->json(["status" => 0, "message" => "Please Enter Booking Type"], 200);
        }
        if ($request->booking_type != 1 && $request->booking_type != 2) {
            return response()->json(["status" => 0, "message" => "Invalid Booking Type"], 200);
        }
        if ($request->payment_type == "") {
            return response()->json(["status" => 0, "message" => "Please Enter Payment Type"], 200);
        }
        if ($request->payment_type != 1 && $request->payment_type != 2) {
            return response()->json(["status" => 0, "message" => "Invalid Payment Type"], 200);
        }
        // Booking Type = 1=Domes, 2=Leagues
        if ($request->dome_id == "") {
            return response()->json(["status" => 0, "message" => "Please Enter Dome ID"], 200);
        }
        if (in_array($request->user_id, [0, ''])) {
            if ($request->customer_email != "") {
                $checkuser = User::where('email', $request->customer_email)->first();
                if (empty($checkuser)) {
                    $password = Str::random(8);
                    $user = new User;
                    $user->type = 3;
                    $user->login_type = 1;
                    $user->email = $request->customer_email;
                    $user->password = Hash::make($password);
                    $user->is_verified = 1;
                    $user->save();
                } else {
                    $user = $checkuser;
                }
            } else {
                return response()->json(["status" => 0, "message" => "Please Enter Guest Email Address"], 200);
            }
        } else {
            $user = $checkuser = User::find($request->user_id);
        }
        if ($request->sport_id == "") {
            return response()->json(["status" => 0, "message" => "Please Enter Sport ID"], 200);
        }
        if ($request->field_id == "") {
            return response()->json(["status" => 0, "message" => "Please Enter Field ID"], 200);
        }
        if ($request->booking_type == 1 && $request->date == "") {
            return response()->json(["status" => 0, "message" => "Please Enter Booking Date"], 200);
        }
        if (Carbon::createFromFormat('Y-m-d', $request->date)->isPast() && $request->date != Carbon::today()->format('Y-m-d')) {
            return response()->json(["status" => 0, "message" => 'Select Current or Future Date Only'], 200);
        }
        if ($request->booking_type == 2 && $request->team_name == "") {
            return response()->json(["status" => 0, "message" => "Please Enter Team Name For League"], 200);
        }
        if ($request->players == "") {
            return response()->json(["status" => 0, "message" => "Please Enter Numbers Of Players"], 200);
        }
        if (in_array($request->payment_method, [2, 3]) && $request->transaction_id == "") {
            return response()->json(["status" => 0, "message" => "Please Enter Transaction ID"], 200);
        }
        if ($request->booking_type == 2 && $request->team_name == "") {
            return response()->json(["status" => 0, "message" => "Please Enter Team Name For League"], 200);
        }
        if ($request->booking_type == 1 && $request->slots == "") {
            return response()->json(["status" => 0, "message" => "Please Select Time Slots For Dome Booking"], 200);
        }
        if ($request->start_time == "") {
            return response()->json(["status" => 0, "message" => "Please Enter Start Time"], 200);
        }
        if ($request->end_time == "") {
            return response()->json(["status" => 0, "message" => "Please Enter End Time"], 200);
        }
        if ($request->total_amount == "") {
            return response()->json(["status" => 0, "message" => "Please Enter Total Amount"], 200);
        }
        if ($request->payment_type == 2 && $request->paid_amount == "") {
            return response()->json(["status" => 0, "message" => "Please Enter Paid Amount"], 200);
        }
        // Payment Method = 1=Card, 2=Apple Pay, 3=Google Pay
        $amount = $request->payment_type == 1 ? $request->total_amount : $request->paid_amount;
        $booking_id = bin2hex(random_bytes(3));
        $transaction_id = $request->transaction_id;
        // if ($request->payment_method == 1) {
        //     if ($request->card_number == "") {
        //         return response()->json(["status" => 0, "message" => "Please Enter Card Number"], 200);
        //     }
        //     if ($request->card_exp_month == "") {
        //         return response()->json(["status" => 0, "message" => "Please Enter Card Expire Month"], 200);
        //     }
        //     if ($request->card_exp_year == "") {
        //         return response()->json(["status" => 0, "message" => "Please Enter Card Expire Year"], 200);
        //     }
        //     if ($request->card_cvv == "") {
        //         return response()->json(["status" => 0, "message" => "Please Enter Card CVV"], 200);
        //     }
        //     try {
        //         $stripe = new \Stripe\StripeClient(Helper::stripe_data()->secret_key);
        //         $gettoken = $stripe->tokens->create([
        //             'card' => [
        //                 'number' => $request->card_number,
        //                 'exp_month' => $request->card_exp_month,
        //                 'exp_year' => $request->card_exp_year,
        //                 'cvc' => $request->card_cvv,
        //             ],
        //         ]);
        //         Stripe\Stripe::setApiKey(Helper::stripe_data()->secret_key);
        //         $payment = Stripe\Charge::create([
        //             "amount" => $amount * 100,
        //             "currency" => "CAD",
        //             "source" => $gettoken->id,
        //             "description" => "Domez Payment",
        //         ]);
        //         $transaction_id = $payment->id;
        //     } catch (\Throwable $th) {
        //         return response()->json(['status' => 0, "message" => "Payment Failed"], 200);
        //     }
        // }
        try {
            if ($request->booking_type == 1) {
                $dome = Domes::where('id', $request->dome_id)->where('is_deleted', 2)->first();
            } else {
                $league = League::find($request->league_id);
                $dome = Domes::where('id', $league->dome_id)->where('is_deleted', 2)->first();
            }

            // Payment Type = 1=Card, 2=Apple Pay, 3=Google Pay
            $transaction = new Transaction;
            $transaction->vendor_id = $dome->vendor_id;
            if ($request->booking_type == 1) {
                $transaction->dome_id = $dome->id;
            } else {
                $transaction->league_id = $league->id;
            }
            $transaction->field_id = $request->field_id;
            $transaction->user_id = $user->id;
            $transaction->booking_id = $booking_id;
            $transaction->payment_method = $request->payment_method;
            $transaction->transaction_id = $transaction_id;
            $transaction->amount = $amount;
            $transaction->save();

            $booking = new Booking;
            $booking->type = $request->booking_type;
            $booking->vendor_id = $dome->vendor_id;
            if ($request->booking_type == 1) {
                $booking->dome_id = $dome->id;
            } else {
                $booking->dome_id = $dome->id;
                $booking->league_id = $league->id;
            }
            $booking->user_id = $user->id;
            $booking->sport_id = $request->sport_id;
            $booking->field_id = $request->field_id;
            $booking->booking_id = $booking_id;
            $booking->booking_date = Carbon::today()->format('Y-m-d');
            $booking->customer_name = $user->name != "" ? $user->name : null;
            $booking->customer_email = $user->email;
            $booking->customer_mobile = $user->phone != "" ? $user->phone : null;
            if ($request->booking_type == 2) {
                $booking->team_name = $request->team_name; // Use For Leagues Bookings Only
            }
            $booking->players = $request->players;
            if ($request->booking_type == 1) {
                $booking->slots = $request->slots; // Use For Domes Bookings Only
            }
            if ($request->booking_type == 2) {
                $booking->start_date = League::find($request->league_id)->start_date; // Use For League Bookings Only
                $booking->end_date = League::find($request->league_id)->end_date; // Use For League Bookings Only
            } else {
                $booking->start_date = $request->date; // Use For League Bookings Only
                $booking->end_date = $request->date; // Use For League Bookings Only

            }
            $booking->start_time = $request->booking_type == 1 ? $request->start_time : League::find($request->league_id)->start_time;
            $booking->end_time = $request->booking_type == 1 ? $request->end_time : League::find($request->league_id)->end_time;
            $booking->total_amount = $request->total_amount;
            $booking->paid_amount = $request->payment_type == 1 ? 0 : $request->paid_amount;
            $booking->due_amount = $request->payment_type == 1 ? 0 : $request->total_amount - $request->paid_amount;
            $booking->payment_type = $request->payment_type;
            $booking->payment_status = $booking->due_amount == 0 ? 1 : 2;
            $booking->booking_status = $booking->payment_status == 1 ? 1 : 2;
            if ($request->payment_type == 2) {
                $booking->token = str_replace(['$', '/', '.', '|'], '', Hash::make($booking_id));
            } else {
                $booking->token = '';
            }
            $booking->save();

            return response()->json(['status' => 1, "message" => "Successful", "transaction_id" => $transaction_id, "booking_id" => $booking->booking_id, "payment_link" => URL::to('/payment/' . $booking->token),], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, "message" => "Something Went Wrong"], 200);
        }
    }
}
