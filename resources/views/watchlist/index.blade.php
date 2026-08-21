@extends('layout.master')

@section('content')


    @include('profile.nav')

    <style>
        .watchlist-card {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .watchlist-card-poster {
            width: 100%;
            height: 360px;
            object-fit: cover;
            flex-shrink: 0;
        }

        .watchlist-card-info {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .watchlist-card-title {
            margin: 0;
            line-height: 1.4;
        }

        .watchlist-card-genre {
            margin: 0;
        }

        .watchlist-card-actions {
            margin-top: auto;
            min-height: 76px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            align-items: flex-start;
            gap: 8px;
        }

        .watchlist-card-actions form {
            margin: 0;
        }

        .watchlist-rating {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .watchlist-rating form {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 0;
        }
    </style>


    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="mb-1">
                My WatchList
            </h2>

            <p class="text-muted mb-0">
                Movies and shows you want to watch
            </p>
        </div>


        <form action="{{ route('watchlist.search') }}" method="GET" class="d-flex">

            <input type="text" name="query" class="form-control" placeholder="Search movies..." style="width: 280px;"
                required>

            <input type="hidden" name="page" value="{{ request('page', 1) }}">

            <button type="submit" class="btn btn-dark ms-2">
                Search
            </button>

        </form>

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


    @if ($movies->count())
        <div class="row">

            @foreach ($movies as $movie)
                <div class="col-12 col-sm-6 col-lg-4 mb-4">

                    <div class="card watchlist-card shadow-sm rounded-0">


                        <a href="{{ route('watchlist.show', $movie) }}"
                            class="text-decoration-none text-dark d-flex flex-column flex-grow-1">

                            @if ($movie->image)
                                <img src="{{ asset('storage/images/' . $movie->image) }}"
                                    class="watchlist-card-poster rounded-0" alt="{{ $movie->title }}">
                            @endif


                            <div class="card-body watchlist-card-info">

                                <h5 class="watchlist-card-title fw-bold">

                                    {{ $movie->title }}

                                    @if ($movie->year)
                                        <span class="text-muted fw-normal">
                                            ({{ $movie->year }})
                                        </span>
                                    @endif

                                </h5>


                                @if ($movie->genre)
                                    <p class="watchlist-card-genre text-muted mt-2">
                                        {{ $movie->genre }}
                                    </p>
                                @endif

                            </div>

                        </a>


                        <div class="card-body pt-0 watchlist-card-actions">


                            @if ($movie->status)
                                <span class="badge bg-success">
                                    Watched
                                </span>


                                @if ($movie->rating)
                                    <span class="badge bg-dark">
                                        {{ $movie->rating }}/10
                                    </span>
                                @else
                                    <div class="watchlist-rating">

                                        <form action="{{ route('watchlist.rate', $movie) }}" method="POST">

                                            @csrf
                                            @method('PUT')

                                            <select name="rating" class="form-select form-select-sm" style="width: 90px;"
                                                required>

                                                <option value="">
                                                    Rate
                                                </option>

                                                @for ($i = 1; $i <= 10; $i++)
                                                    <option value="{{ $i }}">
                                                        {{ $i }}/10
                                                    </option>
                                                @endfor

                                            </select>


                                            <button type="submit" class="btn btn-sm btn-dark">
                                                Save
                                            </button>

                                        </form>

                                    </div>
                                @endif
                            @else
                                <form action="{{ route('watchlist.watched', $movie) }}" method="POST">

                                    @csrf
                                    @method('PUT')

                                    <button type="submit" class="btn btn-sm btn-warning">
                                        Mark as Watched
                                    </button>

                                </form>
                            @endif


                        </div>

                    </div>

                </div>
            @endforeach

        </div>


        <div class="mt-3">

            {{ $movies->links() }}

        </div>
    @else
        <div class="text-center py-5">

            <h4>
                Your WatchList is empty.
            </h4>

            <p class="text-muted">
                Add movies and shows you want to watch.
            </p>

        </div>
    @endif


@endsection
