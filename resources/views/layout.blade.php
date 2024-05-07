<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Log Supervisor' }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
</head>
<body>
    @yield('content')

    <script src="{{ asset('assets/js/script.js') }}"></script>
</body>
</html>
