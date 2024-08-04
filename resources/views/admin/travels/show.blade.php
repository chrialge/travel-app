@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="travels_container d-flex justify-content-between py-5">
            <div class="left">
                <img src="{{ asset('storage/' . $travel->image) }}" alt="">
            </div>
            <div class="right" style="max-width: 500px">
                <h2>{{ $travel->name }}</h2>
                <div class="info_travel d-flex flex-column gap-2">
                    <span>
                        <strong>Data di arrivo:</strong>
                        {{ $travel->date_start }}
                    </span>
                    <span>
                        <strong>Data di partenza:</strong>
                        {{ $travel->date_finish }}
                    </span>
                    <p>
                        <strong>Descrizione: </strong> <br>
                        {{ $travel->content }}

                    </p>
                </div>
            </div>
        </div>
        <div class="steps_container">
            <h3>Itinerario: </h3>
            <div class="bar_date">

            </div>

            @foreach ($travel->steps as $step)
                {{ $step->name }}
            @endforeach
        </div>

    </div>
@endsection
