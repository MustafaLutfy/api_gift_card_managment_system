<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

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

Route::post('register',[UserAuthController::class,'register']);
Route::post('login',[UserAuthController::class,'login']);
Route::post('/use/card', [CardController::class, 'useCard'])->name('use.card');
Route::post('logout',[UserAuthController::class,'logout'])->middleware('auth:sanctum');


Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::get('/myprofile', [UserController::class, 'myProfile'])->name('my.profile');
});

Route::group(['middleware' => ['auth:sanctum','admin']], function() {
    Route::get('/cards/{filter}', [AdminController::class, 'getAllCards'])->name('get.all.cards');
    Route::post('/create/card', [CardController::class, 'store'])->name('create.card');
    Route::get('/view/card/{id}', [AdminController::class, 'viewCard'])->name('view.card');
    Route::get('/view/userinfo/{id}', [AdminController::class, 'viewUserInfo'])->name('view.info');
});

