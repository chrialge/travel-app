@extends('layouts.admin')

@section('content')
    <div class="container py-4 d-flex gap-3">
        <div class="left" style="max-width: 500px; width:80%;">
            <div class="header_step d-flex justify-content-between align-items-center">
                <h2>{{ $step->name }}</h2>
                <a href="{{ route('admin.steps.index') }}" class="btn btn-dark">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                </a>
            </div>
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
        <div class="right w-100">
            @if ($step->image)
                <img class="w-100" src="{{ asset('strorage/' . $step->image) }}"
                    alt="imagine dell'itinerario {{ $step->name }}">
            @else
                <img class="w-100" src="{{ asset('storage/img/img-deafult-travel.jpg') }}"
                    alt="immagine di default del itinerario">
            @endif
        </div>
    </div>
@endsection
