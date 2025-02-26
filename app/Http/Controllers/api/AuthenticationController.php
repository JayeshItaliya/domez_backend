<?php

namespace App\Http\Controllers\api;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Two\User as OAuthTwoUser;

class AuthenticationController extends Controller
{
    public function sign_in(Request $request)
    {
        if ($request->email == "") {
            return response()->json(["status" => 0, "message" => "Please Enter Email"], 200);
        }
        if ($request->password == "") {
            return response()->json(["status" => 0, "message" => "Please Enter Password"], 200);
        }
        $checkuser = User::where('email', $request->email)->where('type', 3)->first();
        if (!empty($checkuser)) {
            if (Hash::check($request->password, $checkuser->password)) {
                if ($checkuser->is_deleted == 2) {
                    if ($checkuser->is_available == 1) {
                        if ($checkuser->is_verified == 1) {
                            $checkuser->fcm_token = $request->fcm_token ?? '';
                            $checkuser->save();
                            $userdata = $this->getuserprofileobject($checkuser->id);
                            return response()->json(["status" => 1, "message" => "Sign In Done Successfully", 'userdata' => $userdata], 200);
                        } else {
                            $otp = rand(1000, 9999);
                            $user = User::where('email', $request->email)->first();
                            $user->otp = $otp;
                            $user->save();
                            $send_mail = Helper::verificationemail($request->email, $checkuser->name, $otp);
                            if ($send_mail == 1) {
                                return response()->json(["status" => 1, "message" => "OTP Sent Successfully On Email"], 200);
                            } else {
                                return response()->json(["status" => 0, "message" => "Email Error"], 200);
                            }
                        }
                    } else {
                        return response()->json(["status" => 0, "message" => "Blocked By Admin"], 200);
                    }
                } else {
                    return response()->json(["status" => 0, "message" => "Account Has Been Deleted"], 200);
                }
            } else {
                return response()->json(["status" => 0, "message" => "Invalid Email/Password"], 200);
            }
        } else {
            return response()->json(["status" => 0, "message" => "Invalid Email/Password"], 200);
        }
    }
    public function sign_up(Request $request)
    {
        if ($request->email == "") {
            return response()->json(["status" => 0, "message" => "Please Enter Email"], 200);
        }
        if (User::where('email', $request->email)->exists()) {
            return response()->json(["status" => 0, "message" => "This email is already registered with an existing account"], 200);
        }
        if ($request->phone == "") {
            return response()->json(["status" => 0, "message" => "Please Enter Phone Number"], 200);
        }
        if (User::where('phone', $request->phone)->exists()) {
            return response()->json(["status" => 0, "message" => "This phone number is already registered with an existing account"], 200);
        }
        if ($request->name == "") {
            return response()->json(["status" => 0, "message" => "Please Enter Your Name"], 200);
        }
        if ($request->password == "") {
            return response()->json(["status" => 0, "message" => "Please Enter Password"], 200);
        }
        if ($request->cpassword == "") {
            return response()->json(["status" => 0, "message" => "Please Enter Confirm Password"], 200);
        }
        if ($request->password != $request->cpassword) {
            return response()->json(["status" => 0, "message" => "Password and Confirm Password do not match"], 200);
        }
        $otp = rand(1000, 9999);
        $send_mail = Helper::verificationemail($request->email, $request->name, $otp);
        if ($send_mail == 1) {
            $userdata = array(
                'name' => $request->name,
                'email' => $request->email,
                'countrycode' => $request->countrycode,
                'phone' => $request->phone ?? "",
                'password' => $request->password,
                'otp' => $otp
            );
            return response()->json(["status" => 1, "message" => "Email Sent Successfully", 'userdata' => $userdata], 200);
        } else {
            return response()->json(["status" => 0, "message" => "Email Error"], 200);
        }
    }
    public function verify(Request $request)
    {
        if ($request->email == "") {
            return response()->json(["status" => 0, "message" => "Please Enter Email"], 200);
        }
        if (User::where('email', $request->email)->exists()) {
            return response()->json(["status" => 0, "message" => "This email is already registered with an existing account"], 200);
        }
        if ($request->phone == "") {
            return response()->json(["status" => 0, "message" => "Please Enter Phone Number"], 200);
        }
        if (User::where('phone', $request->phone)->exists()) {
            return response()->json(["status" => 0, "message" => "This phone number is already registered with an existing account"], 200);
        }
        if ($request->name == "") {
            return response()->json(["status" => 0, "message" => "Please Enter Your Name"], 200);
        }
        if ($request->password == "") {
            return response()->json(["status" => 0, "message" => "Please Enter Password"], 200);
        }
        if ($request->cpassword == "") {
            return response()->json(["status" => 0, "message" => "Please Enter Confirm Password"], 200);
        }
        if ($request->password != $request->cpassword) {
            return response()->json(["status" => 0, "message" => "Password and Confrim Password do not match"], 200);
        }
        $user = new User();
        $user->type = 3;
        $user->login_type = 1;
        $user->name = $request->name ?? "";
        $user->email = $request->email;
        $user->phone = $request->phone ?? "";
        $user->countrycode = $request->countrycode ?? "";
        $user->password = Hash::make($request->password);
        $user->fcm_token = $request->fcm_token ?? "";
        $user->is_verified = 1;
        $user->save();
        $userdata = $this->getuserprofileobject($user->id);
        return response()->json(["status" => 1, "message" => 'User Signed Up Successfully', 'userdata' => $userdata], 200);
    }
    public function resend_otp(Request $request)
    {
        $otp = rand(1000, 9999);
        $send_mail = Helper::verificationemail($request->email, $request->name, $otp);
        if ($send_mail == 1) {
            return response()->json(["status" => 1, "message" => "OTP Sent Successfully On Email", 'otp' => $otp], 200);
        } else {
            return response()->json(["status" => 0, "message" => "Email Error"], 200);
        }
    }
    public function forgot_password(Request $request)
    {
        if ($request->email == "") {
            return response()->json(["status" => 0, "message" => "Please Enter Email"], 200);
        }
        $checkemail = User::where('email', $request->email)->first();
        if (empty($checkemail)) {
            return response()->json(["status" => 0, "message" => "Invalid Email Address"], 200);
        }
        $password = Str::random(10);
        $send_mail = Helper::forgotpassword($checkemail->email, $checkemail->name, $password);
        if ($send_mail == 1) {
            $checkemail->password = Hash::make($password);
            $checkemail->save();
            return response()->json(["status" => 1, "message" => "Email Sent Successfully"], 200);
        } else {
            return response()->json(["status" => 0, "message" => "Email Error"], 200);
        }
    }
    public function changepassword(Request $request)
    {
        if (in_array($request->user_id, [0, ''])) {
            return response()->json(["status" => 0, "message" => "Please Enter Login User ID"], 200);
        }
        $checkuser = User::find($request->user_id);
        if (!empty($checkuser)) {
            if ($request->current_password == "") {
                return response()->json(["status" => 0, "message" => "Please Enter Current Password"], 200);
            }
            if ($request->current_password == $request->new_password) {
                return response()->json(["status" => 0, "message" => "Your New Password Cannot Be The Same As Your Current Password"], 200);
            }
            if ($request->new_password == "") {
                return response()->json(["status" => 0, "message" => "Please Enter New Password"], 200);
            }
            if ($request->confirm_password == "") {
                return response()->json(["status" => 0, "message" => "Please Enter Confirm Password"], 200);
            }
            if ($request->new_password != $request->confirm_password) {
                return response()->json(["status" => 0, "message" => "New Password and Confirm Password Does Not Match"], 200);
            }
            if (Hash::check($request->current_password, $checkuser->password)) {
                $checkuser->password = Hash::make($request->new_password);
                $checkuser->save();
                return response()->json(["status" => 1, "message" => 'Password Changed Successfully'], 200);
            } else {
                return response()->json(["status" => 0, "message" => "Invalid Current Password"], 200);
            }
        } else {
            return response()->json(["status" => 0, "message" => "Invalid User"], 200);
        }
    }
    public function delete_account(Request $request)
    {
        if (in_array($request->id, [0, ''])) {
            return response()->json(["status" => 0, "message" => "Please Enter Login User ID"], 200);
        }
        $checkuser = User::find($request->id);
        if (!empty($checkuser)) {
            $checkuser->is_deleted = 1;
            $checkuser->save();
            return response()->json(["status" => 1, "message" => 'Account Deleted Successfully'], 200);
        } else {
            return response()->json(["status" => 0, "message" => "Invalid User ID"], 200);
        }
    }
    public function google_login(Request $request)
    {
        if ($request->email == "") {
            return response()->json(["status" => 0, "message" => "Please Enter Email"], 200);
        }
        $checkuser = User::where('email', $request->email)->where('login_type', 2)->where('is_deleted', 2)->first();
        if (!empty($checkuser)) {
            $userdata = $this->getuserprofileobject($checkuser->id);
            return response()->json(["status" => 1, "message" => "Succesfully Login", 'userdata' => $userdata], 200);
        }
        if ($request->name == "") {
            return response()->json(["status" => 0, "message" => "Please Enter Name"], 200);
        }
        $user = new User();
        $user->type = 3;
        $user->login_type = 2;
        $user->name = $request->name ?? "";
        $user->email = $request->email;
        $user->phone = $request->phone ?? "";
        $user->countrycode = $request->countrycode ?? "";
        $user->fcm_token = $request->fcm_token ?? "";
        $user->google_id = $request->uid;
        $user->is_verified = $request->is_verified == true ? 1 : 2;
        if ($user->save()) {
            $userdata = $this->getuserprofileobject($user->id);
            return response()->json(["status" => 1, "message" => "Succesfully Login", 'userdata' => $userdata], 200);
        } else {
            return response()->json(["status" => 0, "message" => "Something Went Wrong..!!"], 200);
        }
    }
    public function facebook_login(Request $request)
    {
        if ($request->email == "") {
            return response()->json(["status" => 0, "message" => "Please Enter Email"], 200);
        }
        $checkuser = User::where('email', $request->email)->where('login_type', 4)->where('is_deleted', 2)->first();
        if (!empty($checkuser) && $checkuser->login_type == 4) {
            $userdata = $this->getuserprofileobject($checkuser->id);
            return response()->json(["status" => 1, "message" => "Succesfully Login", 'userdata' => $userdata], 200);
        }
        if ($request->name == "") {
            return response()->json(["status" => 0, "message" => "Please Enter Name"], 200);
        }
        $user = new User();
        $user->type = 3;
        $user->login_type = 4;
        $user->name = $request->name ?? "";
        $user->email = $request->email;
        $user->phone = $request->phone ?? "";
        $user->countrycode = $request->countrycode ?? "";
        $user->fcm_token = $request->fcm_token ?? "";
        $user->facebook_id = $request->uid;
        $user->is_verified = 1;
        if ($user->save()) {
            $userdata = $this->getuserprofileobject($user->id);
            return response()->json(["status" => 1, "message" => "Succesfully Login", 'userdata' => $userdata], 200);
        } else {
            return response()->json(["status" => 0, "message" => "Something Went Wrong..!!"], 200);
        }
    }
    function editprofile(Request $request)
    {
        if (in_array($request->user_id, [0, ''])) {
            return response()->json(["status" => 0, "message" => "Please Enter Login User ID"], 200);
        }
        $checkuser = User::where('id', $request->user_id)->where('type', 3)->where('is_deleted', 2)->first();
        if (!empty($checkuser)) {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $checkuser->id,
                'phone' => 'required|unique:users,phone,' . $checkuser->id,
                'image' => 'image|max:7168',
            ], [
                'name.required' => 'Please Enter Name',
                'email.required' => 'Please Enter Email',
                'email.email' => 'Invalid Email Address',
                'email.unique' => 'This email is already registered with an existing account',
                'phone.required' => 'Please Enter phone',
                'phone.unique' => 'This phone number is already registered with an existing account',
                'image.image' => 'Please select only image type of file',
                'image.max' => 'The image must not be greater than 5MB.',
            ]);
            if ($validator->fails()) {
                foreach ($validator->errors()->toArray() as $key => $error) {
                    return response()->json(["status" => 0, "message" => $error[0]], 200);
                }
            }
            $checkuser->name = $request->name;
            $checkuser->email = $request->email;
            $checkuser->countrycode = $request->countrycode;
            $checkuser->phone = $request->phone;
            if ($request->has('image')) {
                if ($checkuser->image != 'default.png' && file_exists('storage/app/public/admin/images/profiles/' . $checkuser->image)) {
                    unlink('storage/app/public/admin/images/profiles/' . $checkuser->image);
                }
                $new_name = 'profiles-' . uniqId() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move(storage_path('app\public\admin\images\profiles'), $new_name);
                $checkuser->image = $new_name;
            }
            $checkuser->save();
            $userdata = $this->getuserprofileobject($checkuser->id);
            return response()->json(["status" => 1, "message" => "Profile Updated Successfully", 'userdata' => $userdata], 200);
        }
        return response()->json(["status" => 0, "message" => "Invalid User ID"], 200);
    }
    function getuserprofileobject($id)
    {
        $checkuser = User::find($id);
        $data = array(
            'id' => $checkuser->id,
            'name' => $checkuser->name ?? "",
            'email' => $checkuser->email,
            'countrycode' => $checkuser->countrycode ?? "",
            'phone' => $checkuser->phone ?? "",
            'image' => Helper::image_path($checkuser->image),
        );
        return $data;
    }

    public function apple_login(Request $request)
    {
        if ($request->email == "") {
            return response()->json(["status" => 0, "message" => "Please Enter Email"], 200);
        }
        $checkuser = User::where('email', $request->email)->where('login_type', 3)->where('is_deleted', 2)->first();
        if (!empty($checkuser) && $checkuser->login_type == 3) {
            $userdata = $this->getuserprofileobject($checkuser->id);
            return response()->json(["status" => 1, "message" => "Succesfully Login", 'userdata' => $userdata], 200);
        }
        $user = new User();
        $user->type = 3;
        $user->login_type = 3;
        $user->name = $request->name ?? "";
        $user->email = $request->email;
        $user->phone = $request->phone ?? "";
        $user->countrycode = $request->countrycode ?? "";
        $user->fcm_token = $request->fcm_token ?? '';
        $user->apple_id = $request->uid;
        $user->is_verified = 1;
        if ($user->save()) {
            $userdata = $this->getuserprofileobject($user->id);
            return response()->json(["status" => 1, "message" => "Succesfully Login", 'userdata' => $userdata], 200);
        } else {
            return response()->json(["status" => 0, "message" => "Something Went Wrong..!!"], 200);
        }
    }

    protected function getLocalUser(OAuthTwoUser $socialUser): ?User
    {
        $user = User::where('email', $socialUser->email)->first();
        if (!$user) {
            $user = $this->registerAppleUser($socialUser);
        }
        return $user;
    }
    protected function registerAppleUser(OAuthTwoUser $socialUser): ?User
    {
        $user = User::create(
            [
                'full_name' => request()->fullName ? request()->fullName : 'Apple User',
                'email' => $socialUser->email,
                'password' => Str::random(30),

            ]
        );
        return $user;
    }
}
