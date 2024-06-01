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
        <header>
            <nav class="navbar" style="background-color: #cccccc;">
                <div>
                    <h1 style="margin-left: 20px;">Learning Management System</h1>
                </div>
                <div class="md-flex justify-content-end">
                    <div style="margin-right: 20px">
                        @auth
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-primary">Logout</button>
                            </form>
                        @endauth
                    </div>
                </div>
            </nav>
        </header>

        <main>
            @yield('content')
        </main>
</body>

</html>
