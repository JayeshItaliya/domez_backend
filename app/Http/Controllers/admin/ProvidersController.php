<?php
namespace App\Http\Controllers\admin;
use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
class ProvidersController extends Controller
{
    public function index(Request $request)
    {
        $providers = User::where('vendor_id', auth()->user()->id)->where('type', 5)->where('is_deleted', 2)->orderBy('created_at', 'desc')->get();
        return view('admin.providers.index', compact('providers'));
    }
    public function store_worker(Request $request)
    {
        $providers = new User();
        $providers->type = 5;
        $providers->login_type = 1;
        $providers->vendor_id = auth()->user()->id;
        $providers->name = $request->name;
        $providers->email = $request->email;
        $providers->is_verified = 1;
        $providers->password = Hash::make($request->password);
        $providers->save();
        $data = ['title' => 'Domez Providers Login Credentials', 'email' => $request->email, 'name' => $request->name, 'password' => $request->password, 'logo' => Helper::image_path('logo.png')];
        Mail::send('email.worker_providers_login', $data, function ($message) use ($data) {
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
