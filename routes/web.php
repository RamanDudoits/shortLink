<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PersonalLinkController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/personallink', [PersonalLinkController::class, 'index'])->middleware('auth')->name('personallink');

Route::post('/personallink', [PersonalLinkController::class, 'setShortLink']);

Route::get('/', function() {
    if (Auth::check()) {
        return redirect(route('personallink'));
    } else {
        return redirect(route('login'));
    }
});

Route::get('/login', function () {
    if (Auth::check()) {
        return redirect(route('personallink'));
    }
    return view('login');
})->name('login');

Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', function () {
    if(Auth::check()){
        return redirect(route('personallink'));
    }
    return view('register');
})->name('register');

Route::post('/register', [RegisterController::class, 'register']);

Route::get('/logout', function () {
    Auth::logout();
    return redirect(route('login'));
})->name('logout');
