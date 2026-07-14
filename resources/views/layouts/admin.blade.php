<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Payment Admin Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">

    <div class="container">

        <a class="navbar-brand" href="{{ route('dashboard') }}">
            Payment Gateway Admin
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button class="btn btn-outline-light btn-sm">
                Logout
            </button>

        </form>

    </div>

</nav>

<div class="container py-4">

    @yield('content')

</div>

</body>

</html>