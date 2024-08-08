@extends('layouts.admin')

@section('content')
    <div class="container py-4">
        <div class="header_step d-flex justify-content-between align-items-center py-3">
            <h2>Note</h2>
        </div>

        @include('partials.session')

        <div class="table-responsive">
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th scope="col">Nome e Cognome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Dell'itinerario</th>
                        <th scope="col" style="width: 110px; text-align: center;">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($notes as $note)
                        <tr class="">
                            <td scope="row">{{ $note->customer_name . ' ' . $note->customer_lastname }}</td>
                            <td>{{ $note->customer_email }}</td>
                            @if ($note->step_id)
                                <td>{{ $note->steps }}</td>
                            @else
                                <td>N\A</td>
                            @endif

                            <td class="">
                                <a href="{{ route('admin.notes.show', $note) }}" class="btn btn-dark">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </a>

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
                            <td scope="row" colspan="4">Scusa non hai un itinerario</td>
                        </tr>
                    @endforelse


                </tbody>
            </table>
            {{ $notes->links('pagination::bootstrap-5') }}
        </div>

    </div>
@endsection
