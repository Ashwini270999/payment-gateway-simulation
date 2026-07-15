@extends('layouts.admin')

@section('content')

<div class="container py-4">

    <h2 class="mb-4">Payment Dashboard</h2>

    <div class="row g-3">

        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6>Total Transactions</h6>
                    <h3>{{ $dashboard['statistics']['total_transactions'] }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6>Successful</h6>
                    <h3 class="text-success">
                        {{ $dashboard['statistics']['successful_transactions'] }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6>Failed</h6>
                    <h3 class="text-danger">
                        {{ $dashboard['statistics']['failed_transactions'] }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6>Pending</h6>
                    <h3 class="text-warning">
                        {{ $dashboard['statistics']['pending_transactions'] }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6>Processing</h6>
                    <h3 class="text-info">
                        {{ $dashboard['statistics']['processing_transactions'] }}
                    </h3>
                </div>
            </div>
        </div>

    </div>

    <div class="row mt-4 g-3">

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6>Total Payment Volume</h6>
                    <h4>
                        ₹ {{ number_format($dashboard['statistics']['total_payment_volume'],2) }}
                    </h4>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6>Successful Volume</h6>
                    <h4>
                        ₹ {{ number_format($dashboard['statistics']['successful_payment_volume'],2) }}
                    </h4>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6>Today's Transactions</h6>
                    <h4>
                        {{ $dashboard['statistics']['today_transactions'] }}
                    </h4>
                </div>
            </div>
        </div>

    </div>

    <div class="card mt-5 shadow-sm">

        <div class="card-header">
            Latest 10 Transactions
        </div>

        <div class="d-flex justify-content-between align-items-center mt-5 mb-3">

            <h4>Recent Transactions</h4>

            <a href="{{ route('transactions') }}" class="btn btn-primary">
                View All Transactions
            </a>

        </div>

        <div class="card-body p-0">

            <table class="table table-striped mb-0">

                <thead>

                <tr>

                    <th>Reference</th>

                    <th>Customer</th>

                    <th>Amount</th>

                    <th>Status</th>

                    <th>Date</th>

                </tr>

                </thead>

                <tbody>

                @foreach($dashboard['recent_transactions'] as $transaction)

                    <tr>

                        <td>{{ $transaction->transaction_reference }}</td>

                        <td>{{ $transaction->customer_name }}</td>

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

                    </tr>

                @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection