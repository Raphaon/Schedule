<?php

use App\Http\Controllers\AccessController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Api\Auth\UserController as AuthUserController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\UserGroupController;
use App\Models\Images;

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
// Authentification de l'utilisateur
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register    ');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);
//acceder a toute les routes par /api/{route ecrite}
Route::prefix('user')->group(function(){
    Route::get('/get-user/{id}',[UserController::class,'show']);
    Route::get('/get-user',[UserController::class,'index']);
    Route::any('/delete-user/{id}',[UserController::class,'delete']);
    Route::middleware(['read'])->get('/store-user',[UserController::class,'store']);
    // Route::get();
    Route::middleware(['read'])->get('/show-user',[UserController::class,'show']);
    Route::middleware(['whrite'])->put('/update-user/{id}',[UserController::class,'update ']);
});

Route::controller(UserGroupController::class)->prefix('user-group')->group(function(){
    Route::post('save','store');
    Route::get('/','index');
    Route::get('/{id}','show');
    Route::put('update/{id}','update');
    Route::delete('delete/{id}','delete');
});

Route::controller(PermissionsController::class)->prefix('permission')->group(function(){
    Route::post('save','store');
    Route::post('show/{id}','store');
    Route::get('/','index');
    Route::put('update/{id}','update');
    Route::put('delete/{id}','delete');
});
Route::controller(Images::class)->prefix('image')->group(function(){
    Route::post('/upload');
    Route::post('/uploadMany');
    Route::delete('/delete');
    Route::delete('/deleteMany');
});
Route::controller(AccessController::class)->prefix('access')->group(function(){
    Route::post('save','store');
    Route::get('/{id}','show');
    Route::get('/','index');
    Route::put('update/{id}','update');
    Route::delete('delete/{id}','delete');
});
Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });


});
