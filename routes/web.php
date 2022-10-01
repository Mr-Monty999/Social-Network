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

Route::get('/', function () {
    return view('welcome');
});


/// Guests Routes ///
Route::group(["namespace" => "guests"], function () {
    Route::get("/login", "LoginController@index");
    Route::post("/login/attempt", "LoginController@login");

    Route::resource("register", "RegisterController");
});


/// Users Routes ///
Route::group(["middleware" => "auth"], function () {
    /// Posts Routes ///
    Route::resource("posts", "PostController");


    /// Profiles Routes ///
    Route::resource("profiles", "ProfileController");
});
