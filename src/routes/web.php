<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function(){
    Route::get('/', [\App\Http\Controllers\Admin\IndexController::class, 'index'])->name('index');
    Route::resource('events', \App\Http\Controllers\Admin\EventController::class);
});

Route::get('/login', [\App\Http\Controllers\AuthenticateController::class, 'login'])->name('login');
Route::post('/login', [\App\Http\Controllers\AuthenticateController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [\App\Http\Controllers\AuthenticateController::class, 'logout'])->name('logout');
Route::get('/registration', [\App\Http\Controllers\AuthenticateController::class, 'showRegistrationForm'])->name('showRegistrationForm');
Route::post('/registration', [\App\Http\Controllers\AuthenticateController::class, 'registration'])->name('registration');