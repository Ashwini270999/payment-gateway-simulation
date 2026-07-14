<?php

namespace Database\Factories;

use App\Enums\TransactionStatus;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition(): array
    {
        $status = fake()->randomElement([
            TransactionStatus::SUCCESS,
            TransactionStatus::FAILED,
            TransactionStatus::PENDING,
            TransactionStatus::PROCESSING,
        ]);

        return [

            'transaction_reference' =>
                'TXN-' .
                now()->format('Ymd') .
                '-' .
                strtoupper(Str::random(8)),

            'customer_name' => fake()->name(),

            'customer_email' => fake()->unique()->safeEmail(),

            'amount' => fake()->randomFloat(2, 100, 100000),

            'currency' => fake()->randomElement([
                'INR',
                'USD',
            ]),

            'status' => $status,

            'provider' => 'SIMULATED',

            'provider_reference' =>
                'PAY-' . strtoupper(fake()->bothify('########')),

            'provider_response' => [

                'provider' => 'SIMULATED',

                'message' => match ($status) {
                    TransactionStatus::SUCCESS => 'Payment processed successfully.',
                    TransactionStatus::FAILED => 'Payment failed.',
                    TransactionStatus::PROCESSING => 'Payment is being processed.',
                    default => 'Payment initiated.',
                },

                'response_code' => match ($status) {
                    TransactionStatus::SUCCESS => '00',
                    TransactionStatus::FAILED => '99',
                    TransactionStatus::PROCESSING => '01',
                    default => 'PENDING',
                },

            ],

            'processed_at' => fake()->optional()->dateTimeBetween('-30 days'),

            'created_at' => fake()->dateTimeBetween('-6 months'),

            'updated_at' => now(),

        ];
    }
}