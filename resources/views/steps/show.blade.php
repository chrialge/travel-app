@extends('layouts.app')
@section('content')
    @include('partials.session')

    {{-- jumbotron section --}}
    <section id="jumbotron">
        <div class="p-5 text-center">
            <div class="container-md py-5 bg-white">
                <h1 class="" style="color: #E25B07;">Benvenuto a TravelBoo</h1>
                <p class="col-lg-8 mx-auto lead">
                    una web app in cui puoi vedere i viaggi con i suoi itinerari, in caso puoi mettere una nota al
                    itinerario e un voto ed ogni itinaraio ce la locazione
                </p>
            </div>
        </div>
    </section>

    {{-- step front section --}}
    <section id="step_front" class="py-5" style="padding-left: 10px">
        <div class="container py-4">

            {{-- header step front --}}
            <h2 class="card-title text-center py-3 ">
                {{ $step->name }}
            </h2>

            <div class="container_step_front d-flex p-2">

                {{-- left container --}}
                <div class="img_container_step">

                    {{-- img --}}
                    <img class="card-image-top p-2 " src="{{ asset('storage/img/no-img.png') }}"
                        alt="immagine di deafult dell'itinerario">

                    {{-- info dell'itinerario --}}
                    <div class="info_container_step">
                        <div class="time_date">
                            <p>
                                Questo itinerario si svolgera {{ date_format(new DateTime($step->date), 'd M Y') }} dall'ora
                                {{ date_format(new DateTime($step->time_start), 'H:m') }} fino alle
                                {{ date_format(new DateTime($step->time_arrived), 'H:m') }}
                            </p>
                        </div>

                        @if (count($step->votes) > 0)
                            <span>
                                <strong>Voto: </strong> {{ round($step->votes->avg('vote'), 2) }}
                            </span>
                        @endif

                        <p>
                            <strong>Descrizione evento: </strong>
                            @if ($step->description)
                                {{ $step->description }}
                            @else
                                N/A
                            @endif
                        </p>

                    </div>
                </div>

                {{-- right container --}}
                <div id="tom_tom" data-longitude="{{ $longitude }}" data-latitude="{{ $latitude }}">
                    {{-- <img src="{{ 'data:image/png;base64,' . base64_encode($gesu) }}" alt="" style="width: 100%"> --}}
                    {{--  --}}
                </div>

            </div>

            {{-- haeder della parte delle note  --}}
            <h3 class="pt-4" style="color: #1e1e1e;">
                Note
            </h3>

            {{-- se clicci compare la modale di creazione della nota --}}
            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                data-bs-target="#modal-{{ $step->id }}">
                <i class="fa fa-plus" aria-hidden="true"></i>
                <span>aggiungi nota</span>
            </button>

            {{-- separatore --}}
            <span class="separeted my-3"></span>

            <div class="notes w-50 ps-3">
                @forelse ($step->notes as $note)
                    {{-- container of note --}}
                    <div class="note_container d-flex gap-2 mb-2">

                        {{-- left note --}}
                        <div class="left_note">
                            <img src="{{ asset('storage/img/user.png') }}" alt="" width="40">
                        </div>

                        {{-- right note --}}
                        <div class="right_note flex-grow-1">

                            <div class="header_note d-flex justify-content-between">
                                <div class="name_customer">
                                    <strong>{{ $note->customer_name }} {{ $note->customer_lastname }}</strong>
                                </div>
                                <div class="date_note">
                                    <span>
                                        {{ date_format(new DateTime($note->created_at), 'd/m') }}
                                    </span>

                                </div>
                            </div>


                            <div class="content_note">
                                {{ $note->note }}
                            </div>
                            <div class="time_note text-end">
                                <span>
                                    {{ date_format(new DateTime($note->created_at), 'H:m') }}
                                </span>
                            </div>

                        </div>
                    </div>

                @empty
                    {{-- container of note --}}
                    <div class="note_container d-flex gap-2">

                        {{-- left note --}}
                        <div class="left_note">
                            <img src="{{ asset('storage/img/user.png') }}" alt="" width="40">
                        </div>

                        {{-- right note --}}
                        <div class="right_note flex-grow-1">

                            <div class="header_note d-flex justify-content-between">
                                <div class="name_customer">
                                    <strong>Francesco</strong>
                                </div>
                                <div class="date_note">
                                    <span>
                                        10/08
                                    </span>

                                </div>
                            </div>


                            <div class="content_note">
                                mi e piaciuto il viaggio
                            </div>
                            <div class="time_note text-end">
                                <span>
                                    10:40
                                </span>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>


        </div>


        <!-- Modal Body -->
        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
        <div class="modal fade " id="modal-{{ $step->id }}" tabindex="-1" data-bs-backdrop="static"
            data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitle-{{ $step->id }}" aria-hidden="true">
            <div class=" modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                <div class="modal-content modal_note">

                    {{-- header of header --}}
                    <div class="modal-header justify-content-between align-items-center">
                        <h5 class="modal-title" id="modalTitle-{{ $step->id }}">
                            Aggiungi Nota
                        </h5>
                        <button type="button" class="close_modal" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-close" aria-hidden="true"></i>
                        </button>
                    </div>

                    {{-- body of modal --}}
                    <div class="modal-body">
                        <form action="{{ route('note', $step->id) }}" method="post">
                            @csrf

                            {{-- campo customer_name --}}
                            <div class="form-floating mb-3">
                                <input type="text" onkeyup="hide_name_error()" onblur="check_name()"
                                    class="form-control @error('customer_name') is-invalid @enderror" name="customer_name"
                                    id="customer_name" placeholder="Password" value="{{ old('customer_name') }}">
                                <label for="name">Nome</label>

                                {{-- errore lato front --}}
                                <span id="name_error" class="text-danger error_invisible" role="alert">
                                    Il nome deve essere almeno di 3 caratteri e massimo 50 caratteri
                                </span>

                                {{-- errore lato back --}}
                                @error('customer_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- campo customer_lastname --}}
                            <div class="form-floating mb-3">
                                <input type="text" onkeyup="hide_lastname_error()" onblur="check_lastname()"
                                    class="form-control @error('customer_lastname') is-invalid @enderror"
                                    name="customer_lastname" id="customer_lastname" placeholder="Password"
                                    value="{{ old('customer_lastname') }}">
                                <label for="name">Cognome</label>

                                {{-- errore lato front --}}
                                <span id="lastname_error" class="text-danger error_invisible" role="alert">
                                    Il cognome deve essere almeno di 3 caratteri e massimo 50 caratteri
                                </span>

                                {{-- errore lato back --}}
                                @error('customer_lastname')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- campo customer_email --}}
                            <div class="form-floating mb-3">
                                <input type="email" onkeyup="hide_email_error()" onblur="check_email()"
                                    class="form-control @error('customer_email') is-invalid @enderror"
                                    name="customer_email" id="customer_email" placeholder="name@example.com"
                                    value="{{ old('customer_email') }}">
                                <label for="customer_email">Email address</label>

                                {{-- errore lato front --}}
                                <span id="email_error" class="text-danger error_invisible">
                                    L'email deve essere almeno di 3 caratteri e contenere un @
                                </span>

                                {{-- errore lato back --}}
                                @error('customer_email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- campo note --}}
                            <div class="form-floating">
                                <textarea name="note" onkeyup="hide_note_error()" onblur="check_note()"
                                    class="form-control @error('note') is-invalid @enderror" placeholder="Leave a comment here" id="note"
                                    style="height: 100px">{{ old('note') }}</textarea>
                                <label for="note">Nota</label>

                                {{-- errore lato front --}}
                                <span id="note_error" class="text-danger error_invisible">
                                    deve contenere minimo 5 caratteri
                                </span>

                                {{-- errore lato back --}}
                                @error('note')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- bottone di creazione della nota --}}
                            <button id="create_note_btn" type="submit" class="btn my-3 create_note_btn">
                                crea nuova nota
                            </button>

                            {{-- bottone di caricamento della procedura di creazione della nota --}}
                            <button id="btn_loading" class="btn my-3 create_note_btn error_invisible" disabled>
                                Attendi...
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.25.1/maps/maps-web.min.js'></script>

        <script src="{{ asset('js/note_validation.js') }}"></script>
        <link rel='stylesheet' type='text/css'
            href='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.5.0/maps/maps.css'>
        <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.5.0/maps/maps-web.min.js"></script>

    </section>
@endsection
