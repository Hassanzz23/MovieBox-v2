@extends('layout.master')

@section('content')

    @include('profile.nav')

    <style>
        .favorite-card {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .favorite-card-poster {
            width: 100%;
            height: 360px;
            object-fit: cover;
            flex-shrink: 0;
        }

        .favorite-card-info {
            height: 125px;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding: 16px;
        }

        .favorite-card-title {
            margin: 0;
            line-height: 1.4;
        }

        .favorite-card-genre {
            margin: 0;
        }

        .favorite-card-status {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 8px;
        }

        .favorite-card-actions {
            min-height: 105px;
            margin-top: auto;
            padding: 0 16px 16px;
            display: flex;
            align-items: flex-end;
            justify-content: flex-end;
        }

        .favorite-card-actions form {
            margin: 0;
        }

        .favorite-remove-btn {
            min-height: 36px;
            transition: 0.2s ease;
        }

        .favorite-remove-btn:hover {
            background-color: #dc3545;
            border-color: #dc3545;
            color: #fff;
        }
    </style>


    <div class="mb-4">

        <h2 class="mb-1 fw-bold">
            Favorites
        </h2>

        <p class="text-muted mb-0">
            Your favorite movies and shows
        </p>

    </div>


    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    @if (session('info'))
        <div class="alert alert-info">
            {{ session('info') }}
        </div>
    @endif


    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif


    @if ($favorites->count())
        <div class="row">

            @foreach ($favorites as $favorite)
                @php
                    $movie = $favorite->movie;
                @endphp

                @if (!$movie)
                    @continue
                @endif


                <div class="col-12 col-sm-6 col-lg-4 mb-4">

                    <div class="card favorite-card shadow-sm rounded-0">

                        <a href="{{ route('watchlist.show', $movie) }}"
                            class="text-decoration-none text-dark d-flex flex-column flex-grow-1">

                            @if ($movie->image)
                                <img src="{{ asset('storage/images/' . $movie->image) }}"
                                    class="favorite-card-poster rounded-0" alt="{{ $movie->title }}">
                            @endif


                            <div class="favorite-card-info">

                                <h5 class="favorite-card-title fw-bold">

                                    {{ $movie->title }}

                                    @if ($movie->year)
                                        <span class="text-muted fw-normal">
                                            ({{ $movie->year }})
                                        </span>
                                    @endif

                                </h5>


                                @if ($movie->genre)
                                    <p class="favorite-card-genre text-muted mt-2">
                                        {{ $movie->genre }}
                                    </p>
                                @endif


                                @if ($movie->status)
                                    <div class="favorite-card-status">

                                        <span class="badge bg-success">
                                            Watched
                                        </span>


                                        @if ($movie->rating)
                                            <span class="badge bg-dark">
                                                ⭐ {{ $movie->rating }}/10
                                            </span>
                                        @endif

                                    </div>
                                @endif

                            </div>

                        </a>


                        <div class="favorite-card-actions">

                            <form action="{{ route('favorites.remove', $movie) }}" method="POST"
                                onsubmit="return confirm('Remove this movie from your Favorites?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-outline-danger btn-sm favorite-remove-btn">

                                    Remove from Favorites

                                </button>

                            </form>

                        </div>

                    </div>

                </div>
            @endforeach

        </div>


        <div class="mt-3">

            {{ $favorites->links() }}

        </div>
    @else
        <div class="text-center py-5">

            <h4>
                Your Favorites are empty.
            </h4>

            <p class="text-muted">
                Movies and shows you add to your favorites will appear here.
            </p>

        </div>
    @endif

@endsection
