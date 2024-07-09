<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
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
Route::get("/",[ContactController::class,"index"])->name("index");
Route::post("/",[ContactController::class,"store"])->name("store");
Route::post("/confirm",[ContactController::class,"regist"])->name("regist");
Route::post("/thanks",[ContactController::class,"redirect"])->name("redirect");

Route::middleware('auth')
->group(function(){
    Route::get("/admin",[ContactController::class,"admin"])->name("admin");
    Route::post("/admin",[ContactController::class,"search"])->name("search");
});