<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about', function() {
    return view('about');
})->name('about');

// user/login.php 
Route::get('/user/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('user.login');
Route::post('/user/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    // user/dashboard.php
    Route::get('/user/dashboard', [App\Http\Controllers\UserController::class, 'index'])->name('user.dashboard');
    // user/settings.php
    Route::get('/user/settings', [App\Http\Controllers\UserController::class, 'settings'])->name('user.settings');
    // post method for: user/settings.php
    Route::post('/user/settings/change', [App\Http\Controllers\UserController::class, 'changeSettings'])->name('user.settings.change');

    // user/create_character.php?slot={$slot}
    Route::get('/user/create_character/{slot}', [App\Http\Controllers\UserController::class, 'create_character'])->where('slot', '[1-3]')->name('user.create_character');

    // user/character.php?id={$id}
    Route::get('/user/character/{id}', [App\Http\Controllers\UserController::class, 'character'])->name('user.character');
    // user/house.php?id={$id}
    Route::get('/user/house/{id}', [App\Http\Controllers\UserController::class, 'house'])->name('user.house');
    // user/business.php?id={$id}
    Route::get('/user/business/{id}', [App\Http\Controllers\UserController::class, 'business'])->name('user.business');
    // user/vehicle.php?id={$id}
    Route::get('/user/vehicle/{id}', [App\Http\Controllers\UserController::class, 'vehicle'])->name('user.vehicle');

    // ajax/ajax_house_inventory.php (on Vanilla PHP)
    Route::post('/ajax/house_inventory', [App\Http\Controllers\UserController::class, 'house_inventory'])->name('ajax.house_inventory');
    // ajax/ajax_business_inventory.php (on Vanilla PHP)
    Route::post('/ajax/business_inventory', [App\Http\Controllers\UserController::class, 'business_inventory'])->name('ajax.business_inventory');
    // ajax/ajax_vehicle_inventory.php (on Vanilla PHP)
    Route::post('/ajax/vehicle_inventory', [App\Http\Controllers\UserController::class, 'vehicle_inventory'])->name('ajax.vehicle_inventory');
    // ajax/ajax_create_character.php (on Vanilla PHP)
    Route::post('/ajax/create_character', [App\Http\Controllers\UserController::class, 'insertCharacter'])->name('ajax.create_character');
});

// highscores
Route::get('/highscores/playingtime', [App\Http\Controllers\HighscoresController::class, 'playingtime'])->name('highscores.playingtime');
Route::get('/highscores/wealthiest', [App\Http\Controllers\HighscoresController::class, 'wealthiest'])->name('highscores.wealthiest');
Route::get('/highscores/skins', [App\Http\Controllers\HighscoresController::class, 'skins'])->name('highscores.skins');
Route::get('/highscores/vehiclemodels', [App\Http\Controllers\HighscoresController::class, 'vehiclemodels'])->name('highscores.vehiclemodels');