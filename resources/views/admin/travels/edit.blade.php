@extends('layouts.admin')

@section('content')
    <div class="container">

        <div class="header d-flex justify-content-between align-items-center py-4">
            <h2>Modifica Viaggio</h2>

            <a href="{{ route('admin.travels.index') }}" class="btn btn-dark">
                <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
            </a>
        </div>

        @include('partials.validate')


        <form action="{{ route('admin.travels.update', $travel) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Name *</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                    aria-describedby="nameHelper" value="{{ old('name', $travel->name) }}" placeholder="" required />
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <small id="nameHelper" class="form-text text-muted">Inserisci il nome del viaggio</small>
            </div>

            <div class="mb-3">
                <label for="date_start" class="form-label">Data d'inizio *</label>
                <input type="date" class="form-control @error('date_start') is-invalid @enderror" name="date_start"
                    id="date_start" aria-describedby="date_startHelper" value="{{ old('date_start', $travel->date_start) }}"
                    placeholder="" required />
                @error('date_start')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <small id="date_startHelper" class="form-text text-muted">Inserisci la data d'inizio del viaggio</small>
            </div>

            <div class="mb-3">
                <label for="date_finish" class="form-label">Data di fine *</label>
                <input type="date" class="form-control @error('date_finish') is-invalid @enderror" name="date_finish"
                    id="date_finish" aria-describedby="date_startHelper"
                    value="{{ old('date_finish', $travel->date_finish) }}" placeholder="" required />
                @error('date_finish')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <small id="date_finishHelper" class="form-text text-muted">Inserisci la data di fine del viaggio</small>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">scegli l'immagine</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"
                    id="image" value="{{ old('image', $travel->image) }}" placeholder=""
                    aria-describedby="imageHelper" />
                @error('image')
                    <div class="text-danger">{{ $message }}
                    </div>
                @enderror
                <div id="imageHelper" class="form-text">Inserisci l'immagine del viaggio</div>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Descrizione</label>
                <textarea class="form-control" name="content" id="content" rows="3">{{ old('content', $travel->content) }}</textarea>
                @error('content')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-warning my-3">
                <span>MODIFICA VIAGGIO</span>
            </button>

        </form>
    </div>
@endsection
