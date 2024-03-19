<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TripController extends Controller
{

    function createOrUpdate(Request $req){
        $user = Auth::user()->id;

        if(Trip::where('user_id' , '=', $user)->exists()){

            Trip::where('id',$user)->update([
                'pickup_location' => $req->pickup_location,
            ]);

            return ;
        }else {
            Trip::updateOrCreate([
                'user_id' => $user,
                'pickup_location' => $req->pickup_location,
                // 'description' => $req->description
            ]);

            return;
        }

    }

    
}
