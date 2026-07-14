<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Submitted</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-header bg-success text-white text-center">
                    <h4>Payment Submitted Successfully</h4>
                </div>

                <div class="card-body">

                    <p class="mb-3">
                        Your payment request has been submitted successfully.
                    </p>

                    <table class="table table-bordered">

                        <tr>
                            <th width="40%">Transaction Reference</th>
                            <td>{{ $transaction->transaction_reference }}</td>
                        </tr>

                        <tr>
                            <th>Status</th>
                            <td>
                            @if($transaction->status->value == 'SUCCESS')

                                <span class="badge bg-success">
                                    SUCCESS
                                </span>

                            @elseif($transaction->status->value == 'FAILED')

                                <span class="badge bg-danger">
                                    FAILED
                                </span>

                            @elseif($transaction->status->value == 'PROCESSING')

                                <span class="badge bg-info">
                                    PROCESSING
                                </span>

                            @else

                                <span class="badge bg-warning text-dark">
                                    PENDING
                                </span>

                            @endif
                            </td>
                        </tr>

                    </table>

                    <a href="{{ route('payment.form') }}"
                       class="btn btn-primary w-100">
                        Make Another Payment
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>