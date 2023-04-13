<?php

use App\Http\Controllers\Backend\Auth\ForgotPasswordController;
use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\Backend\Auth\RegisterController;
use App\Http\Controllers\Backend\Auth\ResetPasswordController;
use App\Http\Controllers\Backend\Auth\VerificationController;
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

Route::group([
    'middleware' => 'guest:web',
    'prefix'     => '',
    'as'         => ''
], function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.get');
    Route::post('login', [LoginController::class, 'login'])->name('login.post');
    Route::get('', function () {
        return redirect()->route('admin.login.get');
    });

    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register.get');
    Route::post('register', [RegisterController::class, 'register'])->name('register.post');

    Route::get('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email.get');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email.post');
    Route::get('password/reset', [ResetPasswordController::class, 'showResetForm'])->name('password.reset.get');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.reset.post');

    Route::post('email/verify/{user}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('email/resend', [VerificationController::class, 'resend']);
});
