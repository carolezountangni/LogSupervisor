<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ 'Log Supervisor' }} - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('vendor/log-supervisor/assets/css/bootstrap.min.css') }}"
         onerror="alert('app.css failed to load. Please refresh the page, re-publish Log Viewer assets, or fix routing for vendor assets.')">

</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{route('lg.logs.index')}}">Logs</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{route('lg.logs.index')}}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href={{$backUrl}}>{{ $backLabel}}</a>
        </li>
        
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

    <div class="content container">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-1 mb-sm-0">
                    <h1 class="page-header-title">@yield('title')</h1>
                </div>

            </div>
            </div>

        @yield('content')
        
    </div>    

    <script src="{{ asset('vendor/log-supervisor/assets/js/bootstrap.bundle.min.js') }}" onerror="alert('app.js failed to load. Please refresh the page, re-publish Log Viewer assets, or fix routing for vendor assets.')"></script>

</body>
</html>
