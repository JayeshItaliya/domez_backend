<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::where('type', 3)->get();
        return view('admin.users.index', compact('users'));
    }
    public function edit(Request $request)
    {
        $user = User::find($request->id);
        return view('admin.users.edit', compact('user'));
    }
    public function update(Request $request)
    {
        $user = User::find($request->id);
        $request->validate([
            'name' => 'required',
            'email_address' => 'required|email|unique:users,email,' . $user->id,
        ], [
            'name.required' => 'Please Enter Name',
            'email_address.required' => 'Please Enter Email',
            'email_address.email' => 'Invalid Email Address',
            'email_address.unique' => 'This Email is Already Taken',
        ]);

        if ($request->has('profile_image')) {
            $request->validate(
                [
                    'profile_image' => 'mimes:png,jpg,jpeg,svg|max:500'
                ],
                [
                    'profile_image.mimes' => 'The Profile Image must be a file of type: PNG, JPG, JPEG, SVG',
                    'profile_image.max' => 'The image must not be greater than 500KB.',
                ]
            );
            if (file_exists('storage/app/public/admin/images/profiles/' . $user->image)) {
                unlink('storage/app/public/admin/images/profiles/' . $user->image);
            }
            $new_name = 'vendor-' . rand(0000, 9999) . '.' . $request->profile_image->getClientOriginalExtension();
            $path = storage_path('app\public\admin/images\profiles');
            $request->profile_image->move($path, $new_name);
        }
        $user->name = $request->name;
        $user->email = $request->email_address;
        $user->phone = $request->phone_number;
        if ($request->has('profile_image')) {
            $user->image = $new_name;
        }
        $user->save();

        return redirect('admin/users')->with('success', trans('messages.success'));
    }
    public function user_details(Request $request)
    {
        $user = User::find($request->id);
        $bookings = Booking::where('user_id', $user->id)->get();
        return view('admin.users.view', compact('user', 'bookings'));
    }
}
