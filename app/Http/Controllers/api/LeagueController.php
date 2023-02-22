<?php

namespace App\Http\Controllers\api;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Domes;
use App\Models\Favourite;
use App\Models\Field;
use App\Models\League;
use App\Models\Review;
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
                $leagues_list = [];
                //Type = 2 (Most Popular Leagues Data)
                if ($request->type == 2) {
                    if ($request->user_id == "") {
                        return response()->json(["status" => 0, "message" => 'Enter Login User ID'], 200);
                    }
                    if (empty(User::find($request->user_id))) {
                        return response()->json(["status" => 0, "message" => 'Invalid User ID'], 200);
                    }
                    $recentbookings = Booking::where('user_id', $request->user_id)->where('type',2)->get();
                    foreach ($recentbookings as $booking) {
                        $dome = Domes::find($booking->dome_id);
                        $league = League::where('id', $booking->league_id)->where('is_deleted', 2)->first();
                        if (!empty($league)) {
                            if ($request->user_id != "") {
                                $is_fav = Favourite::where('league_id', $league->id)->where('user_id', $request->user_id)->first();
                            }
                            $leagues_list[] = [
                                "id" => $league->id,
                                "league_name" => $league->name,
                                "dome_name" => $dome->name,
                                "image" => $league->image == "" ? "" : Helper::image_path($league->image),
                                "price" => $league->price,
                                "city" => $dome->city,
                                "state" => $dome->state,
                                "is_fav" => !empty(@$is_fav) ? true : false,
                                "date" => date('d F', strtotime($league->start_date)).' - '.date('d F', strtotime($league->end_date)),
                                "sport_data" => Sports::select('id', 'name', DB::raw("CONCAT('" . url('storage/app/public/admin/images/sports') . "/', image) AS image"))->whereIn('id', explode('|', $league->sport_id))->where('is_available', 1)->where('is_deleted', 2)->get(),
                            ];
                        }
                    }
                }
                //Type = 3 (Leagues Around You)
                if ($request->type == 3) {
                    if ($request->lat == "") {
                        return response()->json(["status" => 0, "message" => 'Enter Latitude'], 200);
                    }
                    if ($request->lng == "") {
                        return response()->json(["status" => 0, "message" => 'Enter Longitude'], 200);
                    }
                    $lat = $request->lat;
                    $lng = $request->lng;
                    $getarounddomes = Domes::with('dome_image')->select(
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
                        // dd($getarounddomes);
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
                            "sports_list" => Sports::select('id', 'name', DB::raw("CONCAT('" . url('storage/app/public/admin/images/sports') . "/', image) AS image"))->whereIn('id', explode('|', $dome->sport_id))->where('is_available', 1)->where('is_deleted', 2)->get(),
                        ];
                    }
                }
                return response()->json(["status" => 1, "message" => "Successful", 'leagues_list' => $leagues_list], 200);
            } else {
                return response()->json(["status" => 0, "message" => 'Invalid Type'], 200);
            }
        } else {
            return response()->json(["status" => 0, "message" => "Enter League Data Type"]);
        }
    }
    public function league_details(Request $request)
    {
        $league_data = $this->getleaguedataobject($request->id);
        if ($league_data != 1) {
            return response()->json(["status" => 1, "message" => "Successful", 'league_details' => $league_data], 200);
        } else {
            return response()->json(["status" => 0, "message" => 'Dome Not Found'], 200);
        }
    }
    public function getleaguedataobject($id)
    {
        $league = League::find($id);
        if (empty($league)) {
            return $league_data = 1;
        }
        $sports = Sports::select('id', 'name', DB::raw("CONCAT('" . url('storage/app/public/admin/images/leagues') . "/', image) AS image"))->whereIn('id', explode('|', $league->sport_id))->where('is_available', 1)->where('is_deleted', 2)->get();
        foreach ($sports as $sport) {
            $fields = Field::whereIn('id', explode('|', $league->field_id))->where('dome_id', $league->dome_id)->where('sport_id', $league->sport_id)->where('is_available', 1)->where('is_deleted', 2)->get();
            dd(Field::whereIn('id', explode('|', $league->field_id))->where('dome_id', $league->dome_id)->where('sport_id', $league->sport_id)->get());
            $field_data = [];
            foreach ($fields as $field) {
                $field_data[] = [
                    'field_id' => $field->id,
                    'field_name' => $field->name,
                    'field_area' => $field->area . ' ' . 'Sqr Ft',
                    'field_person' => $field->min_person . '-' . $field->max_person . ' ' . 'People',
                ];
            }
            $sports_list[] = [
                'sport_id' => $sport->id,
                'sport_name' => $sport->name,
                'sport_image' => $sport->image,
                // 'field_data' => $field_data,
            ];
        }

        $review = Review::where('dome_id', $league->id)->selectRaw('SUM(ratting)/COUNT(user_id) AS avg_rating')->first()->avg_rating;
        $images = Review::where('reviews.dome_id', $league->id)
            ->join('users AS users_table', function ($query) {
                $query->on('reviews.user_id', '=', 'users_table.id')->where('users_table.type', 3);
            })->select(DB::raw("CONCAT('" . url('storage/app/public/admin/images/profiles') . "/', users_table.image) AS image"))->get()->take(5)->pluck('image');
        $total_reviews = Review::where('dome_id', $league->id)->get();
        $ratting_data = [
            'avg_rating' => ($review) ? $review : "0",
            'total_review' => $total_reviews->count() > 100 ? '100+' : $total_reviews->count(),
            'images' => $images,
        ];
        $dome = Domes::where('id',$league->dome_id)->first();
        if (!empty($league)) {
            $league_data = array(
                'id' => $league->id,
                'league_name' => $league->name,
                'dome_name' => $dome->name,
                'price' => $league->price,
                'city' => $dome->city,
                'state' => $dome->state,
                'start_time' => $league->start_time,
                'end_time' => $league->end_time,
                'description' => $league->description,
                'lat' => $dome->lat,
                'lng' => $dome->lng,
                'benefits_description' => $league->benefits_description,
                'ratting_data' => $ratting_data,
                'sports_list' => $sports_list,
                'dome_images' => $league->dome_images,
            );
        }
        return $league_data;
    }
}
