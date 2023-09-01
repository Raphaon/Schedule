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
//acceder a toute les routes par /api/{route ecrite}
Route::prefix('user')->group(function(){
    Route::middleware(['read'])->get('/get-user/{id}',[UserControlller::class,'show']);
    Route::middleware(['all'])->get('/delete-user',[UserController::class,'delete']);
    Route::middleware(['read'])->get('/store-user',[UserController::class,'store']);
    Route::middleware(['read'])->get('/show-user',[UserController::class,'show']);
    Route::middleware(['whrite'])->get('/update-user',[UserController::class,'update ']);
});
Route::prefix('userGroup')->group(function(){

});
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
