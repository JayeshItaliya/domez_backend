<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CMS;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        return view('admin.dashboard.index');
    }
    public function landing(Request $request)
    {
        return view('landing.index');
    }
    public function contact(Request $request)
    {
        return view('landing.contact');
    }
    public function privacy_policy(Request $request)
    {
        // $content = CMS::where('type', 1)->first();
        // return view('admin.cms.privacy_policy', compact('content'));
    }

    public function store_privacy_policy(Request $request)
    {
        $request->validate([
            'content' => 'required'
        ], [
            'content.required' => 'This Field is Required.'
        ]);
        if (CMS::where('type', 1)->count() == 0) {
            $content = new CMS;
            $content->type = 1;
            $content->content = $request->content;
            $content->save();

            return redirect()->back()->with('success', 'Successfully');
        } else {
            $content = CMS::where('type', 1)->first();
            $content->content = $request->content;
            $content->save();

            return redirect()->back()->with('success', 'Updated');
        }
    }

    public function terms_condition(Request $request)
    {
        // $content = CMS::where('type', 2)->first();
        // return view('admin.cms.terms_condition', compact('content'));
    }

    public function store_terms_condition(Request $request)
    {
        $request->validate([
            'content' => 'required'
        ], [
            'content.required' => 'This Field is Required.'
        ]);
        if (CMS::where('type', 2)->count() == 0) {
            $content = new CMS;
            $content->type = 2;
            $content->content = $request->content;
            $content->save();

            return redirect()->back()->with('success', 'Successfully');
        } else {
            $content = CMS::where('type', 2)->first();
            $content->content = $request->content;
            $content->save();

            return redirect()->back()->with('success', 'Updated');
        }
    }

    public function refund_policy(Request $request)
    {
        $content = CMS::where('type', 3)->first();
        return view('admin.cms.refund_policy', compact('content'));
    }

    public function store_refund_policy(Request $request)
    {
        $request->validate([
            'content' => 'required'
        ], [
            'content.required' => 'This Field is Required.'
        ]);
        if (CMS::where('type', 3)->count() == 0) {
            $content = new CMS;
            $content->type = 3;
            $content->content = $request->content;
            $content->save();

            return redirect()->back()->with('success', 'Successfully');
        } else {
            $content = CMS::where('type', 3)->first();
            $content->content = $request->content;
            $content->save();

            return redirect()->back()->with('success', 'Updated');
        }

    }
    public function settings(Request $request){
        $user = User::find(Auth::user()->id);
        return view('admin.settings.index', compact('user'));
    }
}
