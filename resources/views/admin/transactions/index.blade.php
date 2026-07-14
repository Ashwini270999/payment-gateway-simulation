@extends('layouts.admin')

@section('content')

<h2 class="mb-4">Transactions</h2>

<div class="card shadow-sm">

    <div class="card-body p-0">

        <table class="table table-striped mb-0">

            <thead>

            <tr>

                <th>Reference</th>

                <th>Customer</th>

                <th>Email</th>

                <th>Amount</th>

                <th>Status</th>

                <th>Created</th>

                <th></th>

            </tr>

            </thead>

            <tbody>

            @forelse($transactions as $transaction)

                <tr>

                    <td>{{ $transaction->transaction_reference }}</td>

                    <td>{{ $transaction->customer_name }}</td>

                    <td>{{ $transaction->customer_email }}</td>

                    <td>
                        {{ $transaction->currency }}
                        {{ number_format($transaction->amount,2) }}
                    </td>

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

                    <td>{{ $transaction->created_at->format('d M Y H:i') }}</td>

                    <td>

                        <a
                            href="{{ route('transactions.show',$transaction->id) }}"
                            class="btn btn-sm btn-outline-primary">

                            View

                        </a>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="7" class="text-center">

                        No Transactions Found

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

<div class="mt-3">

    {{ $transactions->links() }}

</div>

@endsection