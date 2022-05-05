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
Route::get('/profile/edit', [App\Http\Controllers\UserPanelController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update', [App\Http\Controllers\UserPanelController::class, 'update'])->name('profile.update');
Route::get('/profile', [App\Http\Controllers\UserPanelController::class, 'index'])->name('profile');
Route::get('/profile/memorised', [\App\Http\Controllers\UserPanelController::class, 'memorised'])->name('profile.memorised');

Route::resource('/comment', 'App\Http\Controllers\CommentController');

Route::get('/inbox', [App\Http\Controllers\MessageController::class, 'inbox'])->name('messages.inbox');
Route::get('/inbox/new/{user_id?}', [App\Http\Controllers\MessageController::class, 'write'])->name('messages.create-conversation');
Route::post('/inbox/storemessage/{conversation_id}', [\App\Http\Controllers\MessageController::class, 'storeMessage'])->name('messages.store-message');
Route::post('/inbox/storeconversation', [\App\Http\Controllers\MessageController::class, 'storeConversation'])->name('messages.store-conversation');
Route::get('/inbox/conversation/{conversation_id}', [\App\Http\Controllers\MessageController::class, 'conversation'])->name('messages.show-conversation');

Auth::routes();
Route::resource('/ad', 'App\Http\Controllers\AdController');
Route::get('/ad/memorise/{ad_id}', [\App\Http\Controllers\AdController::class, 'memorise'])->name('ad.memorise');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/ajax/models/{id}', [\App\Http\Controllers\Ajax\Models::class, 'getByManufacturerId'])->name('ajax.models');
