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
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="loading">
        <div class="d-flex justify-content-center">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
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
