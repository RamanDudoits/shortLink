<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LoginSubmitController;
use App\Http\Controllers\Auth\LogoutSubmitController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\RegisterSubmitController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ShortLink\PersonalLinkController;
use Illuminate\Support\Facades\Route;

Route::get('/', MainController::class);

Route::prefix('login')->middleware('guest')->group(function () {
    Route::get('/', LoginController::class)->name('login');
    Route::post('/', LoginSubmitController::class)->name('loginSubmit');
});

Route::prefix('register')->middleware('guest')->group(function () {
    Route::get('/', RegisterController::class)->name('register');
    Route::post('/', RegisterSubmitController::class)->name('registerSubmit');
});

Route::get('/logout', LogoutSubmitController::class)->name('logout');

Route::get('/links/{shortLink}', [PersonalLinkController::class, 'redirect'])->name('short_link');

Route::get('/personal-link', [PersonalLinkController::class, 'index'])->middleware('auth')->name('personalLink');
Route::post('/personal-link', [PersonalLinkController::class, 'setShortLink'])->name('setShortLink.store');
Route::post('/destroy', [PersonalLinkController::class, 'destroy'])->name('short_link.destroy');
