<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- app name --}}
    <title>{{ config('app.name', 'TravelBoo') }}</title>

    {{-- faviicon --}}
    <link rel="icon" type="image/png" href="{{ asset('storage/img/logo.png') }}" />

    {{-- fontawesone --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">

    <!-- Usando Vite -->
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

        .container_loader {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        #btn_load_page {
            background-color: #E25B07;
            color: white;
            border: none;
            font-size: 20px;
            box-shadow: 2px 2px 5px black
        }
    </style>


<body>

    {{-- loading for app --}}
    <div id="loading">
        <div class="container_loader">
            <button id="btn_load_page" class="btn" type="button" disabled>
                <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                <span role="status">Loading...</span>
            </button>
        </div>
    </div>

    {{-- app --}}
    <div id="app">

        {{-- navbar --}}
        <nav class="navbar navbar-expand-md shadow-sm">
            <div class="container">

                {{-- se clicci indirizza alla pagina welcome del sito --}}
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">

                    {{-- logo --}}
                    <div class="logo_app">
                        <img class="logo" src="{{ asset('storage/img/logo.png') }}" alt="" width="100%"
                            style="width: 50px;">
                        <span style="color: #E25B07;">TravelBoo</span>
                    </div>

                </a>

                {{-- se clicci fa comparire tutta la navbar-collapse quando si usa uno schermo piccolo --}}
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}" style="color: #E25B07;">
                    <span style="color: #E25B07;">
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                    </span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}"
                                style="color: #E25B07;">{{ __('Home') }}</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">

                        {{-- se sei un'ospite --}}
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}"
                                    style="color: #E25B07;">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}"
                                        style="color: #E25B07;">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            {{-- altrimenti --}}

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    style="color: #E25B07;" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown"
                                    style="background-color: #1E1E1E; border-color:  #E25B07;">

                                    {{-- se clicci vai alla alla dasboard  --}}
                                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}"
                                        style="color: #E25B07;">{{ __('Dashboard') }}</a>

                                    {{-- se clicci va alla sezione del tuo profilo --}}
                                    <a class="dropdown-item" href="{{ url('profile') }}"
                                        style="color: #E25B07;">{{ __('Profile') }}</a>

                                    {{-- se clicci logout --}}
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                                        style="color: #E25B07;">
                                        {{ __('Logout') }}
                                    </a>


                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        {{-- dove viene inserito il contenuto --}}
        <main class="">
            @yield('content')
        </main>
    </div>
</body>

</html>
