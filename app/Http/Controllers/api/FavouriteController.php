<?php

namespace App\Http\Controllers\api;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Domes;
use App\Models\Favourite;
use App\Models\League;
use App\Models\User;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    public function favourite(Request $request)
    {
        if (in_array($request->user_id,[0,''])) {
            return response()->json(["status" => 0, "message" => 'Please Enter Login User ID'], 200);
        }
        if ($request->type == "") {
            return response()->json(["status" => 0, "message" => 'Enter Type'], 200);
        }
        if (!in_array($request->type, [1, 2])) {
            return response()->json(["status" => 0, "message" => 'Invalid Type'], 200);
        }
        if ($request->type == 1) {
            if ($request->dome_id == "") {
                return response()->json(["status" => 0, "message" => 'Please Enter Dome ID'], 200);
            }
        }
        if ($request->type == 2) {
            if ($request->league_id == "") {
                return response()->json(["status" => 0, "message" => 'Please Enter League ID'], 200);
            }
        }
        $is_favourite = Favourite::where('user_id', $request->user_id);
        if ($request->type == 1) {
            $is_favourite = $is_favourite->where('dome_id', $request->dome_id)->first();
        } else {
            $is_favourite = $is_favourite->where('league_id', $request->league_id)->first();
        }
        if (!empty($is_favourite)) {
            $is_favourite->delete();
            return response()->json(["status" => 1, "message" => $request->type . ' Unfavourite Successfully'], 200);
        } else {
            $favourite = new Favourite;
            $favourite->user_id = $request->user_id;
            if ($request->type == 1) {
                $favourite->dome_id = $request->dome_id;
            } else {
                $favourite->league_id = $request->league_id;
            }
            $favourite->save();
            return response()->json(["status" => 1, "message" => $request->type . ' Favourite Successfully'], 200);
        }
    }

    public function favourite_list(Request $request)
    {
        if (in_array($request->user_id,[0,''])) {
            return response()->json(["status" => 0, "message" => 'Please Enter Login User ID'], 200);
        }
        $checkuser = User::where('id', $request->user_id)->where('type', 3)->first();
        if (!empty($checkuser)) {
            if ($request->type == 1) {
                $favourite = Favourite::where('user_id', $checkuser->id)->where('dome_id', '!=', '')->select('dome_id')->get();
                foreach ($favourite as $dome) {
                    $dome_data = Domes::where('id', $dome->dome_id)->where('is_deleted', 2)->first();
                    if (!empty($dome_data)) {
                        $dome_lists[] = [
                            "id" => $dome_data->id,
                            "league_name" => '',
                            "dome_name" => $dome_data->name,
                            "image" => $dome_data->dome_image == "" ? "" : $dome_data->dome_image->image,
                            "price" => Helper::get_dome_price($dome_data->id, explode(',', $dome_data->sport_id)[0]),
                            "city" => $dome_data->city,
                            "state" => $dome_data->state,
                            "sports_list" => Helper::get_sports_list($dome_data->sport_id),
                        ];
                    }
                }
                return response()->json(["status" => 1, "message" => "Successful", 'total_favourite_domes' => $favourite->count(), 'data_list' => $dome_lists], 200);
            }
            if ($request->type == 2) {
                $favourite = Favourite::where('user_id', $checkuser->id)->where('league_id', '!=', '')->select('league_id')->get();
                foreach ($favourite as $league) {
                    $checkleague = League::where('id', $league->league_id)->where('is_deleted', 2)->first();
                    if (!empty($checkleague)) {
                        $league_lists[] = [
                            "id" => $checkleague->id,
                            "league_name" => $checkleague->name,
                            "dome_name" => $checkleague->dome_info->name,
                            "image" => $checkleague->league_image == "" ? "" : $checkleague->league_image->image,
                            "price" => $checkleague->price,
                            "city" => $checkleague->dome_info->city,
                            "state" => $checkleague->dome_info->state,
                            "sports_list" => Helper::get_sports_list($checkleague->sport_id),
                        ];
                    }
                }
                return response()->json(["status" => 1, "message" => "Successful", 'total_favourite_leagues' => $favourite->count(), 'data_list' => $league_lists], 200);
            }
        } else {
            return response()->json(["status" => 0, "message" => 'Invalid User ID'], 200);
        }
    }
}
