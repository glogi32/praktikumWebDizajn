<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\RoomDetailsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PostController as SinglePostController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PostController as SingePostController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\LogsController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\RoomsController as AdminRoomsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::pattern('id', '[0-9]+');

Route::get('/', [HomeController::class,"index"]);
Route::get('/home', [HomeController::class,"index"])->name("home");
Route::get('/rooms', [RoomsController::class,"index"])->name("rooms");
Route::get('/about-us', [FrontController::class,"aboutUs"])->name("aboutUs");
Route::get('/blog', [BlogController::class,"index"])->name("blog");
Route::get('/contact', [ContactController::class,"index"])->name("contact");
Route::get("/post/{id}",[SinglePostController::class,"index"])->name("post");
Route::get('/reservations', [ReservationController::class,"index"])->name("reservations")->middleware("isLogged");

Route::get("/filterRooms",[RoomsController::class,"filterRooms"]);

Route::get('/room-details/{id}', [RoomDetailsController::class,"roomDetails"]);
Route::post("/room-details/make-reservation",[RoomDetailsController::class,"makeReservation"]);
Route::post("/room-details/insert-rating",[RoomDetailsController::class,"insertRating"]);
Route::post("/room-details/insert-comment",[RoomDetailsController::class,"insertCommnet"]);
Route::delete("/room-details/deleteComment/{id}",[RoomDetailsController::class,"deleteComment"]);

Route::post("/login",[AuthController::class, "login"])->name("login");
Route::post("/sign-up",[AuthController::class, "signUp"])->name("signUp");
Route::get("/logout",[AuthController::class,"logout"])->name("logout");

Route::delete("/reservations/{id}",[ReservationController::class,"cancelReservation"]);

Route::get("/blog/load-posts",[BlogController::class,"getPostsPaginate"]);

Route::post("/post/insert-comment",[SingePostController::class,"insertComment"]);
Route::delete("/post/delete-comment/{id}",[SinglePostController::class,"deleteComment"]);

Route::post("/insertComment",[MessageController::class,"insertMessage"]);

Route::prefix("admin")->middleware(["isLogged","admin"])->group(function(){

    Route::resource("users",UsersController::class);
    Route::resource("rooms",AdminRoomsController::class);
    Route::resource("services",ServicesController::class);
    Route::resource("posts",PostController::class);
    Route::get("/logs",[LogsController::class,"index"])->name("logs");
    Route::get("/messages",[MessageController::class,"index"])->name("messages");
});
