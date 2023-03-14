<?php

namespace App\Http\Controllers\api;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\DomeImages;
use App\Models\Domes;
use App\Models\Favourite;
use App\Models\League;
use App\Models\Sports;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
                if (count($favourite) != 0) {
                    foreach ($favourite as $dome) {
                        $dome_data = Domes::where('id', $dome->dome_id)->where('is_deleted', 2)->first();
                        $dome_image = DomeImages::where('dome_id', $dome->dome_id)->first();
                        $dome_list = array(
                            "id" => $dome_data->id,
                            "league_name" => '',
                            "dome_name" => $dome_data->name,
                            "image" => Helper::image_path($dome_image->images),
                            "price" => $dome_data->price,
                            "city" => $dome_data->city,
                            "state" => $dome_data->state,
                            "sports_list" => Sports::select('id', 'name', DB::raw("CONCAT('" . url('storage/app/public/admin/images/sports') . "/', image) AS image"))->whereIn('id', explode('|', $dome_data->sport_id))->where('is_available', 1)->where('is_deleted', 2)->get(),
                        );
                        $dome_lists[] = $dome_list;
                    }
                    return response()->json(["status" => 1, "message" => "Successful", 'total_favourite_domes' => $favourite->count(), 'data_list' => $dome_lists], 200);
                } else {
                    return response()->json(["status" => 0, "message" => 'No Data Found'], 200);
                }
            }
            if ($request->type == 2) {
                $favourite = Favourite::where('user_id', $checkuser->id)->where('league_id', '!=', '')->select('league_id')->get();
                if (count($favourite) != 0) {
                    foreach ($favourite as $league) {
                        $league_data = League::where('id', $league->league_id)->where('is_deleted', 2)->first();
                        $dome_data = Domes::where('id', $league_data->dome_id)->where('is_deleted', 2)->first();
                        $league_list = array(
                            "id" => $league_data->id,
                            "league_name" => $league_data->name,
                            "dome_name" => $dome_data->name,
                            "image" => Helper::image_path($league_data->image),
                            "price" => $league_data->price,
                            "city" => $dome_data->city,
                            "state" => $dome_data->state,
                            "sports_list" => Sports::select('id', 'name', DB::raw("CONCAT('" . url('storage/app/public/admin/images/sports') . "/', image) AS image"))->whereIn('id', explode('|', $league_data->sport_id))->where('is_available', 1)->where('is_deleted', 2)->get(),
                        );
                        $league_lists[] = $league_list;
                    }
                    return response()->json(["status" => 1, "message" => "Successful", 'total_favourite_leagues' => $favourite->count(), 'data_list' => $league_lists], 200);
                } else {
                    return response()->json(["status" => 0, "message" => 'No Data Found'], 200);
                }
            }
        } else {
            return response()->json(["status" => 0, "message" => 'Invalid User ID'], 200);
        }
    }
}
