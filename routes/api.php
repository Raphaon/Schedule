<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::middleware(['read'])->get('/get-user',[UserController::class,'index']);
Route::middleware(['all'])->get('/delete-user',[UserController::class,'delete']);
Route::middleware(['read'])->get('/store-user',[UserController::class,'store']);
Route::middleware(['read'])->get('/show-user',[UserController::class,'show']);
Route::middleware(['whrite'])->get('/update-user',[UserController::class,'update ']);

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
