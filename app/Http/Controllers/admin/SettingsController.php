<?php

namespace App\Http\Controllers\admin;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\CMS;
use App\Models\PaymentGateway;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function privacy_policy(Request $request)
    {
        return view('admin.cms.privacy_policy');
    }
    public function terms_conditions(Request $request)
    {
        return view('admin.cms.terms_condition');
    }
    public function cancellation_policies(Request $request)
    {
        return view('admin.cms.cancellation_policies');
    }
    public function refund_policy(Request $request)
    {
        return view('admin.cms.refund_policy');
    }
    public function store_cms(Request $request)
    {
        $request->validate([
            'content' => 'required',
        ], [
            'content.required' => trans('messages.required'),
        ]);
        if ($request->has('privacy_policy') && $request->privacy_policy == 1) {
            $data = CMS::where('type', 1)->first();
            if (empty($data)) {
                $data = new CMS();
                $data->type = 1;
            }
            $data->content = $request->content;
            $data->save();
        }
        if ($request->has('terms_conditions')) {
            $data = CMS::where('type', 2)->first();
            if (empty($data)) {
                $data = new CMS();
                $data->type = 2;
            }
            $data->content = $request->content;
            $data->save();
        }
        if ($request->has('refund_policy')) {
            $data = CMS::where('type', 3)->first();
            if (empty($data)) {
                $data = new CMS();
                $data->type = 3;
            }
            $data->content = $request->content;
            $data->save();
        }
        if ($request->has('cancellation_policy')) {
            $data = CMS::where('type', 4)->first();
            if (empty($data)) {
                $data = new CMS();
                $data->type = 4;
            }
            $data->content = $request->content;
            $data->save();
        }
        return redirect()->back()->with('success', trans('messages.success'));
    }
    public function email_setting(Request $request)
    {
        return view('admin.settings.email_setting');
    }
    public function store_email_setting(Request $request)
    {
        $request->validate([
            'mailer' => 'required',
            'host' => 'required',
            'port' => 'required',
            'username' => 'required',
            'password' => 'required',
            'encryption' => 'required',
        ], [
            'mailer.required' => trans('messages.required'),
            'host.required' => trans('messages.required'),
            'port.required' => trans('messages.required'),
            'username.required' => trans('messages.required'),
            'password.required' => trans('messages.required'),
            'encryption.required' => trans('messages.required'),
        ]);
        $envFile = base_path('.env');
        file_put_contents($envFile, str_replace('MAIL_MAILER=' . env('MAIL_MAILER'), 'MAIL_MAILER=' . $request->mailer, file_get_contents($envFile)));
        file_put_contents($envFile, str_replace('MAIL_HOST=' . env('MAIL_HOST'), 'MAIL_HOST=' . $request->host, file_get_contents($envFile)));
        file_put_contents($envFile, str_replace('MAIL_PORT=' . env('MAIL_PORT'), 'MAIL_PORT=' . $request->port, file_get_contents($envFile)));
        file_put_contents($envFile, str_replace('MAIL_USERNAME=' . env('MAIL_USERNAME'), 'MAIL_USERNAME=' . $request->username, file_get_contents($envFile)));
        file_put_contents($envFile, str_replace('MAIL_PASSWORD=' . env('MAIL_PASSWORD'), 'MAIL_PASSWORD=' . $request->password, file_get_contents($envFile)));
        file_put_contents($envFile, str_replace('MAIL_ENCRYPTION=' . env('MAIL_ENCRYPTION'), 'MAIL_ENCRYPTION=' . $request->encryption, file_get_contents($envFile)));
        return redirect()->back()->with('success', trans('messages.success'));
    }
    public function stripe_setting(Request $request)
    {
        $stripe = PaymentGateway::where('type', 1)->where('vendor_id', auth()->user()->id)->first();
        return view('admin.settings.stripe_setting', compact('stripe'));
    }
    public function show_profile(Request $request)
    {
        return view('admin.settings.edit_profile');
    }
    public function checkemailexist(Request $request)
    {
        $validator = Validator::make($request->input(), [
            'email' => 'required|email|unique:users,email,' . auth()->user()->id,
        ], [
            'email.required' => trans('messages.email_required'),
            'email.email' => trans('messages.valid_email'),
            'email.unique' => trans('messages.email_exist'),
        ]);
        if ($validator->fails()) {
            foreach ($validator->errors()->toArray() as $key => $error) {
                return response()->json(["status" => 0, "message" => $error[0]], 200);
                if ($key == 0)
                    break;
            }
        }
        try {
            $otp = rand(1000, 9999);
            $user = User::where('email', auth()->user()->email)->first();
            $user->otp = $otp;
            $user->save();
            $sendemail = Helper::verificationemail($request->email, auth()->user()->name, $otp);
            if ($sendemail == 1) {
                return response()->json(["status" => 1, "message" => trans('messages.success')], 200);
            }
            return response()->json(["status" => 0, "message" => trans('messages.email_error')], 200);
        } catch (\Throwable $th) {
            return response()->json(["status" => 0, "message" => trans('messages.wrong')], 200);
        }
    }
    public function verifyemail(Request $request)
    {
        try {
            if ($request->otp == '') {
                return response()->json(["status" => 0, "message" => trans('messages.otp_required')], 200);
            }
            $user = User::find(auth()->user()->id);
            if ($user->otp != $request->otp) {
                return response()->json(["status" => 0, "message" => trans('messages.invalid_otp')], 200);
            }
            $user->email = $request->email;
            $user->otp = '';
            $user->save();
            return response()->json(["status" => 1, "message" => trans('messages.success')], 200);
        } catch (\Throwable $th) {
            return response()->json(["status" => 0, "message" => trans('messages.wrong')], 200);
        }
    }
    public function update_profile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'unique:users,phone,' . auth()->user()->id,
        ], [
            'name.required' => trans('messages.name_required'),
            'phone.unique' => trans('messages.phone_exist'),
        ]);
        $user = User::find(auth()->user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if ($request->has('image')) {
            $request->validate([
                'profile' => 'image|mimes:png,jpg,jpeg,svg|max:7168'
            ], [
                'profile.image' => trans('messages.valid_image'),
                'profile.mimes' => trans('messages.valid_image_type'),
            ]);
            if (auth()->user()->image != 'default.png' && file_exists('storage/app/public/admin/images/profiles/' . auth()->user()->image)) {
                unlink('storage/app/public/admin/images/profiles/' . auth()->user()->image);
            }
            $image = 'profiles-' . uniqid() . '.' . $request->profile->getClientOriginalExtension();
            $request->profile->move(storage_path('app\public\admin\images\profiles'), $image);
            $user->image = $image;
        }
        $user->save();
        return redirect('admin/settings/edit-profile')->with('success', trans('messages.success'));
    }
    public function change_password(Request $request)
    {
        $request->validate([
            'current_password' => 'required|min:8',
            'new_password' => 'required|min:8|different:current_password',
            'confirm_password' => 'required|same:new_password|min:8',
        ], [
            'current_password.required' => trans('messages.old_password_required'),
            'current_password.min' => trans('messages.password_min_length'),
            'new_password.required' => trans('messages.new_password_required'),
            'new_password.different' => trans('messages.new_password_diffrent'),
            'new_password.min' => trans('messages.password_min_length'),
            'confirm_password.required' => trans('messages.confirm_password_required'),
            'confirm_password.same' => trans('messages.confirm_password_same'),
            'confirm_password.min' => trans('messages.password_min_length'),
        ]);
        if (Hash::check($request->current_password, auth()->user()->password)) {
            User::where('id', auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);
            $data = ['title' => 'Password Updated', 'email' => auth()->user()->email];
            Mail::send('email.change_password', $data, function ($message) use ($data) {
                $message->from(env('MAIL_USERNAME'))->subject($data['title']);
                $message->to($data['email']);
            });
            return redirect()->back()->with('success', trans('messages.success'));
        } else {
            return redirect()->back()->with('error', trans('messages.old_password_invalid'));
        }
    }
    public function change_language(Request $request)
    {
        $cookie = cookie('locale', $request->lang, 60 * 24 * 365);
        return redirect()->back()->withCookie($cookie);
    }
    public function resetpassword(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'userid' => 'required|exists:users,id',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password|min:8',
        ], [
            '*.required' => trans('messages.field_required'),
            'userid.*' => trans('messages.invalid_request'),
            'new_password.different' => trans('messages.new_password_diffrent'),
            'confirm_password.same' => trans('messages.confirm_password_same'),
            '*.min' => trans('messages.password_min_length')
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 0, 'message' => trans('messages.error'), 'errors' => $validator->getMessageBag()], 200);
        }
        $cu = User::where('id', $req->userid)->first();
        if (empty($cu)) {
            return response()->json(['status' => 0, 'message' => trans('messages.invalid_request')], 200);
        }
        try {
            $cu->password = Hash::make($req->new_password);
            $cu->save();
            return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
        }
    }
}
