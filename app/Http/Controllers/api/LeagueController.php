<?php
namespace App\Http\Controllers\api;
use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Domes;
use App\Models\League;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class LeagueController extends Controller
{
    public function leagues_list(Request $request)
    {
        if (!in_array($request->type, [1, 2, 3])) {
            return response()->json(["status" => 0, "message" => 'Invalid Request'], 200);
        }
        $leagues_list = [];
        //Type = 2 (Most Popular Leagues Data)
        if ($request->type == 2) {
            $recentbookings = Booking::where('type', 2)->groupBy('league_id')->get();
            $ids = $leagues_list = [];
            foreach ($recentbookings as $booking) {
                $league = League::where('id', $booking->league_id)->where('sport_id', $request->sport_id)->whereDate('end_date', '>=', date('Y-m-d'))->where('is_deleted', 2)->first();
                if (!empty($league)) {
                    $ids[] = $booking->league_id;
                    $leagues_list[] = $this->getleaguelistobject($league, $request->user_id);
                }
            }
            $leagues = League::where('sport_id', $request->sport_id)->whereNotIn('id', $ids)->whereDate('end_date', '>=', date('Y-m-d'))->where('is_deleted', 2)->orderByDesc('id')->get();
            foreach ($leagues as $league) {
                $leagues_list[] = $this->getleaguelistobject($league, $request->user_id);
            }
            // $perPage = 10;
            // $page = $request->query('page', 1);
            // $items = collect($leagues_list);
            // --- $items = $items->values();
            // $paginator = new LengthAwarePaginator(
            //     $items->forPage($page, $perPage),$items->count(),$perPage,$page,
            //     [
            //         'path' => Paginator::resolveCurrentPath(),
            //         'pageName' => 'page',
            //     ]
            // );

            $perPage = 10;
            $page = $request->query('page', 1);
            $items = collect($leagues_list);
            $paginatedItems = $items->forPage($page, $perPage);
            $paginator = new LengthAwarePaginator(
                $paginatedItems,
                $items->count(),
                $perPage,
                $page,
                [
                    'path' => Paginator::resolveCurrentPath(),
                    'pageName' => 'page',
                ]
            );
            $paginator->setCollection($paginatedItems->values());
            return response()->json(["status" => 1, "message" => "Successful", 'leagues_list' => $paginator->toArray()['data'], "last_page" => $paginator->toArray()['last_page']], 200);
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

            $data = League::with('dome_info.dome_image')
                ->select(
                    'leagues.*',
                    DB::raw("6371 * acos(cos(radians(" . $lat . "))
                        * cos(radians(domes.lat))
                        * cos(radians(domes.lng) - radians(" . $lng . "))
                        + sin(radians(" . $lat . "))
                        * sin(radians(domes.lat))) AS distance")
                )
                ->leftJoin('domes', 'leagues.dome_id', '=', 'domes.id')
                ->where('leagues.is_deleted', 2)
                ->where('domes.is_deleted', 2);
            $data = $data->having('distance', '<=', $request->kilometer > 0 ? $request->kilometer : 10000);
            if ($request->sport_id != "") {
                $data = $data->where('leagues.sport_id', $request->sport_id);
            }
            if ($request->max_price > 0) {
                $data = $data->whereBetween('leagues.price', [$request->min_price, $request->max_price]);
            }
            $data = $data->whereDate('leagues.end_date', '>=', date('Y-m-d'))->orderBy('distance')->paginate(10);
            $leagues_list = [];
            foreach ($data as $league) {
                $leagues_list[] = $this->getleaguelistobject($league, $request->user_id);
            }
            return response()->json(["status" => 1, "message" => "Successful", 'leagues_list' => $leagues_list, "last_page" => $data->toArray()['last_page']], 200);
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
        $league_data = $this->getleaguedataobject($request->id, $request->user_id);
        if ($league_data != 1) {
            return response()->json(["status" => 1, "message" => "Successful", 'league_details' => $league_data], 200);
        } else {
            return response()->json(["status" => 0, "message" => 'League Not Found'], 200);
        }
    }
    public function getleaguedataobject($id, $user_id)
    {
        $league = League::where('id', $id)->where('is_deleted', 2)->first();
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
        // $startDate2 = new \DateTime(date('m/d'));
        // $endDate2 = new \DateTime(date('m/d', strtotime("+7 day")));
        // for ($date = $startDate2; $date < $endDate2; $date->modify('+1 day')) {
        //     $daylist[] = $date->format('D');
        // }
        $league_data = array(
            'id' => $league->id,
            'league_name' => $league->name,
            'dome_name' => $league->dome_info->name,
            "fields" => (string)count(explode(',', $league->field_id)),
            // "days" => implode(' | ', $daylist),
            "days" => $league->days,
            "total_games" => $interval->format('%a'),
            "time" => date('h:i A', strtotime($league->start_time)) . ' To ' . date('h:i A', strtotime($league->end_time)),
            "date" => date('d/m/Y', strtotime($league->start_date)) . ' To ' . date('d/m/Y', strtotime($league->end_date)),
            'gender' => $league->gender == 1 ? 'Men' : ($league->gender == 2 ? 'Women' : 'Mixed'),
            'age' => 'Age '.$league->from_age . ' To Age ' . $league->to_age,
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
            'amenities_description' => $league->dome_info->benefits_description ?? '',
            'league_images' => $league->league_images,
            'amenities' => $benefits,
            "booking_deadline" => Carbon::parse($league->booking_deadline)->setTimezone(config('app.timezone'))->toDateTimeString(),
            "is_fav" => Helper::is_fav($user_id, '', $league->id),
            'current_time' => Carbon::now()->setTimezone(config('app.timezone'))->toDateTimeString(),
        );
        return $league_data;
    }
}
