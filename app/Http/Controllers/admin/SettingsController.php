<?php

namespace App\Http\Controllers\admin;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\CMS;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function privacy_policy(Request $request)
    {
        $content = CMS::where('type', 1)->first();
        return view('admin.cms.privacy_policy', compact('content'));
    }
    public function terms_conditions(Request $request)
    {
        $content = CMS::where('type', 2)->first();
        return view('admin.cms.terms_condition', compact('content'));
    }
    public function store_cms(Request $request)
    {
        if ($request->has('privacy_policy')) {
            $data = CMS::where('type', 1)->first();
            if (empty($data)) {
                $data = new CMS;
                $data->type = 1;
            }
            $data->content = $request->content;
            $data->save();
        }
        if ($request->has('terms_conditions')) {
            $data = CMS::where('type', 2)->first();
            if (empty($data)) {
                $data = new CMS;
                $data->type = 2;
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
    public function twilio_setting(Request $request)
    {
        return view('admin.settings.twilio_setting');
    }
    public function stripe_setting(Request $request)
    {
        return view('admin.settings.stripe_setting');
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
            $user = User::where('email', Auth::user()->email)->first();
            $user->otp = $otp;
            $user->save();
            $sendemail = Helper::verificationemail($request->email, Auth::user()->name, $otp);
            if ($sendemail == 1) {
                return response()->json(["status" => 1, "message" => trans('messages.success')], 200);
            }
            return response()->json(["status" => 0, "message" => trans('messages.email_error')], 200);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return response()->json(["status" => 0, "message" => trans('messages.wrong')], 200);
        }
    }
    public function update_profile(Request $request)
    {
        dd($request->input());
        return view('admin.settings.edit_profile');
    }
}
