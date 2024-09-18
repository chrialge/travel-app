@extends('layouts.app')
@section('content')
    @include('partials.session')
    <style>
        .tt-side-panel__header {
            box-shadow: 0 4px 16px rgba(0, 0, 0, .1);
            z-index: 2;
        }

        .tt-filters-container.tail-select-container .select-handle.disabled::after {
            background-image: none;
        }

        .result-card {
            background-color: #ffffff;
        }

        .basic-info-container {
            padding: 15px;
        }

        .poi-name {
            font-weight: bold;
            margin-top: 25px;
        }

        .data-label {
            color: #808080;
            font-size: 12px;
            margin-top: 10px;
        }

        .contact .data-label {
            color: #626262;
            font-size: 12px;
            margin-top: 25px;
        }

        .reviews .data-label {
            margin-top: 25px;
        }

        .reviews-container {
            color: #444444;
            font-size: 12px;
            margin-top: 10px;
        }

        .review-item {
            margin-top: 15px;
        }

        .website-item {
            margin-top: 5px;
        }

        .website-item a {
            color: #1692e4;
        }

        .review-text {
            color: #808080;
            font-style: italic;
            margin-top: 5px;
        }

        .data-segment {
            border-bottom: 1px solid rgba(0, 0, 0, .14);
            padding: 0 15px 15px;
            width: 100%;
        }

        .address,
        .hours-container,
        .phone-number {
            color: #505050;
            font-size: 14px;
            font-weight: bold;
            margin-top: 4px;
        }

        .popup-container {
            font-family: Gotham, Helvetica, Arial, sans-serif;
            margin: -30px -10px -15px;
        }

        .popup-container .popup-text {
            padding: 0 17px 10px;
        }

        .popup-container .popup-text .poi-name {
            font-size: 15px;
            font-weight: bold;
            margin-top: 10px;
        }

        .popup-container img {
            width: 100%;
        }

        .time-range {
            float: right;
        }

        .hours-range {
            margin-top: 5px;
        }

        .social-media-icon {
            background-size: 14px;
            float: left;
            height: 16px;
            margin-top: 2px;
            padding-top: 3px;
            width: 16px;
        }

        .website-link {
            display: inline-block;
            overflow: hidden;
            padding-left: 7px;
            text-overflow: ellipsis;
            white-space: nowrap;
            width: 260px;
        }

        .foursquare-text {
            background-color: #f2f2f2;
            bottom: 0;
            box-shadow: 0 0 5px 0 rgba(0, 0, 0, .22);
            color: #4a4c4c;
            font-size: 12px;
            line-height: 1.5;
            padding: 2px 0;
            text-align: center;
            width: 100%;
            z-index: 2;
        }
    </style>


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
    <section id="step_front" class="py-5">
        <div class="container py-4">

            {{-- header step front --}}
            <h2 class="card-title text-center py-3 ">
                {{ $step->name }}
            </h2>

            <div class="container_step_front d-flex " style="flex-wrap: wrap">

                {{-- left container --}}
                <div class="img_container_step">

                    {{-- img --}}
                    <img class="card-image-top p-2 w-100" src="{{ asset('storage/img/no-img.png') }}"
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
                <div class="map_container map_container_step_front">
                    <div id="map_step" class="map_step_back" data-lon="{{ $longitude }}" data-lat="{{ $latitude }}">
                        <div id="poiBoxInfo" class="poi">
                            <div id="poiname"></div><br>
                            <div class="image_poi">
                                <img src="{{ asset('storage/img/planning.png') }}" alt="">
                            </div>
                            <div id="poicategories"></div><br>
                            <div id="poiphone">

                            </div>
                            <br>

                            <div id="poiaddress">

                            </div>
                            <br>
                            <div id="url"></div><br>
                            <img id="currentPhoto">
                        </div>
                    </div>
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

            <div class="notes  ps-3">
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




    </section>
@endsection

@section('script')
    @vite(['resources/js/map.js'])
    <script src="{{ asset('js/note_validation.js') }}"></script>

    <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.5.0/maps/maps.css'>
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.5.0/maps/maps-web.min.js"></script>
@endsection
