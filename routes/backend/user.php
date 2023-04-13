<?php

use App\Http\Controllers\Backend\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'auth',
    'prefix'     => 'user',
    'as'         => 'user.'
], function () {
    Route::get('/', 'UserController@index')->name('index');

    // Route::get('/home', function () {
    //     return view('backend.pages.home');
    // })->name('home');

    // Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


    // Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
    //     Route::get('/', function () {
    //         return view('backend.pages.users.profiles');
    //     })->name('home');
    // });
});
