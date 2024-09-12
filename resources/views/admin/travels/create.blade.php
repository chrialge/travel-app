@extends('layouts.admin')

@section('content')
    <div class="container py-4" style="background-color: transparent; ">

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
                    Creazione
                </a>
            </li>
        </ul>

        {{-- INTESTAZIONE  --}}
        <div class="header_travels d-flex justify-content-between align-items-center py-4"
            style="background-color: transparent">
            <h2>Nuovo Viaggio</h2>

            {{-- bottone che porta alla pagina precednte --}}
            <a href="#" onclick="history.back()" class="btn btn-dark">
                <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
            </a>
        </div>

        {{-- parziale per la lista di errori lato back --}}
        @include('partials.validate')

        {{-- form per i campi per creare un nuovo viaggio --}}
        <form action="{{ route('admin.travels.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            {{-- campo name di travel --}}
            <div class="mb-3 form-floating">

                <input onkeyup="hide_name_error()" onblur="check_name()" type="text"
                    class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                    aria-describedby="nameHelper" value="{{ old('name') }}" placeholder="" required />
                <label for="name" class="form-label">Name *</label>
                <small id="nameHelper" class="form-text text-muted">Inserisci il nome del viaggio</small>

                {{-- span di errore lato front  --}}
                <span id="name_error" class="text-danger error_invisible" role="alert">
                    Il nome deve essere almeno di 3 caratteri e massimo 50 caratteri
                </span>

                {{-- errore lato back --}}
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

            </div>

            {{-- campo date start di travel --}}
            <div class="mb-3">
                <label for="date_range" class="form-label">Durata *</label>

                <input onkeyup="hide_date_range_error()" onblur="check_date_range()" type="date"
                    class="form-control @error('date_range') is-invalid @enderror" name="date_range" id="date_range"
                    aria-describedby="date_rangeHelper" value="{{ old('date_range') }}" placeholder="" required />



                {{-- span di errore lato front  --}}
                <span id="date_range_error" class="text-danger error_invisible" role="alert">
                    La data d'inizio e obbligatoria
                </span>

                {{-- errore lato back --}}
                @error('date_range')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <small id="date_rangeHelper" class="form-text text-muted">Inserisci la data d'inizio del viaggio</small>
            </div>

            {{-- campo image di travel --}}
            <div class="mb-3">
                <label for="image" class="form-label">scegli l'immagine</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"
                    id="image" value="{{ old('image') }}" placeholder="" aria-describedby="imageHelper" />

                {{-- errore lato back --}}
                @error('image')
                    <div class="text-danger">{{ $message }}
                    </div>
                @enderror
                <div id="imageHelper" class="form-text">Inserisci l'immagine del viaggio</div>
            </div>

            {{-- campo content di travel --}}
            <div class="form-floating mb-3">
                <textarea class="form-control" placeholder="Leave a comment here" id="content" style="height: 100px">{{ old('content') }}</textarea>
                <label for="content">Descrizione</label>

                @error('content')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="container_button d-flex justify-content-center pt-2">
                {{-- bottone di creazione --}}
                <button id="travel_btn" type="submit" class="btn btn-primary">
                    <span>CREA UN VIAGGIO</span>
                </button>
                {{-- bottone di attesa --}}
                <button id="btn_loading" type="submit" class="btn btn-primary error_invisible" disabled>
                    <span>Attendi ...</span>
                </button>
            </div>


        </form>

    </div>
@endsection

@section('script')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    @vite(['resources/js/calendar_range.js'])
    <script src="{{ asset('js/travel_validation_checker.js') }}"></script>
@endsection
