<?php

namespace App\Services;

use App\Models\Transaction;
use App\Enums\TransactionStatus;
use App\Jobs\ProcessTransactionJob;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class TransactionService
{
    public function initiate(array $data, ?string $idempotencyKey = null): Transaction
    {
        // Check Idempotency
        if ($idempotencyKey) {

            $existingTransaction = Transaction::where('idempotency_key', $idempotencyKey)->first();

            if ($existingTransaction) {
                return $existingTransaction;
            }
        }

        // Store Transaction
        $transaction = DB::transaction(function () use ($data, $idempotencyKey) {

            return Transaction::create([

                'transaction_reference' => $this->generateTransactionReference(),

                'customer_name' => $data['customer_name'],

                'customer_email' => $data['customer_email'],

                'amount' => $data['amount'],

                'currency' => $data['currency'] ?? 'INR',

                'status' => TransactionStatus::PENDING,

                'idempotency_key' => $idempotencyKey,

                'provider' => 'SIMULATED',
            ]);
        });

        Log::info('Transaction initiated', [

            'transaction_id' => $transaction->id,

            'reference' => $transaction->transaction_reference,
        ]);

        ProcessTransactionJob::dispatch($transaction);

        Cache::forget('dashboard.statistics');

        return $transaction;
    }

    private function generateTransactionReference(): string
    {
        return 'TXN-' . now()->format('Ymd') . '-' . strtoupper(Str::random(8));
    }
}