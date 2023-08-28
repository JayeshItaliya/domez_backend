<?php

namespace App\Http\Controllers\admin;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Enquiries;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class EnquiryController extends Controller
{
    public function dome_requests(Request $request)
    {
        $enquiries = Enquiries::whereIn('type', [3, 4]);
        if (auth()->user()->type != 1) {
            $enquiries = $enquiries->where('vendor_id', auth()->user()->type == 2 ? auth()->user()->id : auth()->user()->vendor_id);
        }
        $enquiries = $enquiries->latest()->get();
        return view('admin.enquiry.dome_requests', compact('enquiries'));
    }
    public function dome_request_reply(Request $request)
    {
        try {
            $enquiry_data = Enquiries::find($request->id);
            $data = ['title' => 'Reply: Inquiry about Dome Registration', 'type' => $enquiry_data->type, 'email' => $enquiry_data->email, 'name' => $enquiry_data->name, 'reply' => $request->reply];
            Mail::send('email.reply_enquiries', $data, function ($message) use ($data) {
                $message->from(config('app.mail_username'))->subject($data['title']);
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
            $data = ['title' => 'Reply: Dome Request Accepted', 'email' => $enquiry_data->email, 'name' => $enquiry_data->name, 'password' => $password, 'is_exist' => $enquiry_data->is_exist];
            Mail::send('email.accept_dome_request', $data, function ($message) use ($data) {
                $message->from(config('app.mail_username'))->subject($data['title']);
                $message->to($data['email']);
            });
            // Find the user with the given email and type = 2
            $user = User::where('type', 2)->where('email', $enquiry_data->email)->first();

            if (!empty($user)) {
                if ($user->dome_limit == 0) {
                    // If the dome_limit is 0, update it to 1
                    $user->update(['dome_limit' => 1]);
                } else {
                    // If the dome_limit is not 0, increment it by 1
                    $user->increment('dome_limit');
                }
            } else {
                // If the user doesn't exist, create a new one
                $user = new User();
                $user->type = 2;
                $user->login_type = 1;
                $user->dome_limit = 1;
                $user->name = $enquiry_data->name;
                $user->email = $enquiry_data->email;
                $user->password = Hash::make($password);
                $user->phone = $enquiry_data->phone;
                $user->is_verified = 1;
                $user->save();
            }

            $enquiry_data->vendor_id = $user->id;
            $enquiry_data->is_accepted = 1;
            $enquiry_data->is_replied = 1;
            $enquiry_data->save();
            return response()->json(['status' => 1], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0], 200);
        }
    }
    public function dome_request_delete(Request $request)
    {
        try {
            Enquiries::where('id', $request->id)->update(['is_accepted' => 3, 'is_replied' => 1]);
            $enquiry = Enquiries::find($request->id);
            $data = ['title' => 'Reply: Dome Request Declined', 'email' => $enquiry->email, 'name' => $enquiry->name];
            Mail::send('email.decline_dome_request', $data, function ($message) use ($data) {
                $message->from(config('app.mail_username'))->subject($data['title']);
                $message->to($data['email']);
            });
            return response()->json(['status' => 1], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0], 200);
        }
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
                $message->from(config('app.mail_username'))->subject($data['title']);
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
                $message->from(config('app.mail_username'))->subject($data['title']);
                $message->to($data['email']);
            });
            $enquiry_data->is_replied = 1;
            $enquiry_data->save();
            return redirect()->back()->with('success', trans('messages.success'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', trans('messages.wrong'));
        }
    }
    public function supports(Request $request)
    {
        $getsupportslist = Enquiries::where('type', 5);
        if (auth()->user()->type == 2) {
            $getsupportslist = $getsupportslist->where('vendor_id', auth()->user()->type == 2 ? auth()->user()->id : auth()->user()->vendor_id);
        } else {
            $getsupportslist = $getsupportslist->where('is_replied', 2);
        }
        $getsupportslist = $getsupportslist->orderByDesc('id')->get();
        return view('admin.supports.index', compact('getsupportslist'));
    }
    public function store_ticket(Request $request)
    {
        $ticket = new Enquiries();
        $ticket->vendor_id = auth()->user()->type == 2 ? auth()->user()->id : auth()->user()->vendor_id;
        $ticket->type = 5;
        $ticket->name = auth()->user()->name;
        $ticket->email = auth()->user()->email;
        $ticket->phone = auth()->user()->phone;
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
                $message->from(config('app.mail_username'))->subject($data['title']);
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
