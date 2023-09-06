<?php

use App\Models\Branch;
use App\Models\Images;
use Illuminate\Http\Request;
use App\Models\userGroupPermission;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AccessController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\UserGroupController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Api\Auth\UserController as AuthUserController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CompanyController;
use App\Models\Company;

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
    Route::delete('delete/{id}','destroy');
});

Route::controller(BranchController::class)->prefix('branch')->group(function(){
    Route::post('save','store');
    Route::get('/','index');
    Route::get('/{id}','show');
    Route::put('update/{id}','update');
    Route::delete('delete/{id}','destroy');
});

Route::controller(CompanyController::class)->prefix('company')->group(function(){
    Route::post('save','store');
    Route::get('/','index');
    Route::get('/{id}','show');
    Route::put('update/{id}','update');
    Route::delete('delete/{id}','destroy');
});

Route::controller(PermissionsController::class)->prefix('permission')->group(function(){
    Route::post('save','store');
    Route::post('show/{id}','store');
    Route::get('/','index');
    Route::put('update/{id}','update');
    Route::put('delete/{id}','destroy');
});
Route::controller(ImagesController::class)->prefix('image')->group(function(){
    Route::post('/upload','store_1');
    Route::post('/uploadMany','storeMany');
    Route::delete('/delete','deleteMany');
    Route::delete('/deleteMany','delete_1');
});

Route::controller(userGroupPermission::class)->middleware(['auth:sanctum'])->prefix('user-group-permission')->group(function(){
    Route::post('save','store');
    Route::put('update/{id}','update');
});
Route::controller(AccessController::class)->middleware(['auth:sanctum'])->prefix('access')->group(function(){
    Route::post('save','store');
    Route::get('/{id}','show');
    Route::get('/','index');
    Route::put('update/{id}','update');
    Route::delete('delete/{id}','delete');
});

Route::fallback(function () {
    return response()->json(['erreur' => 'Ressource non trouvée.'], 404);
});

Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

});
