@extends('layouts.app')
@section('content')
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

    {{-- section travels front --}}
    <section id="travels_front" style="padding-left: 10px">

        <div class="container py-5">

            {{-- haeder travels front --}}
            <h2 style="color: #1e1e1e;">
                Travels
            </h2>

            {{-- separatore --}}
            <span class="separeted"></span>

            <div class="row gap-2 justify-content-between">

                @foreach ($travels as $travel)
                    {{-- card --}}
                    <div class="card p-0" style="width: 18rem;">

                        {{-- se esiste l'immagine del viaggio --}}
                        @if ($travel->image)
                            <img class="card-img-top" src="{{ asset('storage/' . $travel->image) }}"
                                alt="Immagine del viaggio {{ $travel->name }}">
                        @else
                            <img class="card-img-top" src="{{ asset('storage/img/img-deafult-travel.jpg') }}"
                                alt="immagine di default del viaggio">
                        @endif

                        {{-- card body --}}
                        <div class="card-body">
                            <h5 class="card-title">{{ $travel->name }}</h5>
                            <p class="card-text">
                                <strong>Durata: </strong>
                                {{ date_format(new DateTime($travel->date_start), 'd/m/Y') }} a
                                {{ date_format(new DateTime($travel->date_finish), 'd/m/Y') }}
                            </p>

                            {{-- se clicci ti renderizza alla pagina del singolo viaggio --}}
                            <a href="{{ route('travel', $travel) }}" class="btn btn-primary">Itinerari</a>
                        </div>
                    </div>
                @endforeach




            </div>
        </div>


    </section>
@endsection
