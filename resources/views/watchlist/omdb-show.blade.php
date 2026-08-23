@extends('layout.master')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">


        <h2 class="mb-0 fw-bold">

            {{ $movie['Title'] }}

            @if (!empty($movie['Year']) && $movie['Year'] !== 'N/A')
                <span class="text-muted fw-normal">
                    ({{ $movie['Year'] }})
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

                @if (!empty($movie['Poster']) && $movie['Poster'] !== 'N/A')
                    <img src="{{ $movie['Poster'] }}" alt="{{ $movie['Title'] }}" class="img-fluid w-100 rounded-0"
                        style="max-height: 600px; object-fit: cover;">
                @endif

            </div>


            <div class="col-12 col-md-8">

                <div class="card-body p-4">

                    <h2 class="fw-bold mb-2">

                        {{ $movie['Title'] }}

                        @if (!empty($movie['Year']) && $movie['Year'] !== 'N/A')
                            <span class="text-muted fw-normal">
                                ({{ $movie['Year'] }})
                            </span>
                        @endif

                    </h2>


                    @if (!empty($movie['Genre']) && $movie['Genre'] !== 'N/A')
                        <p class="text-muted mb-4">
                            {{ $movie['Genre'] }}
                        </p>
                    @endif


                    @if (!empty($movie['Plot']) && $movie['Plot'] !== 'N/A')
                        <p class="mb-4">
                            {{ $movie['Plot'] }}
                        </p>
                    @endif


                    @if ($alreadyInWatchlist)
                        <span class="btn btn-secondary disabled">
                            Already in WatchList
                        </span>
                    @else
                        <form action="{{ route('watchlist.store') }}" method="POST">

                            @csrf

                            <input type="hidden" name="type" value="{{ strtolower($movie['Type'] ?? '') }}">

                            <input type="hidden" name="imdb_id" value="{{ $movie['imdbID'] }}">

                            <input type="hidden" name="title" value="{{ $movie['Title'] }}">

                            <input type="hidden" name="year"
                                value="{{ is_numeric($movie['Year'] ?? null) ? $movie['Year'] : '' }}">

                            <input type="hidden" name="genre"
                                value="{{ ($movie['Genre'] ?? 'N/A') !== 'N/A' ? $movie['Genre'] : '' }}">

                            <input type="hidden" name="description"
                                value="{{ ($movie['Plot'] ?? 'N/A') !== 'N/A' ? $movie['Plot'] : '' }}">

                            <input type="hidden" name="poster_url"
                                value="{{ ($movie['Poster'] ?? 'N/A') !== 'N/A' ? $movie['Poster'] : '' }}">

                            <button type="submit" class="btn btn-primary">
                                Add to WatchList
                            </button>

                        </form>
                    @endif


                </div>

            </div>

        </div>


    </div>

@endsection
