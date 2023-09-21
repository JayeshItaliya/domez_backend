<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Helper\Helper;
use Illuminate\Support\Str;

class AuthenticationController extends Controller
{
    public function index(Request $request)
    {
        // User::where('email','ahmeed252523@gmail.com')->update(['password'=>Hash::make(12345678)]);
        return view('admin.authentication.login');
    }
    public function checklogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ], [
            'email.required' => trans('messages.email_required'),
            'email.email' => trans('messages.valid_email'),
            'password.required' => trans('messages.password_required'),
            'password.min' => trans('messages.password_min_length'),
        ]);
        if (Auth::attempt($request->only('email', 'password'))) {
            if (in_array(auth()->user()->type, [1, 2, 4, 5])) {
                if (auth()->user()->is_verified == 1) {
                    if (auth()->user()->is_available == 1) {
                        if (auth()->user()->is_deleted == 2) {
                            if (auth()->user()->type == 5) {
                                return redirect('admin/leagues')->with('success', trans('messages.success'));
                            } else {
                                return redirect('admin/dashboard')->with('success', trans('messages.success'));
                            }
                        } else {
                            Auth::logout();
                            return redirect()->back()->with('error', trans('messages.account_deleted'));
                        }
                    } else {
                        Auth::logout();
                        return redirect()->back()->with('error', trans('messages.account_inactive'));
                    }
                } else {
                    $otp = rand(1000, 9999);
                    $user = User::where('email', auth()->user()->email)->first();
                    $user->otp = $otp;
                    $user->save();
                    $send_mail = Helper::verificationemail($user->email, $user->name, $otp);
                    session()->put('verification_email', auth()->user()->email);
                    Auth::logout();
                    if ($send_mail == 1) {
                        return redirect('verification')->with('success', trans('messages.email_sent'));
                    } else {
                        return redirect()->back()->with('error', trans('messages.email_error'));
                    }
                }
            }
            Auth::logout();
            return redirect()->back()->with('error', trans('messages.email_pass_invalid'));
        } else {

            return redirect()->back()->with('error', trans('messages.email_pass_invalid'));
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('login')->with('success', trans('messages.success'));
    }
    public function verification(Request $request)
    {
        return view('admin.authentication.verification');
    }
    public function forgot_password(Request $request)
    {
        return view('admin.authentication.forgot_password');
    }
    public function send_pass(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ], [
            'email.required' => trans('messages.email_required'),
            'email.email' => trans('messages.valid_email')
        ]);
        $checkuser = User::where('email', $request->email)->first();
        if (!empty($checkuser)) {
            $password = Str::random(10);
            $send_mail = Helper::forgotpassword($checkuser->email, $checkuser->name, $password);
            if ($send_mail == 1) {
                $checkuser->password = Hash::make($password);
                $checkuser->save();
                return redirect('check-mail')->with('success', trans('messages.email_sent'));
            }
            return redirect()->back()->with('error', trans('messages.email_error'));
        } else {
            return redirect()->back()->with('error', trans('messages.invalid_email'));
        }
    }
    public function check_mail(Request $request)
    {
        return view('admin.authentication.check_mail');
    }
    public function resend(Request $request)
    {
        $otp = rand(1000, 9999);
        $user = User::where('email', auth()->user()->email)->first();
        $user->otp = $otp;
        $user->save();
        $send_mail = Helper::verificationemail($user->email, $user->name, $otp);
        session()->put('verification_email', auth()->user()->email);
        if ($send_mail == 1) {
            return redirect()->back()->with('success', trans('messages.email_sent'));
        } else {
            return redirect()->back()->with('error', trans('messages.email_error'));
        }
    }
    public function verify(Request $request)
    {
        if (implode("", $request->otp) == "") {
            return redirect()->back()->with('error', trans('messages.otp_required'));
        }
        $otp = implode("", $request->otp);
        $user = User::where('email', session('verification_email'))->first();
        if (!empty($user)) {
            if ($user->otp == $otp) {
                session()->forget('verification_email');
                $user->otp = 0;
                $user->is_verified = 1;
                $user->save();
                Auth::login($user);
                return redirect('admin/dashboard')->with('success', trans('messages.success'));
            } else {
                return redirect()->back()->with('error', trans('messages.invalid_otp'));
            }
        } else {
            return redirect()->back()->with('error', trans('messages.wrong'));
        }
    }
}
