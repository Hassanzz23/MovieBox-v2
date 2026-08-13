@extends('layout.master')

@section('content')

@include('profile.nav')

<div class="mb-4">

    <h2 class="mb-1 fw-bold">
        Profile
    </h2>

    <p class="text-muted mb-0">
        Your account information
    </p>

</div>


<div class="card shadow-sm rounded-0">

    <div class="card-header fw-bold">
        Profile Information
    </div>

    <div class="card-body">

        <div class="mb-3">

            <label class="text-muted">
                Name
            </label>

            <div class="fw-bold">
                {{ auth()->user()->name }}
            </div>

        </div>


        <div class="mb-3">

            <label class="text-muted">
                Email
            </label>

            <div class="fw-bold">
                {{ auth()->user()->email }}
            </div>

        </div>


        <div>

            <label class="text-muted">
                Joined
            </label>

            <div class="fw-bold">
                {{ auth()->user()->created_at->format('F d, Y') }}
            </div>

        </div>

    </div>

</div>

@endsection