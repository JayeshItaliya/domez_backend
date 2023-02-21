<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Favourite;
use App\Models\Field;
use App\Models\League;
use App\Models\Sports;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeagueController extends Controller
{
    public function leagues_list(Request $request)
    {
        if ($request->type != "") {
            if (in_array($request->type, [1, 2, 3])) {
                $domes_list = [];
                //Type = 1 (Recent Bookings Dome Data)
                if ($request->type == 1) {
                    if ($request->user_id != "") {
                        return response()->json(["status" => 0, "message" => 'Enter Login User ID'], 200);
                    }
                    if (empty(User::find($request->user_id))) {
                        return response()->json(["status" => 0, "message" => 'Invalid User ID'], 200);
                    }
                    $recentbookings = Booking::where('user_id', $request->user_id)->where('type',2)->get();
                    foreach ($recentbookings as $booking) {
                        $league = League::where('id', $booking->league_id)->where('is_deleted', 2)->first();
                        if (!empty($league)) {
                            if ($request->user_id != "") {
                                $is_fav = Favourite::where('league_id', $league->id)->where('user_id', $request->user_id)->first();
                            }
                            $leagues_list[] = [
                                "id" => $league->id,
                                "name" => $league->name,
                                "image" => $league->dome_image == "" ? "" : $league->dome_image->image,
                                "price" => $league->price,
                                "city" => $league->city,
                                "state" => $league->state,
                                "is_fav" => !empty(@$is_fav) ? true : false,
                                "booking_date" => $booking->booking_date,
                                "total_fields" => Field::where('dome_id', $league->id)->where('is_deleted', 2)->count(),
                                "sports_list" => Sports::select('id', 'name', DB::raw("CONCAT('" . url('storage/app/public/admin/images/leagues') . "/', image) AS image"))->whereIn('id', explode('|', $league->sport_id))->where('is_available', 1)->where('is_deleted', 2)->get(),
                            ];
                        }
                    }
                }
                //Type = 2 (Most Popular Dome Data)
                if ($request->type == 2) {
                    $popular_domes = Booking::select('dome_id', DB::raw('count(bookings.dome_id)as dome'))->groupBy('dome_id')->orderBy('dome', 'desc')->get();
                    foreach ($popular_domes as $pdome) {
                        $dome = League::where('id', $pdome->dome_id)->where('is_deleted', 2)->first();
                        if (!empty($dome)) {
                            if ($request->user_id != "") {
                                $is_fav = Favourite::where('dome_id', $dome->id)->where('user_id', $request->user_id)->first();
                            }
                            $leagues_list[] = [
                                "id" => $dome->id,
                                "name" => $dome->name,
                                "image" => $dome->dome_image == "" ? "" : $dome->dome_image->image,
                                "price" => $dome->price,
                                "city" => $dome->city,
                                "state" => $dome->state,
                                "is_fav" => !empty(@$is_fav) ? true : false,
                                "booking_date" => "",
                                "total_fields" => Field::where('dome_id', $dome->id)->where('is_deleted', 2)->count(),
                                "sports_list" => Sports::select('id', 'name', DB::raw("CONCAT('" . url('storage/app/public/admin/images/leagues') . "/', image) AS image"))->whereIn('id', explode('|', $dome->sport_id))->where('is_available', 1)->where('is_deleted', 2)->get(),
                            ];
                        }
                    }
                }
                //Type = 3 (Domes Around You)
                if ($request->type == 3) {
                    if ($request->lat == "") {
                        return response()->json(["status" => 0, "message" => 'Enter Latitude'], 200);
                    }
                    if ($request->lng == "") {
                        return response()->json(["status" => 0, "message" => 'Enter Longitude'], 200);
                    }
                    $lat = $request->lat;
                    $lng = $request->lng;
                    $getarounddomes = League::with('dome_image')->select(
                        'domes.*',
                        DB::raw("6371 * acos(cos(radians(" . $lat . "))
                    * cos(radians(lat))
                    * cos(radians(lng) - radians(" . $lng . "))
                    + sin(radians(" . $lat . "))
                    * sin(radians(lat))) AS distance")
                    );
                    // The Distance Will Be in Kilometers
                    $getarounddomes = $getarounddomes->having('distance', '<=', $request->kilometer > 0 ? $request->kilometer : 1000);

                    if ($request->sport_id != "") {
                        $getarounddomes = $getarounddomes->whereRaw("find_in_set('" . $request->sport_id . "',sport_id)");
                    }
                    if ($request->max_price > 0) {
                        $getarounddomes = $getarounddomes->whereBetween('price', [$request->min_price, $request->max_price]);
                    }
                    $getarounddomes = $getarounddomes->orderBy('distance')->whereIn('id', [1, 2, 3, 4])->get();

                    foreach ($getarounddomes as $dome) {
                        if ($request->user_id != "") {
                            $is_fav = Favourite::where('dome_id', $dome->id)->where('user_id', $request->user_id)->first();
                        }
                        $leagues_list[] = [
                            "id" => $dome->id,
                            "name" => $dome->name,
                            "image" => $dome->dome_image == "" ? "" : $dome->dome_image->image,
                            "price" => $dome->price,
                            "city" => $dome->city,
                            "state" => $dome->state,
                            "is_fav" => !empty(@$is_fav) ? true : false,
                            "booking_date" => "",
                            "total_fields" => Field::where('dome_id', $dome->id)->where('is_deleted', 2)->count(),
                            "sports_list" => Sports::select('id', 'name', DB::raw("CONCAT('" . url('storage/app/public/admin/images/leagues') . "/', image) AS image"))->whereIn('id', explode('|', $dome->sport_id))->where('is_available', 1)->where('is_deleted', 2)->get(),
                        ];
                    }
                }
                return response()->json(["status" => 1, "message" => "Successful", 'domes_list' => $domes_list], 200);
            } else {
                return response()->json(["status" => 0, "message" => 'Invalid Type'], 200);
            }
        } else {
            return response()->json(["status" => 0, "message" => "Enter League Data Type"]);
        }
    }
}
