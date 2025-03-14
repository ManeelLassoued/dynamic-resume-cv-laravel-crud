<?php

use App\Http\Controllers\Userprofile;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\SocialiteController;


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


//Auth::routes();

Route::get('/', function () {
    return redirect()->route('login');
});

// Custom Login Route
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

// Custom Registration Route
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::middleware(['auth'])->group(function () {
    // Custom Logout Route
    Route::get('/index', [Userprofile::class, 'index'])->name('index');
    Route::get('/user/{id}/{user_id}', [Userprofile::class, 'view'])->name('user.profile.view');
    Route::get('/create', [Userprofile::class, 'create'])->name('user.profile.create');
    Route::post('/store', [Userprofile::class, 'store'])->name('store');
    Route::get('/edit/{id}/{user_id}', [Userprofile::class, 'edit'])->name('edit');
    Route::post('/update', [Userprofile::class, 'update'])->name('update');
    Route::post('/destroy/{id}', [Userprofile::class, 'destroy'])->name('destroy');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});




// Google routes
Route::get('/login/google', [SocialiteController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [SocialiteController::class, 'handleGoogleCallback']);

// GitHub routes
Route::get('/login/github', [SocialiteController::class, 'redirectToGithub'])->name('login.github');
Route::get('/login/github/callback', [SocialiteController::class, 'handleGithubCallback']);

// Admin-only routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/admin/{id}', [HomeController::class, 'view'])->name('admin.view');
});
