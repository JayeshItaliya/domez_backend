<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\CMS;
use App\Helper\Helper;
use App\Models\Enquiries;
use App\Models\Sports;
use App\Models\User;
use Illuminate\Http\Request;

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
    function helpcenter(Request $request)
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
    function pushnotification(Request $request)
    {
        try {
            // $FcmToken = User::whereNotNull('fcm_token')->pluck('fcm_token')->all();
            // $data = [
            //     "registration_ids" => $FcmToken,
            //     "notification" => [
            //         "title" => $request->title,
            //         "body" => $request->body,
            //     ]
            // ];
            // $encodedData = json_encode($data);
            // $headers = [
            //     'Authorization:key=' . 'API KEY',
            //     'Content-Type: application/json',
            // ];
            // $ch = curl_init();
            // curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            // curl_setopt($ch, CURLOPT_POST, true);
            // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            // curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            // // Disabling SSL Certificate support temporarly
            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            // curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
            // // Execute post
            // $result = curl_exec($ch);
            // if ($result === FALSE) {
            //     die('Curl failed: ' . curl_error($ch));
            // }
            // // Close connection
            // curl_close($ch);



            $type = $order_id = '';
            $title = "Test Notification";
            $body = "Test Message";
            $token = "5618EDAC-F96A-49CC-8C4D-DCD9BCA977ED";
            $newdata = array(
                "type" => $type,
                "order_id" => $order_id,
            );
            $msg = array(
                'body' =>$body,
                'title'=>$title,
                'sound'=>1/*Default sound*/
            );
            $fields = array(
                'to'           =>$token,
                'notification' =>$msg,
                'data'=> $newdata
            );
            $headers = array(
                'Authorization: key=AIzaSyCHYsAIsuw4yGYd7EXwFro9coWguKdWu_A',
                'Content-Type: application/json'
            );
            #Send Reponse To FireBase Server
            $ch = curl_init();
            curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
            curl_setopt( $ch,CURLOPT_POST, true );
            curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
            curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
            curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
            $result = curl_exec ( $ch );
            curl_close ( $ch );

            dd(11, $result);
        } catch (\Throwable $th) {
            dd(1111111, $th);
            return response()->json(["status" => 0, "message" => "Something Went Wrong..!!"], 200);
        }
    }
}
