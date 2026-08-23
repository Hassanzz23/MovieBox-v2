@extends('layout.master')

@section('content')

    <style>
        .detail-card {
            height: 520px;
            overflow: hidden;
        }

        .detail-card>.row {
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

        .detail-info-wrapper {
            height: 100%;
        }

        .detail-info {
            height: 100%;
            display: flex;
            flex-direction: column;
            min-height: 0;
        }

        .detail-content {
            flex: 1 1 auto;
            min-height: 0;
            overflow-y: auto;
            padding-right: 8px;
        }

        .detail-actions {
            flex-shrink: 0;
            padding-top: 15px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .detail-action {
            height: 40px;
            flex-shrink: 0;
        }

        .detail-action form {
            height: 40px;
            margin: 0;
        }

        .detail-action button {
            height: 40px;
            min-width: 190px;
        }

        @media (max-width: 767.98px) {
            .detail-card {
                height: auto;
            }

            .detail-card>.row {
                height: auto;
            }

            .detail-poster {
                height: 500px;
            }

            .detail-info-wrapper {
                height: 500px;
            }
        }
    </style>


    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="mb-0 fw-bold">

            {{ $movie->title }}

            @if ($movie->year)
                <span class="text-muted fw-normal">
                    ({{ $movie->year }})
                </span>
            @endif

        </h2>

        <a href="{{ route('watchlist.index') }}" class="btn btn-dark">
            Back
        </a>

    </div>


    <div class="card detail-card shadow-sm rounded-0">

        <div class="row g-0">


            {{-- Poster --}}
            <div class="col-12 col-md-4 detail-poster">

                @if ($movie->image)
                    <img src="{{ asset('storage/images/' . $movie->image) }}" alt="{{ $movie->title }}">
                @endif

            </div>


            {{-- Information --}}
            <div class="col-12 col-md-8 detail-info-wrapper">

                <div class="card-body p-4 detail-info">


                    {{-- Scrollable content --}}
                    <div class="detail-content">

                        <h3 class="fw-bold mb-2">

                            {{ $movie->title }}

                            @if ($movie->year)
                                <span class="text-muted fw-normal">
                                    ({{ $movie->year }})
                                </span>
                            @endif

                        </h3>


                        @if ($movie->genre)
                            <p class="text-muted mb-4">
                                {{ $movie->genre }}
                            </p>
                        @endif


                        @if ($movie->description)
                            <p class="mb-4">
                                {{ $movie->description }}
                            </p>
                        @endif


                        @if ($movie->status)
                            <div class="mb-2">

                                <span class="badge bg-success">
                                    Watched
                                </span>

                                @if ($movie->rating)
                                    <span class="badge bg-dark ms-2">
                                        ⭐ {{ $movie->rating }}/10
                                    </span>
                                @endif

                            </div>
                        @endif

                    </div>


                    {{-- Fixed actions --}}
                    <div class="detail-actions">


                        {{-- Mark as Watched --}}
                        @if (!$movie->status)
                            <div class="detail-action">

                                <form action="{{ route('watchlist.watched', $movie) }}" method="POST">

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

                            @if ($isFavorite)
                                <form action="{{ route('favorites.remove', $movie) }}" method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-dark">
                                        ★ Remove from Favorites
                                    </button>

                                </form>
                            @else
                                <form action="{{ route('favorites.add', $movie) }}" method="POST">

                                    @csrf

                                    <button type="submit" class="btn btn-success">
                                        ☆ Add to Favorites
                                    </button>

                                </form>
                            @endif

                        </div>


                        <div class="detail-action">

                            <form action="{{ route('watchlist.remove', $movie) }}" method="POST"
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
