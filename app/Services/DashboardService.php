<?php

namespace App\Services;

use App\Enums\TransactionStatus;
use App\Models\Transaction;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DashboardService
{
    public function getStatistics(): array
    {
        return Cache::remember('dashboard.statistics', now()->addMinutes(5), function () {

            $statistics = Transaction::selectRaw("
                COUNT(*) AS total_transactions,

                SUM(CASE WHEN status = ? THEN 1 ELSE 0 END) AS successful_transactions,

                SUM(CASE WHEN status = ? THEN 1 ELSE 0 END) AS failed_transactions,

                SUM(CASE WHEN status = ? THEN 1 ELSE 0 END) AS pending_transactions,

                SUM(CASE WHEN status = ? THEN 1 ELSE 0 END) AS processing_transactions,

                COALESCE(SUM(amount),0) AS total_payment_volume,

                COALESCE(SUM(
                    CASE
                        WHEN status = ? THEN amount
                        ELSE 0
                    END
                ),0) AS successful_payment_volume
            ", [

                TransactionStatus::SUCCESS->value,

                TransactionStatus::FAILED->value,

                TransactionStatus::PENDING->value,

                TransactionStatus::PROCESSING->value,

                TransactionStatus::SUCCESS->value,

            ])->first();

            $recentTransactions = Transaction::latest()
            ->select([
                'transaction_reference',
                'customer_name',
                'customer_email',
                'amount',
                'currency',
                'status',
                'provider',
                'created_at',
            ])
            ->take(10)
            ->get();

            return [

                'statistics' => [

                    'total_transactions' => (int) $statistics->total_transactions,

                    'successful_transactions' => (int) $statistics->successful_transactions,

                    'failed_transactions' => (int) $statistics->failed_transactions,

                    'pending_transactions' => (int) $statistics->pending_transactions,

                    'processing_transactions' => (int) $statistics->processing_transactions,

                    'total_payment_volume' => (float) $statistics->total_payment_volume,

                    'successful_payment_volume' => (float) $statistics->successful_payment_volume,

                    'today_transactions' => Transaction::whereDate(
                        'created_at',
                        today()
                    )->count(),

                ],

                'recent_transactions' => $recentTransactions,
            ];
        });
    }
}