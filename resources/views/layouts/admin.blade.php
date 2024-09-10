<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TravelBoo') }}</title>

    {{-- faviicon --}}
    <link rel="icon" type="image/png" href="{{ asset('storage/img/logo.png') }}" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/js/app.js'])

    @livewireStyles

    @yield('script')

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
            box-shadow: 2px 2px 5px black display: inline-block;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            text-align: center;
            text-decoration: none;
            vertical-align: middle;
            cursor: pointer;
            user-select: none;
            border: none;
            border-radius: 0.375rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .spinner_border {
            border: 0.2em solid currentcolor;
            border-right-color: transparent;
        }

        .spinner_border {
            font-family: "Lilita One", sans-serif;
            display: inline-block;
            width: 1rem;
            height: 1rem;
            vertical-align: -0.125em;
            border-radius: 50%;
            animation: 0.75s linear infinite spinner-border;
        }
    </style>
</head>

<body>

    {{-- loading for app --}}
    <div id="loading">
        <div class="d-flex justify-content-center align-items-center h-100">
            <button id="btn_load_page" type="button" disabled>
                <span class="spinner_border" aria-hidden="true"></span>
                <span role="status">Caricamento...</span>
            </button>
        </div>
    </div>

    {{-- app --}}
    <div id="app">

        <main class="d-flex">

            {{-- sidebar for phone --}}
            <div id="siderbar_phone_container">
                <img src="{{ asset('storage/img/logo.png') }}" alt="">
            </div>
            {{-- siderbar --}}
            <div id="sidebar_pc" class="sidebar sidebar-narrow-unfoldable ">

                {{-- header of siderbar --}}
                <div class="sidebar-header border-bottom">
                    <img class="logo" src="{{ asset('storage/img/logo.png') }}" alt="" width="100%"
                        style="width: 50px;">
                </div>

                {{-- body of siderbar  --}}
                <ul class="sidebar-nav">

                    <li class="nav-item">
                        {{-- se clicco va alla sezione del profilo --}}
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                            <div class="avatar me-2 nav-icon">
                                <img class="avatar-img" src="{{ asset('storage/img/user.png') }}" alt="user@email.com">
                                <span class="avatar-status bg-success"></span>
                            </div>

                            <span style="color: #E25B07">{{ Auth::user()->name }}</span>
                        </a>

                    </li>
                    <li class="nav-item">
                        {{-- se clicco valla alla pagina welcome --}}
                        <a class="nav-link" href="{{ url('/') }}" style="color: #E25B07">
                            <i class="fa-solid fa-house nav-icon" style="color: #E25B07"></i> HOME
                        </a>
                    </li>

                    <li class="nav-item">
                        {{-- se clicci va ai viaggi --}}
                        <a class="nav-link" href="{{ route('admin.travels.index') }}" style="color: #E25B07">
                            <i class="fa-solid fa-plane nav-icon" style="color: #E25B07"></i> VIAGGI
                        </a>
                    </li>

                    <li class="nav-item">
                        {{-- se clicco va ai itinerari --}}
                        <a class="nav-link" href="{{ route('admin.steps.index') }}" style="color: #E25B07">
                            <i class="fa-solid fa-location-dot nav-icon" style="color: #E25B07"></i> ITINERARI
                        </a>
                    </li>

                    <li class="nav-item">
                        {{-- se clicco vai alle note --}}
                        <a class="nav-link" href="{{ route('admin.notes.index') }}" style="color: #E25B07">

                            <i class="fa-solid fa-note-sticky nav-icon" style="color: #E25B07"></i> NOTE
                        </a>
                    </li>

                    <li class="nav-item">

                        {{-- se clicco va alla sezione dello profilo --}}
                        <a class="nav-link" href="{{ url('profile') }}" style="color: #E25B07">
                            <i class="fa-solid fa-user nav-icon" style="color: #E25B07"></i>
                            PROFILO

                        </a>
                    </li>
                </ul>

                {{-- footer of siderbar --}}
                <div class="sidebar-footer border-top d-flex justify-content-start">

                    {{-- se clicco scollega l'utente --}}
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

            {{-- contenuto della pagina --}}
            <div class="container_admin">
                @yield('content')
            </div>

        </main>


    </div>

    @livewireScripts
</body>

</html>
