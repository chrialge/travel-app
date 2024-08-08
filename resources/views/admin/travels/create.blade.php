@extends('layouts.admin')

@section('content')
    <div class="container">

        {{-- INTESTAZIONE  --}}
        <div class="header d-flex justify-content-between align-items-center py-4">
            <h2>Nuovo Viaggio</h2>

            {{-- bottone che porta alla pagina index di travel --}}
            <a href="{{ route('admin.travels.index') }}" class="btn btn-dark">
                <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
            </a>
        </div>

        {{-- parziale per la lista di errori lato back --}}
        @include('partials.validate')

        {{-- form per i campi per creare un nuovo viaggio --}}
        <form action="{{ route('admin.travels.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            {{-- campo name di travel --}}
            <div class="mb-3">
                <label for="name" class="form-label">Name *</label>
                <input onkeyup="hide_name_error()" onblur="check_name()" type="text"
                    class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                    aria-describedby="nameHelper" value="{{ old('name') }}" placeholder="" required />

                {{-- span di errore lato front  --}}
                <span id="name_error" class="text-danger error_invisible" role="alert">
                    Il nome deve essere almeno di 3 caratteri e massimo 50 caratteri
                </span>

                {{-- errore lato back --}}
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <small id="nameHelper" class="form-text text-muted">Inserisci il nome del viaggio</small>
            </div>

            {{-- campo date start di travel --}}
            <div class="mb-3">
                <label for="date_start" class="form-label">Data d'inizio *</label>
                <input onkeyup="hide_date_start_error()" onblur="check_date_start()" type="date"
                    class="form-control @error('date_start') is-invalid @enderror" name="date_start" id="date_start"
                    aria-describedby="date_startHelper" value="{{ old('date_start') }}" placeholder="" required />

                {{-- span di errore lato front  --}}
                <span id="date_start_error" class="text-danger error_invisible" role="alert">
                    La data d'inizio e obbligatoria
                </span>

                {{-- errore lato back --}}
                @error('date_start')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <small id="date_startHelper" class="form-text text-muted">Inserisci la data d'inizio del viaggio</small>
            </div>

            {{-- campo date_finish di travel --}}
            <div class="mb-3">
                <label for="date_finish" class="form-label">Data di fine *</label>
                <input onkeyup="hide_date_finish_error()" onblur="check_date_finish()" type="date"
                    class="form-control @error('date_finish') is-invalid @enderror" name="date_finish" id="date_finish"
                    aria-describedby="date_startHelper" value="{{ old('date_finish') }}" placeholder="" required />

                {{-- errore lato back --}}
                <span id="date_finish_error" class="text-danger error_invisible" role="alert">
                    La data di fine e obbligatoria
                </span>

                {{-- errore lato back --}}
                @error('date_finish')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <small id="date_finishHelper" class="form-text text-muted">Inserisci la data di fine del viaggio</small>
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
            <div class="mb-3">
                <label for="content" class="form-label">Descrizione</label>
                <textarea class="form-control" name="content" id="content" rows="3">{{ old('content') }}</textarea>

                {{-- errore lato back --}}
                @error('content')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- bottone di creazione --}}
            <button id="create_travel_btn" type="submit" class="btn btn-primary">
                <span>CREA UN VIAGGIO</span>
            </button>
            {{-- bottone di attesa --}}
            <button id="btn_loading" type="submit" class="btn btn-primary error_invisible" disabled>
                <span>Attendi ...</span>
            </button>

        </form>
        <script src="{{ asset('js/travel_validation_checker.js') }}"></script>
    </div>
@endsection
