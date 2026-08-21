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


            <div class="col-12 col-md-4 detail-poster">

                @if ($movie->image)
                    <img src="{{ asset('storage/images/' . $movie->image) }}" alt="{{ $movie->title }}">
                @endif

            </div>


            <div class="col-12 col-md-8">

                <div class="card-body p-4 detail-info">


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


                    <div class="detail-actions">


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


                        <div class="detail-action">

                            @if ($movie->favorite)
                                <form action="{{ route('favorites.remove', $movie) }}" method="POST"
                                    onsubmit="return confirm('Remove this movie from your Favorites?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-outline-warning">
                                        ⭐ Remove from Favorites
                                    </button>

                                </form>
                            @else
                                <form action="{{ route('favorites.add', $movie) }}" method="POST">

                                    @csrf

                                    <button type="submit" class="btn btn-success">
                                        ⭐ Add to Favorites
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
