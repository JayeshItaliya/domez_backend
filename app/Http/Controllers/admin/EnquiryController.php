<?php

namespace App\Http\Controllers\admin;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Enquiries;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class EnquiryController extends Controller
{
    public function dome_requests(Request $request)
    {
        $enquiries = Enquiries::where('type', 3)->where('is_accepted', 2)->where('is_deleted', 2)->orderByDesc('id')->get();
        return view('admin.enquiry.dome_requests', compact('enquiries'));
    }
    public function dome_request_reply(Request $request)
    {
        try {
            $enquiry_data = Enquiries::find($request->id);
            $data = ['title' => 'Reply: Inquiry about Dome Registration', 'type' => $enquiry_data->type, 'email' => $enquiry_data->email, 'name' => $enquiry_data->name, 'reply' => $request->reply, 'logo' => Helper::image_path('logo.png')];
            Mail::send('email.reply_enquiries', $data, function ($message) use ($data) {
                $message->from(env('MAIL_USERNAME'))->subject($data['title']);
                $message->to($data['email']);
            });
            $enquiry_data->is_replied = 1;
            $enquiry_data->save();
            return redirect()->back()->with('success', trans('messages.success'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', trans('messages.wrong'));
        }
    }
    public function dome_request_status(Request $request)
    {
        try {
            $password = Str::random(8);
            $enquiry_data = Enquiries::find($request->id);
            $data = ['title' => 'Reply: Dome Request Accepted', 'email' => $enquiry_data->email, 'name' => $enquiry_data->name, 'password' => $password, 'logo' => Helper::image_path('logo.png')];
            Mail::send('email.accept_dome_request', $data, function ($message) use ($data) {
                $message->from(env('MAIL_USERNAME'))->subject($data['title']);
                $message->to($data['email']);
            });

            $user = new User;
            $user->type = 2;
            $user->login_type = 1;
            $user->name = $enquiry_data->name;
            $user->email = $enquiry_data->email;
            $user->password = Hash::make($password);
            $user->phone = $enquiry_data->phone;
            $user->is_verified = 1;
            $user->save();

            $enquiry_data->is_accepted = 1;
            $enquiry_data->save();

            return response()->json(['status' => 1], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0], 200);
        }
    }
    public function dome_request_delete(Request $request)
    {
        try {
            Enquiries::where('id', $request->id)->update(['is_deleted' => 1]);
            return response()->json(['status' => 1], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0], 200);
        }
    }
    public function store_general_enquiries(Request $request)
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
    public function general_enquiry(Request $request)
    {
        $enquiries = Enquiries::where('type', 2)->where('is_replied', 2)->where('is_accepted', 2)->where('is_deleted', 2)->orderByDesc('id')->get();
        return view('admin.enquiry.general_enquiry', compact('enquiries'));
    }
    public function general_enquiry_reply(Request $request)
    {
        try {
            $enquiry_data = Enquiries::find($request->id);
            $data = ['title' => 'Reply to Enquiry - Domez', 'type' => $enquiry_data->type, 'email' => $enquiry_data->email, 'name' => $enquiry_data->name, 'subject' => $enquiry_data->subject, 'reply' => $request->reply];
            Mail::send('email.reply_enquiries', $data, function ($message) use ($data) {
                $message->from(env('MAIL_USERNAME'))->subject($data['title']);
                $message->to($data['email']);
            });
            $enquiry_data->is_replied = 1;
            $enquiry_data->save();
            return redirect()->back()->with('success', trans('messages.success'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', trans('messages.wrong'));
        }
    }
    public function help_support(Request $request)
    {
        $enquiries = Enquiries::where('type', 1)->where('is_replied', 2)->where('is_accepted', 2)->where('is_deleted', 2)->orderByDesc('id')->get();
        return view('admin.enquiry.help_support', compact('enquiries'));
    }
    public function help_support_reply(Request $request)
    {
        try {
            $enquiry_data = Enquiries::find($request->id);
            $data = ['title' => 'Reply to Enquiry - Domez App', 'type' => $enquiry_data->type, 'email' => $enquiry_data->email, 'name' => $enquiry_data->user_info->name, 'subject' => $enquiry_data->subject, 'reply' => $request->reply];
            Mail::send('email.reply_enquiries', $data, function ($message) use ($data) {
                $message->from(env('MAIL_USERNAME'))->subject($data['title']);
                $message->to($data['email']);
            });
            $enquiry_data->is_replied = 1;
            $enquiry_data->save();
            return redirect()->back()->with('success', trans('messages.success'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', trans('messages.wrong'));
        }
    }
    public function dome_request(Request $request)
    {
        if ($request->send_otp == 1) {
            $otp = rand(1000, 9999);
            session()->put('verification_otp', $otp);
            $mail = Helper::verificationemail($request->email, $request->name, $otp);
            if ($mail == 1) {
                return response()->json(['status' => 1, 'message' => "Account Verification Otp email has been sent to you."], 200);
            } else {
                return response()->json(['status' => 0, 'message' => "Email error!!"], 200);
            }
        }
        if ($request->verify_otp == 1) {
            if ($request->otp == "") {
                return response()->json(['status' => 0, 'message' => "Please Enter OTP"], 200);
            }
            if ($request->otp != session()->get('verification_otp')) {
                return response()->json(['status' => 0, 'message' => "Please Enter Valid OTP"], 200);
            } else {
                return response()->json(['status' => 1, 'message' => "OTP Verification Successfull"], 200);
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
    public function supports(Request $request)
    {
        $getsupportslist = Enquiries::where('type', 5);
        if (Auth::user()->type == 2) {
            $getsupportslist = $getsupportslist->where('vendor_id', Auth::user()->id);
        }else{
            $getsupportslist = $getsupportslist->where('is_replied', 2);
        }
        $getsupportslist = $getsupportslist->orderByDesc('id')->get();
        return view('admin.supports.index', compact('getsupportslist'));
    }
    public function store_ticket(Request $request)
    {
        $ticket = new Enquiries;
        $ticket->vendor_id = Auth::user()->id;
        $ticket->type = 5;
        $ticket->name = Auth::user()->name;
        $ticket->email = Auth::user()->email;
        $ticket->phone = Auth::user()->phone;
        $ticket->subject = $request->subject;
        $ticket->message = $request->message;
        $ticket->save();
        return redirect()->back()->with('success', trans('messages.success'));
    }
    public function ticket_reply(Request $request)
    {
        try {
            $enquiry_data = Enquiries::find($request->id);
            $data = ['title' => 'Reply to Ticket - Domez Owner', 'type' => $enquiry_data->type, 'email' => $enquiry_data->email, 'name' => $enquiry_data->user_info->name, 'subject' => $enquiry_data->subject, 'reply' => $request->reply];
            Mail::send('email.reply_enquiries', $data, function ($message) use ($data) {
                $message->from(env('MAIL_USERNAME'))->subject($data['title']);
                $message->to($data['email']);
            });
            $enquiry_data->is_replied = 1;
            $enquiry_data->save();
            return redirect()->back()->with('success', trans('messages.success'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', trans('messages.wrong'));
        }
    }
}
