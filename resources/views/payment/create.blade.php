<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Gateway</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-header text-center">
                    <h4>Payment Gateway</h4>
                </div>

                <div class="card-body">

                    <form action="{{ route('payment.store') }}" method="POST"  id="paymentForm">

                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Customer Name</label>

                            <input
                                type="text"
                                name="customer_name"
                                class="form-control"
                                value="{{ old('customer_name') }}"
                            >

                            @error('customer_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">

                            <label class="form-label">Customer Email</label>

                            <input
                                type="email"
                                name="customer_email"
                                class="form-control"
                                value="{{ old('customer_email') }}"
                            >

                            @error('customer_email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>

                        <div class="mb-3">

                            <label class="form-label">Amount</label>

                            <input
                                type="number"
                                step="0.01"
                                name="amount"
                                class="form-control"
                                value="{{ old('amount') }}"
                            >

                            @error('amount')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>

                        <div class="mb-3">

                            <label class="form-label">Currency</label>

                            <select
                                name="currency"
                                class="form-select"
                            >
                                <option value="INR">INR</option>
                                <option value="USD">USD</option>
                            </select>

                        </div>

                        <button
                            type="submit"
                            class="btn btn-primary w-100"
                            id="submitButton">

                            <span id="buttonText">
                                Pay Now
                            </span>

                            <span
                                id="loadingSpinner"
                                class="spinner-border spinner-border-sm ms-2 d-none"
                                role="status"
                                aria-hidden="true">
                            </span>

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

document
    .getElementById('paymentForm')
    .addEventListener('submit', function (event) {

        if (!this.checkValidity()) {

            return;

        }

        const button = document.getElementById('submitButton');

        const buttonText = document.getElementById('buttonText');

        const spinner = document.getElementById('loadingSpinner');

        button.disabled = true;

        buttonText.textContent = 'Processing Payment...';

        spinner.classList.remove('d-none');

    });

</script>

</body>
</html>