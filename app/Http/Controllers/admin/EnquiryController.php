<?php

namespace App\Http\Controllers\admin;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Enquiries;
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

    public function general_enquiries(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required|max:150',
            'message' => 'required|max:500',
        ], [
            'name.required' => 'Name is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Invalid Email Address.',
            'subject.required' => 'Subject is required.',
            'subject.required' => 'Maximum limit of characters allowed are 150.',
            'message.required' => 'Message is required.',
            'message.required' => 'Maximum limit of characters allowed are 500.',
        ]);

        $enquiry = new Enquiries;
        $enquiry->type = 2;
        $enquiry->name = $request->name;
        $enquiry->email = $request->email;
        $enquiry->subject = $request->subject;
        $enquiry->message = $request->message;
        $enquiry->save();

        return redirect()->back()->with('success', 'Submitted Successfully');
    }

    public function dome_request(Request $request)
    {
        if($request->send_otp == 1){
            $otp = rand(1000, 9999);
            session()->put('verification_otp',$otp);
            $mail = Helper::verificationemail($request->email, $request->name, $otp);
            if($mail == 1){
                return response()->json(['status' => 1, 'message' => "Account Verification Otp email has been sent to you."],200);
            }else{
                return response()->json(['status' => 0, 'message' => "Email error!!"],200);
            }
        }
        if($request->verify_otp == 1){
            if($request->otp == ""){
                return response()->json(['status' => 0, 'message' => "Please Enter OTP"],200);
            }
            if($request->otp != session()->get('verification_otp')){
                return response()->json(['status' => 0, 'message' => "Please Enter Valid OTP"],200);
            }else{
                return response()->json(['status' => 1, 'message' => "OTP Verification Successfull"],200);
            }
        }


        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'dome_name' => 'required',
            'dome_city' => 'required',
            'dome_state' => 'required',
            'dome_country' => 'required',
        ], [
            'name.required' => 'Name is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Invalid Email Address.',
            'phone.required' => 'Phone is required.',
            'dome_name.required' => 'Dome Name is required.',
            'dome_zipcode.required' => 'Dome Zipcode is required.',
            'dome_city.required' => 'Dome City is required.',
            'dome_state.required' => 'Dome State is required.',
            'dome_country.required' => 'Dome Country is required.',
        ]);

        $enquiry = new Enquiries;
        $enquiry->type = 3;
        $enquiry->name = $request->name;
        $enquiry->email = $request->email;
        $enquiry->phone = $request->phone;
        $enquiry->dome_name = $request->dome_name;
        $enquiry->dome_zipcode = $request->dome_zipcode;
        $enquiry->dome_city = $request->dome_city;
        $enquiry->dome_state = $request->dome_state;
        $enquiry->dome_country = $request->dome_country;
        $enquiry->save();

        return redirect('/')->with('success', 'Submitted Successfully');
    }
}
