<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'cors'], function() {
    Route::get('/notify', 'fitbitAPIController@notify');
    //Route::get('/heart', 'fitbitAPIController@syncup');
    //Route::get('/sleep', 'fitbitAPIController@syncupSleep');
    Route::post('/alta', 'fitbitAPIController@grabar');
    Route::resource('/fitbits', 'fitbitAPIController@grabar');
    Route::post('/sign', 'fitbitAPIController@signOcb');
 });



