<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    public function index(Request $req){
        
        return $req->user();
    }

    public function register(Request $req){
        $req->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $result = User::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => bcrypt($req->password)
        ]);

        return $result;
    }

    public function login(Request $req){

    $credentials =  
        $req->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);


    if(Auth::attempt($credentials)){
        $user = Auth::user();
        $token = md5(time()). ".". md5($req->email);

        $user->forcefill([
            'api_token'=>$token,
            'firebase_token' =>$req->firebase_token
        ])->save();

        return response()->json(['token' => $token]);
    }
        
        return response()->json(['message' => "The Provided Credentials do not match out records"],401);
        
    }

    public function logout(Request $req){
        $req->user()->forceFill([
            'api_token' =>null
        ])->save();

        return response()->json(['message' => "Logout Success"]);

    }



}
