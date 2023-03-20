<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\CMS;
use App\Helper\Helper;
use App\Models\Domes;
use App\Models\Enquiries;
use App\Models\Favourite;
use App\Models\League;
use App\Models\Sports;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function privacy_policy(Request $request)
    {
        $policy = CMS::where('type', 1)->first();
        return response()->json(['status' => 1, "message" => "Successful", 'policy' => @$policy->content], 200);
    }
    public function terms_conditions(Request $request)
    {
        $policy = CMS::where('type', 2)->first();
        return response()->json(['status' => 1, "message" => "Successful", 'terms_conditions' => @$policy->content], 200);
    }
    public function sportslist(Request $request)
    {
        $getsportslist = Sports::where('is_available', 1)->where('is_deleted', 2)->get();
        $sportslist = [];
        foreach ($getsportslist as $sports) {
            $sportslist[] = [
                "id" => $sports->id,
                "name" => $sports->name,
                "image" => Helper::image_path($sports->image),
            ];
        }
        return response()->json(["status" => 1, "message" => "Successful", 'sportslist' => $sportslist], 200);
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
            return response()->json(["status" => 1, "message" => "Successful"], 200);
        } catch (\Throwable $th) {
            return response()->json(["status" => 0, "message" => "Something Went Wrong..!!"], 200);
        }
    }
    public function pushnotification(Request $request)
    {
        try {
            // TYPE  =  4  ->  NEW LEAGUE IS ADDED BY DOME OWNER (only those users who've been favourited that dome)
            // TYPE  =  5  ->  DOME BOOKING IS CONFIRMED
            // TYPE  =  6  ->  LEAGUE BOOKING IS CONFIRMED

            $type = 4;
            $title = "Test Notification";
            $token = $request->token;
            // $token = "erAQsdXuT1iFMB_A0oWYWq:APA91bEhTrUry9qlpYzIVECvmaucNwMWmmh6K8PmGBeOXxg52R3buzXe9pBnRw1DdiAZ0lTe0GXIaVt8MfWzx4eq4kexrUOMCkDqnuojlcEWiF3_vnadDKSGu_lVlrqTgPkABa-ZOd7G";
            $body = "Test Message";
            $firebasekey = $request->server_key;
            // $firebasekey = "AAAAThCJSTQ:APA91bG2bwTSmHb23mBs_YRAdNC_c-YfseDAeUXfp3jXm8Oy01aeB9hu5JXDxra0YlqeQ6jqxZrAlMI2kvVg1YqSyrYInzDE4VsRLqDzswU70nDw-m3uZn8tL8TnKWeoNHK6V2hxGwFC";
            $data = array(
                "type" => $type,
                "league_id" => '',
                "booking_id" => '',
            );
            $notification = array(
                'body' => $body,
                'title' => $title,
                'sound' => 1/*Default sound*/
            );
            $fields = array(
                'to' => $token,
                'notification' => $notification,
                'data' => $data
            );
            $headers = array(
                'Authorization: key=' . $firebasekey,
                'Content-Type: application/json'
            );
            #Send Reponse To FireBase Server
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);
            curl_close($ch);
            dd($result);
            return response()->json(["status" => 1, "message" => "Successfull"], 200);
        } catch (\Throwable $th) {
            dd($th);
            return response()->json(["status" => 0, "message" => "Something Went Wrong..!!"], 200);
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
                $getfilterlist = League::with(['league_image', 'dome_info'])
                    ->where('leagues.is_deleted', 2)->select('leagues.*');
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
                    "price" => $request->type == 1 ? Helper::get_dome_price($data->id->id,explode(',', $data->sport_id)[0]) : $data->price,
                    "image" => $image,
                    "city" => $request->type == 1 ? $data->city : $data->dome_info->city,
                    "state" => $request->type == 1 ? $data->state : $data->dome_info->state,
                    "is_fav" => !in_array($request->user_id,[0,'']) ? (!empty(@$fav) ? true : false) : false,
                    "sport_id" => $data->sport_id,
                    "sports_list" => Sports::select('id', 'name', DB::raw("CONCAT('" . url('storage/app/public/admin/images/sports') . "/', image) AS image"))->whereIn('id', explode(',', $data->sport_id))->where('is_available', 1)->where('is_deleted', 2)->get(),
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
            $getsearchlist = League::with('league_image', 'dome_info')->where('is_deleted', 2);
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
                "is_fav" => !in_array($request->user_id,[0,'']) ? Helper::is_fav($request->user_id, $dome_id, $league_id) : false,
                "league_name" => $request->type == 1 ? '' : $data->name,
                "dome_name" => $request->type == 1 ? $data->name : $data->dome_info->name,
                "price" => $request->type == 1 ? Helper::get_dome_price($data->id,explode(',', $data->sport_id)[0]) : $data->price,
                "image" => $image,
                "city" => $request->type == 1 ? $data->city : $data->dome_info->city,
                "state" => $request->type == 1 ? $data->state : $data->dome_info->state,
                "sports_list" => Sports::select('id', 'name', DB::raw("CONCAT('" . url('storage/app/public/admin/images/sports') . "/', image) AS image"))->whereIn('id', explode(',', $data->sport_id))->where('is_available', 1)->where('is_deleted', 2)->get(),
            ];
        }
        return response()->json(['status' => 1, 'message' => 'Successfull', 'data' => $responsedata, 'pagination' => $getsearchlist->toArray()['links']], 200);
    }
    public function dome_request(Request $request)
    {
        if ($request->venue_name == "") {
            return response()->json(["status" => 0, "message" => "Enter Venue Name"], 200);
        }
        if ($request->venue_address == "") {
            return response()->json(["status" => 0, "message" => "Enter Venue Address"], 200);
        }
        if ($request->name == "") {
            return response()->json(["status" => 0, "message" => "Enter Name"], 200);
        }
        // if ($request->email == "") {
        //     return response()->json(["status" => 0, "message" => "Enter Email"], 200);
        // }
        // if ($request->phone == "") {
        //     return response()->json(["status" => 0, "message" => "Enter Phone"], 200);
        // }
        $comment  = $request->comment != '' ? $request->comment : '';
        $send_mail = Helper::invite_dome($request->venue_name, $request->venue_address, $request->name, $request->email, $request->phone, $comment);
        if ($send_mail == 1) {
            $enquiry = new Enquiries;
            $enquiry->type = 4;
            $enquiry->venue_name = $request->venue_name;
            $enquiry->venue_address = $request->venue_address;
            $enquiry->name = $request->name;
            $enquiry->email = $request->email;
            $enquiry->phone = $request->phone;
            $enquiry->message = $comment;
            $enquiry->save();
            return response()->json(["status" => 1, "message" => "Request Submit Successfully"], 200);
        } else {
            return response()->json(["status" => 0, "message" => "Email Error"], 200);
        }
    }
}
