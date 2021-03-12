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

Route::get('/home', function () {
    return view('pages/home');
});

Route::get('/post-single', function () {
    return view('pages/post-single');
});

Route::get('/', function () {
    return view('pages/home');
});

Route::get('/properties', function () {
    return view('pages/properties');
});

Route::get('/blog', function () {
    return view('pages/blog');
});

Route::get('/contact', function () {
    return view('pages/contact');
});

Route::get('/about-us', function () {
    return view('pages/contact');
});
