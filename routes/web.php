<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| Customer Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [PaymentController::class, 'create'])
    ->name('payment.form');

Route::post('/payment', [PaymentController::class, 'store'])
    ->name('payment.store');

Route::get('/payment/success/{reference}', [PaymentController::class, 'success'])
    ->name('payment.success');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/transactions', [DashboardController::class, 'transactions'])
        ->name('transactions');

    Route::get('/transactions/{transaction}', [DashboardController::class, 'show'])
        ->name('transactions.show');
});

require __DIR__.'/auth.php';