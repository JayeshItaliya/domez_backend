<?php

namespace App\Http\Controllers\api;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Domes;
use App\Models\League;
use App\Models\SetPricesDaysSlots;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function stripe_key(Request $request)
    {
        // \Stripe\Stripe::setApiKey(Helper::stripe_data()->secret_key);
        // $source = \Stripe\PaymentIntent::retrieve('pi_3MvJVzFysF0okTxJ1AmFph3m')->charges->data[0]->payment_method_details->card->wallet->type;
        // $source = \Stripe\PaymentIntent::retrieve('pi_3MuwTgFysF0okTxJ1Zsj53q0')->charges->data;
        // if(empty($source)){
        //     $type = 'card';
        // }else{;
        //     $type = $source[0]->payment_method_details->card->wallet->type;
        // }
        return response()->json(["status" => 1, "message" => "Successfull", 'data' => Helper::stripe_data()], 200);
    }
    public function payment(Request $request)
    {
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
            foreach (explode(',', $request->slots) as $key => $slot) {
                $check = SetPricesDaysSlots::where('start_time', date('H:i', strtotime(explode(' - ', $slot)[0])))->where('end_time', date('H:i', strtotime(explode(' - ', $slot)[1])))->where('sport_id', $request->sport_id)->whereDate('date', date('Y-m-d', strtotime($request->start_date)))->where('status', 0)->first();
                if (!empty($check)) {
                    return response()->json(["status" => 0, "message" => "Time Slots Has been selected "], 200);
                }
            }
        } else {
            $league = League::where('id', $request->league_id)->whereDate('booking_deadline', '>=', date('Y-m-d'))->where('is_deleted', 2)->first();
            $dome = @$league->dome_info;
            if ($request->league_id == "") {
                return response()->json(["status" => 0, "message" => "Please Enter League ID"], 200);
            }
            if (empty($league)) {
                return response()->json(["status" => 0, "message" => "League Not Found"], 200);
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
            if ($request->customer_email == "") {
                return response()->json(["status" => 0, "message" => "Please Enter Customer Email"], 200);
            }
            $checkuser = User::where('email', $request->customer_email)->first();
            if (empty($checkuser)) {
                $password = Str::random(8);
                $user = new User();
                $user->type = 3;
                $user->login_type = 1;
                $user->email = $request->customer_email;
                $user->password = Hash::make($password);
                $user->is_verified = 1;
                $user->fcm_token = $request->fcm_token;
                $user->save();
                $data = ['title' => 'Domez App Login Credential', 'email' => $user->email, 'name' => $request->name ?? '', 'password' => $password, 'logo' => Helper::image_path('logo.png')];
                Mail::send('email.share_login_details', $data, function ($message) use ($data) {
                    $message->from(config('app.mail_username'))->subject($data['title']);
                    $message->to($data['email']);
                });
            } else {
                $user = $checkuser;
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
        $amount = $request->payment_type == 1 ? $request->total_amount : $request->paid_amount;
        $booking_id = bin2hex(random_bytes(4));
        $transaction_id = $request->transaction_id;
        DB::beginTransaction();
        try {
            $booking = new Booking();
            $booking->type = $request->booking_type;
            $booking->vendor_id = $dome->vendor_id;
            if (@$league->provider_id != "") {
                $booking->provider_id = $league->provider_id;
            }
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
            $booking->customer_name = $user->name ?? '';
            $booking->customer_email = $user->email;
            $booking->customer_mobile = $user->phone ?? '';
            $booking->team_name = $team_name;
            $booking->players = $request->players;
            if ($request->booking_type == 1) {
                $booking->slots = $request->slots;
            }
            if ($request->booking_type == 2) {
                $booking->start_date = $league->start_date;
                $booking->end_date = $league->end_date;
            } else {
                $booking->start_date = $request->date;
            }
            $booking->start_time = Carbon::createFromFormat('h:i A', $request->booking_type == 1 ? $request->start_time : $league->start_time)->format('H:i');
            $booking->end_time = Carbon::createFromFormat('h:i A', $request->booking_type == 1 ? $request->end_time : $league->end_time)->format('H:i');;
            $booking->sub_total = $request->sub_total;
            $booking->service_fee = $request->service_fee;
            $booking->hst = $request->hst;
            $booking->total_amount = $request->total_amount;
            $booking->paid_amount = $request->paid_amount;
            $booking->due_amount = $request->due_amount;
            $booking->min_split_amount = $request->min_split_amount;
            $booking->payment_type = $request->payment_type;
            $booking->payment_status = $booking->due_amount == 0 ? 1 : 2;
            $booking->booking_status = $booking->payment_status == 1 ? 1 : 2;
            $booking->token = str_replace(['$', '/', '.', '|'], '', Hash::make($booking_id));
            $booking->save();

            $transaction = new Transaction();
            $transaction->type = 1;
            $transaction->vendor_id = $dome->vendor_id;
            $transaction->dome_id = $dome_id;
            if ($request->booking_type == 2) {
                $transaction->league_id = $league->id;
            }
            $transaction->user_id = $user->id;
            $transaction->booking_id = $booking_id;
            $transaction->payment_method = $request->payment_method;
            $transaction->transaction_id = $transaction_id;
            $transaction->amount = $amount;
            $transaction->save();
            if ($request->booking_type == 1) {
                foreach (explode(',', $request->slots) as $key => $slot) {
                    $start_time = date('H:i', strtotime(explode(' - ', $slot)[0]));
                    $end_time = date('H:i', strtotime(explode(' - ', $slot)[1]));
                    SetPricesDaysSlots::where('start_time', $start_time)->where('end_time', $end_time)->where('sport_id', $booking->sport_id)->whereDate('date', date('Y-m-d', strtotime($booking->start_date)))->where('status', 1)->update(['status' => 0]);
                }
            }
            $title = $request->booking_type == 1 ? 'Dome Booking' : 'League Booking';
            $body = 'Thank you for making '.$title;
            $tokens[] = $user->fcm_token;
            if ($booking->payment_status == 1) {
                $type = $request->booking_type == 1 ? 5 : 6;
                Helper::send_notification($title, $body, $type, $booking_id, '', $tokens);
            }
            if ($booking->payment_type == 2) {
                $type = 1;
                $body = 'Thank you for your Booking with us! Please complete the payment within the next 2 hours to ensure that your booking is Confirmed.';
                Helper::send_notification($title, $body, $type, $booking_id, '', $tokens);
            }
            Helper::booking_confirmation($booking);
            DB::commit();
            return response()->json(['status' => 1, "message" => "Successful", "transaction_id" => $transaction_id, "booking_id" => $booking->id, "payment_link" => URL::to('/payment/' . $booking->token),], 200);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['status' => 0, "message" => 'Something went wrong..'], 200);
        }
    }
    public function split_payment_process(Request $request)
    {
        DB::beginTransaction();
        try {
            $checktransaction = Transaction::where('transaction_id', $request->transaction_id)->first();
            if (empty($checktransaction)) {
                $checkbooking = Booking::where('id', $request->booking_id)->first();
                $checkbooking->due_amount -= $request->amount;
                $checkbooking->paid_amount += $request->amount;
                $checkbooking->save();
                $newcheckbooking = Booking::where('id', $request->booking_id)->first();
                if ($newcheckbooking->due_amount == 0) {
                    $newcheckbooking->booking_status = 1;
                    $newcheckbooking->payment_status = 1;
                    $newcheckbooking->save();
                }
                $checkbooking1 = Booking::where('id', $request->booking_id)->first();
                $transaction = new Transaction();
                $transaction->type = 1;
                $transaction->vendor_id = $checkbooking1->vendor_id;
                $transaction->dome_id = $checkbooking1->dome_id;
                $transaction->league_id = $checkbooking1->league_id;
                $transaction->booking_id = $checkbooking1->booking_id;
                $transaction->contributor_name = $request->contributor_name;
                $transaction->payment_method = $request->payment_method;
                $transaction->transaction_id = $request->transaction_id;
                $transaction->amount = $request->amount;
                $transaction->save();
                if ($checkbooking1->due_amount > 0) {
                    $totalpendingplayers = $checkbooking1->players - $checkbooking1->transactions->count();
                    $checkbooking1->min_split_amount = $totalpendingplayers > 1 ? $checkbooking1->due_amount / $totalpendingplayers : $checkbooking1->due_amount;
                    $checkbooking1->save();
                }
                if ($checkbooking1->booking_status == 1 && $checkbooking1->payment_status == 1) {
                    $title = $checkbooking1->booking_type == 1 ? 'Dome Booking' : 'League Booking';
                    $tokens[] = $checkbooking1->user_info->fcm_token;
                    if ($checkbooking1->booking_type == 1) {
                        $body = 'Payment Successful. Dome Booking has been Confirmed.';
                        $type = 5;
                    } else {
                        $body = 'Payment Successful. League Booking has been Confirmed.';
                        $type = 6;
                    }
                    Helper::send_notification($title, $body, $type, $checkbooking1->booking_id, '', $tokens);
                }
            }
            DB::commit();
            return response()->json(['status' => 1, 'message' => 'Payment Successfull'], 200);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['status' => 0, 'message' => 'Something Went Wrong..!!'], 200);
        }
    }
}
