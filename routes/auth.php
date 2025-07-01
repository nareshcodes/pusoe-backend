<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('ninjax/register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('ninjax/register', [RegisteredUserController::class, 'store']);

    Route::get('ninjax/login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('ninjax/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('ninjax/forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('ninjax/forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('ninjax/reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('ninjax/reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('ninjax/verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('ninjax/verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('ninjax/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('ninjax/confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('ninjax/confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('ninjax/password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('ninjax/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
