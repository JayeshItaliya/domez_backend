<?php
namespace App\Http\Controllers\api;
use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Favourite;
use App\Models\User;
use Illuminate\Http\Request;
class FavouriteController extends Controller
{
    public function favourite(Request $request)
    {
        if (in_array($request->user_id,[0,''])) {
            return response()->json(["status" => 0, "message" => 'Please Enter Login User ID'], 200);
        }
        if (!in_array($request->type, [1, 2])) {
            return response()->json(["status" => 0, "message" => 'Invalid request!'], 200);
        }
        if ($request->type == 1 && $request->dome_id == "") {
            return response()->json(["status" => 0, "message" => 'Please Enter Dome ID'], 200);
        }
        if ($request->type == 2 && $request->league_id == "") {
            return response()->json(["status" => 0, "message" => 'Please Enter League ID'], 200);
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
            $favourite = new Favourite();
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
            $league_lists = $dome_lists = [];
            if ($request->type == 1) {
                $q = Favourite::with('has_dome_info')->where('user_id', $checkuser->id)->where('dome_id', '!=', '')->select('id','dome_id')->has('has_dome_info');
                $cnt = $q->count();
                $data = $q->paginate(10);
                foreach ($data as $fav) {
                    $dome_lists[] = [
                        "id" => $fav->has_dome_info->id,
                        "league_name" => '',
                        "dome_name" => $fav->has_dome_info->name,
                        "image" => $fav->has_dome_info->dome_image == "" ? "" : $fav->has_dome_info->dome_image->image,
                        "price" => Helper::get_dome_price($fav->has_dome_info->id, explode(',', $fav->has_dome_info->sport_id)[0]),
                        "city" => $fav->has_dome_info->city,
                        "state" => $fav->has_dome_info->state,
                        "sports_list" => Helper::get_sports_list($fav->has_dome_info->sport_id),
                    ];
                }
                return response()->json(["status" => 1, "message" => "Successful", 'total_favourite' => $cnt, 'data_list' => $dome_lists, "last_page" => $data->toArray()['last_page']], 200);
            }
            if ($request->type == 2) {
                $q = Favourite::with('has_league_info')->where('user_id', $checkuser->id)->select('id','league_id')->has('has_league_info');
                $cnt = $q->count();
                $data = $q->paginate(10);
                foreach ($data as $fav) {
                    $league_lists[] = [
                        "id" => $fav->has_league_info->id,
                        "league_name" => $fav->has_league_info->name,
                        "dome_name" => $fav->has_league_info->dome_info->name,
                        "image" => $fav->has_league_info->league_image == "" ? "" : $fav->has_league_info->league_image->image,
                        "price" => $fav->has_league_info->price,
                        "city" => $fav->has_league_info->dome_info->city,
                        "state" => $fav->has_league_info->dome_info->state,
                        "sports_list" => Helper::get_sports_list($fav->has_league_info->sport_id),
                    ];
                }
                return response()->json(["status" => 1, "message" => "Successful", 'total_favourite' => $cnt, 'data_list' => $league_lists, "last_page" => $data->toArray()['last_page']], 200);
            }
        } else {
            return response()->json(["status" => 0, "message" => 'Invalid User ID'], 200);
        }
    }
}
