@extends('layouts.account')

@section('content')
    <div class="container-fluid mt-4 flex-column d-flex align-items-center gap-4">
        <h1>TRAVELBOO</h1>
        <div class="row justify-content-center w-100">
            <button class="button_return" onclick="history.back()">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
            </button>

            <div class="card_register">
                <div class="card_header">
                    <h2>{{ __('Registrazione') }}</h2>
                </div>

                <div class="card_body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="col-form-label text-md-right">{{ __('Nome *') }}</label>

                            <div id="input_group_name" class="input-group">
                                <span class="input-group-text">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </span>
                                <input onkeyup="hide_name_error()" onblur="check_name()" id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus>

                            </div>

                            <span id="name_error" class="text-danger error_invisible">
                                Il nome deve essere almeno di 3 caratteri
                            </span>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="lastname" class="col-form-label text-md-right">{{ __('Cognome *') }}</label>

                            <div id="input_group_lastname" class="input-group">
                                <span class="input-group-text">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </span>
                                <input onkeyup="hide_lastname_error()" onblur="check_lastname()" id="lastname"
                                    type="text" class="form-control @error('lastname') is-invalid @enderror"
                                    name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname"
                                    autofocus>

                            </div>


                            <span id="lastname_error" class="text-danger error_invisible">
                                Il cognome deve essere almeno di 3 caratteri
                            </span>
                            @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="col-form-label text-md-right">{{ __('E-Mail *') }}</label>

                            <div id="input_group_email" class="input-group">
                                <span class="input-group-text">
                                    <i class="fa-solid fa-envelope"></i>
                                </span>
                                <input onkeyup="hide_email_error()" onblur="check_email()" id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email">

                            </div>


                            <span id="email_error" class="text-danger error_invisible">
                                L'email deve essere almeno di 3 caratteri e contenere un @
                            </span>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="col-form-label text-md-right">{{ __('Password *') }}</label>

                            <div class="">

                                <div id="input_group_password" class="password_container input-group">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-key"></i>
                                    </span>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password" onkeyup="hide_password_error()"
                                        onblur='check_pw();'>
                                    <i class="fa-solid fa-eye" id="visibilityBtn"></i>
                                </div>


                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password-confirm"
                                class="col-form-label text-md-right">{{ __('Conferma Password *') }}</label>

                            <div class="">
                                <div id="input_group_password_confirm" class="password_container input-group">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-key"></i>
                                    </span>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password"
                                        onkeyup="hide_password_error()" onblur='check_pw();'>
                                    <i class="fa-solid fa-eye" id="visibilityBtn_confirm"></i>
                                </div>

                                <small id="password_error" class="text-danger error_invisible">
                                    La password non coincide.
                                </small>
                            </div>
                        </div>
                        <span class="d-flex gap-1 pb-3">
                            Hai gia un account? <a class="text-white" href="{{ route('login') }}">Accedi</a>
                        </span>

                        <div class="mb-3 row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" id="register-submit-button">
                                    {{ __('Registrati') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <script src="{{ asset('js/validation_checker.js') }}"></script>
@endsection
