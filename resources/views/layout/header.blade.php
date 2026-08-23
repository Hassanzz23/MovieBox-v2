<!doctype html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MovieBox</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            transition:
                background-color 0.25s ease,
                color 0.25s ease;
        }




        [data-bs-theme="dark"] body {
            background-color: #121212;
            color: #f1f1f1;
        }


        [data-bs-theme="dark"] .navbar {
            background-color: #181818 !important;
            border-bottom: 1px solid #2a2a2a;
        }


        [data-bs-theme="dark"] .text-dark {
            color: #f1f1f1 !important;
        }


        [data-bs-theme="dark"] .text-muted {
            color: #a5a5a5 !important;
        }


        [data-bs-theme="dark"] h1,
        [data-bs-theme="dark"] h2,
        [data-bs-theme="dark"] h3,
        [data-bs-theme="dark"] h4,
        [data-bs-theme="dark"] h5,
        [data-bs-theme="dark"] h6,
        [data-bs-theme="dark"] p,
        [data-bs-theme="dark"] label {
            color: #f1f1f1;
        }




        [data-bs-theme="dark"] .card {
            background-color: #1b1b1b;
            border-color: #2a2a2a;
            color: #f1f1f1;
        }


        .card {
            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease;
        }




        [data-bs-theme="dark"] .form-control,
        [data-bs-theme="dark"] .form-select {
            background-color: #1c1c1c;
            border-color: #3a3a3a;
            color: #fff;
        }


        [data-bs-theme="dark"] .form-control::placeholder {
            color: #888;
        }




        [data-bs-theme="dark"] .btn-outline-secondary {
            color: #ddd;
            border-color: #555;
        }


        [data-bs-theme="dark"] .btn-outline-secondary:hover {
            background-color: #333;
            color: #fff;
        }




        [data-bs-theme="dark"] .alert {
            border-color: #333;
        }




        .navbar .nav-link {
            position: relative;
            transition: color 0.2s ease;
        }


        .navbar .nav-link::after {
            content: "";

            position: absolute;

            left: 8px;
            right: 8px;
            bottom: 2px;

            height: 2px;

            background-color: currentColor;

            transform: scaleX(0);

            transform-origin: center;

            transition: transform 0.2s ease;
        }


        .navbar .nav-link.active::after {
            transform: scaleX(1);
        }




        .username-link {
            margin-left: 6px;

            padding: 6px 12px !important;

            border-radius: 8px;

            background-color: #212529;

            color: #fff !important;

            transition:
                background-color 0.2s ease,
                transform 0.2s ease;
        }


        .username-link::after {
            left: 12px !important;
            right: 12px !important;
            bottom: 3px !important;
        }


        .username-link:hover {
            background-color: #343a40;

            transform: translateY(-1px);
        }



        [data-bs-theme="light"] .username-link {
            background-color: #212529;
            color: #fff !important;
        }



        [data-bs-theme="dark"] .username-link {
            background-color: #f1f1f1;
            color: #121212 !important;
        }


        [data-bs-theme="dark"] .username-link:hover {
            background-color: #ffffff;
        }




        .theme-toggle {

            width: 58px;
            height: 30px;

            border: 1px solid #aaa;
            border-radius: 50px;

            background: #eeeeee;

            padding: 3px 5px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            cursor: pointer;

            transition: 0.25s ease;
        }


        .theme-toggle:hover {
            transform: scale(1.05);
        }


        .theme-toggle:focus {
            outline: none;

            box-shadow:
                0 0 0 3px rgba(100, 100, 100, 0.2);
        }


        .theme-icon {

            font-size: 15px;

            line-height: 1;

            transition: 0.25s ease;
        }



        .theme-icon.moon {
            opacity: 1;
        }


        .theme-icon.sun {
            opacity: 0.35;
        }



        [data-bs-theme="dark"] .theme-toggle {

            background: #292929;

            border-color: #555;
        }


        [data-bs-theme="dark"] .theme-icon.moon {
            opacity: 0.35;
        }


        [data-bs-theme="dark"] .theme-icon.sun {
            opacity: 1;
        }




        html {
            transition: background-color 0.25s ease;
        }
    </style>

</head>


<body>


    <nav class="navbar navbar-expand-lg bg-body-tertiary">

        <div class="container-fluid">



            <a class="navbar-brand" href="{{ route('home') }}">

                MovieBox

            </a>



            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">

                <span class="navbar-toggler-icon"></span>

            </button>



            <div class="collapse navbar-collapse" id="navbarNav">


                <ul class="navbar-nav">



                    <li class="nav-item">

                        <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">

                            Home

                        </a>

                    </li>


                    @auth



                        <li class="nav-item">

                            <a href="{{ route('profile.index') }}"
                                class="nav-link username-link {{ request()->routeIs('profile.*') || request()->routeIs('watchlist.*') || request()->routeIs('favorites.*') ? 'active' : '' }}">

                                {{ auth()->user()->name }}

                            </a>

                        </li>


                    @endauth


                    @guest



                        <li class="nav-item">

                            <a href="{{ route('login') }}"
                                class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}">

                                Login

                            </a>

                        </li>



                        <li class="nav-item">

                            <a href="{{ route('register') }}"
                                class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}">

                                Sign Up

                            </a>

                        </li>


                    @endguest


                </ul>



                <div class="ms-auto d-flex align-items-center gap-3">


                    @auth


                        <a href="{{ route('logout') }}" class="nav-link">

                            Log out

                        </a>

                    @endauth



                    <button id="themeToggle" type="button" class="theme-toggle" aria-label="Toggle theme"
                        title="Toggle theme">

                        <span class="theme-icon moon">
                            🌙
                        </span>

                        <span class="theme-icon sun">
                            ☀️
                        </span>

                    </button>


                </div>


            </div>

        </div>

    </nav>
