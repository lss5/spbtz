<?php

use Illuminate\Http\Request;
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

Route::prefix('v1/admin')
    ->namespace('App\Http\Controllers\Api\V1')
    ->middleware('auth:sanctum')
    ->group(function(){
        Route::apiResource('events', Admin\EventController::class);
        Route::post('events/participant/{event}', [App\Http\Controllers\Admin\EventController::class, 'participant'])->name('events.participant');
});
Route::prefix('v1/admin')->group(function(){
    Route::post('/login', [App\Http\Controllers\Api\V1\AuthenticateController::class, 'authenticate']);
    Route::post('/registration', [App\Http\Controllers\Api\V1\AuthenticateController::class, 'registration']);
});
