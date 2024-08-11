@extends('layouts.admin')

@section('content')
    <div class="container" style="padding-left: 50px">
        <div class="header d-flex justify-content-between align-items-center py-4" style="background: transparent">
            <h2>Viaggi</h2>
            <a href="{{ route('admin.travels.create') }}" class="btn" style="color: white; background-color:#E25B07">
                <i class="fa-solid fa-plus" aria-hidden="true"></i>
            </a>
        </div>

        @include('partials.session')

        <div class="table-responsive m-0" style="background-color: transparent">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Inizio del viaggio</th>
                        <th scope="col">Fine del viaggio</th>
                        <th style="width: 150px; text-align:center;">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($travels as $travel)
                        <tr class="">
                            <td scope="row">{{ $travel->name }}</td>
                            <td>{{ date_format(date_create($travel->date_start), 'd/m/Y') }}</td>
                            <td>{{ date_format(date_create($travel->date_finish), 'd/m/Y') }}</td>
                            <td class="" style="min-height: 100%">
                                <div class="justify-content-center d-flex gap-1 flex-wrap">
                                    <a href="{{ route('admin.travels.show', $travel) }}" class="btn btn-dark">
                                        <i class="fa-solid fa-eye" aria-hidden="true"></i>
                                    </a>
                                    <a href="{{ route('admin.travels.edit', $travel) }}" class="btn btn-warning">
                                        <i class="fa-solid fa-pencil" aria-hidden="true"></i>
                                    </a>

                                    <!-- Modal trigger button -->
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
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalTitleId-{{ $travel->id }}">
                                                        Attenzione!
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Sei sicuro di cancellare il viaggio, la cancellazione sara
                                                    irreversibile.
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('admin.travels.destroy', $travel) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
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
            {{ $travels->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
