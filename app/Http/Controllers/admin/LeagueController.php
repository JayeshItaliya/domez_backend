<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DomeImages;
use App\Models\Domes;
use App\Models\Field;
use App\Models\League;
use App\Models\Sports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeagueController extends Controller
{
    public function index(Request $request)
    {
        $leaguesdata = League::where('is_deleted', 2)->orderByDesc('id')->get();
        return view('admin.leagues.index', compact('leaguesdata'));
    }
    public function add(Request $request)
    {
        $sports = Sports::where('is_available', 1)->where('is_deleted', 2)->orderByDesc('id')->get();
        $domes = Domes::where('vendor_id', Auth::user()->id)->where('is_deleted', 2)->orderByDesc('id')->get();
        return view('admin.leagues.add', compact('sports', 'domes'));
    }
    public function getsportsandfields(Request $request)
    {
        try {
            $getdomedata = Domes::where('id', $request->id)->where('vendor_id', Auth::user()->id)->where('is_deleted', 2)->first();
            if (!empty($getdomedata)) {
                $sports = Sports::whereIn('id', explode(',', $getdomedata->sport_id))->where('is_available', 1)->where('is_deleted', 2)->orderByDesc('id')->get();
                $fields = Field::where('vendor_id', Auth::user()->id)->where('dome_id', $getdomedata->id)->where('is_available', 1)->where('is_deleted', 2)->orderByDesc('id')->get();
                return response()->json(['status' => 1, 'message' => trans('messages.success'), 'sportsdata' => $sports, 'fieldsdata' => $fields], 200);
            }
            return response()->json(['status' => 0, 'message' => trans('messages.invalid_dome')], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
        }
    }
    public function store(Request $request)
    {
        $request->validate([
            'dome' => 'required',
            'field' => 'required',
            'sport' => 'required',
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'from_age' => 'required',
            'to_age' => 'required',
            'gender' => 'required',
            'min_player' => 'required',
            'max_player' => 'required',
            'team_limit' => 'required',
            'price' => 'required',
        ], [
            'dome.required' => trans('messages.select_dome'),
            'field.required' => trans('messages.select_field'),
            'sport.required' => trans('messages.select_sport'),
            'name.required' => 'Please Enter Name',
            'start_date.required' => trans('messages.select_start_date'),
            'end_date.required' => trans('messages.select_end_date'),
            'start_time.required' => trans('messages.select_start_time'),
            'end_time.required' => trans('messages.select_end_time'),
            'from_age.required' => trans('messages.select_from_age'),
            'to_age.required' => trans('messages.select_to_age'),
            'gender.required' => trans('messages.select_gender'),
            'min_player.required' => trans('messages.select_min_player'),
            'max_player.required' => trans('messages.select_max_player'),
            'team_limit.required' => trans('messages.select_team_limit'),
            'price.required' => trans('messages.price_required'),
        ]);

        try {
            $league = League::find($request->id);
            if(empty($league)){
                $league = new League();
            }
            $league->vendor_id = auth()->user()->id;
            $league->dome_id = $request->dome;
            $league->field_id = $request->field;
            $league->sport_id = $request->sport;
            $league->name = $request->name;
            $league->start_date = $request->start_date;
            $league->end_date = $request->end_date;
            $league->start_time = $request->start_time;
            $league->end_time = $request->end_time;
            $league->from_age = $request->from_age;
            $league->to_age = $request->to_age;
            $league->gender = $request->gender;
            $league->min_player = $request->min_player;
            $league->max_player = $request->max_player;
            $league->team_limit = $request->team_limit;
            $league->price = $request->price;
            $league->is_deleted = 2;
            $league->save();
            if ($request->has('images')) {
                foreach ($request->file('images') as $img) {
                    $domeimage = new DomeImages();
                    $image = 'league-' . uniqid() . '.' . $img->getClientOriginalExtension();
                    $img->move('storage/app/public/admin/images/leagues', $image);
                    $domeimage->vendor_id = Auth::user()->id;
                    $domeimage->league_id = $league->id;
                    $domeimage->images = $image;
                    $domeimage->save();
                }
            }
            return redirect('/admin/leagues')->with('success', trans('messages.success'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', trans('messages.wrong'));
        }
    }
    public function edit(Request $request)
    {
        $getleaguedata = League::find($request->id);
        $getdomedata = Domes::where('id', $getleaguedata->dome_id)->where('vendor_id', Auth::user()->id)->where('is_deleted', 2)->first();
        $sports = Sports::whereIn('id', explode(',', $getdomedata->sport_id))->where('is_available', 1)->where('is_deleted', 2)->orderByDesc('id')->get();
        $domes = Domes::where('vendor_id', Auth::user()->id)->where('is_deleted', 2)->orderByDesc('id')->get();
        $fields = Field::where('vendor_id', Auth::user()->id)->where('dome_id', $getdomedata->id)->where('is_available', 1)->where('is_deleted', 2)->orderByDesc('id')->get();
        return view('admin.leagues.edit', compact('sports', 'domes', 'fields', 'getleaguedata'));
    }
    public function leaguedetails(Request $request)
    {
        return view('admin.leagues.leaguedetails');
    }
}
