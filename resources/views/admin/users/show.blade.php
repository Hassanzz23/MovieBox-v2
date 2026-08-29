@extends('admin.layout.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-5">

        <div>
            <h2 class="mb-1">
                User Details
            </h2>

            <p class="text-muted mb-0">
                View user information
            </p>
        </div>

        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
            Back to Users
        </a>

    </div>


    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="row g-4">

                <div class="col-md-6">

                    <h6 class="text-muted">
                        Username
                    </h6>

                    <p class="fs-5 mb-0">
                        {{ $user->name }}
                    </p>

                </div>


                <div class="col-md-6">

                    <h6 class="text-muted">
                        Email
                    </h6>

                    <p class="fs-5 mb-0">
                        {{ $user->email }}
                    </p>

                </div>


                <div class="col-md-6">

                    <h6 class="text-muted">
                        Joined
                    </h6>

                    <p class="fs-5 mb-0">
                        {{ $user->created_at->format('M d, Y') }}
                    </p>

                </div>


                <div class="col-md-6">

                    <h6 class="text-muted">
                        Status
                    </h6>

                    @if ($user->is_banned)
                        <span class="badge bg-danger fs-6">
                            Banned
                        </span>
                    @else
                        <span class="badge bg-success fs-6">
                            Active
                        </span>
                    @endif

                </div>


                <div class="col-md-6">

                    <h6 class="text-muted">
                        Watchlist
                    </h6>

                    <p class="fs-5 mb-0">
                        {{ $watchlistCount }}
                        movies
                    </p>

                </div>


                <div class="col-md-6">

                    <h6 class="text-muted">
                        Favorites
                    </h6>

                    <p class="fs-5 mb-0">
                        {{ $favoriteCount }}
                        movies
                    </p>

                </div>

            </div>

        </div>

    </div>
@endsection
