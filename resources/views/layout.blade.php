<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ 'Log Supervisor' }} - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('vendor/log-supervisor/assets/css/bootstrap.min.css') }}"
         onerror="alert('app.css failed to load. Please refresh the page, re-publish Log Viewer assets, or fix routing for vendor assets.')">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('lg.logs.index') }}">Logs</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('lg.logs.index') }}">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ $backUrl }}">{{ $backLabel }}</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2 rounded" type="search" placeholder="Rechercher" aria-label="Search">
                    <button class="btn btn-outline-success rounded" type="submit">Rechercher</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-5 pt-5">
        <div class="page-header mb-4 pb-2 border-bottom">
            <div class="row align-items-center">
                <div class="col-sm mb-1 mb-sm-0">
                    <h1 class="h2">@yield('title')</h1>
                </div>
            </div>
        </div>

        @yield('content')

    </div>

    <footer class="py-4 bg-white mt-auto border-top">
        <div class="container text-center">
            &copy; {{ date('Y') }} Log Supervisor. Tous droits réservés.
        </div>
    </footer>

    <script src="{{ asset('vendor/log-supervisor/assets/js/bootstrap.bundle.min.js') }}" onerror="alert('app.js failed to load. Please refresh the page, re-publish Log Viewer assets, or fix routing for vendor assets.')"></script>
</body>
</html>
