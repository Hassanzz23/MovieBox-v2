@extends('layout.master')

@section('content')

    <style>
        .detail-card {
            height: 450px;
            overflow: hidden;
        }

        .detail-card .row {
            height: 100%;
        }

        .detail-poster {
            height: 100%;
        }

        .detail-poster img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .detail-info {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .detail-content {
            flex: 1;
            overflow-y: auto;
        }

        .detail-actions {
            margin-top: auto;
            padding-top: 15px;
        }

        .detail-action {
            margin-bottom: 10px;
        }

        .detail-action:last-child {
            margin-bottom: 0;
        }
    </style>


    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="mb-0 fw-bold">

            {{ $todo->title }}

            @if ($todo->year)
                <span class="text-muted fw-normal">
                    ({{ $todo->year }})
                </span>
            @endif

        </h2>


        <a href="{{ route('watchlist.index') }}" class="btn btn-dark">
            Back
        </a>

    </div>


    {{-- Movie Card --}}
    <div class="card detail-card shadow-sm rounded-0">

        <div class="row g-0">


            {{-- Poster --}}
            <div class="col-12 col-md-4 detail-poster">

                @if ($todo->image)
                    <img src="{{ asset('storage/images/' . $todo->image) }}" alt="{{ $todo->title }}">
                @endif

            </div>


            {{-- Information --}}
            <div class="col-12 col-md-8">

                <div class="card-body p-4 detail-info">


                    {{-- Main Information --}}
                    <div class="detail-content">

                        {{-- Title --}}
                        <h3 class="fw-bold mb-2">

                            {{ $todo->title }}

                            @if ($todo->year)
                                <span class="text-muted fw-normal">
                                    ({{ $todo->year }})
                                </span>
                            @endif

                        </h3>


                        {{-- Genre --}}
                        @if ($todo->genre)
                            <p class="text-muted mb-4">
                                {{ $todo->genre }}
                            </p>
                        @endif


                        {{-- Description --}}
                        @if ($todo->description)
                            <p class="mb-4">
                                {{ $todo->description }}
                            </p>
                        @endif


                        {{-- Watch Status --}}
                        @if ($todo->status)
                            <div class="mb-2">

                                <span class="badge bg-success">
                                    Watched
                                </span>


                                @if ($todo->rating)
                                    <span class="badge bg-dark ms-2">
                                        ⭐ {{ $todo->rating }}/10
                                    </span>
                                @endif

                            </div>
                        @endif

                    </div>


                    {{-- Actions --}}
                    <div class="detail-actions">


                        {{-- Mark as Watched --}}
                        @if (!$todo->status)
                            <div class="detail-action">

                                <form action="{{ route('watchlist.watched', $todo) }}" method="POST">

                                    @csrf
                                    @method('PUT')

                                    <button type="submit" class="btn btn-warning">
                                        Mark as Watched
                                    </button>

                                </form>

                            </div>
                        @endif


                        {{-- Favorite --}}
                        <div class="detail-action">

                            @if ($todo->favorite)
                                {{-- Remove from Favorites --}}
                                <form action="{{ route('favorites.remove', $todo) }}" method="POST"
                                    onsubmit="return confirm('Remove this movie from your Favorites?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-outline-warning">
                                        ⭐ Remove from Favorites
                                    </button>

                                </form>
                            @else
                                {{-- Add to Favorites --}}
                                <form action="{{ route('favorites.add', $todo) }}" method="POST">

                                    @csrf

                                    <button type="submit" class="btn btn-success">
                                        ⭐ Add to Favorites
                                    </button>

                                </form>
                            @endif

                        </div>


                        {{-- Delete from WatchList --}}
                        <div class="detail-action">

                            <form action="{{ route('watchlist.remove', $todo) }}" method="POST"
                                onsubmit="return confirm('Remove this movie from your WatchList?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-outline-danger">
                                    Delete from WatchList
                                </button>

                            </form>

                        </div>


                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
