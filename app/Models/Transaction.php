<?php

namespace App\Models;

use App\Enums\TransactionStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [

        'transaction_reference',

        'customer_name',

        'customer_email',

        'amount',

        'currency',

        'status',

        'idempotency_key',

        'provider',

        'provider_reference',

        'provider_response',

        'processed_at',
    ];

    protected $casts = [

        'status' => TransactionStatus::class,

        'provider_response' => 'array',

        'processed_at' => 'datetime',
    ];
}