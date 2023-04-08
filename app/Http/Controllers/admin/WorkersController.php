<?php

namespace App\Http\Controllers\admin;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class WorkersController extends Controller
{
    public function index(Request $request)
    {
        $workers = User::where('type', 4)->where('is_deleted', 2)->orderBy('created_at', 'desc')->get();
        return view('admin.workers.index', compact('workers'));
    }
    public function store_worker(Request $request)
    {
        $workers = new User();
        $workers->type = 4;
        $workers->login_type = 1;
        $workers->vendor_id = auth()->user()->id;
        $workers->name = $request->name;
        $workers->email = $request->email;
        $workers->is_verified = 1;
        $workers->password = Hash::make($request->password);
        $workers->save();
        $data = ['title' => 'Domez Employee Login Credentials', 'email' => $request->email, 'name' => $request->name, 'password' => $request->password, 'logo' => Helper::image_path('logo.png')];
        Mail::send('email.worker_login', $data, function ($message) use ($data) {
            $message->from(env('MAIL_USERNAME'))->subject($data['title']);
            $message->to($data['email']);
        });
        return redirect()->back()->with('success', 'success');
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
        $worker = User::find($request->id);
        $worker->is_deleted = $request->status;
        $worker->save();

        return 1;
    }
}
