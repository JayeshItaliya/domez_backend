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
        abort_if(empty  ($user),404);
        return view('admin.users.edit', compact('user'));
    }
    public function update(Request $request)
    {
        $user = User::find($request->id);
        $request->validate([
            'name' => 'required',
            'email_address' => 'required|email|unique:users,email,' . $user->id,
        ], [
            'name.required' => trans('messages.name_required'),
            'email_address.required' => trans('messages.email_required'),
            'email_address.email' => trans('messages.valid_email'),
            'email_address.unique' => trans('messages.email_exist'),
        ]);
        if ($request->has('profile_image')) {
            $request->validate([
                    'profile_image' => 'mimes:png,jpg,jpeg,svg|max:7168'
                ],[
                    'profile_image.mimes' => trans('messages.valid_image_type'),
                    'profile_image.max' => trans('messages.valid_image_size'),
                ]
            );
            if ($user->image != 'default.png' && file_exists('storage/app/public/admin/images/profiles/' . $user->image)) {
                unlink('storage/app/public/admin/images/profiles/' . $user->image);
            }
            $new_name = 'profiles-' . uniqid() . '.' . $request->profile_image->getClientOriginalExtension();
            $path = storage_path('app\public\admin\images\profiles');
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
        abort_if(empty($user),404);
        $bookings = Booking::where('user_id', $user->id)->get();
        return view('admin.users.view', compact('user', 'bookings'));
    }
}
