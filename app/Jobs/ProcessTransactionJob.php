<?php

namespace App\Jobs;

use App\Enums\TransactionStatus;
use App\Models\Transaction;
use App\Services\PaymentProviderService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class ProcessTransactionJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Transaction $transaction
    ) {
    }

    public function handle(PaymentProviderService $paymentProviderService): void
    {
        try {

            $this->transaction->update([
                'status' => TransactionStatus::PROCESSING,
            ]);

            $providerResponse = $paymentProviderService->process($this->transaction);

            $this->transaction->update([

                'status' => $providerResponse['status'],

                'provider_reference' => $providerResponse['provider_reference'],

                'provider_response' => $providerResponse['provider_response'],

                'processed_at' => now(),
            ]);

            Cache::forget('dashboard.statistics');

            Log::info('Transaction processed.', [

                'transaction_id' => $this->transaction->id,

                'reference' => $this->transaction->transaction_reference,

                'status' => $this->transaction->status->value,
            ]);

        } catch (\Throwable $exception) {

            Log::error('Transaction processing failed.', [

                'transaction_id' => $this->transaction->id,

                'error' => $exception->getMessage(),
            ]);

            $this->transaction->update([

                'status' => TransactionStatus::FAILED,

                'processed_at' => now(),
            ]);

            Cache::forget('dashboard.statistics');

            throw $exception;
        }
    }
}