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
</head>

<body>

    {{-- loading for app --}}
    <div id="loading">
        <div class="container_loader">
            <button id="btn_load_page" class="btn" type="button" disabled>
                <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                <span role="status">Caricamento...</span>
            </button>
        </div>
    </div>

    <div id="app">

        <main class="account_container" style="height: 100%">
            @yield('content')
        </main>
    </div>
</body>

</html>
