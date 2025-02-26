<?php

namespace App\Http\Controllers\admin;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\DomeImages;
use App\Models\Domes;
use App\Models\Favourite;
use App\Models\Field;
use App\Models\League;
use App\Models\Sports;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class LeagueController extends Controller
{
    public function index(Request $request)
    {
        $leaguesdata = League::NotDeleted();
        if (in_array(auth()->user()->type, [2, 4])) {
            $leaguesdata = $leaguesdata->where('vendor_id', auth()->user()->type == 2 ? auth()->user()->id : auth()->user()->vendor_id);
        }
        if (auth()->user()->type == 5) {
            $leaguesdata = $leaguesdata->where('provider_id', auth()->user()->id);
        }
        $leaguesdata = $leaguesdata->orderByDesc('id')->get();
        return view('admin.leagues.index', compact('leaguesdata'));
    }
    public function add(Request $request)
    {
        $sports = Sports::Available()->NotDeleted()->orderByDesc('id')->get();
        $domes = Domes::where('vendor_id', auth()->user()->type == 2 ? auth()->user()->id : auth()->user()->vendor_id)->NotDeleted()->orderByDesc('id')->get();
        return view('admin.leagues.add', compact('sports', 'domes'));
    }
    public function getsportsandfields(Request $request)
    {
        try {
            $getdomedata = Domes::where('id', $request->id)->where('vendor_id', auth()->user()->type == 2 ? auth()->user()->id : auth()->user()->vendor_id)->NotDeleted()->first();
            if (!empty($getdomedata)) {
                $working_days = array_reduce($getdomedata->working_hours->toArray(), function ($result, $item) {
                    if ($item['is_closed'] === 2) {
                        $abbreviation = ucfirst(substr($item['day'], 0, 3));
                        $result[] = [(string)$abbreviation => ucfirst($item['day'])];
                    }
                    return $result;
                }, []);
                $sports = Sports::whereIn('id', explode(',', $getdomedata->sport_id))->Available()->NotDeleted()->orderByDesc('id')->get();
                $fields = Field::where('vendor_id', auth()->user()->type == 2 ? auth()->user()->id : auth()->user()->vendor_id)->where('dome_id', $getdomedata->id)->Available()->NotDeleted();
                if ($request->has('sport') && $request->sport != "") {
                    $fields = $fields->where('sport_id', $request->sport);
                }
                $fields = $fields->orderByDesc('id')->get();
                return response()->json(['status' => 1, 'message' => trans('messages.success'), 'sportsdata' => $sports, 'fieldsdata' => $fields, 'working_days' => $working_days], 200);
            }
            return response()->json(['status' => 0, 'message' => trans('messages.invalid_dome')], 200);
        } catch (\Throwable $th) {
            Log::channel('leagues_logs')->error("=====> " . __FUNCTION__ . " error :- " . $th->getMessage() . " =====> At :- " . date('j F, Y | h:i A', strtotime(now())));
            return response()->json(['status' => 0, 'message' => trans('messages.wrong'), 'err_msg' => $th->getMessage()], 200);
        }
    }
    public function store(Request $request)
    {
        $checkdome = Domes::where('id', $request->dome)->NotDeleted()->first();
        $request->validate([
            'dome' => 'required',
            'field' => 'required',
            'field.*' => 'required',
            'sport' => 'required',
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'from_age' => 'required',
            'to_age' => 'required',
            'gender' => 'required',
            'min_player' => 'required',
            'max_player' => 'required',
            'team_limit' => 'required',
            'price' => 'required',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'booking_deadline' => 'required|date|before:start_date',

            'days' => 'required|array|min:1',
            'days.*' => 'in:Mon,Tue,Wed,Thu,Fri,Sat,Sun',
        ], [
            'dome.required' => trans('messages.select_dome'),
            'field.required' => trans('messages.select_field'),
            'field.*.required' => trans('messages.select_field'),
            'sport.required' => trans('messages.select_sport'),
            'name.required' => trans('messages.name_required'),
            'start_date.required' => trans('messages.select_start_date'),
            'end_date.required' => trans('messages.select_end_date'),
            'from_age.required' => trans('messages.select_from_age'),
            'to_age.required' => trans('messages.select_to_age'),
            'gender.required' => trans('messages.select_gender'),
            'min_player.required' => trans('messages.select_min_player'),
            'max_player.required' => trans('messages.select_max_player'),
            'team_limit.required' => trans('messages.select_team_limit'),
            'price.required' => trans('messages.price_required'),
            'start_time.required' => trans('messages.start_time_required'),
            'start_time.date_format' => trans('messages.valid_time_format'),
            'end_time.required' => trans('messages.end_time_required'),
            'end_time.date_format' => trans('messages.valid_time_format'),
            'end_time.after' => trans('messages.end_time_must_after_start_time'),
            'booking_deadline.required' => trans('messages.booking_deadline_required'),
            'booking_deadline.date' => trans('messages.valid_date'),
            'booking_deadline.before' => trans('messages.booking_deadline_before_start_date'),

            'days.required' => 'Day selection is required.',
            'days.array' => 'Day selection is in invalid format.',
            'days.min' => 'Day selection is required.',
            'days.*.in' => 'Invalid day selected.',
        ]);
        try {
            $league = League::find($request->id);
            if (empty($league)) {
                $league = new League();
                $league->is_deleted = 2;
                $sendnoti = 1;
                $league->vendor_id = auth()->user()->type == 2 ? auth()->user()->id : auth()->user()->vendor_id;
                if (auth()->user()->type == 5) {
                    $league->provider_id = auth()->user()->id;
                }
            }
            $league->dome_id = $request->dome;
            $league->field_id = implode(',', $request->field);
            $league->sport_id = $request->sport;
            $league->name = $request->name;
            $league->booking_deadline = $request->booking_deadline;
            $league->start_date = $request->start_date;
            $league->end_date = $request->end_date;
            $league->start_time = $request->start_time;
            $league->end_time = $request->end_time;
            $league->days = implode(' | ', $request->days);
            $league->from_age = $request->from_age;
            $league->to_age = $request->to_age;
            $league->gender = $request->gender;
            $league->min_player = $request->min_player;
            $league->max_player = $request->max_player;
            $league->team_limit = $request->team_limit;
            $league->price = $request->price;
            $league->save();
            if ($request->has('images')) {
                $request->validate([
                    'images.*' => 'required|image|mimes:png,jpg,jpeg,svg|max:7168',
                ], [
                    'images.image' => trans('messages.valid_image'),
                    'images.mimes' => trans('messages.valid_image_type'),
                    'images.max' => trans('messages.valid_image_size'),
                ]);
                foreach ($request->file('images') as $img) {
                    $domeimage = new DomeImages();
                    $image = 'league-' . uniqid() . '.' . $img->getClientOriginalExtension();
                    $img->move('storage/app/public/admin/images/league', $image);
                    $domeimage->league_id = $league->id;
                    $domeimage->images = $image;
                    $domeimage->save();
                }
            }
            if (@$sendnoti == 1) {
                $getfavoriteusers = Favourite::select('user_id')->where('dome_id', $checkdome->id)->get()->pluck('user_id')->toArray();
                $tokens = User::whereIn('id', $getfavoriteusers)->get()->pluck('fcm_token')->toArray();
                if (count($tokens) > 0) {
                    $title = 'New League Added!';
                    $body = 'Get ready to explore and participate in the latest competitions and events.';
                    Helper::send_notification($title, $body, 4, '', $league->id, $tokens);
                }
            }
            return redirect('/admin/leagues')->with('success', trans('messages.success'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', trans('messages.wrong'));
        }
    }
    public function edit(Request $request)
    {
        $getleaguedata = League::where('id', $request->id)->where('vendor_id', auth()->user()->type == 2 ? auth()->user()->id : auth()->user()->vendor_id);
        if (auth()->user()->type == 5) {
            $getleaguedata = $getleaguedata->where('provider_id', auth()->user()->id);
        }
        $getleaguedata = $getleaguedata->first();
        abort_if(empty($getleaguedata), 404);
        $vendor_id = auth()->user()->type == 2 ? auth()->user()->id : auth()->user()->vendor_id;
        $getdomedata = Domes::where('id', $getleaguedata->dome_id)->where('vendor_id', $vendor_id)->NotDeleted()->first();
        $sports = Sports::whereIn('id', explode(',', $getdomedata->sport_id))->Available()->NotDeleted()->orderByDesc('id')->get();
        $domes = Domes::where('vendor_id', $vendor_id)->NotDeleted()->orderByDesc('id')->get();
        $fields = Field::where('vendor_id', $vendor_id)->where('dome_id', $getdomedata->id)->Available()->NotDeleted()->orderByDesc('id')->get();
        return view('admin.leagues.edit', compact('sports', 'domes', 'fields', 'getleaguedata'));
    }
    public function leaguedetails(Request $request)
    {
        $getleaguedata = League::find($request->id);
        return view('admin.leagues.view', compact('getleaguedata'));
    }
    public function delete(Request $request)
    {
        try {
            $field = League::find($request->id);
            $field->is_deleted = 1;
            $field->save();
            return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
        } catch (\Throwable $th) {
            Log::channel('leagues_logs')->error("=====> " . __FUNCTION__ . " error :- " . $th->getMessage() . " =====> At :- " . date('j F, Y | h:i A', strtotime(now())));
            return response()->json(['status' => 0, 'message' => trans('messages.wrong'), 'err_msg' => $th->getMessage()], 200);
        }
    }
    public function image_delete(Request $request)
    {
        try {
            $image = DomeImages::find($request->id);
            if (file_exists('storage/app/public/admin/images/league/' . $image->images)) {
                unlink('storage/app/public/admin/images/league/' . $image->images);
            }
            $image->delete();
            return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
        } catch (\Throwable $th) {
            Log::channel('leagues_logs')->error("=====> " . __FUNCTION__ . " error :- " . $th->getMessage() . " =====> At :- " . date('j F, Y | h:i A', strtotime(now())));
            return response()->json(['status' => 0, 'message' => trans('messages.wrong'), 'err_msg' => $th->getMessage()], 200);
        }
    }
}
