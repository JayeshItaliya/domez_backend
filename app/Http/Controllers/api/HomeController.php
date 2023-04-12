<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Helper\Helper;
use App\Models\Domes;
use App\Models\Enquiries;
use App\Models\Favourite;
use App\Models\League;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function sportslist(Request $request)
    {
        if (strpos(request()->header('User-Agent'), 'Postman') !== false) {
            $d = Helper::send_notification($request->title, $request->body, $request->type, $request->booking_id, $request->league_id, $request->tokens);
            dd($d);
        }
        return response()->json(["status" => 1, "message" => "Successful", 'sportslist' => Helper::get_sports_list('')], 200);
    }
    public function helpcenter(Request $request)
    {
        try {
            if ($request->email == "") {
                return response()->json(["status" => 0, "message" => "Please Enter Email"], 200);
            }
            if ($request->subject == "") {
                return response()->json(["status" => 0, "message" => "Please Enter subject"], 200);
            }
            if ($request->message == "") {
                return response()->json(["status" => 0, "message" => "Please Enter message"], 200);
            }
            $enquiries = new Enquiries();
            $enquiries->email = $request->email;
            $enquiries->subject = $request->subject;
            $enquiries->message = $request->message;
            $enquiries->type = 1;   // 1=HelpCenter,2=GeneralEnquiry,3=DomesRequest
            $enquiries->save();
            return response()->json(["status" => 1, "message" => "Query Submitted Successfully"], 200);
        } catch (\Throwable $th) {
            return response()->json(["status" => 0, "message" => "Something Went Wrong..!!"], 200);
        }
    }
    public function dome_request(Request $request)
    {
        if ($request->venue_name == "") {
            return response()->json(["status" => 0, "message" => "Enter Venue Name"], 200);
        }
        if ($request->venue_address == "") {
            return response()->json(["status" => 0, "message" => "Enter Venue Address"], 200);
        }
        // if ($request->name == "") {
        //     return response()->json(["status" => 0, "message" => "Enter Name"], 200);
        // }
        $comment  = $request->comment ?? '';
        $send_mail = Helper::invite_dome($request->venue_name, $request->venue_address, $request->name, $request->email, $request->phone, $comment);
        if ($send_mail == 1) {
            $enquiry = new Enquiries();
            $enquiry->type = 4;
            $enquiry->venue_name = $request->venue_name;
            $enquiry->venue_address = $request->venue_address;
            $enquiry->name = $request->name;
            $enquiry->email = $request->email;
            $enquiry->phone = $request->phone;
            $enquiry->message = $comment;
            $enquiry->save();
            return response()->json(["status" => 1, "message" => "Thank You. We have received your request"], 200);
        } else {
            return response()->json(["status" => 0, "message" => "Email Error"], 200);
        }
    }
    public function filter(Request $request)
    {
        try {
            if ($request->type == "") {
                return response()->json(["status" => 0, "message" => "Select Filter Type"], 200);
            }
            if (!in_array($request->type, [1, 2])) {
                return response()->json(["status" => 0, "message" => "Invalid Request!!"], 200);
            }

            if ($request->sport_id == "" && $request->lat == "" && $request->lng == "" && $request->start_price == "" && $request->end_price == "") {
                return response()->json(["status" => 0, "message" => "Please Select Atleast One Filter"], 200);
            }

            $getfilterlist = [];
            if ($request->type == 1) {
                $getfilterlist = Domes::with('dome_image')->where('is_deleted', 2)->select('domes.*');
                // ---------- Location Filter --------- //
                if ($request->lat != "" && $request->lng != "") {
                    $getfilterlist = $getfilterlist->select(
                        'domes.*',
                        DB::raw("6371 * acos(cos(radians(" . $request->lat . "))
                        * cos(radians(lat))
                    * cos(radians(lng) - radians(" . $request->lng . "))
                    + sin(radians(" . $request->lat . "))
                    * sin(radians(lat))) AS distance")
                    );
                    // NOTE :- The Distance Will Be in Kilometers
                    $getfilterlist = $getfilterlist->having('distance', '<=', $request->kilometer > 0 ? $request->kilometer : 1000)->orderBy('distance');
                } else {
                    $getfilterlist = $getfilterlist->orderBy('id');
                }
                // ---------- Sports Filter ---------- //
                if ($request->has('sport_id') && $request->sport_id != "") {
                    $q = '';
                    foreach (explode(',', $request->sport_id) as $key => $value) {
                        $q .= 'FIND_IN_SET(' . $value . ', sport_id) ';
                        $q .= $key + 1 == count(explode(',', $request->sport_id)) ? '' : ' OR ';
                    }
                    $getfilterlist = $getfilterlist->whereRaw($q);
                }
                // ------------ Price Filter ---------- //
                if ($request->max_price > 0) {
                    $getfilterlist = $getfilterlist->whereBetween('price', [$request->min_price, $request->max_price]);
                }
                $getfilterlist = $getfilterlist->paginate(20);
            } else {
                $getfilterlist = League::with(['league_image', 'dome_info'])->whereDate('booking_deadline', '>=', date('Y-m-d'))->where('leagues.is_deleted', 2)->select('leagues.*');
                // ---------- Location Filter --------- //
                if ($request->lat != "" && $request->lng != "") {
                    $getfilterlist = $getfilterlist->join('domes', 'leagues.dome_id', 'domes.id')
                        ->select(
                            'leagues.*',
                            DB::raw("6371 * acos(cos(radians(" . $request->lat . "))
                        * cos(radians(domes.lat))
                    * cos(radians(domes.lng) - radians(" . $request->lng . "))
                    + sin(radians(" . $request->lat . "))
                    * sin(radians(domes.lat))) AS distance")
                        );
                    // NOTE :- The Distance Will Be in Kilometers
                    $getfilterlist = $getfilterlist->having('distance', '<=', $request->kilometer > 0 ? $request->kilometer : 1000)->orderBy('distance');
                } else {
                    $getfilterlist = $getfilterlist->orderBy('leagues.id');
                }
                // ---------- Sports Filter ---------- //
                if ($request->has('sport_id') && $request->sport_id != "") {
                    $q = '';
                    foreach (explode(',', $request->sport_id) as $key => $value) {
                        $q .= 'FIND_IN_SET(' . $value . ', leagues.sport_id) ';
                        $q .= $key + 1 == count(explode(',', $request->sport_id)) ? '' : ' OR ';
                    }
                    $getfilterlist = $getfilterlist->whereRaw($q);
                }
                // ------------ Price Filter ---------- //
                if ($request->max_price > 0) {
                    $getfilterlist = $getfilterlist->whereBetween('leagues.price', [$request->min_price, $request->max_price]);
                }
                $getfilterlist = $getfilterlist->paginate(20);
            }

            $responsedata = [];
            foreach ($getfilterlist as $data) {
                $checkuser = User::where('id', $request->user_id)->where('type', 3)->first();
                if ($request->type == 1) {
                    if (!empty($checkuser)) {
                        $fav = Favourite::where('user_id', $checkuser->id)->where('dome_id', $data->id)->select('dome_id')->first();
                    }
                    $image = $data->dome_image == "" ? "" : $data->dome_image->image;
                } else {
                    if (!empty($checkuser)) {
                        $fav = Favourite::where('user_id', $checkuser->id)->where('league_id', $data->id)->select('league_id')->first();
                    }
                    $image = $data->league_image == "" ? "" : $data->league_image->image;
                }
                $responsedata[] = [
                    "id" => $data->id,
                    "type" => $request->type == 1 ? 1 : 2,
                    "league_name" => $request->type == 1 ? '' : $data->name,
                    "dome_id" => $request->type == 1 ? '' : $data->dome_id,
                    "dome_name" => $request->type == 1 ? $data->name : $data->dome_info->name,
                    "price" => $request->type == 1 ? Helper::get_dome_price($data->id->id, explode(',', $data->sport_id)[0]) : $data->price,
                    "image" => $image,
                    "city" => $request->type == 1 ? $data->city : $data->dome_info->city,
                    "state" => $request->type == 1 ? $data->state : $data->dome_info->state,
                    "is_fav" => !in_array($request->user_id, [0, '']) ? (!empty(@$fav) ? true : false) : false,
                    "sport_id" => $data->sport_id,
                    "sports_list" => Helper::get_sports_list($data->sport_id),
                ];
            }
            return response()->json(['status' => 1, 'message' => 'Successfull', 'data' => $responsedata, 'pagination' => $getfilterlist->toArray()['links']], 200);
        } catch (\Throwable $th) {
            return response()->json(["status" => 0, "message" => "Something Went Wrong..!!"], 200);
        }
    }
    public function search(Request $request)
    {
        if ($request->type == "") {
            return response()->json(["status" => 0, "message" => "Select Search Type"], 200);
        }
        if (!in_array($request->type, [1, 2])) {
            return response()->json(["status" => 0, "message" => "Invalid Request!!"], 200);
        }
        $responsedata = [];
        if ($request->type == 1) {
            $getsearchlist = Domes::with('dome_image')->where('is_deleted', 2);
        } else {
            $getsearchlist = League::with('league_image', 'dome_info')->whereDate('booking_deadline', '>=', date('Y-m-d'))->where('is_deleted', 2);
        }
        if ($request->has('name') && $request->name != "") {
            $getsearchlist = $getsearchlist->where('name', 'like', '%' . $request->name . '%');
        }
        $getsearchlist = $getsearchlist->paginate(10);
        $responsedata = [];
        foreach ($getsearchlist as $data) {
            $dome_id = "";
            if ($request->type == 1) {
                $dome_id = $data->id;
                $image = $data->dome_image == "" ? "" : $data->dome_image->image;
            } else {
                $league_id = $data->id;
                $image = $data->league_image == "" ? "" : $data->league_image->image;
            }
            $responsedata[] = [
                "id" => $data->id,
                "is_fav" => !in_array($request->user_id, [0, '']) ? Helper::is_fav($request->user_id, $dome_id, $league_id) : false,
                "league_name" => $request->type == 1 ? '' : $data->name,
                "dome_name" => $request->type == 1 ? $data->name : $data->dome_info->name,
                "price" => $request->type == 1 ? Helper::get_dome_price($data->id, explode(',', $data->sport_id)[0]) : $data->price,
                "image" => $image,
                "city" => $request->type == 1 ? $data->city : $data->dome_info->city,
                "state" => $request->type == 1 ? $data->state : $data->dome_info->state,
                "sports_list" => Helper::get_sports_list($data->sport_id),
            ];
        }
        return response()->json(['status' => 1, 'message' => 'Successfull', 'data' => $responsedata, 'pagination' => $getsearchlist->toArray()['links']], 200);
    }
}
