<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class DestinationController extends Controller
{
    function create(Request $req) {
        $user = Auth::user()->id;
        $trip = Trip::where('user_id',$user)->get();
        
        Destination::updateOrCreate([
            'trip_id' => $trip[0]->id,
            'location' => $req->location
        ]);


    }

    function delete(Request $req){
        Destination::where('id',$req->id)->delete();
    }
}
