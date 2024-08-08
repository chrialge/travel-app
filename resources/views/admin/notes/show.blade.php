@extends('layouts.admin')

@section('content')
    <div class="container py-4 d-flex gap-3">
        <div class="card_note w-100">
            <div class="top_note d-flex justify-content-between align-items-center">
                <div class="left d-flex align-items-center gap-2">
                    <div class="container_img">
                        <img src="{{ asset('storage/img/user.png') }}" alt="">
                    </div>
                    <div class="info_user">
                        <h4>{{ $note->customer_name . ' ' . $note->customer_lastname }}</h4>
                        <span>{{ $note->customer_email }}</span>
                    </div>
                </div>
                <div class="right d-flex flex-column ">
                    <span>{{ $date }}</span>
                    <span class=" text-end">{{ $time }}</span>
                </div>
            </div>
            <div class="bottom_note">
                <p>
                    <strong>Descrizione: </strong>
                    {{ $note->note }}
                </p>
            </div>
        </div>
    </div>
@endsection
