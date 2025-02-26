<?php

namespace App\Http\Controllers\admin;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Exception;
use Illuminate\Support\Facades\Validator;

class ProvidersController extends Controller
{
    public function index(Request $request)
    {
        $providers = User::where('vendor_id', auth()->user()->id)->where('type', 5)->NotDeleted()->orderBy('created_at', 'desc')->get();
        return view('admin.providers.index', compact('providers'));
    }
    public function store_worker(Request $request)
    {
        if (empty(User::where('email', $request->email)->first())) {
            try {
                $data = ['title' => 'Domez Providers Login Credentials', 'email' => $request->email, 'name' => $request->name, 'password' => $request->password];
                Mail::send('email.share_login_details', $data, function ($message) use ($data) {
                    $message->from(env('MAIL_USERNAME'))->subject($data['title']);
                    $message->to($data['email']);
                });
                try {
                    $providers = new User();
                    $providers->type = 5;
                    $providers->login_type = 1;
                    $providers->vendor_id = auth()->user()->id;
                    $providers->name = $request->name;
                    $providers->email = $request->email;
                    $providers->is_verified = 1;
                    $providers->password = Hash::make($request->password);
                    $providers->save();
                    return redirect()->back()->with('success', trans('messages.success'));
                } catch (\Throwable $th) {
                    return redirect()->back()->with('error', trans('messages.wrong'));
                }
            } catch (Exception $ex) {
                return redirect()->back()->with('error', trans('messages.email_error'));
            }
        } else {
            return redirect()->back()->with('error', trans('messages.email_exist'));
        }
    }
    public function change_status(Request $request)
    {
        $user = User::find($request->id);
        $user->is_available = $request->status;
        $user->save();
        return 1;
    }
    public function delete(Request $request)
    {
        try {
            $worker = User::find($request->id);
            $worker->is_deleted = 1;
            $worker->save();
            return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
        }
    }
    public function edit_provider(Request $request)
    {
        $checkuser = User::find($request->id);
        if (empty($checkuser)) {
            return redirect()->back()->with('error', trans('messages.invalid_provider'));
        }
        try {
            $validator = Validator::make($request->input(), [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $checkuser->id,
            ], [
                'name.required' => trans('messages.name_required'),
                'email.required' => trans('messages.email_required'),
                'email.email' => trans('messages.valid_email'),
                'email.unique' => trans('messages.email_exist'),
            ]);
            if ($validator->fails()) {
                foreach ($validator->errors()->toArray() as $key => $error) {
                    return redirect()->back()->with('error', $error[0]);
                    break;
                }
            }
            $checkuser->name = $request->name;
            $checkuser->email = $request->email;
            $checkuser->save();
            return redirect()->back()->with('success', trans('messages.success'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', trans('messages.wrong'));
        }
    }
}
