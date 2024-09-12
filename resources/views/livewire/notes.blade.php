<div>
    {{-- header --}}
    <div class="header_travels d-flex justify-content-between align-items-center py-4" style="flex-wrap: wrap">

        @if ($notes->count() >= 1)

            @if ($notes->count() === 1)
                <h2>Nota 1</h2>
            @else
                <h2>Note {{ $notes->total() }}</h2>
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

                <a href="{{ route('admin.notes.index') }}" class="btn btn-dark">
                    <i class="fa-solid fa-rotate"></i>
                </a>
            </div>
        @else
            <h2>Nessuna nota</h2>
        @endif

    </div>

    {{-- partial for message of session --}}
    @include('partials.session')

    {{-- table with notes  --}}
    <div class="table-responsive">
        <table class="table table-striped table-hover">

            {{-- header of table --}}
            <thead class="table-dark" style="letter-spacing: 1px">
                <tr>
                    <th scope="col">Nome e Cognome</th>
                    <th scope="col" class="tupla_invisible">Email</th>
                    <th scope="col">Dell'itinerario</th>
                    <th scope="col" style="width: 110px; text-align: center;">Azioni</th>
                </tr>
            </thead>

            {{-- body of table --}}
            <tbody>
                @forelse ($notes as $note)
                    <tr class="">
                        <td scope="row">{{ $note->customer_name . ' ' . $note->customer_lastname }}</td>
                        <td class="tupla_invisible">{{ $note->customer_email }}</td>
                        @if ($note->step_id)
                            <td>{{ $note->step->name }}</td>
                        @else
                            <td>N\A</td>
                        @endif

                        <td class="">

                            {{-- se clicci ci mostra il singolo itinerario --}}
                            <a href="{{ route('admin.notes.show', $note) }}" class="btn btn-dark">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </a>

                            {{-- se cliccli apre la modale --}}
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#modalId-{{ $note->id }}">
                                <i class="fa-solid fa-trash" aria-hidden="true"></i>
                            </button>

                            <!-- Modal Body -->
                            <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                            <div class="modal fade" id="modalId-{{ $note->id }}" tabindex="-1"
                                data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                aria-labelledby="modalTitleId-{{ $note->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                    role="document">

                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalTitleId-{{ $note->id }}">
                                                Attenzione!
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            Sei sicuro di cancellare il viaggio, la cancellazione sara irreversibile.
                                        </div>

                                        <div class="modal-footer">
                                            <form action="{{ route('admin.notes.destroy', $note) }}" method="post">
                                                @csrf
                                                @method('DELETE')

                                                {{-- clicco che cancella l'itinerio --}}
                                                <button type="submit" class="btn btn-danger">Cancella</button>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>
                @empty
                    <tr class="">
                        <td scope="row" colspan="4">Scusa non hai una nota</td>
                    </tr>
                @endforelse


            </tbody>
        </table>
        @if ($notes->count() >= 1)
            {{ $notes->links('pagination::bootstrap-5') }}
        @endif

    </div>
</div>
