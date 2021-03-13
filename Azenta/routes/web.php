<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', "FrontController@index")->name("home");
Route::get('/home', "FrontController@index")->name("home");
Route::get('/properties', "PropertiesController@index");
Route::get('/blog', "BlogController@blog");
Route::get('/contact', "FrontController@contact");
Route::get('/about-us', "FrontController@aboutUs");

Route::get('/property-single/{id}', "PropertiesController@showOne");
Route::get('/post-single/{id}', "BlogController@showOne");

Route::post("/login","AuthController@login")->name("login");
Route::post("/sign-up","AuthController@signUp")->name("signUp");
Route::get("/logout","AuthController@logout")->name("logout");

Route::get("/filterProperties","PropertiesController@filterProperties");

Route::post('/property-single/contact-agent', "Admin\NotificationsController@insertAgentMessage")->name("contact-agent");
Route::post('/contact/contact-admin', "Admin\NotificationsController@insertAdminMessage");


Route::get("/getPostsPaginate/{page}","BlogController@getPostPaginate");
Route::post("/insertComment","BlogController@insertComment");

Route::prefix("admin")->middleware(["isLogged","controlPanel"])->group(function(){

    Route::resource("users","Admin\UsersController");
    Route::resource("properties","Admin\PropertiesController");
    Route::resource("posts","Admin\PostsController");

    Route::get("/notifications","Admin\NotificationsController@notifications");
    Route::get("/logs","Admin\BackController@logs")->middleware(["adminMiddleware"]);
});




