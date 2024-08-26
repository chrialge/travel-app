@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class="fs-4 text-secondary my-4">
            {{ __('Dashboard') }}
        </h2>
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('User Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="top_card_body d-flex justify-content-between gap-1" style="flex-wrap:wrap">
                            {{-- travels --}}
                            <div class="travel_dashboard">
                                <h3>l'ultimi Viaggi</h3>

                                <table class="table table-striped table-inverse table-responsive">
                                    <thead class="thead-inverse">
                                        <tr>
                                            <th style="width:100px"></th>
                                            <th>nome</th>
                                            <th>durata</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($travels as $travel)
                                            <tr>
                                                <td scope="row">
                                                    @if ($travel->image)
                                                        <img src="{{ asset('storage/' . $travel->image) }}"
                                                            alt="Immagine del viaggio {{ $travel->name }}" width="70">
                                                        @else{{-- altrimenti --}}
                                                        <img src="{{ asset('storage/img/img-deafult-travel.jpg') }}"
                                                            alt="immagine di default del viaggio" width="70">
                                                    @endif
                                                </td>
                                                <td>{{ $travel->name }}</td>
                                                <td>
                                                    da
                                                    {{ date_format(date_create($travel->date_start), 'd/m') }}
                                                    a
                                                    {{ date_format(date_create($travel->date_finish), 'd/m') }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td scope="row" colspan="3">Non ci sono viaggi programmati</td>
                                            </tr>
                                        @endforelse


                                    </tbody>
                                </table>
                            </div>

                            {{-- steps  --}}
                            <div class="steps_dashboard">
                                <h3>Itinerari con piu voti</h3>
                                <table class="table table-striped table-inverse table-responsive">
                                    <thead class="thead-inverse">
                                        <tr>
                                            <th>nome</th>
                                            <th>data</th>
                                            <th class=" d-none d-sm-block">viaggio</th>
                                            <th>voto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($steps as $step)
                                            <tr>
                                                <td scope="row">{{ $step->name }}</td>
                                                <td>{{ date_format(date_create($step->date), 'd/m/Y') }}</td>
                                                <td class=" d-none d-sm-block">{{ $step->travel->name }}</td>
                                                <td>
                                                    {{ $step->votes->avg('vote') }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td scope="row" colspan="4">Non ci sono itinerari con voti</td>
                                            </tr>
                                        @endforelse


                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="bottom_card_body pt-5">
                            <h3>Ultime note</h3>
                            @forelse ($notes as $note)
                                <div class="card_note w-100">

                                    {{-- top note --}}
                                    <div class="top_note d-flex justify-content-between align-items-center row">

                                        {{-- left top note --}}
                                        <div class="left d-flex align-items-center gap-2 " style="flex-wrap: wrap">

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
                                            <span>{{ date_format(date_create($note->created_at), 'd/m') }}</span>
                                            <span
                                                class=" text-end">{{ date_format(date_create($note->created_at), 'H:i') }}</span>
                                        </div>
                                    </div>

                                    {{-- botton note --}}
                                    <div class="bottom_note">
                                        <p>
                                            <strong>Nota: </strong>
                                            {{ $note->note }}
                                        </p>
                                        <span>{{ $note->step->name }}</span>
                                    </div>

                                </div>
                            @empty
                                Non hai nessuna nota
                            @endforelse

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
