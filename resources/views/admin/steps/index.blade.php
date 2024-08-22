@extends('layouts.admin')

@section('content')
    <div class="container py-4">

        {{-- header step --}}
        <div class="header_step d-flex justify-content-between align-items-center py-3">
            <h2>Itinerari {{ count($steps) }}</h2>

            {{-- se clicci renderizza alla pagina di creazione dell'itinerario --}}
            <a href="{{ route('admin.steps.create') }}" class="btn" style="color: white; background-color:#E25B07">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </a>
        </div>

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
                        <th scope="col">Data</th>
                        <th scope="col" style="width: 150px; text-align: center;">Azioni</th>
                    </tr>
                </thead>

                {{-- body of table --}}
                <tbody>
                    @forelse ($steps as $step)
                        <tr class="">
                            <td scope="row">{{ $step->name }}</td>
                            <td>{{ $step->travel->name }}</td>
                            <td>{{ date_format(new DateTime($step->date), 'd/m/Y') }}</td>
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
            {{ $steps->links('pagination::semantic-ui') }}
        </div>

    </div>
@endsection
