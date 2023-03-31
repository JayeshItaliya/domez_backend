<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Domes;
use App\Models\Sports;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
    public function index(Request $request)
    {
        $vendors = User::where('type', 2)->where('is_deleted', 2)->orderBy('created_at', 'desc')->get();
        return view('admin.vendors.index', compact('vendors'));
    }

    public function add(Request $request)
    {
        return view('admin.vendors.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ], [
            'name.required' => 'Please Enter Name',
            'email.required' => 'Please Enter Email',
            'email.email' => 'Invalid Email Address',
            'email.unique' => 'This Email is Already Taken',
            'password.required' => 'Please Enter Password',
            'password.min' => 'Password must be at least 8 characters in length',
        ]);

        if ($request->has('profile')) {
            $request->validate(
                [
                    'profile' => 'image|max:500'
                ],
                [
                    'profile.image' => 'Invalid Image File',
                    'profile.max' => 'The image must not be greater than 500KB.',
                ]
            );
            $new_name = 'vendor-' . rand(0000, 9999) . '.' . $request->profile->getClientOriginalExtension();
            $path = storage_path('app\public\admin\images\profiles');
            $request->profile->move($path, $new_name);
        }

        $vendor = new User;
        $vendor->type = 2;
        $vendor->login_type = 1;
        $vendor->name = $request->name;
        $vendor->email = $request->email;
        $vendor->password = Hash::make($request->password);
        if ($request->has('profile')) {
            $vendor->image = $new_name;
        }
        $vendor->save();

        return redirect('admin/vendors')->with('success', trans('messages.success'));
    }

    public function dome_owner_detail(Request $request)
    {
        $dome_owner = User::find($request->id);
        $domes = Domes::with('dome_images')->where('vendor_id',$dome_owner->id)->get();
        $sports = Sports::where('is_available',1)->where('is_deleted',2)->get();
        return view('admin.vendors.view', compact('domes','dome_owner','sports'));
    }

    public function edit(Request $request)
    {
        $user = User::find($request->id);
        return view('admin.vendors.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $vendor = User::find($request->id);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $request->id,
        ], [
            'name.required' => 'Please Enter Name',
            'email.required' => 'Please Enter Email',
            'email.email' => 'Invalid Email Address',
            'email.unique' => 'This Email is Already Taken',
        ]);

        if ($request->has('profile')) {
            $request->validate(
                [
                    'profile' => 'mimes:png,jpg,jpeg,svg|max:500'
                ],
                [
                    'profile.mimes' => 'The Profile Image must be a file of type: PNG, JPG, JPEG, SVG',
                    'profile.max' => 'The image must not be greater than 500KB.',
                ]
            );
            if (file_exists('storage/app/public/admin/images/profiles/' . $vendor->image)) {
                unlink('storage/app/public/admin/images/profiles/' . $vendor->image);
            }
            $new_name = 'vendor-' . rand(0000, 9999) . '.' . $request->profile->getClientOriginalExtension();
            $path = storage_path('app\public\admin/images\profiles');
            $request->profile->move($path, $new_name);
        }

        $vendor->name = $request->name;
        $vendor->email = $request->email;
        if ($request->has('profile')) {
            $vendor->image = $new_name;
        }
        $vendor->save();

        return redirect('admin/vendors')->with('success', trans('messages.success'));
    }

    public function delete(Request $request)
    {
        $user = User::find($request->id);
        $user->is_deleted = $request->status;
        $user->save();

        return 1;
    }
    public function change_status(Request $request)
    {
        $user = User::find($request->id);
        $user->is_available = $request->status;
        $user->save();

        return 1;
    }
}
