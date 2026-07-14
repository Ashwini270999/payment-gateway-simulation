<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\TransactionStatus;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {

            $table->id();

            // Business Reference
            $table->string('transaction_reference', 30)->unique();

            // Customer Details
            $table->string('customer_name');
            $table->string('customer_email')->index();

            // Payment Details
            $table->decimal('amount', 12, 2);
            $table->char('currency', 3)->default('INR');

            // Transaction Status
            $table->string('status', 20)
            ->default(TransactionStatus::PENDING->value)
            ->index();

            // Idempotency
            $table->string('idempotency_key')->nullable()->unique();

            // Payment Provider
            $table->string('provider')->default('SIMULATED');

            $table->string('provider_reference')->nullable()->index();

            // Complete Provider Response
            $table->json('provider_response')->nullable();

            // Processing Time
            $table->timestamp('processed_at')->nullable();

            $table->timestamps();

            // Composite Index
            $table->index([
                'customer_email',
                'status'
            ]);

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
