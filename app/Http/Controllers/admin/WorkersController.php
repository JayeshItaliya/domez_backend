<?php

namespace App\Http\Controllers\admin;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class WorkersController extends Controller
{
    public function index(Request $request)
    {
        $workers = User::where('vendor_id', auth()->user()->id)->where('type', 4)->where('is_deleted', 2)->orderBy('created_at', 'desc')->get();
        return view('admin.workers.index', compact('workers'));
    }
    public function store_worker(Request $request)
    {
        try {
            $data = ['title' => 'Domez Employee Login Credentials', 'email' => $request->email, 'name' => $request->name, 'password' => $request->password, 'logo' => Helper::image_path('logo.png')];
            Mail::send('email.worker_providers_login', $data, function ($message) use ($data) {
                $message->from(env('MAIL_USERNAME'))->subject($data['title']);
                $message->to($data['email']);
            });
        } catch (Exception $ex) {
            return redirect()->back()->with('error', trans('messages.email_error'));
        }
        try {
            $workers = new User();
            $workers->type = 4;
            $workers->login_type = 1;
            $workers->vendor_id = auth()->user()->id;
            $workers->name = $request->name;
            $workers->email = $request->email;
            $workers->is_verified = 1;
            $workers->password = Hash::make($request->password);
            $workers->save();
            return redirect()->back()->with('success', trans('messages.success'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', trans('messages.wrong'));
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
}
