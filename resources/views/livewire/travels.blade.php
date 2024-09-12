<div>
    {{-- header --}}
    <div class="header_travels d-flex justify-content-between align-items-center py-4" style="flex-wrap: wrap">

        @if ($travels->count() >= 1)
            @if ($travels->count() === 1)
                <h1>Viaggio 1</h1>
            @else
                <h1>Viaggi {{ $travels->total() }}</h1>
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

                <a href="{{ route('admin.travels.index') }}" class="btn btn-dark">
                    <i class="fa-solid fa-rotate"></i>
                </a>
            </div>
        @else
            <h1>Nessun Viaggio</h1>


        @endif




    </div>

    {{-- se clicci ti renderizza alla pagina di creazione del viaggio --}}
    <a href="{{ route('admin.travels.create') }}" class="btn mb-3" style="color: white; background-color:#E25B07">
        <i class="fa-solid fa-plus" aria-hidden="true"></i>
        <span class="ps-1">Aggiungi viaggio</span>
    </a>

    {{-- partial for message of session --}}
    @include('partials.session')

    {{-- table travel --}}
    <div class="table-responsive m-0" style="background-color: transparent">
        <table class="table table-striped table-hover">

            {{-- header of table --}}
            <thead class="table-dark">
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">
                        <span class="text-center">Durata</span>
                    </th>

                    <th style="width: 150px; text-align:center;">Azioni</th>
                </tr>
            </thead>

            {{-- body of table --}}
            <tbody>
                @forelse ($travels as $travel)
                    <tr class="">
                        <td scope="row">{{ $travel->name }}</td>
                        <td>{{ date_format(date_create($travel->date_start), 'd/m/Y') }}
                            {{ date_format(date_create($travel->date_finish), 'd/m/Y') }}</td>

                        <td class="" style="min-height: 100%">
                            <div class="justify-content-center d-flex gap-1 flex-wrap">

                                {{-- se clicci mostra il singolo viaggio --}}
                                <a href="{{ route('admin.travels.show', $travel) }}" class="btn btn-dark">
                                    <i class="fa-solid fa-eye" aria-hidden="true"></i>
                                </a>

                                {{-- se clicci renderizza alla pagina di modifica del viaggio --}}
                                <a href="{{ route('admin.travels.edit', $travel) }}" class="btn btn-warning">
                                    <i class="fa-solid fa-pencil" aria-hidden="true"></i>
                                </a>

                                {{-- se clicci compare la modale di cancellazione del viaggio --}}
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#modalId-{{ $travel->id }}">
                                    <i class="fa-solid fa-trash" aria-hidden="true"></i>
                                </button>

                                <!-- Modal Body -->
                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                <div class="modal fade" id="modalId-{{ $travel->id }}" tabindex="-1"
                                    data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                    aria-labelledby="modalTitleId-{{ $travel->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                        role="document">
                                        <div class="modal-content">

                                            {{-- header of modal --}}
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalTitleId-{{ $travel->id }}">
                                                    Attenzione!
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>

                                            {{-- body of modal  --}}
                                            <div class="modal-body">
                                                Sei sicuro di cancellare il viaggio, la cancellazione sara
                                                irreversibile.
                                            </div>

                                            {{-- footer of modal --}}
                                            <div class="modal-footer">
                                                <form action="{{ route('admin.travels.destroy', $travel) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    {{-- se clicci cancella il viaggio --}}
                                                    <button type="submit" class="btn btn-danger">Delete</button>
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
                        <td scope="row" colspan="4">Non ci sono viaggi programmati</td>
                    </tr>
                @endforelse


            </tbody>
        </table>
        @if ($travels->count() >= 1)
            {{ $travels->links('pagination::bootstrap-5') }}
        @endif
    </div>
</div>
