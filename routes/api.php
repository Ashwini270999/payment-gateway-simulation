<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\DashboardController;

Route::post('/transactions', [TransactionController::class, 'store']);
