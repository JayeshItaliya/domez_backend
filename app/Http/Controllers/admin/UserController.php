<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
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
        return view('admin.users.edit');
    }
    public function user_details(Request $request)
    {
        return view('admin.users.view');
    }
}
