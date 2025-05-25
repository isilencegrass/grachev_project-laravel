<?php

use Illuminate\Http\Request;
use App\Models\Posts;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\RegistrationController;
use App\http\Controllers\LoginController;
use App\Http\Controllers\PostsController;


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
    $posts = Posts::where('user_id', auth()->id())->latest()->get();
    return view('profile', compact('posts'));
})->middleware('auth')->name('profile');

Route::post('/profile/avatar', function(Request $request) {
    $request->validate([
        'avatar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ]);
    $user = auth()->user();
    if ($request->hasFile('avatar')) {
        $path = $request->file('avatar')->store('avatars', 'public');
        $user->avatar = $path;
        $user->save();
    }
    return redirect()->route('profile');
})->middleware('auth')->name('profile.avatar');


Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');


Route::get('/editor', function () {
    return view('editor');
})->middleware('auth')->name('editor');
Route::post('/posts/store', [PostsController::class, 'store'])->middleware('auth')->name('posts.store');

