@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="header_step d-flex justify-content-between align-items-center">
            <h2>Itinerari</h2>
            <a href="" class="btn btn-primary">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th scope="col">Column 1</th>
                        <th scope="col">Column 2</th>
                        <th scope="col">Column 3</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="">
                        <td scope="row">R1C1</td>
                        <td>R1C2</td>
                        <td>R1C3</td>
                    </tr>
                    <tr class="">
                        <td scope="row">Item</td>
                        <td>Item</td>
                        <td>Item</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
@endsection
