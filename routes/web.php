<?php

use App\Http\Controllers\PassportController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/redirect', [PassportController::class, 'redirect']);
Route::get('/callback', [PassportController::class, 'callback']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('tasks', TaskController::class)->name('tasks');
});
