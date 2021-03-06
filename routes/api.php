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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::resource('customer',App\Http\Controllers\CustomerController::class)->only(['index','store','show','update','destroy']);


Route::group(['prefix' => 'customer'], function () {
    Route::get('/', 'App\Http\Controllers\CustomerController@index');
    Route::post('submit', 'App\Http\Controllers\CustomerController@submit');
    Route::delete('delete/{id}', 'App\Http\Controllers\CustomerController@delete');
});