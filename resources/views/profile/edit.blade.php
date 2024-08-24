@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="d-flex gap-1 align-items-center">
            <div class="avatar me-2 nav-icon">
                <img class="avatar-img" src="{{ asset('storage/img/user.png') }}" alt="user@email.com">
                <span class="avatar-status bg-success"></span>
            </div>
            <h2 class="fs-4  my-4">
                {{ $user->name }}
            </h2>
        </div>

        <div class="card p-4 mb-4 bg-white shadow rounded-lg">

            @include('profile.partials.update-profile-information-form')

        </div>

        <div class="card p-4 mb-4 bg-white shadow rounded-lg">


            @include('profile.partials.update-password-form')

        </div>

        <div class="card p-4 mb-4 bg-white shadow rounded-lg">


            @include('profile.partials.delete-user-form')

        </div>
    </div>
@endsection
