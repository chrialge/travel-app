<div>
    {{-- header --}}
    <div class="header_travels d-flex justify-content-between align-items-center py-4" style="flex-wrap: wrap">

        @if ($steps->count() >= 1)

            @if ($steps->count() === 1)
                <h2>Itinerario 1</h2>
            @else
                <h2>Itinerarii {{ $steps->total() }}</h2>
            @endif


            <div class="d-flex gap-3" style="flex-wrap: wrap;">

                <form id="search_form" role="search">
                    <label for="search">Cerca per nome</label>
                    <input wire:model.live="search" id="search" type="search" placeholder="Cerca..."
                        aria-label="cerca itinerari" autofocus required />
                    <button type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>

                </form>




                <a href="{{ route('admin.steps.index') }}" class="btn btn-dark">
                    <i class="fa-solid fa-rotate"></i>
                </a>
            </div>
        @else
            <h2>Nessun Itinerario</h2>
        @endif

    </div>


    {{-- se clicci renderizza alla pagina di creazione dell'itinerario --}}
    <a href="{{ route('admin.steps.create') }}" class="btn mb-3" style="color: white; background-color:#E25B07">
        <i class="fa fa-plus" aria-hidden="true"></i>
        <span class="ps-1">Aggiungi itinerario</span>
    </a>

    {{-- partial for message of session --}}
    @include('partials.session')

    {{-- teble of step --}}
    <div class="table-responsive">
        <table class="table table-striped table-hover">

            {{-- header table --}}
            <thead class="table-dark">
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Viaggio</th>
                    <th scope="col" class="tupla_invisible">Data</th>
                    <th scope="col" style="width: 150px; text-align: center;">Azioni</th>
                </tr>
            </thead>

            {{-- body of table --}}
            <tbody>
                @forelse ($steps as $step)
                    <tr class="">
                        <td scope="row">{{ $step->name }}</td>
                        <td>{{ $step->travel->name }}</td>
                        <td class="tupla_invisible">{{ date_format(new DateTime($step->date), 'd/m/Y') }}</td>
                        <td class="">
                            <div class="d-flex justify-content-center flex-wrap gap-1">

                                {{-- se clicco mi mostra il singolo itinerario --}}
                                <a href="{{ route('admin.steps.show', $step) }}" class="btn btn-dark">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </a>

                                {{-- se clicco mi renderizza alla paggina di modifica dell'itinerario --}}
                                <a href="{{ route('admin.steps.edit', $step) }}" class="btn btn-warning">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </a>

                                {{-- se clicco mi apre la modale di cancellazione dell'itinerario --}}
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#modalId-{{ $step->id }}">
                                    <i class="fa-solid fa-trash" aria-hidden="true"></i>
                                </button>

                                <!-- Modal Body -->
                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                <div class="modal fade" id="modalId-{{ $step->id }}" tabindex="-1"
                                    data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                    aria-labelledby="modalTitleId-{{ $step->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                        role="document">
                                        <div class="modal-content">

                                            {{-- header of modal --}}
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalTitleId-{{ $step->id }}">
                                                    Attenzione!
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>

                                            {{-- body of modal --}}
                                            <div class="modal-body">
                                                Sei sicuro di cancellare il viaggio, la cancellazione sara
                                                irreversibile.
                                            </div>

                                            {{-- footer of modal --}}
                                            <div class="modal-footer">
                                                <form action="{{ route('admin.steps.destroy', $step) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <input type="text" class="d-none" value="no" name="no-page"
                                                        id="no-page">
                                                    {{-- se clicco cancello l'itinerario --}}
                                                    <button type="submit" class="btn btn-danger">Cancella</button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>


                        </td>
                    </tr>
                @empty
                    <tr class="">
                        <td scope="row" colspan="4">Scusa non hai un itinerario</td>
                    </tr>
                @endforelse


            </tbody>
        </table>
        @if ($steps->count() >= 1)
            {{ $steps->links('pagination::bootstrap-5') }}
        @endif
    </div>
</div>
