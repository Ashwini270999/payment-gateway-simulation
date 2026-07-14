<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InitiateTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation Rules
     */
    public function rules(): array
    {
        return [

            'customer_name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[A-Za-z\s]+$/',
            ],

            'customer_email' => [
                'required',
                'email',
                'max:255',
            ],

            'amount' => [
                'required',
                'numeric',
                'min:1',
            ],

            'currency' => [
                'nullable',
                'string',
                'size:3',
            ],

        ];
    }

    /**
     * Custom Validation Messages
     */
    public function messages(): array
    {
        return [

            'customer_name.required' => 'Customer name is required.',

            'customer_name.regex' => 'Customer name should contain only letters and spaces.',

            'customer_email.required' => 'Customer email is required.',

            'customer_email.email' => 'Please provide a valid email address.',

            'amount.required' => 'Transaction amount is required.',

            'amount.numeric' => 'Amount must be a valid number.',

            'amount.min' => 'Amount must be greater than zero.',

            'currency.size' => 'Currency must be a 3-letter ISO code.',
        ];
    }
}