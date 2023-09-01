<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is whe
re you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::prefix('user')->group(function(){
    Route::get('/get-user/{id}',[UserController::class,'show']);
    Route::middleware(['all'])->get('/delete-user',[UserController::class,'delete']);
    Route::middleware(['read'])->get('/store-user',[UserController::class,'store']);
    Route::middleware(['read'])->get('/show-user',[UserController::class,'show']);
    Route::middleware(['whrite'])->get('/update-user',[UserController::class,'update ']);
});



require __DIR__.'/auth.php';
