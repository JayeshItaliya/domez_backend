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
            'name.required' => trans('messages.name_required'),
            'email.required' => trans('messages.email_required'),
            'email.email' => trans('messages.valid_email'),
            'email.unique' => trans('messages.email_exist'),
            'password.required' => trans('messages.password_required'),
            'password.min' => trans('messages.password_min_length'),
        ]);

        if ($request->has('profile')) {
            $request->validate(
                [
                    'profile' => 'mimes:png,jpg,jpeg,svg|max:500',
                ],
                [
                    'profile.mimes' => trans('messages.valid_image_type'),
                    'profile.max' => trans('messages.valid_image_size'),
                ]
            );
            $new_name = 'profiles-' . uniqid() . '.' . $request->profile->getClientOriginalExtension();
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
        abort_if(empty($dome_owner),404);
        $domes = Domes::with('dome_images')->where('vendor_id',$dome_owner->id)->get();
        $sports = Sports::where('is_available',1)->where('is_deleted',2)->get();
        return view('admin.vendors.view', compact('domes','dome_owner','sports'));
    }

    public function edit(Request $request)
    {
        $user = User::find($request->id);
        abort_if(empty($user),404);
        return view('admin.vendors.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $vendor = User::find($request->id);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $request->id,
        ], [
            'name.required' => trans('messages.name_required'),
            'email.required' => trans('messages.email_required'),
            'email.email' => trans('messages.valid_email'),
            'email.unique' => trans('messages.email_exist'),
        ]);

        if ($request->has('profile')) {
            $request->validate(
                [
                    'profile' => 'mimes:png,jpg,jpeg,svg|max:500'
                ],
                [
                    'profile.mimes' => trans('messages.valid_image_type'),
                    'profile.max' => trans('messages.valid_image_size'),
                ]
            );
            if ($vendor->image != 'default.png' && file_exists('storage/app/public/admin/images/profiles/' . $vendor->image)) {
                unlink('storage/app/public/admin/images/profiles/' . $vendor->image);
            }
            $new_name = 'profile-' . uniqid() . '.' . $request->profile->getClientOriginalExtension();
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
