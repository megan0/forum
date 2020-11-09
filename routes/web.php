<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('discussions', App\Http\Controllers\DiscussionsController::class);

Route::post('/replies/{discussion}',[App\Http\Controllers\RepliesController::class, 'store'])->name('reply.store');

Route::resource('discussions/{discusion}/replies', App\Http\Controllers\RepliesController::class);

Route::post('discussions/{discussion}/replies/{reply}/mark-as-best-reply',[App\Http\Controllers\DiscussionsController::class, 'reply'])->name('best.reply');

Route::get('users/notifications',[App\Http\Controllers\UsersController::class, 'notifications'])->name('notifications');
