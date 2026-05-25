<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>The Food Store</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <header>
        <a href="{{ route('index') }}">
            <h1>The Food Store</h1>
        </a>
    </header>

    <main>
        @yield('content')
    </main>

</body>

</html>