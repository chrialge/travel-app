@extends('layouts.admin')

@section('content')
    <div class="container py-4">
        <div class="header_step d-flex justify-content-between align-items-center py-3">
            <h2>Itinerari</h2>
            <a href="{{ route('admin.steps.create') }}" class="btn btn-primary">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Viaggio</th>
                        <th scope="col">Data</th>
                        <th scope="col" style="width: 150px; text-align: center;">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($steps as $step)
                        <tr class="">
                            <td scope="row">{{ $step->name }}</td>
                            <td>{{ $step->travel->name }}</td>
                            <td>{{ $step->date }}</td>
                            <td class="">
                                <a href="{{ route('admin.steps.show', $step) }}" class="btn btn-dark">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </a>
                                <a href="{{ route('admin.steps.edit', $step) }}" class="btn btn-warning">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </a>
                                <a href="{{ route('admin.steps.destroy', $step) }}" class="btn btn-danger">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr class="">
                            <td scope="row" colspan="4">Scusa non hai un itinerario</td>
                        </tr>
                    @endforelse


                </tbody>
            </table>
            {{ $steps->links('pagination::bootstrap-5') }}
        </div>

    </div>
@endsection
