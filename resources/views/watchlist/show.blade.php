@extends('layout.master')

@section('content')

    <style>
        .movie-details {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .movie-details-title {
            margin: 0;
            line-height: 1.4;
        }

        .movie-details-genre {
            margin: 0;
        }

        .movie-details-description {
            margin: 8px 0 0;
            line-height: 1.7;
        }

        .movie-details-status {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
            margin-top: 8px;
        }

        .movie-details-actions {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
            margin-top: 12px;
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


    <div class="card shadow-sm rounded-0">

        <div class="row g-0">

            <div class="col-12 col-md-4">

                @if ($movie->image)
                    <img src="{{ asset('storage/images/' . $movie->image) }}" alt="{{ $movie->title }}"
                        class="img-fluid w-100 rounded-0" style="max-height: 600px; object-fit: cover;">
                @endif

            </div>


            <div class="col-12 col-md-8">

                <div class="card-body p-4">

                    <div class="movie-details">

                        <h3 class="movie-details-title fw-bold">

                            {{ $movie->title }}

                            @if ($movie->year)
                                <span class="text-muted fw-normal">
                                    ({{ $movie->year }})
                                </span>
                            @endif

                        </h3>


                        @if ($movie->genre)
                            <p class="movie-details-genre text-muted">
                                {{ $movie->genre }}
                            </p>
                        @endif


                        @if ($movie->description)
                            <p class="movie-details-description">
                                {{ $movie->description }}
                            </p>
                        @endif


                        <div class="movie-details-status">

                            @if ($movie->status)
                                <span class="badge bg-success">
                                    Watched
                                </span>

                                @if ($movie->rating)
                                    <span class="badge bg-dark">
                                        ⭐ {{ $movie->rating }}/10
                                    </span>
                                @endif
                            @else
                                <form action="{{ route('watchlist.watched', $movie) }}" method="POST">

                                    @csrf
                                    @method('PUT')

                                    <button type="submit" class="btn btn-warning">
                                        Mark as Watched
                                    </button>

                                </form>
                            @endif

                        </div>


                        <div class="movie-details-actions">

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
