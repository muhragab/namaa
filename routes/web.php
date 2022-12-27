<?php

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
Route::middleware(['checkSubscribers', 'checkPc'])->group(function () {

    Route::get('/', [App\Http\Controllers\HomeController::class, 'welcome'])->name('welcome');
    Route::get('/blog/{id}', [App\Http\Controllers\HomeController::class, 'details']);
});

Route::middleware(['checkPc'])->group(function () {
    Auth::routes([
        'register' => false, // Registration Routes...
        'reset' => false, // Password Reset Routes...
        'verify' => false, // Email Verification Routes...
    ]);
    Route::middleware(['checkAdmin'])->group(function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::resource('subscribers', App\Http\Controllers\SubscriberController::class);
        Route::resource('blogs', App\Http\Controllers\BlogController::class);
    });
});

