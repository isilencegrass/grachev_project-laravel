<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\RegistrationController;
use App\http\Controllers\LoginController;

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

Route::get('/', [MainController::class, 'home']);
Route::get('/about', [MainController::class, 'about']);

Route::get('/registration', [RegistrationController::class, 'show'])->name('registration');
Route::post('/registration/check', [RegistrationController::class, 'check'])->name('registration.check');

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login/check', [LoginController::class, 'check'])->name('login.check');

Route::get('/profile', function () {
    return view('profile');
})->middleware('auth')->name('profile');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');


