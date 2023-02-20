<?php

namespace App\Http\Controllers\api;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\DomeImages;
use App\Models\Domes;
use App\Models\Favourite;
use App\Models\User;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    public function favourite(Request $request)
    {
        if ($request->user_id == "") {
            return response()->json(["status" => 0, "message" => 'Please Enter Login User ID'], 200);
        }
        if ($request->dome_id == "") {
            return response()->json(["status" => 0, "message" => 'Please Enter Dome ID'], 200);
        }
        $is_favourite = Favourite::where('user_id', $request->user_id)->where('dome_id', $request->dome_id)->first();
        if (!empty($is_favourite)) {
            $is_favourite->delete();
            return response()->json(["status" => 1, "message" => 'Now Dome is Unfavourite'], 200);
        } else {
            $favourite = new Favourite;
            $favourite->user_id = $request->user_id;
            $favourite->dome_id = $request->dome_id;
            $favourite->save();
            return response()->json(["status" => 1, "message" => 'Now Dome is Favourite'], 200);
        }
    }

    public function favourite_list(Request $request)
    {
        $checkuser = User::find($request->id);
        if (!empty($checkuser)) {
            if ($checkuser->type == 3) {
                $favourite = Favourite::where('user_id', $checkuser->id)->select('dome_id')->get();
                if (count($favourite) != 0) {
                    foreach ($favourite as $dome) {
                        $dome_data = Domes::where('id', $dome->dome_id)->where('is_deleted', 2)->first();
                        $dome_image = DomeImages::where('dome_id', $dome->dome_id)->first();
                        $dome_list = array(
                            "id" => $dome_data->id,
                            "name" => $dome_data->name,
                            "image" => Helper::image_path($dome_image->images),
                            "price" => $dome_data->price,
                            "city" => $dome_data->city,
                            "state" => $dome_data->state,
                        );
                        $dome_lists[] = $dome_list;
                    }
                    return response()->json(["status" => 1, "message" => "Successful", 'total_favourite_domes' => $favourite->count(), 'dome_list' => $dome_lists], 200);
                } else {
                    return response()->json(["status" => 0, "message" => 'No Data Found'], 200);
                }
            } else {
                return response()->json(["status" => 0, "message" => 'Invalid User'], 200);
            }
        } else {
            return response()->json(["status" => 0, "message" => 'Invalid User ID'], 200);
        }
    }
}
