<?php

namespace App\Services;

use App\Enums\TransactionStatus;
use App\Models\Transaction;

class PaymentProviderService
{
    /**
     * Simulate communication with an external payment provider.
     */
    public function process(Transaction $transaction): array
    {
        // Simulate provider decision
        $isSuccess = $transaction->amount <= 50000;

        return [

            'status' => $isSuccess
                ? TransactionStatus::SUCCESS
                : TransactionStatus::FAILED,

            'provider_reference' => 'PAY-' . strtoupper(fake()->bothify('########')),

            'provider_response' => [

                'provider' => 'SIMULATED',

                'transaction_reference' => $transaction->transaction_reference,

                'message' => $isSuccess
                    ? 'Payment processed successfully.'
                    : 'Payment failed.',

                'response_code' => $isSuccess
                    ? '00'
                    : '05',

                'processed_at' => now()->toDateTimeString(),
            ],
        ];
    }
}