<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

    public function edit_profile(Request $request)
    {
        return view('admin.settings.edit_profile');
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
}
