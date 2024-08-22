@extends('layouts.account')

@section('content')
    <div class="container-fluid mt-4 flex-column d-flex align-items-center gap-4"
        style="height: calc(100vh - 70px); overflow: hidden;">

        {{-- header --}}
        <h1>TRAVELBOO</h1>

        <div class="row justify-content-center w-100">

            {{-- se clicci ti riporta alla pagina precedente --}}
            <button class="button_return" onclick="history.back()">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
            </button>

            <div class="row justify-content-center">

                {{-- card_login --}}
                <div class="card_login">

                    {{-- card header --}}
                    <div class="card_header">
                        <h2>Accedi</h2>
                    </div>

                    {{-- card body --}}
                    <div class="card_body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            {{-- campo email --}}
                            <div class="mb-3 ">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                        </span>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    </div>

                                    {{-- errore lato back --}}
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- canpo password --}}
                            <div class="mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="input-group p-0 w-100">
                                    <span class="input-group-text">
                                        <i class="fa fa-key" aria-hidden="true"></i>
                                    </span>
                                    <input id="password_login" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-eye" id="visibility_password_login"></i>
                                    </span>


                                </div>

                                {{-- errore lato back --}}
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{-- se esiste questa rotta --}}
                            @if (Route::has('password.request'))
                                {{-- se clicci ti indirizza alla pagina per recupere la password --}}
                                <a class="text-white" href="{{ route('password.request') }}">
                                    {{ __('Ti sei dimenticato la password?') }}
                                </a>
                            @endif

                            <span class="d-block pt-3">
                                Non hai un account?
                                {{-- se clicci ti renderizza alla pagina di registrazione --}}
                                <a class="text-white" href="{{ route('register') }}">{{ __(' Registrati') }}</a>
                            </span>

                            <div class="my-3">
                                <div class="">
                                    {{-- campo per farti ricordare l'utente loggato --}}
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Ricordati') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            {{-- buttone per accedere --}}
                            <div class="mb-3 d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary" id="login-submit-button">
                                    Accedi
                                </button>

                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <script src="{{ asset('js/show_password.js') }}"></script>
    @endsection
