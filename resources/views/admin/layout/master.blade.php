<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        MovieBox Admin
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>


    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">

        <div class="container">

            <a class="navbar-brand fw-bold" href="{{ route('admin') }}">
                MovieBox
            </a>


            <div class="navbar-nav">

                <a href="{{ route('home-movies.index') }}" class="nav-link">
                    Home
                </a>


                <a href="#" class="nav-link">
                    Users
                </a>

            </div>


            <div class="d-flex align-items-center gap-3">


                <button class="btn btn-outline-light">
                    🌙
                </button>


                <form action="{{ route('logout') }}" method="POST">

                    @csrf

                    <button class="btn btn-danger">
                        Logout
                    </button>

                </form>


            </div>


        </div>

    </nav>



    <main class="container py-4">

        @yield('content')

    </main>


</body>

</html>
