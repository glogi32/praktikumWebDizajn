<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ApiController;
use App\Http\Controllers\ReservationController;

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

Route::get("/getAllUsers",[ApiController::class,"getAllUsers"]);
Route::get("/getAllRooms",[ApiController::class,"getAllRooms"]);
Route::get("/getAllServices",[ApiController::class,"getAllServices"]);
Route::get("/getAllReservations",[ReservationController::class,"getAllReservations"]);
Route::get("/getAllPosts",[ApiController::class,"getAllPosts"]);
Route::patch("/featuredRooms/{id}",[ApiController::class,"featuredRooms"]);
Route::patch("/featuredService/{id}",[ApiController::class,"featuredService"]);
Route::patch("/featuredPosts/{id}",[ApiController::class,"featuredPosts"]);
