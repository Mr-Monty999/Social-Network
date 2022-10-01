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
Route::resource("login", "LoginController");
Route::post("/login/attempt", "LoginController@login");

Route::resource("register", "RegisterController");



/// Users Routes ///
Route::group(["middleware" => "auth"], function () {
    /// Posts Routes ///
    Route::resource("posts", "PostController");


    /// Profiles Routes ///
    Route::resource("profiles", "ProfileController");
});
