<?php

use Illuminate\Support\Facades\Route;

//+
use App\Http\Controllers\UserController;

Route::get('/welcome', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//middleware(['auth'])
Route::middleware(['auth'])->group(function () {

    //likes or unlikes
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    //likes or unlikes
    Route::post('/users/{user}', [UserController::class, 'store'])->name('users.store');
    //matches
    Route::get('/users/matches', [UserController::class, 'matches'])->name('users.matches');
    // users.show
    Route::get('/users/matches/{num}', [UserController::class, 'matches_show'])->name('users.matches_show');

    Route::middleware(['auth'])->group(function () {
        //+
           //users.room
           Route::get('/users/room/{user}', [UserController::class, 'room'])->name('users.room');
       });
    
});