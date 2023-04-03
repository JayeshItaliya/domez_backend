<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Domes;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function review(Request $request)
    {
        if (in_array($request->user_id, [0, ''])) {
            return response()->json(["status" => 0, "message" => 'Enter Login User ID'], 200);
        }
        if ($request->dome_id == "") {
            return response()->json(["status" => 0, "message" => 'Enter Dome ID'], 200);
        }
        if ($request->ratting == "") {
            return response()->json(["status" => 0, "message" => 'Enter Dome Ratting'], 200);
        }
        if (in_array($request->ratting, [1, 2, 3, 4, 5])) {
            $checkreview = Review::where('dome_id', $request->dome_id)->where('user_id', $request->user_id)->first();
            if (empty($checkreview)) {
                $checkreview = new Review();
                $checkreview->dome_id = $request->dome_id;
                $checkreview->user_id = $request->user_id;
                $checkreview->ratting = $request->ratting;
                $checkreview->comment = $request->comment == "" ? "" : $request->comment;
                $checkreview->save();
                return response()->json(["status" => 1, "message" => "Successful", 'review' => $checkreview], 200);
            }
            return response()->json(["status" => 0, "message" => 'Review Already Exist'], 200);
        } else {
            return response()->json(["status" => 0, "message" => 'Invalid Dome Ratting'], 200);
        }
    }
    public function avg_rating(Request $request)
    {
        if ($request->id == "") {
            return response()->json(["status" => 0, "message" => 'Enter Dome ID'], 200);
        }
        if (!empty(Domes::where('id', $request->id)->where('is_deleted', 2)->first())) {
            $review = Review::where('dome_id', $request->id)->selectRaw('SUM(ratting)/COUNT(user_id) AS avg_rating')->first()->avg_rating;
            return response()->json(["status" => 1, "message" => "Successful", 'review' => $review], 200);
        } else {
            return response()->json(["status" => 0, "message" => 'Dome Not Found'], 200);
        }
    }

    public function rattinglist(Request $request)
    {
        if ($request->dome_id == "") {
            return response()->json(["status" => 0, "message" => 'Enter Dome ID'], 200);
        }
        if (!empty(Domes::where('id', $request->dome_id)->where('is_deleted', 2)->first())) {
            $rattinglist = Review::join('users AS users_table', function ($query) {
                $query->on('reviews.user_id', '=', 'users_table.id')->where('users_table.type', 3);
            })
                ->join('domes AS dome_table', function ($query) {
                    $query->on('reviews.dome_id', '=', 'dome_table.id');
                })
                ->leftJoin('users AS dome_owner', function ($query) {
                    $query->on('dome_table.vendor_id', '=', 'dome_owner.id');
                })
                ->where('reviews.dome_id', $request->dome_id)
                ->select(
                    'reviews.user_id',
                    'users_table.name as user_name',
                    'reviews.ratting',
                    'reviews.created_at',
                    'dome_table.name as dome_name',
                    'dome_owner.name as dome_owner_name',
                    DB::raw('(CASE WHEN reviews.comment IS NULL THEN "" ELSE reviews.comment END) AS comment'),
                    DB::raw('(CASE WHEN reviews.reply_message IS NULL THEN "" ELSE reviews.reply_message END) AS reply_message'),
                    DB::raw('(CASE WHEN reviews.replied_at IS NULL THEN "" ELSE DATE_FORMAT(reviews.replied_at, "%d %M %Y") END) AS replied_at'),
                    DB::raw("CONCAT('" . url('storage/app/public/admin/images/profiles') . "/', users_table.image) AS user_image")
                )->orderByDesc('reviews.id')->paginate(5);

            return response()->json(["status" => 1, "message" => "Successful", 'rattinglist' => $rattinglist], 200);
        } else {
            return response()->json(["status" => 0, "message" => 'Dome Not Found'], 200);
        }
    }
}

        // DB::raw('DATE_FORMAT(reviews.created_at, "%d %M %Y") as ratting_created_at'),
