<?php
namespace App\Http\Controllers\api;
use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Domes;
use App\Models\Field;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class DomesController extends Controller
{
    public function domes_list(Request $request)
    {
        if ($request->type != "") {
            if (in_array($request->type, [1, 2, 3])) {
                $domes_list = [];
                //Type = 1 (Recent Bookings Dome Data)
                if ($request->type == 1) {
                    if (in_array($request->user_id, [0, ''])) {
                        return response()->json(["status" => 0, "message" => 'Enter Login User ID'], 200);
                    }
                    if (empty(User::find($request->user_id))) {
                        return response()->json(["status" => 0, "message" => 'Invalid User ID'], 200);
                    }
                    $recentbookings = Booking::where('user_id', $request->user_id)->where('type', 1)->orderByDesc('created_at')->take(10)->get();
                    foreach ($recentbookings as $booking) {
                        $dome = Domes::where('id', $booking->dome_id)->where('is_deleted', 2)->first();
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
                                "total_fields" => Field::where('dome_id', $dome->id)->where('is_deleted', 2)->count(),
                                "sports_list" => Helper::get_sports_list($dome->sport_id),
                            ];
                        }
                    }
                }
                //Type = 2 (Most Popular Dome Data)
                if ($request->type == 2) {
                    $popular_domes = Booking::select('dome_id', DB::raw('count(bookings.dome_id)as dome'))->where('type', 1)->groupBy('dome_id')->orderBy('dome', 'desc')->get();
                    if (count($popular_domes) > 0) {
                        foreach ($popular_domes as $pdome) {
                            $dome = Domes::where('id', $pdome->dome_id)->where('is_deleted', 2)->whereRaw("find_in_set('" . $request->sport_id . "',sport_id)")->first();
                            if (!empty($dome)) {
                                $domes_list[] = [
                                    "id" => $dome->id,
                                    "name" => $dome->name,
                                    "image" => $dome->dome_image == "" ? "" : $dome->dome_image->image,
                                    "price" => Helper::get_dome_price($dome->id, $request->sport_id != '' ? $request->sport_id : explode(',', $dome->sport_id)[0]),
                                    "hst" => $dome->hst,
                                    "city" => $dome->city,
                                    "state" => $dome->state,
                                    "is_fav" => Helper::is_fav($request->user_id, $dome->id, ''),
                                    "is_active" => 0,
                                    "booking_id" => 0,
                                    "booking_type" => 0,
                                    "booking_payment_type" => 0,
                                    "booking_date" => "",
                                    "total_fields" => Field::where('dome_id', $dome->id)->where('is_deleted', 2)->count(),
                                    "sports_list" => Helper::get_sports_list($dome->sport_id),
                                ];
                            }
                        }
                    } else {
                        $popular_domes = Domes::where('is_deleted', 2)->whereRaw("find_in_set('" . $request->sport_id . "',sport_id)")->orderByDesc('id')->get();
                        foreach ($popular_domes as $dome) {
                            $domes_list[] = [
                                "id" => $dome->id,
                                "name" => $dome->name,
                                "image" => $dome->dome_image == "" ? "" : $dome->dome_image->image,
                                "price" => Helper::get_dome_price($dome->id, $request->sport_id != '' ? $request->sport_id : explode(',', $dome->sport_id)[0]),
                                "hst" => $dome->hst,
                                "city" => $dome->city,
                                "state" => $dome->state,
                                "is_fav" => Helper::is_fav($request->user_id, $dome->id, ''),
                                "is_active" => 0,
                                "booking_id" => 0,
                                "booking_type" => 0,
                                "booking_payment_type" => 0,
                                "booking_date" => "",
                                "total_fields" => Field::where('dome_id', $dome->id)->where('is_deleted', 2)->count(),
                                "sports_list" => Helper::get_sports_list($dome->sport_id),
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
                    $getarounddomes = Domes::select(
                        'domes.*',
                        DB::raw("6371 * acos(cos(radians(" . $lat . "))
                    * cos(radians(lat))
                    * cos(radians(lng) - radians(" . $lng . "))
                    + sin(radians(" . $lat . "))
                    * sin(radians(lat))) AS distance")
                    )->where('domes.is_deleted', 2);
                    $getarounddomes = $getarounddomes->having('distance', '<=', $request->kilometer > 0 ? $request->kilometer : 10000);
                    if ($request->sport_id != "") {
                        $getarounddomes = $getarounddomes->whereRaw("find_in_set('" . $request->sport_id . "',sport_id)");
                    }
                    if ($request->max_price > 0) {
                        $getarounddomes = $getarounddomes->whereBetween('price', [$request->min_price, $request->max_price]);
                    }
                    $getarounddomes = $getarounddomes->orderBy('distance')->get();
                    foreach ($getarounddomes as $dome) {
                        $domes_list[] = [
                            "id" => $dome->id,
                            "name" => $dome->name,
                            "image" => $dome->dome_image == "" ? "" : $dome->dome_image->image,
                            "price" => Helper::get_dome_price($dome->id, $request->sport_id != '' ? $request->sport_id : explode(',', $dome->sport_id)[0]),
                            "hst" => $dome->hst,
                            "city" => $dome->city,
                            "state" => $dome->state,
                            "is_fav" => Helper::is_fav($request->user_id, $dome->id, ''),
                            "is_active" => 0,
                            "booking_id" => 0,
                            "booking_type" => 0,
                            "booking_payment_type" => 0,
                            "booking_date" => "",
                            "total_fields" => Field::where('dome_id', $dome->id)->where('is_deleted', 2)->count(),
                            "sports_list" => Helper::get_sports_list($dome->sport_id),
                        ];
                    }
                }
                return response()->json(["status" => 1, "message" => "Successful", 'domes_list' => $domes_list], 200);
            } else {
                return response()->json(["status" => 0, "message" => 'Invalid Type'], 200);
            }
        } else {
            return response()->json(["status" => 0, "message" => 'Enter Dome Data Type'], 200);
        }
    }
    public function domes_details(Request $request)
    {
        $dome_data = $this->getdomedataobject($request->id);
        if ($dome_data != 1) {
            return response()->json(["status" => 1, "message" => "Successful", 'dome_details' => $dome_data], 200);
        } else {
            return response()->json(["status" => 0, "message" => 'Dome Not Found'], 200);
        }
    }
    public function getdomedataobject($id)
    {
        $dome = Domes::with('dome_images')->where('id', $id)->where('is_deleted', 2)->first();
        if (empty($dome)) {
            return $dome_data = 1;
        }
        $benefits = [];
        foreach (explode('|', $dome->benefits) as $benefit) {
            $benefits[] = [
                'benefit' => $benefit,
                'benefit_image' => '',
            ];
        }
        $review = Review::where('dome_id', $dome->id)->selectRaw('SUM(ratting)/COUNT(user_id) AS avg_rating')->first()->avg_rating;
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
                'total_fields' => Field::where('dome_id', $id)->whereIn('sport_id', explode(',', $dome->sports_id))->where('is_available', 1)->where('is_deleted', 2)->count(),
                'name' => $dome->name,
                'price' => Helper::get_dome_price($dome->id, explode(',', $dome->sport_id)[0]),
                'hst' => $dome->hst,
                'address' => $dome->address,
                'city' => $dome->city,
                'state' => $dome->state,
                'start_time' => $dome->day_working_hours('')->start_time,
                'end_time' => $dome->day_working_hours('')->end_time,
                'description' => $dome->description,
                'lat' => $dome->lat,
                'lng' => $dome->lng,
                'benefits_description' => $dome->benefits_description,
                'ratting_data' => $ratting_data,
                'benefits' => $benefits,
                'sports_list' => Helper::get_sports_list($dome->sport_id),
                'dome_images' => $dome->dome_images,
            );
        }
        return $dome_data;
    }
}
