<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\InitiateTransactionRequest;
use App\Services\TransactionService;
use Illuminate\Http\JsonResponse;

class TransactionController extends Controller
{
    public function __construct(
        private readonly TransactionService $transactionService
    ) {
    }

    public function store(InitiateTransactionRequest $request): JsonResponse
    {
        $transaction = $this->transactionService->initiate(
            $request->validated(),
            $request->header('Idempotency-Key')
        );

        return response()->json([
            'success' => true,
            'message' => 'Transaction initiated successfully.',
            'data' => $transaction,
        ], 201);
    }
}