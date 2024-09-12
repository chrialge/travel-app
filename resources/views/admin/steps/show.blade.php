@extends('layouts.admin')

@section('content')
    <div class="container py-4">

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
                <a href="{{ route('admin.steps.index') }}" style="color:#1e1e1e">
                    Itinerari
                </a>
            </li>
            <li>
                <span class="text-white">
                    /
                </span>
            </li>
            <li>
                <a href="#" class="text-decoration-none text-white">
                    {{ $step->slug }}
                </a>
            </li>
        </ul>

        {{-- header  --}}
        <div class="header_step d-flex justify-content-between align-items-center w-100 py-3">
            <h2>{{ $step->name }}</h2>

            {{-- renderizza alla pagina precedente --}}
            <div class="action_btn">
                <a href="#" onclick="history.back()" class="btn btn-dark">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                </a>
                <a href="{{ route('admin.steps.edit', $step) }}" class="btn btn-warning">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                </a>
            </div>

        </div>

        {{-- step_container --}}
        <div class="d-flex show_steps gap-2 mb-3">

            {{-- left container --}}
            <div class="left_image_show w-100">

                {{-- se esiste l'immagine dell'itinerario --}}
                @if ($step->image)
                    <img class="w-100" src="{{ asset('storage/' . $step->image) }}"
                        alt="imagine dell'itinerario {{ $step->name }}">
                    @else{{-- altrimenti --}}
                    <img class="w-100" src="{{ asset('storage/img/img-deafult-travel.jpg') }}"
                        alt="immagine di default del itinerario">
                @endif
            </div>

            {{-- right container --}}
            <div class="right_info_show">

                {{-- informazioni dello step --}}
                <div class="step_info d-flex flex-column gap-2">
                    <span>
                        <strong class="pe-1">Del viaggio: </strong>
                        {{ $step->travel->name }}
                    </span>
                    <span>
                        <strong class="pe-1">Data: </strong>
                        {{ date_format(new DateTime($step->date), 'd/m/Y') }}
                    </span>
                    <span>
                        <strong class="pe-1">Indirizzo: </strong>
                        {{ $step->location }}
                    </span>

                    <div class="time_container d-flex justify-content-between">
                        <span>
                            <strong class="pe-1">Inizia: </strong>
                            {{ date_format(new DateTime($step->time_start), 'H:i') }}
                        </span>
                        <span>
                            <strong class="pe-1">Finisce: </strong>
                            {{ date_format(new DateTime($step->time_arrived), 'H:i') }}
                        </span>
                    </div>

                    <div class="rating">
                        <span class="pe-1">Voto: </span>
                        {{-- @dd(round($step->votes->avg('vote'))) --}}
                        @for ($i = 0; $i < round($step->votes->avg('vote'), 0); $i++)
                            <i class="fa fa-star" aria-hidden="true" style="color: #E25B07"></i>
                        @endfor
                        @for ($i = round($step->votes->avg('vote')); $i < 5; $i++)
                            <i class="fa fa-star" aria-hidden="true" style="color: white"></i>
                        @endfor
                        <span class="ps-1"> {{ round($step->votes->avg('vote'), 0) }}/5</span>
                    </div>

                    <p>
                        <strong>Description: </strong>
                        @if ($step->description)
                            {{ $step->description }}
                        @else
                            N/A
                        @endif

                    </p>
                </div>
            </div>
        </div>

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

        @if (count($step->notes) == 1)
            <section id="show_notes" class="px-1">
                @if (count($step->notes) > 1)
                @endif
                <h3>Nota</h3>

                {{-- separatore --}}
                <span class="separeted"></span>

                <div class="row">
                    @foreach ($step->notes as $note)
                        <div class="card_note w-100">

                            {{-- top note --}}
                            <div class="top_note d-flex justify-content-between align-items-center row">

                                {{-- left top note --}}
                                <div class="left d-flex align-items-center gap-2 ">

                                    {{-- container img --}}
                                    <div class="container_img">
                                        <img src="{{ asset('storage/img/user.png') }}" alt="">
                                    </div>

                                    {{-- info user --}}
                                    <div class="info_user">
                                        <h4>{{ $note->customer_name . ' ' . $note->customer_lastname }}</h4>
                                        <span>{{ $note->customer_email }}</span>
                                    </div>
                                </div>

                                {{-- right note top --}}
                                <div class="right d-flex flex-column ">
                                    <span>{{ date_format(new DateTime($note->created_at), 'd/m/Y') }}</span>
                                    <span
                                        class=" text-end">{{ date_format(new DateTime($note->created_at), 'h:m') }}</span>
                                </div>
                            </div>

                            {{-- botton note --}}
                            <div class="bottom_note">
                                <p>
                                    <strong>Nota: </strong>
                                    {{ $note->note }}
                                </p>
                            </div>

                        </div>
                    @endforeach

                </div>
            </section>
        @endif



    </div>
@endsection

@section('script')
    @vite(['resources/js/map.js'])
    <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.5.0/maps/maps.css'>
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.5.0/maps/maps-web.min.js"></script>
@endsection
