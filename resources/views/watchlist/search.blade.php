@extends('layout.master')

@section('content')

    @include('profile.nav')

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
                <div class="col-12 col-sm-6 col-lg-4 mb-4">

                    <a href="{{ route('watchlist.select', [
                        'imdb_id' => $result['imdbID'],
                    ]) }}"
                        class="text-decoration-none text-dark">

                        <div class="card h-100 shadow-sm rounded-0">

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

                                <div class="movie-card-info">

                                    <h5 class="movie-card-title fw-bold mb-0">

                                        {{ $result['Title'] }}

                                    </h5>

                                    @if (!empty($result['Year']))
                                        <p class="movie-card-year text-muted mb-0">

                                            {{ $result['Year'] }}

                                        </p>
                                    @endif

                                    @if (!empty($result['Type']))
                                        <span class="badge bg-secondary">

                                            {{ ucfirst($result['Type']) }}

                                        </span>
                                    @endif

                                </div>

                            </div>

                        </div>

                    </a>

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
