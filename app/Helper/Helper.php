<?php

namespace App\Helper;

use App\Models\Favourite;
use App\Models\PaymentGateway;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

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
        if (Str::contains($image, 'vendor') || Str::contains($image, 'default') || Str::contains($image, 'user')) {
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
            $path = url('storage/app/public/admin/images/leagues/' . $image);
        }
        if (Str::contains($image, 'field')) {
            $path = url('storage/app/public/admin/images/fields/' . $image);
        }

        return $path;
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
        if (!empty(Favourite::where('user_id', $user_id)->where('dome_id', $dome_id)->orWhere('league_id', $league_id)->first())) {
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
        return '$' . $price;
    }
    // public static function verificationsms($mobile, $otp)
    // {
    //     try {
    //         $getconfiguration = OTPConfiguration::where('status', 1)->first();
    //         if (!empty($getconfiguration)) {
    //             if ($getconfiguration->name == "twilio") {
    //                 $sid    = $getconfiguration->twilio_sid;
    //                 $token  = $getconfiguration->twilio_auth_token;
    //                 $twilio = new Client($sid, $token);
    //                 $message = $twilio->messages->create($mobile, array("from" => $getconfiguration->twilio_mobile_number, "body" => "Your Verification Code is : " . $otp));
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
