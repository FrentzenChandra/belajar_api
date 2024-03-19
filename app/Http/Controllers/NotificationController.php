<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    function index(){
        $users = User::where('firebase_token', '!=', null)->get();
        return view('notification', compact('users'));
    }

    function sendOne(Request $req){
        $title = $req->title;
        $body = $req->body;
        $to = $req->firebase_token;
        $this->send($title,$body,$to);
        return redirect('/');
    }

    function send($title,$body,$destination){
       
        define('API_ACCESS_KEY','AAAAv327Y0Q:APA91bH6BQWa_bLqJHu9mxeAmD2Kgb8RKr2OO1il_t409tBiCZDixan5QyJ9P82CLJPZ63xOAzOw3XsAWyPkYauLGIQd6S9vi2oLiRRZHHedUAPfUGvn8GdB5gCKC3hVOX2w8sCiaN0c');
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        $token= $destination;

        $notification = [
                'title' =>$title,
                'body' => $body,
                // 'icon' =>'myIcon', // ini icon yang akan digunakan untuk notif
                // 'sound' => 'mySound' // ini ada sound yang mau digunakan jika notif muncul
            ];

            $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

            $fcmNotification = [
                //'registration_ids' => [reg id 1, reg id 2, reg id 3], //multple token array
                'to'        => $token, //single token untuk 1 orang
                'notification' => $notification,
                'data' => $extraNotificationData
            ];

            $headers = [
                'Authorization: key=' . API_ACCESS_KEY,
                'Content-Type: application/json'
            ];


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);



         
    }
}
