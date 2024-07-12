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
Route::post("/confirm",[ContactController::class,"store"])->name("store");
Route::post("/thanks",[ContactController::class,"regist"])->name("regist");

Route::middleware('auth')
->group(function(){
    Route::get("/admin",[ContactController::class,"admin"])->name("admin");
    Route::get("/admin/reset",[ContactController::class,"reset"])->name("reset");
    Route::get("/admin/search",[ContactController::class,"search"])->name("search");
    Route::delete("/admin/delete/{id}",[ContactController::class,"destroy"])->name("destroy");
    Route::post("/admin",[ContactController::class,"export"])->name("export");
});