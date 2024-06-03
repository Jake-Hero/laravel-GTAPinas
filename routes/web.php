<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Mail\VerifyEmail;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Disable Routes 
Auth::routes([
    'register' => false, 
    'verify' => false,
]);

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Mailer (Verification)
Route::get('mail/verify/{id}/{hash}', [App\Http\Controllers\MailerController::class, 'verify'])->name('mail.verify');
Route::get('mail/resend', [App\Http\Controllers\MailerController::class, 'resend'])->name('mail.resend');

// About.php
Route::get('/about', function() {
    return view('about');
})->name('about');

// Skins.php
Route::get('/skins', function() {
    return view('skins');
})->name('skins');

// Download.php
Route::get('/download', function() {
    return view('download');
})->name('download');

// highscores
Route::get('/highscores/playingtime', [App\Http\Controllers\HighscoresController::class, 'playingtime'])->name('highscores.playingtime');
Route::get('/highscores/wealthiest', [App\Http\Controllers\HighscoresController::class, 'wealthiest'])->name('highscores.wealthiest');
Route::get('/highscores/skins', [App\Http\Controllers\HighscoresController::class, 'skins'])->name('highscores.skins');
Route::get('/highscores/vehiclemodels', [App\Http\Controllers\HighscoresController::class, 'vehiclemodels'])->name('highscores.vehiclemodels');

Route::get('password/forgot', [App\Http\Controllers\ForgotPasswordController::class, 'showLinkRequestForm'])->name('passwords.request');
Route::post('password/email', [App\Http\Controllers\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('passwords.email');
Route::get('password/reset/{token}', [App\Http\Controllers\ResetPasswordController::class, 'showResetForm'])->name('passwords.reset');
Route::post('password/reset', [App\Http\Controllers\ResetPasswordController::class, 'reset'])->name('passwords.update');

// user/login.php 
Route::get('/user/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('user.login');
Route::post('/user/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

// Registered Users Only
Route::middleware(['auth'])->group(function () {
    // user/dashboard.php
    Route::get('/user/', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
    
    // user/logged_history.php
    Route::get('/user/logged_history', [App\Http\Controllers\UserController::class, 'logged_history'])->name('user.logged_history');

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
    // ajax/ajax_fetch_characters.php (on Vanilla PHP)
    Route::get('/ajax/fetch_characters', [App\Http\Controllers\AdminController::class, 'fetchCharacters'])->name('ajax.fetch_characters');

    // Admin Panel
    Route::middleware([AdminMiddleware::class])->group(function () {
        // admin/dashboard.php (on Vanilla PHP)
        Route::get('/admin/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
        // admin/groups.php (on Vanilla PHP)
        Route::get('/admin/groups', [App\Http\Controllers\AdminController::class, 'groups'])->name('admin.groups');
        // admin/turfs.php (on Vanilla PHP)
        Route::get('/admin/turfs', [App\Http\Controllers\AdminController::class, 'turfs'])->name('admin.turfs');

        // admin/characters.php (on Vanilla PHP)
        Route::get('/admin/characters', [App\Http\Controllers\AdminController::class, 'characters'])->name('admin.characters');
        // user/character.php?id={$id}
        Route::get('/admin/character/{id}', [App\Http\Controllers\AdminController::class, 'character'])->name('admin.character');
        // user/house.php?id={$id}
        Route::get('/admin/house/{id}', [App\Http\Controllers\AdminController::class, 'house'])->name('admin.house');
        // user/business.php?id={$id}
        Route::get('/admin/business/{id}', [App\Http\Controllers\AdminController::class, 'business'])->name('admin.business');
        // user/vehicle.php?id={$id}
        Route::get('/admin/vehicle/{id}', [App\Http\Controllers\AdminController::class, 'vehicle'])->name('admin.vehicle');
        // ajax/ajax_house_inventory.php (on Vanilla PHP)
        Route::post('/ajax/admin/house_inventory', [App\Http\Controllers\UserController::class, 'house_inventory'])->name('ajax.admin.house_inventory');
        // ajax/ajax_business_inventory.php (on Vanilla PHP)
        Route::post('/ajax/admin/business_inventory', [App\Http\Controllers\UserController::class, 'business_inventory'])->name('ajax.admin.business_inventory');
        // ajax/ajax_vehicle_inventory.php (on Vanilla PHP)
        Route::post('/ajax/admin/vehicle_inventory', [App\Http\Controllers\UserController::class, 'vehicle_inventory'])->name('ajax.admin.vehicle_inventory');
    });
});
