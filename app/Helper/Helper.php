<?php

namespace App\Helper;

use App\Models\Booking;
use App\Models\CMS;
use App\Models\Domes;
use App\Models\Enquiries;
use App\Models\Favourite;
use App\Models\PaymentGateway;
use App\Models\SetPrices;
use App\Models\Sports;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Stripe;
use Stripe\Refund;
use Stripe\PaymentIntent;

class Helper
{
    public static function image_path($image)
    {
        $path = url('storage/app/public/admin/images/' . $image);
        if (Str::contains($image, 'logo')) {
            $path = url('storage/app/public/admin/images/' . $image);
        }
        if (Str::contains($image, 'favicon')) {
            $path = url('storage/app/public/admin/images/favicon/' . $image);
        }
        if (Str::contains($image, 'vendor') || Str::contains($image, 'default') || Str::contains($image, 'user') || Str::contains($image, 'profiles')) {
            $path = url('storage/app/public/admin/images/profiles/' . $image);
        }
        if (
            Str::contains($image, 'login') || Str::contains($image, 'register') ||
            Str::contains($image, 'forgot_password') || Str::contains($image, 'verification') || Str::contains($image, 'apple') || Str::contains($image, 'google') || Str::contains($image, 'facebook') || Str::contains($image, 'email')
        ) {
            $path = url('storage/app/public/admin/images/authentication/' . $image);
        }
        if (Str::contains($image, 'sport')) {
            $path = url('storage/app/public/admin/images/sports/' . $image);
        }
        if (Str::contains($image, 'dome')) {
            $path = url('storage/app/public/admin/images/domes/' . $image);
        }
        if (Str::contains($image, 'default_league') || Str::contains($image, 'league')) {
            $path = url('storage/app/public/admin/images/league/' . $image);
        }
        if (Str::contains($image, 'field')) {
            $path = url('storage/app/public/admin/images/fields/' . $image);
        }

        return $path;
    }
    public static function booking_cancelled_email($title, $description, $bookingdata, $type)
    {
        try {
            // $type == 1(ByAutoCancel) == 2(ByDomeOwner) == 3(ByCustomer)
            $data = ['title' => $title, 'email' => $bookingdata->customer_email, 'type' => $type, 'description' => $description, 'bookingdata' => $bookingdata];
            Mail::send('email.auto_booking_cancel', $data, function ($message) use ($data) {
                $message->from(env('MAIL_USERNAME'))->subject($data['title']);
                $message->to($data['email']);
            });
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }
    public static function verificationemail($email, $name, $otp)
    {
        $data = ['title' => 'Email Verification', 'email' => $email, 'name' => $name, 'otp' => $otp, 'logo' => Helper::image_path('logo.png')];
        try {
            Mail::send('email.otp_verification', $data, function ($message) use ($data) {
                $message->from(env('MAIL_USERNAME'))->subject($data['title']);
                $message->to($data['email']);
            });
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }
    public static function forgotpassword($email, $name, $password)
    {
        $data = ['title' => 'Forgot Password', 'email' => $email, 'name' => $name, 'password' => $password, 'logo' => Helper::image_path('logo.png')];
        try {
            Mail::send('email.forgot_password', $data, function ($message) use ($data) {
                $message->from(env('MAIL_USERNAME'))->subject($data['title']);
                $message->to($data['email']);
            });
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }
    public static function invite_dome($venue_name, $venue_address, $name, $email, $phone, $comment)
    {
        $data = ['title' => 'New Domes Invitation', 'email' => $email, 'name' => $name, 'venue_name' => $venue_name, 'venue_address' => $venue_address, 'phone' => $phone, 'comment' => $comment, 'logo' => Helper::image_path('logo.png')];
        try {
            Mail::send('email.domes_invitation', $data, function ($message) use ($data) {
                $message->from(env('MAIL_USERNAME'))->subject($data['title']);
                $message->to(env('MAIL_USERNAME'));
            });
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }
    public static function is_fav($user_id, $dome_id, $league_id)
    {
        $checkfav = Favourite::where('user_id', $user_id);
        $checkfav = $league_id != "" ? $checkfav->where('league_id', $league_id) : $checkfav = $checkfav->where('dome_id', $dome_id);
        $checkfav = $checkfav->first();
        if (!empty($checkfav)) {
            return true;
        } else {
            return false;
        }
    }
    public static function stripe_data()
    {
        return PaymentGateway::select('public_key', 'secret_key')->where('type', 1)->first();
    }
    public static function date_format($date)
    {
        return date('d M, Y', strtotime($date));
    }
    public static function time_format($time)
    {
        return date('h:i A', strtotime($time));
    }
    public static function currency_format($price)
    {
        return '$' . number_format($price, 2);
    }
    public static function cms($type)
    {
        return @CMS::where('type', $type)->select('content')->first()->content;
    }
    public static function get_slot_duration($dome_id)
    {
        $getduration = Domes::find($dome_id);
        return $getduration->slot_duration == 2 ? 90 : 60;
    }
    public static function get_dome_price($dome_id, $sport_id)
    {
        $checkpricetype = SetPrices::where('dome_id', $dome_id)->where('sport_id', $sport_id)->where('price_type', 1)->first();
        return !empty($checkpricetype) ? $checkpricetype->price : 0;
    }
    public static function get_sports_list($sports_id)
    {
        // SPORTS_ID : CAN BE IN COMMA SAPERATED FORMAT
        $sportslist = Sports::select('id', 'name', DB::raw("CONCAT('" . url('storage/app/public/admin/images/sports') . "/', image) AS image"));
        if ($sports_id != "") {
            $sportslist = $sportslist->whereIn('id', explode(',', $sports_id));
        }
        $sportslist = $sportslist->where('is_available', 1)->where('is_deleted', 2)->get();
        return $sportslist;
    }
    public static function refund_cancel_booking($booking_id)
    {
        // -------------------- NOTE ---------------------- //
        // -------- Type 1 = Dome Owner && 2 = User ------- //
        // ------------------------------------------------ //
        $booking = Booking::find($booking_id);
        try {
            Stripe\Stripe::setApiKey(Helper::stripe_data()->secret_key);
            $transactions = $booking->transactions->pluck('transaction_id');
            foreach ($transactions as $transaction) {
                $payment_intent = PaymentIntent::retrieve($transaction);
                $refunds = Refund::create([
                    'charge' => $payment_intent->charges->data[0]->id,
                    'amount' => $payment_intent->charges->data[0]->amount,
                ]);
                $refunded_amount[] = $refunds->amount / 100;
            }
            $booking->refunded_amount = array_sum($refunded_amount);
            $booking->payment_status = 3;
            $booking->booking_status = 3;
            $booking->save();
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }
    public static function send_notification($title, $body, $type, $booking_id, $league_id, $tokens)
    {
        // TYPE  =  1  ->  MANUAL ---  Aftre Create Booking --> in case of split payment --> Notify to complete payment in 2 hours to confirm the booking
        // TYPE  =  2  ->  AUTO   ---  Send Notitification One Day Before to League Booked Users To Notify That League Is going To Start Tomorrow
        // TYPE  =  3  ->  AUTO   ---  Send Notification to User to notify to add the review When User has not added The Review On Booking End time
        // TYPE  =  5  ->  MANUAL ---  DOME BOOKING IS CONFIRMED (booking_id)
        // TYPE  =  6  ->  MANUAL ---  LEAGUE BOOKING IS CONFIRMED (booking_id)
        // TYPE  =  4  ->  MANUAL ---  NEW LEAGUE IS ADDED BY DOME OWNER (only those users who've been favourited that dome) (league_id)
        try {
            is_array($tokens) ? $gettokens = $tokens : $gettokens[] = $tokens;
            $title = $title == "" ? "Domez Notification" : $title;
            $body = $body == "" ? "Domez Notification Message" : $body;
            $fields = [
                'registration_ids' => $gettokens,
                'data' => [
                    "NotificationId" => substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 10),
                    "type" => $type,
                    "booking_id" => $booking_id,
                    "league_id" => $league_id,
                ],
                'notification' => [
                    'title' => $title,
                    'body' => $body,
                    'click_action' => 'FLUTTER_NOTIFICATION_CLICK'
                ]
            ];
            $headers = [
                'Authorization: key=' . env('FIREBASE_KEY'),
                'Content-Type: application/json'
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);
            curl_close($ch);
            return $result;
        } catch (\Throwable $th) {
        }
    }

    // Used For Admins Only
    public static function get_noti_count($type)
    {
        $getcount = Enquiries::where('type', $type)->where('is_replied', 2)->count();
        if ($type == 5 && auth()->user()->type != 1) {
            $getcount = Enquiries::where('type', $type)->where('vendor_id', auth()->user()->type == 2 ? auth()->user()->id : auth()->user()->vendor_id)->where('is_replied', 2)->count();
        }
        return $getcount;
    }
    public static function getTodayBookings()
    {
        $getbookings = Booking::where('vendor_id', auth()->user()->type == 2 ? auth()->user()->id : auth()->user()->vendor_id)->whereDate('created_at', date('Y-m-d'))->orderByDesc('id')->take(5)->get();
        return $getbookings;
    }
    public static function breadcrumb_home_li()
    {
        $html = '<li class="breadcrumb-item">
                    <a href="' . route('admins.dashboard') . '">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home"
                            width="20" height="20" viewBox="0 0 24 24" stroke-width="2"
                            stroke="var(--bs-secondary)" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <polyline points="5 12 3 12 12 3 21 12 19 12" />
                            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                            <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                        </svg>
                    </a>
                </li>';
        return $html;
    }






    // public static function verificationsms($mobile, $otp)
    // {
    //     try {
    //         $getconfiguration = OTPConfiguration::where('status', 1)->first();
    //         if (!empty($getconfiguration)) {
    //             if ($getconfiguration->name == "twilio") {
    //                 $sid    = env('TWILIO_SID');
    //                 $token  = env('TWILIO_AUTH_TOKEN');
    //                 $twilio = new Client($sid, $token);
    //                 $message = $twilio->messages->create($mobile, array("from" => env('TWILIO_PHONE_NUMBER'), "body" => "Your Verification Code is : " . $otp));
    //             }
    //             if ($getconfiguration->name == "msg91") {
    //                 $curl = curl_init();
    //                 curl_setopt_array($curl, array(
    //                     CURLOPT_URL => "https://api.msg91.com/api/v5/otp?template_id=" . $getconfiguration->msg_template_id . "&mobile=" . $mobile . "&authkey=" . $getconfiguration->msg_authkey . "",
    //                     CURLOPT_RETURNTRANSFER => true,
    //                     CURLOPT_ENCODING => "",
    //                     CURLOPT_MAXREDIRS => 10,
    //                     CURLOPT_TIMEOUT => 30,
    //                     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //                     CURLOPT_CUSTOMREQUEST => "GET",
    //                     CURLOPT_HTTPHEADER => array("content-type: application/json"),
    //                 ));
    //                 $response = curl_exec($curl);
    //                 $err = curl_error($curl);
    //                 curl_close($curl);
    //             }
    //             return 1;
    //         }
    //         return 0;
    //     } catch (\Throwable $th) {
    //         return 0;
    //     }
    // }
}
