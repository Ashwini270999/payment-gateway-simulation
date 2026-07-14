<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\TransactionStatus;

class PaymentWebhookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'transaction_reference' => [
                'required',
                'string',
                'exists:transactions,transaction_reference',
            ],

            'provider_reference' => [
                'required',
                'string',
                'max:255',
            ],

            'status' => [
                'required',
                Rule::in([
                    TransactionStatus::SUCCESS->value,
                    TransactionStatus::FAILED->value,
                ]),
            ],

            'response_code' => [
                'required',
                'string',
                'max:10',
            ],

        ];
    }
}