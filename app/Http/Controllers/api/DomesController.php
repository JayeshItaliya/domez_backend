<?php

namespace App\Http\Controllers\api;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Domes;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class DomesController extends Controller
{
    public function domes_list(Request $request)
    {
        if (!in_array($request->type, [1, 2, 3])) {
            return response()->json(["status" => 0, "message" => 'Invalid request!'], 200);
        }
        $ids = $domes_list = [];
        //Type = 1 (Recent Bookings Dome Data)
        if ($request->type == 1) {
            if (in_array($request->user_id, [0, ''])) {
                return response()->json(["status" => 0, "message" => 'Enter Login User ID'], 200);
            }
            if (empty(User::where('id',$request->user_id)->where('is_available',1)->where('is_deleted',2)->first())) {
                return response()->json(["status" => 0, "message" => 'Invalid User ID'], 200);
            }
            $data = Booking::where('user_id', $request->user_id)->where('type', 1)->orderByDesc('created_at')->paginate(10);
            foreach ($data as $booking) {
                $dome = Domes::where('id', $booking->dome_id)->where('is_deleted', 2)->hasFields()->first();
                if (!empty($dome)) {
                    $start_date_time = Carbon::createFromFormat('Y-m-d h:i A', $booking->start_date . ' ' . date('h:i A', strtotime($booking->end_time)));
                    $now = Carbon::now();
                    $current_date_time = $now->format('Y-m-d h:i A');
                    $domes_list[] = [
                        "id" => $dome->id,
                        "name" => $dome->name,
                        "image" => $dome->dome_image == "" ? "" : $dome->dome_image->image,
                        "price" => Helper::get_dome_price($dome->id, $request->sport_id != '' ? $request->sport_id : explode(',', $dome->sport_id)[0]),
                        "hst" => $dome->hst,
                        "city" => $dome->city,
                        "state" => $dome->state,
                        "is_active" => $start_date_time->lessThan($current_date_time) == true ? 2 : 1,
                        "is_fav" => Helper::is_fav($request->user_id, $dome->id, ''),
                        "booking_id" => $request->type == 1 ? $booking->id : 0,
                        "booking_type" => $request->type == 1 ? $booking->type : 0,
                        "booking_payment_type" => $request->type == 1 ? $booking->payment_type : 0,
                        "booking_date" => date('D, d M', strtotime($booking->start_date)),
                        "total_fields" => $dome->total_fields,
                        "sports_list" => Helper::get_sports_list($dome->sport_id),
                    ];
                }
            }
        }
        //Type = 2 (Most Popular Dome Data)
        if ($request->type == 2) {
            $popular_domes = Booking::select('dome_id', DB::raw('count(bookings.dome_id)as dome'))->where('type', 1)->groupBy('dome_id')->orderBy('dome', 'desc')->get();
            foreach ($popular_domes as $pdome) {
                $dome = Domes::where('id', $pdome->dome_id)->where('is_deleted', 2)->whereRaw("find_in_set('" . $request->sport_id . "',sport_id)")->hasFields()->first();
                if (!empty($dome)) {
                    $ids[] = $dome->id;
                    $domes_list[] = $this->domelistobject($dome, $request->user_id, $request->sport_id);
                }
            }
            $popular_domes = Domes::where('is_deleted', 2)->whereNotIn('id', $ids)->whereRaw("find_in_set('" . $request->sport_id . "',sport_id)")->hasFields()->orderByDesc('id')->get();
            foreach ($popular_domes as $dome) {
                $domes_list[] = $this->domelistobject($dome, $request->user_id, $request->sport_id);
            }
            $perPage = 10;
            $page = $request->query('page', 1);
            $items = collect($domes_list);
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
            return response()->json(["status" => 1, "message" => "Successful", 'domes_list' => $paginator->toArray()['data'], "last_page" => $paginator->toArray()['last_page']], 200);
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
            $data = Domes::select(
                'domes.*',
                DB::raw("6371 * acos(cos(radians(" . $lat . "))
                * cos(radians(lat))
                * cos(radians(lng) - radians(" . $lng . "))
                + sin(radians(" . $lat . "))
                * sin(radians(lat))) AS distance")
            )->where('domes.is_deleted', 2);
            $data = $data->having('distance', '<=', $request->kilometer > 0 ? $request->kilometer : 10000);
            if ($request->sport_id != "") {
                $data = $data->whereRaw("find_in_set('" . $request->sport_id . "',sport_id)");
            }
            if ($request->max_price > 0) {
                $data = $data->whereBetween('price', [$request->min_price, $request->max_price]);
            }
            $data = $data->orderBy('distance')->hasFields()->paginate(10);
            foreach ($data as $dome) {
                $domes_list[] = $this->domelistobject($dome, $request->user_id, $request->sport_id);
            }
        }
        return response()->json(["status" => 1, "message" => "Successful", 'domes_list' => $domes_list, "last_page" => $data->toArray()['last_page']], 200);
    }
    public function domelistobject($dome, $user_id, $sport_id)
    {
        $arr = [
            "id" => $dome->id,
            "name" => $dome->name,
            "image" => $dome->dome_image == "" ? "" : $dome->dome_image->image,
            "price" => Helper::get_dome_price($dome->id, $sport_id != '' ? $sport_id : explode(',', $dome->sport_id)[0]),
            "hst" => $dome->hst,
            "city" => $dome->city,
            "state" => $dome->state,
            "is_fav" => Helper::is_fav($user_id, $dome->id, ''),
            "is_active" => 0,
            "booking_id" => 0,
            "booking_type" => 0,
            "booking_payment_type" => 0,
            "booking_date" => "",
            "total_fields" => $dome->total_fields,
            "sports_list" => Helper::get_sports_list($dome->sport_id),
        ];
        return $arr;
    }
    public function domes_details(Request $request)
    {
        $dome = Domes::with(['dome_images','working_hours'])->where('id', $request->id)->where('is_deleted', 2)->first();
        if (empty($dome)) {
            return response()->json(["status" => 0, "message" => 'Dome Not Found'], 200);
        }
        $benefits = [];
        foreach (explode('|', $dome->benefits) as $benefit) {
            $benefits[] = [
                'benefit' => $benefit,
                'benefit_image' => '',
            ];
        }
        $review = Review::where('dome_id', $dome->id)->selectRaw('SUM(rating)/COUNT(user_id) AS avg_rating')->first()->avg_rating;
        $images = Review::where('reviews.dome_id', $dome->id)
            ->join('users AS users_table', function ($query) {
                $query->on('reviews.user_id', '=', 'users_table.id')->where('users_table.type', 3);
            })->select(DB::raw("CONCAT('" . url('storage/app/public/admin/images/profiles') . "/', users_table.image) AS image"))->get()->take(5)->pluck('image');
        $total_reviews = Review::where('dome_id', $dome->id)->get();
        $ratting_data = [
            'avg_rating' => ($review) ? $review : "0",
            'total_review' => $total_reviews->count() > 100 ? '100+' : $total_reviews->count(),
            'images' => $images,
        ];
        if (!empty($dome)) {
            $dome_data = array(
                'id' => $dome->id,
                'total_fields' => $dome->total_fields,
                'name' => $dome->name,
                'price' => Helper::get_dome_price($dome->id, explode(',', $dome->sport_id)[0]),
                'hst' => $dome->hst,
                'address' => $dome->address,
                'city' => $dome->city,
                'state' => $dome->state,
                'start_time' => date('h:i A',strtotime($dome->day_working_hours('')->open_time)),
                'end_time' => date('h:i A',strtotime($dome->day_working_hours('')->close_time)),
                'description' => $dome->description,
                'lat' => $dome->lat,
                'lng' => $dome->lng,
                'benefits_description' => $dome->benefits_description ?? '',
                'ratting_data' => $ratting_data,
                'benefits' => $benefits,
                'sports_list' => Helper::get_sports_list($dome->sport_id),
                'dome_images' => $dome->dome_images,
                "current_time" => Carbon::now()->setTimezone(config('app.timezone'))->toDateTimeString(),
                'closed_days' => $dome->working_hours->pluck('is_closed'),
            );
        }
        return response()->json(["status" => 1, "message" => "Successful", 'dome_details' => $dome_data], 200);
    }
}
