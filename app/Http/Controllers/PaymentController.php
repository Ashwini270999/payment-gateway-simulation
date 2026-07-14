<?php

namespace App\Http\Controllers;

use App\Http\Requests\InitiateTransactionRequest;
use App\Services\TransactionService;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function __construct(
        private readonly TransactionService $transactionService
    ) {
    }

    public function create(): View
    {
        return view('payment.create');
    }

    public function store(InitiateTransactionRequest $request): RedirectResponse
    {
        $idempotencyKey = $request->header('Idempotency-Key') ?? Str::uuid()->toString();

        $transaction = $this->transactionService->initiate(
            $request->validated(),
            $idempotencyKey
        );

        return redirect()->route(
            'payment.success',
            $transaction->transaction_reference
        );
    }

    public function success(string $reference): View
    {
        $transaction = \App\Models\Transaction::where(
            'transaction_reference',
            $reference
        )->firstOrFail();

        return view('payment.success', [
            'transaction' => $transaction,
        ]);
    }
}