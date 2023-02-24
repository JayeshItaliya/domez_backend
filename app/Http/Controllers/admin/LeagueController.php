<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Domes;
use App\Models\Field;
use App\Models\Sports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeagueController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.leagues.index');
    }

    public function add(Request $request)
    {
        $sports = Sports::where('is_available', 1)->where('is_deleted', 2)->get();
        $domes = Domes::where('vendor_id', Auth::user()->id)->where('is_deleted', 2)->get();
        $fields = Field::where('vendor_id', Auth::user()->id)->where('is_available', 1)->where('is_deleted', 2)->get();
        return view('admin.leagues.add', compact('sports', 'domes', 'fields'));
    }
    public function edit(Request $request)
    {
        $sports = Sports::where('is_available', 1)->where('is_deleted', 2)->get();
        $domes = Domes::where('vendor_id', Auth::user()->id)->where('is_deleted', 2)->get();
        $fields = Field::where('vendor_id', Auth::user()->id)->where('is_available', 1)->where('is_deleted', 2)->get();
        return view('admin.leagues.edit', compact('sports', 'domes', 'fields'));
    }
    public function leaguedetails(Request $request)
    {
        return view('admin.leagues.leaguedetails');
    }
}
