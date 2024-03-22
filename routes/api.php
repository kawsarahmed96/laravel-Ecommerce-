<?php

use App\Http\Controllers\api\AuthApiController;
use App\Http\Controllers\api\ProductApiController;
use App\Http\Controllers\api\UserApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */

Route::post("login", [AuthApiController::class, "login"]);
Route::post('user-signup', [AuthApiController::class, 'signup']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post("user-logout/{id}", [AuthApiController::class, "logout"]);

    Route::get("user-view/{id}", [UserApiController::class, "show"]);
    Route::get("user-list", [UserApiController::class, "userList"]);
    Route::post("user-update/{id}", [UserApiController::class, "update"]);
    Route::post("user-delete", [UserApiController::class, "delete"]);

});

Route::get("product-list", [ProductApiController::class, "productList"]);
