<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LeagueController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.leagues.index');
    }

    public function add(Request $request)
    {
        return view('admin.leagues.add');
    }
    public function edit(Request $request)
    {
        return view('admin.leagues.edit');
    }
    public function leaguedetails(Request $request)
    {
        return view('admin.leagues.leaguedetails');
    }
}
