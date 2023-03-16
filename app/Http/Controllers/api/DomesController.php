<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Sports;
use App\Models\Domes;
use App\Models\Favourite;
use App\Models\Field;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
                    $recentbookings = Booking::where('user_id', $request->user_id)->where('type', 1)->get();
                    foreach ($recentbookings as $booking) {
                        $dome = Domes::where('id', $booking->dome_id)->where('is_deleted', 2)->first();
                        if (!empty($dome)) {
                            if ($request->user_id != "") {
                                $is_fav = Favourite::where('dome_id', $dome->id)->where('user_id', $request->user_id)->first();
                            }
                            $domes_list[] = [
                                "id" => $dome->id,
                                "name" => $dome->name,
                                "image" => $dome->dome_image == "" ? "" : $dome->dome_image->image,
                                "price" => rand(11, 99),
                                "hst" => $dome->hst,
                                "city" => $dome->city,
                                "state" => $dome->state,
                                "is_fav" => !empty(@$is_fav) ? true : false,
                                "booking_id" => $request->type == 1 ? $booking->id : '',
                                "booking_date" => date('D', strtotime($booking->booking_date)) . ', ' . date('d M', strtotime($booking->booking_date)),
                                "total_fields" => Field::where('dome_id', $dome->id)->where('is_deleted', 2)->count(),
                                "sports_list" => Sports::select('id', 'name', DB::raw("CONCAT('" . url('storage/app/public/admin/images/sports') . "/', image) AS image"))->whereIn('id', explode('|', $dome->sport_id))->where('is_available', 1)->where('is_deleted', 2)->get(),
                            ];
                        }
                    }
                }
                //Type = 2 (Most Popular Dome Data)
                if ($request->type == 2) {
                    $popular_domes = Booking::select('dome_id', DB::raw('count(bookings.dome_id)as dome'))->where('type', 1)->groupBy('dome_id')->orderBy('dome', 'desc')->get();
                    foreach ($popular_domes as $pdome) {
                        $dome = Domes::where('id', $pdome->dome_id)->where('is_deleted', 2)->first();
                        if (!empty($dome)) {
                            if (!in_array($request->user_id, [0, ''])) {
                                $is_fav = Favourite::where('dome_id', $dome->id)->where('user_id', $request->user_id)->first();
                            }
                            $domes_list[] = [
                                "id" => $dome->id,
                                "name" => $dome->name,
                                "image" => $dome->dome_image == "" ? "" : $dome->dome_image->image,
                                "price" => rand(11, 99),
                                "hst" => $dome->hst,
                                "city" => $dome->city,
                                "state" => $dome->state,
                                "is_fav" => !empty(@$is_fav) ? true : false,
                                "booking_date" => "",
                                "total_fields" => Field::where('dome_id', $dome->id)->where('is_deleted', 2)->count(),
                                "sports_list" => Sports::select('id', 'name', DB::raw("CONCAT('" . url('storage/app/public/admin/images/sports') . "/', image) AS image"))->whereIn('id', explode('|', $dome->sport_id))->where('is_available', 1)->where('is_deleted', 2)->get(),
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
                        if (!in_array($request->user_id, [0, ''])) {
                            $is_fav = Favourite::where('dome_id', $dome->id)->where('user_id', $request->user_id)->first();
                        }
                        $domes_list[] = [
                            "id" => $dome->id,
                            "name" => $dome->name,
                            "image" => $dome->dome_image == "" ? "" : $dome->dome_image->image,
                            "price" => rand(11, 99),
                            "hst" => $dome->hst,
                            "city" => $dome->city,
                            "state" => $dome->state,
                            "is_fav" => !empty(@$is_fav) ? true : false,
                            "booking_date" => "",
                            "total_fields" => Field::where('dome_id', $dome->id)->where('is_deleted', 2)->count(),
                            "sports_list" => Sports::select('id', 'name', DB::raw("CONCAT('" . url('storage/app/public/admin/images/sports') . "/', image) AS image"))->whereIn('id', explode('|', $dome->sport_id))->where('is_available', 1)->where('is_deleted', 2)->get(),
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
        $categories = explode('|', $dome->sport_id);

        $categoriess = Sports::select('id', 'name', DB::raw("CONCAT('" . url('storage/app/public/admin/images/sports') . "/', image) AS image"))->whereIn('id', explode('|', $dome->sport_id))->where('is_available', 1)->where('is_deleted', 2)->get();
        foreach ($categoriess as $cat) {
            $fields = Field::where('dome_id', $id)->whereIn('sport_id', $categories)->where('is_available', 1)->where('is_deleted', 2)->get();
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
                'sport_id' => $cat->id,
                'sport_name' => $cat->name,
                'sport_image' => $cat->image,
                // 'field_data' => $field_data,
            ];
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
                'total_fields' => $fields->count(),
                'name' => $dome->name,
                'price' => rand(11, 99),
                'hst' => $dome->hst,
                'address' => $dome->address,
                'city' => $dome->city,
                'state' => $dome->state,
                'start_time' => $dome->start_time,
                'end_time' => $dome->end_time,
                'description' => $dome->description,
                'lat' => $dome->lat,
                'lng' => $dome->lng,
                'benefits_description' => $dome->benefits_description,
                'ratting_data' => $ratting_data,
                'benefits' => $benefits,
                'sports_list' => $sports_list,
                'dome_images' => $dome->dome_images,
            );
        }
        return $dome_data;
    }
}
