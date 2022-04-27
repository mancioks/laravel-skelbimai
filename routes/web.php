<?php

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

Route::get('/', function () {
    return view('landing');
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'landing'])->name('homepage');
Route::get('/profile/ads', [App\Http\Controllers\UserPanelController::class, 'myAds'])->name('profile.ads');

Route::resource('/comment', 'App\Http\Controllers\CommentController');

Auth::routes();
Route::resource('/ad', 'App\Http\Controllers\AdController');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/ajax/models/{id}', [\App\Http\Controllers\Ajax\Models::class, 'getByManufacturerId'])->name('ajax.models');
