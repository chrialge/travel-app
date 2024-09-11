@extends('layouts.admin')

@section('content')
    <div class="container-xl py-4 h-100">

        {{-- percorso di file / breadcrumb --}}
        <ul class="d-flex gap-2 list-unstyled">
            <li>
                <a href="{{ route('admin.dashboard') }}" style="color:#1e1e1e">
                    Dashboard
                </a>
            </li>
            <li>
                <span class="text-white">
                    /
                </span>
            </li>
            <li>
                <a href="{{ route('admin.travels.index') }}" style="color:#1e1e1e">
                    Viaggi
                </a>
            </li>
            <li>
                <span class="text-white">
                    /
                </span>
            </li>
            <li>
                <a href="#" class="text-decoration-none text-white">
                    {{ $travel->slug }}
                </a>
            </li>
        </ul>


        {{-- partial for message of session --}}
        @include('partials.session')

        {{-- travel_container --}}
        <div class="travels_container d-flex justify-content-between py-5 gap-4">

            {{-- left container --}}
            <div class="left">

                {{-- se esiste l'immagine del viaggio --}}
                @if ($travel->image)
                    <img class="w-100" src="{{ asset('storage/' . $travel->image) }}"
                        alt="Immagine del viaggio {{ $travel->name }}">
                    @else{{-- altrimenti --}}
                    <img class="w-100" src="{{ asset('storage/img/img-deafult-travel.jpg') }}"
                        alt="immagine di default del viaggio">
                @endif
            </div>

            {{-- right container --}}
            <div class="right_show_travel">

                {{-- header of travel --}}
                <div class="header_travel d-flex justify-content-between align-items-center">
                    <h2 class="color_orange">{{ $travel->name }}</h2>

                    {{-- se clicci renderizza alla pagfina index del viaggio --}}
                    <a href="#" onclick="history.back()" class="btn btn-dark btn_return">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    </a>
                </div>

                {{-- info del viaggio --}}
                <div class="info_travel d-flex flex-column gap-2">
                    <span class="text-white">
                        <strong class="color_orange">Data di arrivo:</strong>
                        {{ $travel->date_start }}
                    </span>
                    <span class="text-white">
                        <strong class="color_orange">Data di partenza:</strong>
                        {{ $travel->date_finish }}
                    </span>
                    <p class="text-white">
                        <strong class="color_orange">Descrizione: </strong> <br>
                        @if ($travel->content)
                            {{ $travel->content }}
                        @else
                            N/A
                        @endif
                    </p>
                </div>
            </div>
        </div>

        {{-- step container --}}
        <div class="steps_container">

            <h3 class="text-white">Itinerario: </h3>

            {{-- la barra della data per dispositivi come tablet e pc --}}
            <div class="bar_date d-flex ">
                @foreach ($dateArray as $index => $dates)
                    @foreach ($dates as $date)
                        <a href="{{ route('admin.travels.show', [$travel, $date['value']]) }}"
                            id="date-{{ $index }}" class="date_container text-decoration-none text-white">
                            {{ $date['format'] }}
                        </a>
                    @endforeach
                @endforeach
            </div>

            {{-- la barra della data per dispositivi come telefono --}}
            <div id="bar_date_mobile">
                <div class="d-flex align-items-center gap-1">

                    {{-- data precedente --}}
                    @if (date_format(DateTime::createFromFormat('d/m/Y', $travel->date_start), 'Y-m-d') == $dateActive['value'])
                    @else
                        <a class=" text-decoration-none"
                            href="{{ route('admin.travels.show', [$travel, date_format((new DateTime($dateActive['value']))->modify('-1 day'), 'Y-m-d')]) }}">
                            <i class="fa-solid fa-caret-left" style="font-size: 23px; color:#1E1E1E"></i>
                        </a>
                    @endif

                    {{-- data seguente --}}
                    <a href="" id="date-new" class="date_container text-decoration-none text-white active">
                        {{ $dateActive['format'] }}
                    </a>

                    {{-- data seguente --}}
                    @if (date_format(DateTime::createFromFormat('d/m/Y', $travel->date_finish), 'Y-m-d') == $dateActive['value'])
                    @else
                        <a class=" text-decoration-none"
                            href="{{ route('admin.travels.show', [$travel, date_format((new DateTime($dateActive['value']))->modify('+1 day'), 'Y-m-d')]) }}">
                            <i class="fa-solid fa-caret-right" style="font-size: 23px; color:#1E1E1E"></i>
                        </a>
                    @endif
                </div>
            </div>


            <div class="container_step d-flex flex-column gap-3">


                @foreach ($steps as $step)
                    {{-- card of step --}}
                    <div class="step_card d-flex justify-content-between align-items-center">

                        {{-- left card --}}
                        <div class="left d-flex align-items-center">

                            {{-- immagine dell'itinerario --}}
                            <div class="img_step">
                                <img src="{{ asset('storage/img/no-img.png') }}" alt="immagine di deafult dell'itinerario">
                            </div>

                            {{-- info dell'itinerario --}}
                            <div class="info_step">
                                <div class="name_step">
                                    {{ $step->name }}
                                </div>
                                <div class="location">
                                    {{ $step->location }}
                                </div>

                                <div class="time">
                                    <span>da:
                                        {{ date_format(new DateTime($step->time_start), 'H:i') }}</span>
                                    <span>a:
                                        {{ date_format(new DateTime($step->time_arrived), 'H:i') }}</span>

                                </div>
                            </div>
                        </div>

                        {{-- right card --}}
                        <div class="right">
                            <a href="{{ route('admin.steps.show', $step) }}" class="btn btn-dark btn_return">
                                <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            </a>

                            {{-- se clicco mi apre la modale di cancellazione dell'itinerario --}}
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#modalId-{{ $step->id }}">
                                <i class="fa-solid fa-trash" aria-hidden="true"></i>
                            </button>

                            <!-- Modal Body -->
                            <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                            <div class="modal fade" id="modalId-{{ $step->id }}" tabindex="-1"
                                data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                aria-labelledby="modalTitleId-{{ $step->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                    role="document">
                                    <div class="modal-content">

                                        {{-- header of modal --}}
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalTitleId-{{ $step->id }}">
                                                Attenzione!
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        {{-- body of modal --}}
                                        <div class="modal-body">
                                            Sei sicuro di cancellare il viaggio, la cancellazione sara
                                            irreversibile.
                                        </div>

                                        {{-- footer of modal --}}
                                        <div class="modal-footer">
                                            <form action="{{ route('admin.steps.destroy', $step) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input type="text" class=" d-none" name="no-page" id="no-page"
                                                    value="{{ $travel->id }}">

                                                <input type="text" class=" d-none" name="travel_id" id="travel_id"
                                                    value="si">

                                                {{-- se clicco cancello l'itinerario --}}
                                                <button type="submit" class="btn btn-danger">Cancella</button>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach

                {{-- add_ step --}}
                <div class="step_add">

                    {{-- renderizza alla pagina di creazione dell'itinerario --}}
                    <a class="container d-flex justify-content-center align-items-center gap-2"
                        href="{{ route('admin.steps.create', [$travel->id, $dateActive['value']]) }}">
                        <div class="plus">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                        </div>
                        <div class="title">
                            AGGIUNGI ITINERARIO
                        </div>
                    </a>
                </div>


            </div>

        </div>
        <div id="map_step" class="map_step_back" data-lon="{{ $arrayLong }}" data-lat="{{ $arrayLat }}"
            data-time="{{ $timeArray }}">
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
        <script src="{{ asset('js/bar_date.js') }}"></script>
    </div>
@endsection


@section('script')
    @vite(['resources/js/map_routing.js'])
    <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.5.0/maps/maps.css'>
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.5.0/maps/maps-web.min.js"></script>
@endsection
