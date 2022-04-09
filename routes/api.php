<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controller\Orders_Client_ManipulationsController;
use App\Http\Controller\Auth_ApiController;

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

Route::resource('manipulation','Orders_Client_ManipulationsController');

Route::post('login','Api_controllers\Auth_ApiController@login');
Route::post('register','Api_controllers\Auth_ApiController@register');
