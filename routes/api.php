<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');

Route::middleware(['auth:api'])->group(function(){
    Route::get('user', 'UserController@index');


    Route::post('logout', 'UserController@logout');


    Route::post('trips','TripController@createOrUpdate');


    // Destination Route
    Route::post('destination','Destination@create');
    Route::post('destination/delete','Destination@delete');
    

});



Route::get('notification', 'NotificationController@index');
Route::post('notification/send', 'NotificationController@sendOne');
