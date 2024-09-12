@extends('layouts.admin')

@section('content')
    <div class="container py-4">

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
                <a href="{{ route('admin.steps.index') }}" style="color:#1e1e1e">
                    Itinerari
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

        {{-- header  --}}
        <div class="header_create_step d-flex justify-content-between align-items-center">
            <h2>Crea un nuovo Itinerario</h2>

            {{-- se clicco mi renderizza alla pagina precedente --}}
            <a href="#" onclick="history.back()" class="btn btn-dark">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
            </a>
        </div>

        {{-- parziale per la lista di errori lato back --}}
        @include('partials.validate')

        <form action="{{ route('admin.steps.store') }}" method="post" enctype="multipart/form-data">
            @csrf


            {{-- campo name di step --}}
            <div class="my-3 form-floating">
                <input onkeyup="hide_name_error()" onblur="check_name()" type="text"
                    class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                    aria-describedby="nameHelper" value="{{ old('name') }}" placeholder="" required />
                <label for="name" class="form-label">Name *</label>

                {{-- span di errore lato front  --}}
                <span id="name_error" class="text-danger error_invisible" role="alert">
                    Il nome deve essere almeno di 3 caratteri e massimo 50 caratteri
                </span>

                {{-- errore lato back --}}
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <small id="nameHelper" class="form-text text-muted">Inserisci il nome dell'itinerario</small>
            </div>

            {{-- campo per selezionare il viaggio --}}
            <div class="mb-3">
                <label for="travel_id" class="form-label">Viaggi *</label>
                <select class="form-select form-select-lg @error('travel_id') is-invalid @enderror" name="travel_id"
                    id="travel_id">
                    <option selected disabled>Select one</option>
                    @foreach ($travels as $travel)
                        <option value="{{ $travel->id }}"
                            {{ $travel->id === old('travel_id', $travel_id) ? 'selected' : '' }}>
                            {{ $travel->name }}</option>
                    @endforeach
                </select>

                {{-- errore lato back --}}
                @error('travel_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                <small id="nameHelper" class="form-text text-muted">Inserisci il Viaggio per l'itinerario</small>
            </div>


            {{-- campo date di step --}}
            <div class="mb-3">
                <label for="date" class="form-label">Data *</label>
                <input onkeyup="hide_date_error()" onblur="check_date()" type="date"
                    class="form-control @error('date') is-invalid @enderror" name="date" id="date"
                    aria-describedby="dateHelper" value="{{ old('date', $date) }}"
                    data-value="{{ $date !== '' ? $date : '' }}" placeholder="" required />

                {{-- span di errore lato front  --}}
                <span id="date_error" class="text-danger error_invisible" role="alert">
                    La data e obbligatoria
                </span>

                {{-- errore lato back --}}
                @error('date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <small id="dateHelper" class="form-text text-muted">Inserisci la data dell'itinerario</small>
            </div>

            <div class="d-flex row row-cols-1 row-cols-sm-2">
                {{-- campo time_start di step --}}
                <div class="mb-3">
                    <label for="time_start" class="form-label">Ora d'inizio *</label>
                    <input onkeyup="hide_time_start_error()" onblur="check_time_start()" type="time_start"
                        class="form-control @error('time_start') is-invalid @enderror" name="time_start" id="time_start"
                        aria-describedby="time_startHelper" value="{{ old('time_start') }}" placeholder="" required />

                    {{-- span di errore lato front  --}}
                    <span id="time_start_error" class="text-danger error_invisible" role="alert">
                        L'ora d'inizio e obbligatoria
                    </span>

                    {{-- errore lato back --}}
                    @error('time_start')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <small id="time_startHelper" class="form-text text-muted">Inserisci l'ora d'inizio
                        dell'itinerario</small>
                </div>


                {{-- campo time_end di step --}}
                <div class="mb-3">
                    <label for="time_arrived" class="form-label">Ora di fine *</label>
                    <input onkeyup="hide_time_arrived_error()" onblur="check_time_arrived()" type="time_arrived"
                        class="form-control @error('time_arrived') is-invalid @enderror" name="time_arrived"
                        id="time_arrived" aria-describedby="dateHelper" value="{{ old('time_arrived') }}" placeholder=""
                        required />

                    {{-- span di errore lato front  --}}
                    <span id="time_arrived_error" class="text-danger error_invisible" role="alert">
                        L'ora di fine e obbligatoria
                    </span>

                    {{-- errore lato back --}}
                    @error('time_arrived')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <small id="dateHelper" class="form-text text-muted">Inserisci l'ora di fine dell'itinerario</small>
                </div>
            </div>


            {{-- campo image di step --}}
            <div class="mb-3">
                <label for="image" class="form-label">scegli l'immagine</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"
                    id="image" value="{{ old('image') }}" placeholder="" aria-describedby="imageHelper" />

                {{-- errore lato back --}}
                @error('image')
                    <div class="text-danger">{{ $message }}
                    </div>
                @enderror
                <div id="imageHelper" class="form-text">Inserisci l'immagine dell'itinerario</div>
            </div>


            {{-- campi per location di step --}}
            <div class="map_container_step">
                <div class="tt-side-panel w-100 py-2">
                    <label for="location" class="pb-2">Localita *</label>
                    <div class="tt-side-panel_header w-100">

                    </div>
                    {{-- span di errore lato front  --}}
                    <span id="location_error" class="text-danger error_invisible" role="alert">
                        La Localia e Obbligatoria
                    </span>
                </div>
                <div id="map_step">
                    <div id="poiBoxInfo" class="poi">
                        <div id="poiname"></div><br>
                        <div class="image_poi">
                            <img src="{{ asset('storage/img/planning.png') }}" alt="">
                        </div>
                        <div id="poicategories"></div><br>
                        <div id="poiphone">

                        </div>
                        <br>

                        <div id="poiaddress">

                        </div>
                        <br>
                        <div id="url"></div><br>
                        <img id="currentPhoto">
                    </div>
                </div>
            </div>


            {{-- campo description di travel --}}
            <div class="form-floating mb-3">
                <textarea class="form-control" placeholder="Leave a comment here" id="description" style="height: 100px">{{ old('description') }}</textarea>
                <label for="description">Descrizione</label>

                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div id="compiled_field"
                class=" text-danger text-center btn btn-dark border-danger border-2 w-100 w-sm-50 error_invisible">
                <h5>Inserisci tutti i campi obbligatori *</h5>
            </div>
            <div class="container_button d-flex justify-content-center pt-2">
                {{-- bottone di creazione --}}
                <button id="create_step_btn" type="submit" class="btn btn-primary">
                    <span>CREA UN ITINERARIO</span>
                </button>
                {{-- bottone di attesa --}}
                <button id="btn_loading" type="submit" class="btn btn-primary error_invisible" disabled>
                    <span>Attendi ...</span>
                </button>
            </div>




            <script src="{{ asset('js/step_validation_checker.js') }}"></script>

        </form>
    </div>
@endsection

@section('script')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    @vite(['resources/js/map_search.js', 'resources/js/calendar.js'])
    <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.5.0/maps/maps.css'>
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.5.0/maps/maps-web.min.js"></script>
@endsection
