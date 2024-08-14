@extends('layouts.admin')

@section('content')
    <div class="container-xl py-4 h-100">
        <div class="travels_container d-flex justify-content-between py-5 gap-4">
            <div class="left">
                @if ($travel->image)
                    <img class="w-100" src="{{ asset('storage/' . $travel->image) }}"
                        alt="Immagine del viaggio {{ $travel->name }}">
                @else
                    <img class="w-100" src="{{ asset('storage/img/img-deafult-travel.jpg') }}"
                        alt="immagine di default del viaggio">
                @endif
            </div>
            <div class="right_show_travel">
                <div class="header_travel d-flex justify-content-between align-items-center">
                    <h2 class="color_orange">{{ $travel->name }}</h2>
                    <a href="{{ route('admin.travels.index') }}" class="btn btn-dark btn_return">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    </a>
                </div>

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
        <div class="steps_container">
            <h3 class="text-white">Itinerario: </h3>
            <div class="bar_date d-flex ">

                @foreach ($dateArray as $index => $dates)
                    @foreach ($dates as $date)
                        <a href="{{ route('admin.travels.show', [$travel, $date['value']]) }}" id="date-{{ $index }}"
                            class="date_container text-decoration-none text-white">
                            {{ $date['format'] }}
                        </a>
                    @endforeach
                @endforeach



            </div>
            <div id="bar_date_mobile">
                <div class="d-flex align-items-center gap-1">

                    @if (date_format(DateTime::createFromFormat('d/m/Y', $travel->date_start), 'Y-m-d') == $dateActive['value'])
                    @else
                        <a class=" text-decoration-none"
                            href="{{ route('admin.travels.show', [$travel, date_format((new DateTime($dateActive['value']))->modify('-1 day'), 'Y-m-d')]) }}">
                            <i class="fa-solid fa-caret-left" style="font-size: 23px; color:#1E1E1E"></i>
                        </a>
                    @endif


                    <a href="" id="date-new" class="date_container text-decoration-none text-white active">
                        {{ $dateActive['format'] }}
                    </a>
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
                @foreach ($step as $step)
                    <div class="step_card d-flex justify-content-between align-items-center">
                        <div class="left d-flex align-items-center">
                            <div class="img_step">
                                <img src="{{ asset('storage/img/no-img.png') }}" alt="immagine di deafult dell'itinerario">
                            </div>
                            <div class="info_step">
                                <div class="name_step">
                                    {{ $step->name }}

                                </div>
                                <div class="vote">
                                    @for ($i = 0; $i < 5; $i++)
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <div class="right">
                            <a href="{{ route('admin.steps.show', $step) }}" class="btn btn-dark btn_return">
                                <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            </a>
                        </div>

                    </div>
                @endforeach
                <div class="step_add">
                    <a class="container d-flex justify-content-center align-items-center gap-2"
                        href="{{ route('admin.steps.create', $travel->id) }}">
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
        <script src="{{ asset('js/bar_date.js') }}"></script>
    </div>
@endsection
