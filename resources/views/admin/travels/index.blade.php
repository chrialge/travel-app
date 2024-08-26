@extends('layouts.admin')

@section('content')
    <div class="container-xl py-4">

        {{-- percorso di file / breadcrumb --}}
        <ul class="d-flex gap-2 list-unstyled">
            <li>
                <a href="{{ route('admin.dashboard') }}" style="color:#1e1e1e">
                    Dashboard
                </a>
            </li>
            <li>
                <span class="text-white">
                    /
                </span>
            </li>
            <li>
                <a href="#" class="text-decoration-none text-white">
                    Viaggi
                </a>
            </li>
        </ul>




        @livewire('travels')
    </div>
@endsection
