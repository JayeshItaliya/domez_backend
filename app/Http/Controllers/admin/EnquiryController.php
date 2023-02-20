<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function dome_requests(Request $request)
    {
        return view('admin.enquiry.dome_requests');
    }
    public function general_enquiry(Request $request)
    {
        return view('admin.enquiry.general_enquiry');
    }
    public function help_support(Request $request)
    {
        return view('admin.enquiry.help_support');
    }
}
