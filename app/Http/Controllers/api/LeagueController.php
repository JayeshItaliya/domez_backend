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
use Carbon\CarbonPeriod;
use DateInterval;
use DatePeriod;
use DateTime;
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
                    if ($request->has('user_id') && !in_array($request->user_id, [0, ''])) {
                        if (empty(User::find($request->user_id))) {
                            return response()->json(["status" => 0, "message" => 'Invalid User ID'], 200);
                        }
                    }
                    $recentbookings = Booking::where('user_id', $request->user_id)->where('type', 2)->get();
                    if (count($recentbookings) > 0) {
                        foreach ($recentbookings as $booking) {
                            $dome = Domes::where('id', $booking->dome_id)->where('is_deleted', 2)->first();
                            $league = League::where('id', $booking->league_id)->where('is_deleted', 2)->first();
                            if (!empty($league)) {
                                if (!in_array($request->user_id, [0, ''])) {
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
                                    "date" => date('d M', strtotime($league->start_date)) . ' - ' . date('d M', strtotime($league->end_date)),
                                    "sport_data" => Sports::select('id', 'name', DB::raw("CONCAT('" . url('storage/app/public/admin/images/sports') . "/', image) AS image"))->whereIn('id', explode('|', $league->sport_id))->where('is_available', 1)->where('is_deleted', 2)->get(),
                                ];
                            }
                        }
                    } else {
                        $leagues = League::orderByDesc('id')->where('is_deleted', 2)->get();
                        foreach ($leagues as $league) {
                            if (!empty($league)) {
                                $dome = Domes::where('id', $league->dome_id)->where('is_deleted', 2)->first()
                                if (!in_array($request->user_id, [0, ''])) {
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
                                    "date" => date('d M', strtotime($league->start_date)) . ' - ' . date('d M', strtotime($league->end_date)),
                                    "sport_data" => Sports::select('id', 'name', DB::raw("CONCAT('" . url('storage/app/public/admin/images/sports') . "/', image) AS image"))->whereIn('id', explode('|', $league->sport_id))->where('is_available', 1)->where('is_deleted', 2)->get(),
                                ];
                            }
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
                    )->where('domes.is_deleted', 2);
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
            return response()->json(["status" => 0, "message" => 'League Not Found'], 200);
        }
    }
    public function getleaguedataobject($id)
    {
        $league = League::find($id);
        if (empty($league)) {
            return $league_data = 1;
        }
        $sports = Sports::select('id', 'name', DB::raw("CONCAT('" . url('storage/app/public/admin/images/leagues') . "/', image) AS image"))->whereIn('id', explode('|', $league->sport_id))->where('is_available', 1)->where('is_deleted', 2)->get();

        $dome = Domes::where('id', $league->dome_id)->where('is_deleted', 2)->first();
        $benefits = [];
        foreach (explode('|', $dome->benefits) as $benefit) {
            $benefits[] = [
                'benefit' => $benefit,
                'benefit_image' => 'https://via.placeholder.com/150',
            ];
        }
        if (!empty($league)) {
            $datetime1 = new DateTime($league->start_date);
            $datetime2 = new DateTime($league->end_date);
            $interval = $datetime1->diff($datetime2);
            $startDate2 = new \DateTime(date('m/d'));
            $endDate2 = new \DateTime(date('m/d', strtotime("+7 day")));
            for ($date = $startDate2; $date < $endDate2; $date->modify('+1 day')) {
                $daylist[] = $date->format('D');
            }
            $league_data = array(
                'id' => $league->id,
                'league_name' => $league->name,
                'dome_name' => $dome->name,
                "fields" => '1 & 3',
                "days" => implode(' | ', $daylist),
                "total_games" => $interval->format('%a'),
                "time" => $league->start_time . ' To ' . $league->end_time,
                "date" => date('d/m/Y', strtotime($league->start_date)) . ' To ' . date('d/m/Y', strtotime($league->end_date)),
                'gender' => $league->gender == 1 ? 'Men' : ($league->gender == 2 ? 'Women' : 'Other'),
                'age' => $league->from_age . ' Years' . ' To ' . $league->to_age . ' Years',
                'sport' => Sports::find($league->sport_id)->name,
                'team_limit' => $league->team_limit . ' Teams ',
                'min_player' => $league->min_player . ' Players ',
                'max_player' => $league->max_player . ' Players ',
                'price' => $league->price,
                'price' => $league->price,
                'hst' => $dome->hst,
                'address' => $dome->address,
                'city' => $dome->city,
                'state' => $dome->state,
                'lat' => $dome->lat,
                'lng' => $dome->lng,
                'amenities_description' => $dome->benefits_description,
                'league_images' => [
                    [
                        "id" => '',
                        "league_id" => $league->id,
                        "image" => 'https://www.playall.in/images/gallery/orbitMall_box_cricket_2.png',
                    ],
                    [
                        "id" => '',
                        "league_id" => $league->id,
                        "image" => 'https://cdn.xxl.thumbs.canstockphoto.com/3d-render-of-a-round-cricket-stadium-with-black-seats-and-vip-boxes-3d-render-of-a-beautiful-modern-clipart_csp46450310.jpg',
                    ],
                    [
                        "id" => '',
                        "league_id" => $league->id,
                        "image" => 'https://thumbs.dreamstime.com/b/indoor-stadium-view-behind-wicket-cricket-160851985.jpg',
                    ],
                ],
                'amenities' => $benefits,
            );
        }
        return $league_data;
    }
}
