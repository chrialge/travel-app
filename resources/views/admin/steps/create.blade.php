@extends('layouts.admin')

@section('content')
    <div class="container py-4">

        {{-- header  --}}
        <div class="header_create_step d-flex justify-content-between align-items-center">
            <h2>Crea un nuovo Itinerario</h2>

            {{-- se clicco mi renderizza alla pigina index dell'itinerario --}}
            <a href="{{ route('admin.steps.index') }}" class="btn btn-dark">
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
                    id=" travel_id">
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
                    aria-describedby="dateHelper" value="{{ old('date') }}" placeholder="" required />

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

            {{-- campo time_start di step --}}
            <div class="mb-3">
                <label for="time_start" class="form-label">Ora d'inizio *</label>
                <input onkeyup="hide_time_start_error()" onblur="check_time_start()" type="time"
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
                <small id="time_startHelper" class="form-text text-muted">Inserisci l'ora d'inizio dell'itinerario</small>
            </div>


            {{-- campo time_end di step --}}
            <div class="mb-3">
                <label for="time_arrived" class="form-label">Ora di fine *</label>
                <input onkeyup="hide_time_arrived_error()" onblur="check_time_arrived()" type="time"
                    class="form-control @error('time_arrived') is-invalid @enderror" name="time_arrived" id="time_arrived"
                    aria-describedby="dateHelper" value="{{ old('time_arrived') }}" placeholder="" required />

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
            <div class="location_container d-flex row-cols-2 row mb-3">

                {{-- campo di state per location of step --}}
                <div class="state">
                    <label for="state" class="form-label">Stato *</label>
                    <input onkeyup="hide_state_error()" onblur="check_state()" type="text"
                        class="form-control @error('state') is-invalid @enderror" name="state" id="state"
                        aria-describedby="stateHelper" value="{{ old('state') }}" placeholder="" required />

                    {{-- span di errore lato front  --}}
                    <span id="state_error" class="text-danger error_invisible" role="alert">
                        Lo stato e obbligatoria
                    </span>

                    {{-- errore lato back --}}
                    @error('state')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <small id="stateHelper" class="form-text text-muted">Inserisci lo stato dell'itinerario</small>
                </div>

                {{-- campo di region per location of step --}}
                <div class="region">
                    <label for="region" class="form-label">Regione *</label>
                    <input onkeyup="hide_region_error()" onblur="check_region()" type="text"
                        class="form-control @error('region') is-invalid @enderror" name="region" id="region"
                        aria-describedby="regiionHelper" value="{{ old('region') }}" placeholder="" required />

                    {{-- span di errore lato front  --}}
                    <span id="region_error" class="text-danger error_invisible" role="alert">
                        La regione e obbligatoria
                    </span>

                    {{-- errore lato back --}}
                    @error('region')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <small id="regiionHelper" class="form-text text-muted">Inserisci la regione dell'itinerario</small>
                </div>


                {{-- campo di route per location of step --}}
                <div class="route">
                    <label for="route" class="form-label">Via *</label>
                    <input onkeyup="hide_route_error()" onblur="check_route()" type="text"
                        class="form-control @error('route') is-invalid @enderror" name="route" id="route"
                        aria-describedby="routeHelper" value="{{ old('route') }}" placeholder="" required />

                    {{-- span di errore lato front  --}}
                    <span id="route_error" class="text-danger error_invisible" role="alert">
                        La via e obbligatoria
                    </span>

                    {{-- errore lato back --}}
                    @error('route')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <small id="routeHelper" class="form-text text-muted">Inserisci la via dell'itinerario</small>
                </div>

                {{-- campo di cap per location of step --}}
                <div class="cap">
                    <label for="cap" class="form-label">cap *</label>
                    <input onkeyup="hide_cap_error()" onblur="check_cap()" type="number"
                        class="form-control @error('cap') is-invalid @enderror" name="cap" id="cap"
                        aria-describedby="capHelper" value="{{ old('cap') }}" placeholder="" required />

                    {{-- span di errore lato front  --}}
                    <span id="cap_error" class="text-danger error_invisible" role="alert">
                        il cap e obbligatoria e deve essere un intero
                    </span>

                    {{-- errore lato back --}}
                    @error('cap')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <small id="capHelper" class="form-text text-muted">Inserisci il cap dell'itinerario</small>
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

            {{-- bottone di creazione --}}
            <button id="create_step_btn" type="submit" class="btn btn-primary">
                <span>CREA UN ITINERARIO</span>
            </button>
            {{-- bottone di attesa --}}
            <button id="btn_loading" type="submit" class="btn btn-primary error_invisible" disabled>
                <span>Attendi ...</span>
            </button>



            <script src="{{ asset('js/step_validation_checker.js') }}"></script>

        </form>
    </div>
@endsection
