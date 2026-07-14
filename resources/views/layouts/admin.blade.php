<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Payment Admin Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">

    <div class="container">

        <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
            Payment Gateway Admin
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto align-items-center">

                <li class="nav-item">

                    <a
                        class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                        href="{{ route('dashboard') }}">

                        Dashboard

                    </a>

                </li>

                <li class="nav-item">

                    <a
                        class="nav-link {{ request()->routeIs('transactions*') ? 'active' : '' }}"
                        href="{{ route('transactions') }}">

                        Transactions

                    </a>

                </li>

                <li class="nav-item ms-3">

                    <form method="POST" action="{{ route('logout') }}">

                        @csrf

                        <button class="btn btn-outline-light btn-sm">

                            Logout

                        </button>

                    </form>

                </li>

            </ul>

        </div>

    </div>

</nav>

<div class="container py-4">

    @yield('content')

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>