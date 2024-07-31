@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Registrazione') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-4 row">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Nome *') }}</label>

                                <div class="col-md-6">
                                    <input onkeyup="hide_name_error()" onblur="check_name()" id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    <span id="name_error" class="text-danger error_invisible">
                                        Il nome deve essere almeno di 3 caratteri
                                    </span>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="lastname"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Cognome *') }}</label>

                                <div class="col-md-6">
                                    <input onkeyup="hide_lastname_error()" onblur="check_lastname()" id="lastname"
                                        type="text" class="form-control @error('lastname') is-invalid @enderror"
                                        name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname"
                                        autofocus>

                                    <span id="lastname_error" class="text-danger error_invisible">
                                        Il cognome deve essere almeno di 3 caratteri
                                    </span>
                                    @error('lastname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail *') }}</label>

                                <div class="col-md-6">
                                    <input onkeyup="hide_email_error()" onblur="check_email()" id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    <span id="email_error" class="text-danger error_invisible">
                                        L'email deve essere almeno di 3 caratteri e contenere un @
                                    </span>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password *') }}</label>

                                <div class="col-md-6">
                                    <div class="password_container">
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

                            <div class="mb-4 row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Conferma Password *') }}</label>

                                <div class="col-md-6">
                                    <div class="password_container">
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

                            <div class="mb-4 row mb-0">
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
    </div>

    <script src="{{ asset('js/validation_checker.js') }}"></script>
@endsection
