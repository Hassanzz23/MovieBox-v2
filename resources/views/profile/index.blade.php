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


            <div class="mb-4">

                <label class="text-muted">
                    Email
                </label>

                <div class="fw-bold">
                    {{ auth()->user()->email }}
                </div>

            </div>


            <div class="row g-3 mb-4">

                <div class="col-md-6">

                    <div class="border p-3 h-100">

                        <div class="text-muted mb-1">
                            🎬 Movies in Watchlist
                        </div>

                        <div class="d-flex justify-content-between align-items-center">

                            <span class="fs-4 fw-bold">
                                {{ $watchlistCount }}
                            </span>

                            <a href="{{ route('watchlist.index') }}" class="btn btn-dark btn-sm">
                                View Watchlist
                            </a>

                        </div>

                    </div>

                </div>


                <div class="col-md-6">

                    <div class="border p-3 h-100">

                        <div class="text-muted mb-1">
                            ❤️ Movies in Favorites
                        </div>

                        <div class="d-flex justify-content-between align-items-center">

                            <span class="fs-4 fw-bold">
                                {{ $favoriteCount }}
                            </span>

                            <a href="{{ route('favorites.index') }}" class="btn btn-dark btn-sm">
                                View Favorites
                            </a>

                        </div>

                    </div>

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

            <div class="mt-4 d-flex justify-content-end">

                <a href="{{ route('profile.change-password') }}" class="btn btn-dark">
                    Change Password
                </a>

            </div>

        </div>

    </div>
@endsection
