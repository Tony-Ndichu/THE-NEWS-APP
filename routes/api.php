<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReadingController;

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

Route::get('readings', [ReadingController::class, 'index']);
Route::group(['prefix' => 'reading'], function () {
    Route::post('add', [ReadingController::class, 'add']);
    Route::post('update', [ReadingController::class, 'update']);
});
