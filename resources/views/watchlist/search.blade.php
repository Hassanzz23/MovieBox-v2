@extends('layout.master')

@section('content')

    @include('profile.nav')

    <style>
        .search-action-btn {
            width: 28px;
            height: 28px;
            padding: 0;
            border-radius: 4px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            font-size: 18px;
            font-weight: 400;
            line-height: 28px;
        }
    </style>

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="mb-1 fw-bold">
                Search Results
            </h2>

            <p class="text-muted mb-0">
                Results for:
                <strong>"{{ $query }}"</strong>
            </p>
        </div>

        <a href="{{ route('watchlist.index') }}" class="btn btn-dark">
            Back to WatchList
        </a>

    </div>


    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif


    @if (count($results))
        <div class="row">

            @foreach ($results as $result)
                @php
                    $watchlistMovie = $watchlistMovies->get($result['imdbID']);
                    $isFavorite = $watchlistMovie ? in_array($watchlistMovie->id, $favoriteMovieIds) : false;
                @endphp

                <div class="col-12 col-sm-6 col-lg-4 mb-4">

                    <div class="card h-100 shadow-sm rounded-0 position-relative">

                        <a href="{{ route('watchlist.select', ['imdb_id' => $result['imdbID']]) }}"
                            class="text-decoration-none text-dark">

                            @if (!empty($result['Poster']) && $result['Poster'] !== 'N/A')
                                <img src="{{ $result['Poster'] }}" class="card-img-top rounded-0"
                                    alt="{{ $result['Title'] }}" style="height: 360px; object-fit: cover;">
                            @else
                                <div class="d-flex align-items-center justify-content-center bg-secondary text-white"
                                    style="height: 360px;">

                                    No Poster

                                </div>
                            @endif

                            <div class="card-body">

                                <h5 class="fw-bold mb-0">
                                    {{ $result['Title'] }}
                                </h5>

                                @if (!empty($result['Year']))
                                    <p class="text-muted mb-1">
                                        {{ $result['Year'] }}
                                    </p>
                                @endif

                                @if (!empty($result['Type']))
                                    <span class="badge bg-secondary">
                                        {{ ucfirst($result['Type']) }}
                                    </span>
                                @endif

                            </div>

                        </a>


                        <div class="card-body pt-0 d-flex justify-content-end align-items-center gap-2">

                            @if ($watchlistMovie)
                                <span class="text-muted small">
                                    Already in WatchList
                                </span>
                            @else
                                <form action="{{ route('watchlist.store') }}" method="POST">

                                    @csrf

                                    <input type="hidden" name="imdb_id" value="{{ $result['imdbID'] }}">

                                    <input type="hidden" name="title" value="{{ $result['Title'] }}">

                                    <input type="hidden" name="year" value="{{ $result['Year'] ?? '' }}">

                                    <input type="hidden" name="type" value="{{ $result['Type'] ?? '' }}">

                                    <button type="submit" class="btn btn-primary search-action-btn"
                                        title="Add to WatchList">
                                        +
                                    </button>

                                </form>
                            @endif

                        </div>

                    </div>

                </div>
            @endforeach

        </div>
    @else
        <div class="text-center py-5">

            <h4>
                No results found.
            </h4>

            <p class="text-muted">
                Try searching with a different movie or show name.
            </p>

        </div>
    @endif

@endsection
