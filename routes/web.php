<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LoginSubmitController;
use App\Http\Controllers\Auth\LogoutSubmitController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\RegisterSubmitController;
use App\Http\Controllers\Links\RedirectController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ShortLink\CreateController as CreateShorLinkController;
use App\Http\Controllers\ShortLink\DestroyController as DestroyShortLinkController;
use App\Http\Controllers\ShortLink\IndexController as PersonalLinkIndexController;
use App\Http\Controllers\ShortLink\EditController as EditShortLinkController;
use App\Http\Controllers\ShortLink\UpdateController as UpdateShortLinkController;
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

Route::prefix('personal-link')->middleware('auth')->group(function () {
    Route::get('/', PersonalLinkIndexController::class)->name('personalLink');
    Route::post('/', CreateShorLinkController::class)->name('short_link.store');
    Route::post('/destroy', DestroyShortLinkController::class)->name('short_link.destroy');
    Route::get('/{shortLink}/edit', EditShortLinkController::class)->name('short_link.edit');
    Route::post('/{shortLink}/update', UpdateShortLinkController::class)->name('short_link.update');
});

Route::prefix('links')->middleware('auth')->group(function () {
    Route::get('/{shortLink}', RedirectController::class)->name('links.redirect');
});

