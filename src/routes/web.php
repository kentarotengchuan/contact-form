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
Route::get("/","index")->name("index");
Route::post("/","store")->name("store");
Route::get("/confirm","confirm")->name("confirm");
Route::post("/confirm","regist")->name("regist");
Route::get("/thanks","thanks")->name("thanks");
Route::post("/thanks","redirect")->name("redirect");

Route::middleware('auth')
->controller(ContactController::class)
->group(function(){
    Route::get("/admin","admin")->name("admin");
});