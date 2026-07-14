<?php

namespace App\Enums;

enum TransactionStatus: string
{
    case PENDING = 'PENDING';
    case PROCESSING = 'PROCESSING';
    case SUCCESS = 'SUCCESS';
    case FAILED = 'FAILED';
}