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

    {{-- travels front section --}}
    <section id="travels_front" class="py-5" style="padding-left: 10px; padding-right: 10px">

        <div class="container bg-white py-3 rounded-3">

            {{-- header of travels front --}}
            <h2 style="color: #E25B07; padding-bottom: 10px">{{ $travel->name }}</h2>

            {{-- img of travels front --}}
            <div class="img_travel">
                {{-- se esiste l'immagine del viaggio --}}
                @if ($travel->image)
                    <img class="card-img-top" src="{{ asset('storage/' . $travel->image) }}"
                        alt="Immagine del viaggio {{ $travel->name }}">
                @else
                    {{-- altrimenti --}}

                    <img class="card-img-top" src="{{ asset('storage/img/img-deafult-travel.jpg') }}"
                        alt="immagine di default del viaggio">
                @endif
            </div>

            {{-- info del viaggio --}}
            <div class="info_travel">
                <span>
                    <strong>Durata:</strong>
                    {{ $travel->date_start }}
                    <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                    {{ $travel->date_finish }}
                </span>
                <p>
                    <strong class="color_orange">Descrizione: </strong> <br>
                    @if ($travel->content)
                        {{ $travel->content }}
                    @else
                        N/A
                    @endif

                </p>
            </div>

            {{-- step container --}}
            <div id="steps_container_row" class="row gap-2 justify-content-between px-1">
                @forelse ($steps as $step)
                    {{-- card step --}}
                    <div class="card card_step p-0" style="width: 18rem;">

                        {{-- se clicco mi renderizza alla pagina che mostra il singolo itinerario  --}}
                        <a href="{{ route('step', $step) }}" class=" text-decoration-none text-dark">
                            <img class="card-image-top p-2 w-100" src="{{ asset('storage/img/no-img.png') }}"
                                alt="immagine di deafult dell'itinerario">
                        </a>

                        {{-- card body --}}
                        <div class="card-body">
                            <h5 class="card-title">{{ $step->name }}</h5>
                            <span class=" card-text">
                                {{ date_format(new DateTime($step->date), 'd M') }}
                            </span>
                            <p class="card-text">
                                <strong>Description: </strong>
                                @if ($step->description)
                                    {{ $step->description }}
                                @else
                                    N/A
                                @endif
                            </p>
                        </div>

                        {{-- parte for rating --}}
                        <ul class="list-group list-group-flush">

                            {{-- se ce almeno un voto --}}
                            @if (count($step->votes) > 0)
                                <li class="list-group-item">
                                    voto {{ round($step->votes->avg('vote'), 2) }}
                                </li>
                            @endif

                            {{-- mostra il voto che vorresti dare --}}
                            <li class="list-group-item d-flex justify-content-between">
                                <div class="conatiner_stars d-flex gap-1">
                                    @for ($i = 1; $i < 6; $i++)
                                        <div onclick="rating({{ $i }}, {{ $step->id }})"
                                            id="rating{{ $i }}" class="star-rating-{{ $step->id }} stars"
                                            role="rating">

                                            <i class="fa fa-star" aria-hidden="true"></i>


                                        </div>
                                    @endfor
                                </div>

                                {{-- per confermare il voto --}}
                                <form action="{{ route('vote', $step) }}" method="post" class="">
                                    @csrf
                                    <input class="d-none" type="number" name="vote" id="vote-{{ $step->id }}">
                                    <button type="submit" class="border-0 bg-white">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                    </button>

                                </form>
                            </li>

                        </ul>

                    </div>
                @empty
                @endforelse
            </div>






        </div>


        <script src="{{ asset('js/rating_star.js') }}"></script>
    </section>
@endsection
