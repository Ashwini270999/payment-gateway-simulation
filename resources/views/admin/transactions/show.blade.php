@extends('layouts.admin')

@section('content')

<h2 class="mb-4">Transaction Details</h2>

<div class="card shadow-sm">

    <div class="card-body">

        <table class="table table-bordered">

            <tr>
                <th width="30%">Transaction Reference</th>
                <td>{{ $transaction->transaction_reference }}</td>
            </tr>

            <tr>
                <th>Customer Name</th>
                <td>{{ $transaction->customer_name }}</td>
            </tr>

            <tr>
                <th>Customer Email</th>
                <td>{{ $transaction->customer_email }}</td>
            </tr>

            <tr>
                <th>Amount</th>
                <td>
                    {{ $transaction->currency }}
                    {{ number_format($transaction->amount,2) }}
                </td>
            </tr>

            <tr>
                <th>Status</th>
                <td>

                    <span class="badge
                    @if($transaction->status->value == 'SUCCESS') bg-success
                    @elseif($transaction->status->value == 'FAILED') bg-danger
                    @elseif($transaction->status->value == 'PROCESSING') bg-info
                    @else bg-warning text-dark
                    @endif">

                        {{ $transaction->status->value }}

                    </span>

                </td>
            </tr>

            <tr>
                <th>Provider</th>
                <td>{{ $transaction->provider }}</td>
            </tr>

            <tr>
                <th>Provider Reference</th>
                <td>{{ $transaction->provider_reference ?? '-' }}</td>
            </tr>

            <tr>
                <th>Processed At</th>
                <td>{{ $transaction->processed_at ?? '-' }}</td>
            </tr>

            <tr>
                <th>Created At</th>
                <td>{{ $transaction->created_at }}</td>
            </tr>

        </table>

        <h5 class="mt-4">Provider Response</h5>

        <pre class="bg-light p-3 border rounded">{{ json_encode($transaction->provider_response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>

        <a href="{{ route('transactions') }}" class="btn btn-secondary mt-3">
            Back
        </a>

    </div>

</div>

@endsection