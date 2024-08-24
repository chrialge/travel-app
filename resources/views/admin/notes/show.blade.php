@extends('layouts.admin')

@section('content')
    <div class="container py-4  gap-3">

        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('admin.notes.index') }}" class="btn btn-dark">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                <span>ritorna alla note</span>
            </a>
        </div>


        <div class="card_note w-100">

            {{-- top note --}}
            <div class="top_note d-flex justify-content-between align-items-center row">

                {{-- left top note --}}
                <div class="left d-flex align-items-center gap-2 ">

                    {{-- container img --}}
                    <div class="container_img">
                        <img src="{{ asset('storage/img/user.png') }}" alt="">
                    </div>

                    {{-- info user --}}
                    <div class="info_user">
                        <h4>{{ $note->customer_name . ' ' . $note->customer_lastname }}</h4>
                        <span>{{ $note->customer_email }}</span>
                    </div>
                </div>

                {{-- right note top --}}
                <div class="right d-flex flex-column ">
                    <span>{{ $date }}</span>
                    <span class=" text-end">{{ $time }}</span>
                </div>
            </div>

            {{-- botton note --}}
            <div class="bottom_note">
                <p>
                    <strong>Nota: </strong>
                    {{ $note->note }}
                </p>
            </div>

        </div>

    </div>
@endsection
