<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/home', function (){
    return redirect()->route('verification.notice');
})->name('home');

Route::group(['middleware' => 'verified'], function(){
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

    Route::get('/home', function (){
        return redirect()->route('homepage');
    })->name('home');
});

Auth::routes();
Route::resource('/ad', 'App\Http\Controllers\AdController');
Route::get('/ad/memorise/{ad_id}', [\App\Http\Controllers\AdController::class, 'memorise'])->name('ad.memorise')->middleware('auth');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/ajax/models/{id}', [\App\Http\Controllers\Ajax\Models::class, 'getByManufacturerId'])->name('ajax.models');


Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (\Illuminate\Foundation\Auth\EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');
