<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CMS;
use Illuminate\Http\Request;

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
        return view('admin.cms.terms_condition',compact('content'));
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
        return view('admin.settings.edit_profile');
    }
    public function update_profile(Request $request)
    {
        dd($request->input());
        return view('admin.settings.edit_profile');
    }
}
