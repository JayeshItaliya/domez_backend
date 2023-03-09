<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login_dev(Request $request)
    {
        if (Auth::user()->type == 1) {
            Auth::loginUsingId(2);
        } else {
            Auth::loginUsingId(1);
        }
        return redirect('admin/dashboard')->with('success', trans('messages.success'));
    }
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

    public function supports(Request $request)
    {
        $getsupportslist = Enquiries::where('type', 5)->orderByDesc('id')->get();
        return view('admin.supports.index', compact('getsupportslist'));
    }
}
