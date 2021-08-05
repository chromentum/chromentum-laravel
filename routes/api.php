<?php

use App\Http\Controllers\Api\BackgroundImageController;
use App\Http\Controllers\Api\QuoteController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\PassportController;
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

Route::get('background-image', BackgroundImageController::class);
Route::get('quote', QuoteController::class);

Route::middleware('auth:api')->group(function () {
    Route::get('user', [PassportController::class, 'user']);
    Route::get('logout', [PassportController::class, 'logout']);


    Route::resource('/tasks', TaskController::class);
});
