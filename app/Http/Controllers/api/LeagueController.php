<?php

namespace App\Http\Controllers\api;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Domes;
use App\Models\League;
use App\Models\User;
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
                    // if ($request->has('user_id') && !in_array($request->user_id, [0, ''])) {
                    //     if (empty(User::find($request->user_id))) {
                    //         return response()->json(["status" => 0, "message" => 'Invalid User ID'], 200);
                    //     }
                    // }
                    $recentbookings = Booking::where('type', 2)->groupBy('league_id')->get();
                    foreach ($recentbookings as $booking) {
                        $league = League::where('id', $booking->league_id)->where('sport_id', $request->sport_id)->whereDate('booking_deadline', '>=', date('Y-m-d'))->where('is_deleted', 2)->first();
                        if (!empty($league)) {
                            $leagues_list[] = $this->getleaguelistobject($league, $request->user_id);
                        }
                    }
                    if (count($recentbookings) == 0 || count($leagues_list) == 0) {
                        $leagues = League::where('sport_id', $request->sport_id)->whereDate('booking_deadline', '>=', date('Y-m-d'))->where('is_deleted', 2)->orderByDesc('id')->get();
                        foreach ($leagues as $league) {
                            $leagues_list[] = $this->getleaguelistobject($league, $request->user_id);
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
                    $getarounddomes = $getarounddomes->orderBy('distance')->get();
                    foreach ($getarounddomes as $dome) {
                        $leagues = League::where('dome_id', $dome->id)->where('sport_id', $request->sport_id)->whereDate('booking_deadline', '>=', date('Y-m-d'))->where('is_deleted', 2)->orderByDesc('id')->get();
                        foreach ($leagues as $league) {
                            $leagues_list[] = $this->getleaguelistobject($league, $request->user_id);
                        }
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
    public function getleaguelistobject($league, $user_id)
    {
        $arr = [
            "id" => $league->id,
            "league_name" => $league->name,
            "dome_name" => $league->dome_info->name,
            "image" => $league->league_image == "" ? "" : $league->league_image->image,
            "price" => $league->price,
            "city" => $league->dome_info->city,
            "state" => $league->dome_info->state,
            "is_fav" => Helper::is_fav($user_id, '', $league->id),
            "date" => date('d M', strtotime($league->start_date)) . ' - ' . date('d M', strtotime($league->end_date)),
            "sport_data" => Helper::get_sports_list($league->sport_id),
            "booking_deadline" => $league->booking_deadline,
        ];
        return $arr;
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
        $league = League::where('id', $id)->where('is_deleted', 2)->first();
        // ->whereDate('booking_deadline', '>=', date('Y-m-d'))
        if (empty($league)) {
            return $league_data = 1;
        }
        $benefits = [];
        foreach (explode('|', $league->dome_info->benefits) as $benefit) {
            $benefits[] = [
                'benefit' => $benefit,
                'benefit_image' => '',
            ];
        }
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
            'dome_name' => $league->dome_info->name,
            "fields" => (string)count(explode(',', $league->field_id)),
            "days" => implode(' | ', $daylist),
            "total_games" => $interval->format('%a'),
            "time" => $league->start_time . ' To ' . $league->end_time,
            "date" => date('d/m/Y', strtotime($league->start_date)) . ' To ' . date('d/m/Y', strtotime($league->end_date)),
            'gender' => $league->gender == 1 ? 'Men' : ($league->gender == 2 ? 'Women' : 'Mixed'),
            'age' => $league->from_age . ' Years To ' . $league->to_age . ' Years',
            'sport' => $league->sport_info->name,
            'team_limit' => $league->team_limit . ' Teams ',
            'min_player' => $league->min_player . ' Players ',
            'max_player' => $league->max_player . ' Players ',
            'price' => $league->price,
            'hst' => $league->dome_info->hst,
            'address' => $league->dome_info->address,
            'city' => $league->dome_info->city,
            'state' => $league->dome_info->state,
            'lat' => $league->dome_info->lat,
            'lng' => $league->dome_info->lng,
            'amenities_description' => $league->dome_info->benefits_description,
            'league_images' => $league->league_images,
            'amenities' => $benefits,
            "booking_deadline" => $league->booking_deadline,
        );
        return $league_data;
    }
}
