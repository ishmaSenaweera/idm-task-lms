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
        <nav class="navbar" style="background-color: #cccccc;">
            <div>
                <h1 style="margin-left: 20px;">Learning Management System</h1>
            </div>
            @auth
                <div class="d-flex justify-content-end align-items-center" style="margin-right: 20px;">
                    <div class="me-3">
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                            Dashboard
                        </a>
                    </div>
                    <div class="col d-flex flex-column justify-content-center align-items-center">
                        <div>
                            <h6 class="mb-0">
                                {{ auth()->user()->name }} - {{ auth()->user()->role }}
                            </h6>
                        </div>
                        <div class="mt-2">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-primary">Logout</button>
                            </form>
                        </div>
                    </div>

                </div>
            @endauth
        </nav>
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>
