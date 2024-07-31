@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="header d-flex justify-content-between align-items-center py-4">
            <h2>Travel</h2>
            <a href="{{ route('admin.travels.create') }}" class="btn btn-info">
                <i class="fa-solid fa-plus" aria-hidden="true"></i>
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Date Start</th>
                        <th scope="col">Date Finish</th>
                        <th style="width: 150px; text-align:center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($travels as $travel)
                        <tr class="">
                            <td scope="row">{{ $travel->name }}</td>
                            <td>{{ $travel->date_start }}</td>
                            <td>{{ $travel->date_start }}</td>
                            <td class="justify-content-center">
                                <a href="{{ route('admin.travels.show', $travel) }}" class="btn btn-dark">
                                    <i class="fa-solid fa-eye" aria-hidden="true"></i>
                                </a>
                                <a href="{{ route('admin.travels.edit', $travel) }}" class="btn btn-warning">
                                    <i class="fa-solid fa-pencil" aria-hidden="true"></i>
                                </a>
                                <a href="#" class="btn btn-danger">
                                    <i class="fa-solid fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr class="">
                            <td scope="row" colspan="4">Non ci sono viaggi programmati</td>
                        </tr>
                    @endforelse


                </tbody>
            </table>
        </div>
    </div>
@endsection
