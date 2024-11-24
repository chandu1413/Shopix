<?php

 
use Illuminate\Support\Facades\Route;
use Modules\Customer\Http\Controllers\Auth\AuthenticatedSessionController;
use Modules\Customer\Http\Controllers\Auth\ConfirmablePasswordController;
use Modules\Customer\Http\Controllers\Auth\EmailVerificationNotificationController;
use Modules\Customer\Http\Controllers\Auth\EmailVerificationPromptController;
use Modules\Customer\Http\Controllers\Auth\NewPasswordController;
use Modules\Customer\Http\Controllers\Auth\PasswordResetLinkController;
use Modules\Customer\Http\Controllers\Auth\RegisteredUserController;
use Modules\Customer\Http\Controllers\Auth\VerifyEmailController;

Route::middleware('auth')->prefix('customer')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('customer.register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('customer.login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('customer.password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('customer.password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('customer.password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('customer.password.store');
});

Route::middleware('auth')->prefix('customer')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('customer.verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('customer.verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('customer.verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('customer.password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [ConfirmablePasswordController::class, 'update'])->name('customer.password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('customer.logout');
});
