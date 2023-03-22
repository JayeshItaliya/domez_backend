<?php

namespace App\Http\Controllers\api;

use App\Helper\Helper;
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

        // booking_type == 1 == Dome
        // booking_type == 2 == League

        if ($request->booking_type == "") {
            return response()->json(["status" => 0, "message" => "Please Enter Booking Type"], 200);
        }
        if (!in_array($request->booking_type, [1, 2])) {
            return response()->json(["status" => 0, "message" => "Invalid Booking Type"], 200);
        }
        if ($request->payment_type == "") {
            return response()->json(["status" => 0, "message" => "Please Enter Payment Type"], 200);
        }
        if (!in_array($request->payment_type, [1, 2])) {
            return response()->json(["status" => 0, "message" => "Invalid Payment Type"], 200);
        }

        if ($request->booking_type == 1) {
            $dome = Domes::where('id', $request->dome_id)->where('is_deleted', 2)->first();
        } else {
            $league = League::where('id', $request->league_id)->where('is_deleted', 2)->first();
            $dome = @$league->dome_info;
        }

        if ($request->booking_type == 1) {
            if ($request->dome_id == "") {
                return response()->json(["status" => 0, "message" => "Please Enter Dome ID"], 200);
            }
            if ($request->sport_id == "") {
                return response()->json(["status" => 0, "message" => "Please Enter Sport ID"], 200);
            }
            if ($request->date == "") {
                return response()->json(["status" => 0, "message" => "Please Enter Booking Date"], 200);
            }
            if (Carbon::createFromFormat('Y-m-d', $request->date)->isPast() && $request->date != Carbon::today()->format('Y-m-d')) {
                return response()->json(["status" => 0, "message" => 'Select Current or Future Date Only'], 200);
            }
            if ($request->slots == "") {
                return response()->json(["status" => 0, "message" => "Please Select Time Slots For Dome Booking"], 200);
            }
            if ($request->players == "") {
                return response()->json(["status" => 0, "message" => "Please Enter Numbers Of Players"], 200);
            }
            if ($request->field_id == "") {
                return response()->json(["status" => 0, "message" => "Please Enter Field ID"], 200);
            }
            if ($request->start_time == "") {
                return response()->json(["status" => 0, "message" => "Please Enter Start Time"], 200);
            }
            if ($request->end_time == "") {
                return response()->json(["status" => 0, "message" => "Please Enter End Time"], 200);
            }
            $dome_id = $request->dome_id;
            $sport_id = $request->sport_id;
            $field_id = $request->field_id;
            $team_name = '';
        } else {
            if ($request->league_id == "") {
                return response()->json(["status" => 0, "message" => "Please Enter League ID"], 200);
            }
            if (empty($league)) {
                return response()->json(["status" => 0, "message" => "League Not Found"], 200);
            }
            if ($request->customer_name == "") {
                return response()->json(["status" => 0, "message" => "Please Enter Customer Name"], 200);
            }
            if ($request->customer_email == "") {
                return response()->json(["status" => 0, "message" => "Please Enter Customer Email"], 200);
            }
            if ($request->customer_phone == "") {
                return response()->json(["status" => 0, "message" => "Please Enter Customer Phone"], 200);
            }
            if ($request->players == "") {
                return response()->json(["status" => 0, "message" => "Please Enter Numbers Of Players"], 200);
            }
            if ($request->team_name == "") {
                return response()->json(["status" => 0, "message" => "Please Enter Team Name"], 200);
            }
            $dome_id = $league->dome_id;
            $sport_id = $league->sport_id;
            $field_id = $league->field_id;
            $team_name = $request->team_name;
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
            if (empty($user)) {
                return response()->json(["status" => 0, "message" => "User Not Found"], 200);
            }
        }

        if ($request->payment_type == 1) {
            if ($request->total_amount == "") {
                return response()->json(["status" => 0, "message" => "Please Enter Total Amount"], 200);
            }
        } else {
            if ($request->total_amount == "") {
                return response()->json(["status" => 0, "message" => "Please Enter Total Amount"], 200);
            }
            if ($request->paid_amount == "") {
                return response()->json(["status" => 0, "message" => "Please Enter Paid Amount"], 200);
            }
        }


        if ($request->payment_method == "") {
            return response()->json(["status" => 0, "message" => "Please Select Payment Method"], 200);
        }
        if ($request->transaction_id == "") {
            return response()->json(["status" => 0, "message" => "Please Enter Transaction ID"], 200);
        }
        // Payment Method = 1=Card, 2=Apple Pay, 3=Google Pay
        $amount = $request->payment_type == 1 ? $request->total_amount : $request->paid_amount;
        $booking_id = bin2hex(random_bytes(3));
        $transaction_id = $request->transaction_id;
        try {
            // Payment Type = 1=Full Payment, 2=Split Payment
            $transaction = new Transaction;
            $transaction->vendor_id = $dome->vendor_id;
            $transaction->dome_id = $dome_id;
            if ($request->booking_type == 1) {
                $transaction->dome_id = $dome->id;
            } else {
                $transaction->league_id = $league->id;
            }
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
            $booking->sport_id = $sport_id;
            $booking->field_id = $field_id;
            $booking->booking_id = $booking_id;
            $booking->customer_name = $user->name != "" ? $user->name : null;
            $booking->customer_email = $user->email;
            $booking->customer_mobile = $user->phone != "" ? $user->phone : null;
            $booking->team_name = $team_name; // Use For Leagues Bookings Only
            $booking->players = $request->players;
            if ($request->booking_type == 1) {
                $booking->slots = $request->slots; // Use For Domes Bookings Only
            }
            if ($request->booking_type == 2) {
                $booking->start_date = $league->start_date; // Use For League Bookings Only
                $booking->end_date = $league->end_date; // Use For League Bookings Only
            } else {
                $booking->start_date = $request->date; // Use For Dome Bookings Only
            }
            $booking->start_time = $request->booking_type == 1 ? $request->start_time : $league->start_time;
            $booking->end_time = $request->booking_type == 1 ? $request->end_time : $league->end_time;
            $booking->total_amount = $request->total_amount;
            $booking->paid_amount = $request->payment_type == 1 ? 0 : $request->paid_amount;
            $booking->due_amount = $request->payment_type == 1 ? 0 : $request->total_amount - $request->paid_amount;
            $booking->payment_type = $request->payment_type;
            $booking->payment_status = $booking->due_amount == 0 ? 1 : 2;
            $booking->booking_status = $booking->payment_status == 1 ? 1 : 2;
            if ($request->payment_type == 2) {
                $booking->token = str_replace(['$', '/', '.', '|'], '', Hash::make($booking_id));
            }
            $booking->save();

            return response()->json(['status' => 1, "message" => "Successful", "transaction_id" => $transaction_id, "booking_id" => $booking->booking_id, "payment_link" => URL::to('/payment/' . $booking->token),], 200);
        } catch (\Throwable $th) {
            dd($th);
            return response()->json(['status' => 0, "message" => "Something Went Wrong"], 200);
        }
    }
}
