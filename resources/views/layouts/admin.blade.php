<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/js/app.js'])

    <style>
        #app {
            display: none;
        }

        #loading {
            position: fixed;
            z-index: 999;
            top: 0;
            left: 0;
            width: 100%;
            min-height: 100vh;
            height: 100%;
            display: block;
            filter: blur(50%);
            background-color: rgba(245, 245, 245, 0.679);
        }

        #btn_load_page {
            background-color: #E25B07;
            color: white;
            border: none;
            font-size: 20px;
            box-shadow: 2px 2px 5px black
        }
    </style>
</head>

<body>

    <div id="loading">
        <div class="d-flex justify-content-center align-items-center h-100">
            <button id="btn_load_page" class="btn" type="button" disabled>
                <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                <span role="status">Loading...</span>
            </button>
        </div>
    </div>

    <div id="app">




        <main class="d-flex">

            <div class="sidebar sidebar-narrow-unfoldable ">
                <div class="sidebar-header border-bottom">
                    <img class="logo" src="{{ asset('storage/img/logo.png') }}" alt="" width="100%"
                        style="width: 50px;">

                </div>
                <ul class="sidebar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('profile') }}">
                            <div class="avatar me-2 nav-icon">
                                <img class="avatar-img" src="{{ asset('storage/img/user.png') }}" alt="user@email.com">
                                <span class="avatar-status bg-success"></span>
                            </div>
                            <span style="color: #E25B07">{{ Auth::user()->name }}</span>
                        </a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}" style="color: #E25B07">
                            <i class="fa-solid fa-house nav-icon" style="color: #E25B07"></i> HOME
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.travels.index') }}" style="color: #E25B07">
                            <i class="fa-solid fa-plane nav-icon" style="color: #E25B07"></i> VIAGGI
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.steps.index') }}" style="color: #E25B07">
                            <i class="fa-solid fa-location-dot nav-icon" style="color: #E25B07"></i> ITINERARI
                        </a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('profile') }}" style="color: #E25B07">
                            <i class="fa-solid fa-user nav-icon" style="color: #E25B07"></i>
                            PROFILO

                        </a>
                    </li>
                </ul>
                <div class="sidebar-footer border-top d-flex justify-content-start">
                    <a class=" nav-icon" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                        <i class="fa-solid fa-right-from-bracket" style="color: #E25B07"></i>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                </div>
            </div>

            <div class="container_admin">
                @yield('content')
            </div>

        </main>
    </div>


</body>

</html>
