<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #dbdde0;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#" style="font-size: 1.5rem; font-weight: bold;">Learning Management
                    System</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    @auth
                        <ul class="navbar-nav">
                            {{-- Dashboard --}}
                            <li class="nav-item">
                                <a class="nav-link btn btn-secondary me-3" href="{{ route('dashboard') }}">
                                    <b>Dashboard</b>
                                </a>
                            </li>

                            {{-- Name and logout --}}
                            <li class="nav-item dropdown">
                                <button class="nav-link dropdown-toggle" id="navbarDropdown" data-bs-toggle="dropdown"
                                    aria-expanded="false" onKeyPress="handleKeyPress(event)"
                                    onKeyDown="handleKeyDown(event)" onKeyUp="handleKeyUp(event)">
                                    {{ auth()->user()->name }} - {{ auth()->user()->role }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            {{-- Logout button --}}
                                            <button type="submit" class="dropdown-item">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    @endauth
                </div>
            </div>
        </nav>
    </header>

    <main class="container mt-4">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
