<?php

namespace App\Helper;

use App\Models\PaymentGateway;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
class Helper
{
    public static function image_path($image)
    {
        $path = url('storage/app/public/admin/images/' . $image);
        if(Str::contains($image , 'logo')){
            $path = url('storage/app/public/admin/images/' . $image);
        }
        if(Str::contains($image , 'favicon')){
            $path = url('storage/app/public/admin/images/favicon/' . $image);
        }
        if(Str::contains($image , 'vendor') || Str::contains($image , 'default') || Str::contains($image , 'user')){
            $path = url('storage/app/public/admin/images/profiles/' . $image);
        }
        if(Str::contains($image , 'login') || Str::contains($image , 'register') ||
            Str::contains($image , 'forgot_password') || Str::contains($image , 'verification') || Str::contains($image , 'apple') || Str::contains($image , 'google') || Str::contains($image , 'facebook') || Str::contains($image , 'email')){
            $path = url('storage/app/public/admin/images/authentication/' . $image);
        }
        if(Str::contains($image , 'sport')){
            $path = url('storage/app/public/admin/images/sports/' . $image);
        }
        if(Str::contains($image , 'dome')){
            $path = url('storage/app/public/admin/images/domes/' . $image);
        }
        if(Str::contains($image , 'default_league') || Str::contains($image , 'league')){
            $path = url('storage/app/public/admin/images/leagues/' . $image);
        }
        if(Str::contains($image , 'field')){
            $path = url('storage/app/public/admin/images/fields/' . $image);
        }

        return $path;
    }

    public static function verificationemail($email, $name, $otp){
        $data=['title'=>'Email Verification','email'=>$email, 'name'=>$name,'otp'=>$otp,'logo'=>Helper::image_path('logo.png')];
        try {
            Mail::send('email.otp_verification',$data,function($message)use($data){
                $message->from(env('MAIL_USERNAME'))->subject($data['title']);
                $message->to($data['email']);
            });
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }
    public static function forgotpassword($email, $name, $password){
        $data=['title'=>'Forgot Password','email'=>$email, 'name'=>$name,'password'=>$password,'logo'=>Helper::image_path('logo.png')];
        try {
            Mail::send('email.forgot_password',$data,function($message)use($data){
                $message->from(env('MAIL_USERNAME'))->subject($data['title']);
                $message->to($data['email']);
            });
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }
    public static function invite_dome($venue_name, $venue_address, $name, $email, $phone, $comment){
        $data=['title'=>'New Domes Invitation','email'=>$email, 'name'=>$name,'venue_name'=>$venue_name, 'venue_address'=>$venue_address, 'phone'=>$phone, 'comment'=>$comment, 'logo'=>Helper::image_path('logo.png')];
        try {
            Mail::send('email.domes_invitation',$data,function($message)use($data){
                $message->from(env('MAIL_USERNAME'))->subject($data['title']);
                $message->to(env('MAIL_USERNAME'));
            });
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }

    public static function stripe_data()
    {
        return PaymentGateway::select('public_key','secret_key')->where('type', 1)->first();
    }
}
