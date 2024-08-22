@extends('layouts.admin')

@section('content')
    <div class="container py-1">

        {{-- header  --}}
        <div class="header_step d-flex justify-content-between align-items-center w-100 py-3">
            <h2>{{ $step->name }}</h2>

            {{-- renderizza alla pagina index dell'itineraio --}}
            <a href="{{ route('admin.steps.index') }}" class="btn btn-dark">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
            </a>
        </div>

        {{-- step_container --}}
        <div class="d-flex show_steps">

            {{-- left container --}}
            <div class="left_image_show w-100">

                {{-- se esiste l'immagine dell'itinerario --}}
                @if ($step->image)
                    <img class="w-100" src="{{ asset('strorage/' . $step->image) }}"
                        alt="imagine dell'itinerario {{ $step->name }}">
                    @else{{-- altrimenti --}}
                    <img class="w-100" src="{{ asset('storage/img/img-deafult-travel.jpg') }}"
                        alt="immagine di default del itinerario">
                @endif
            </div>

            {{-- right container --}}
            <div class="right_info_show" style="max-width: 500px; width:80%;">

                {{-- informazioni dello step --}}
                <div class="step_info d-flex flex-column gap-2">
                    <span>
                        <strong>Del viaggio: </strong>
                        {{ $step->travel->name }}
                    </span>
                    <span>
                        <strong>Data: </strong>
                        {{ $step->date }}
                    </span>
                    <span>
                        <strong>Indirizzo: </strong>
                        {{ $step->location }}
                    </span>
                    <div class="time_container d-flex justify-content-between">
                        <span>
                            <strong>Inizia: </strong>
                            {{ $step->time_start }}
                        </span>
                        <span>
                            <strong>Finisce: </strong>
                            {{ $step->time_arrived }}
                        </span>
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


    </div>
@endsection
