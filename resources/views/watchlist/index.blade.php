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
            height: 125px;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding: 16px;
        }

        .watchlist-card-title {
            margin: 0;
            line-height: 1.4;
        }

        .watchlist-card-genre {
            margin: 0;
        }

        .watchlist-card-actions {
            min-height: 105px;
            margin-top: auto;
            padding: 0 16px 16px;
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

        .watchlist-bottom-actions {
            width: 100%;
            min-height: 36px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 8px;
        }

        .watchlist-bottom-actions form {
            margin: 0;
        }

        .watchlist-action-btn {
            width: 36px;
            height: 36px;
            padding: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 4px;

            font-size: 20px;
            line-height: 1;

            cursor: pointer;
            transition: 0.2s ease;
        }

        /* Favorite */

        .favorite-action {
            background-color: transparent;
            border: 1px solid #ffc107;
            color: #ffc107;
        }

        .favorite-action:hover {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #212529;
        }

        .favorite-action.active {
            background-color: #212529;
            border-color: #212529;
            color: #ffc107;
        }

        .favorite-action.active:hover {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #212529;
        }

        /* Remove */

        .remove-action {
            background-color: transparent;
            border: 1px solid #dc3545;
            color: #dc3545;
            font-size: 23px;
        }

        .remove-action:hover {
            background-color: #dc3545;
            border-color: #dc3545;
            color: #fff;
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


        <div class="d-flex flex-column align-items-end gap-2">

            <form action="{{ route('watchlist.search') }}" method="GET" class="d-flex">

                <input type="text" name="query" class="form-control" placeholder="Search movies..." style="width: 280px;"
                    required>

                <button type="submit" class="btn btn-dark ms-2">
                    Search
                </button>

            </form>


            <form action="{{ route('watchlist.index') }}" method="GET"
                class="d-flex align-items-center gap-2 flex-wrap justify-content-end">

                <label class="text-muted mb-0">
                    View:
                </label>

                <select name="filter" class="form-select form-select-sm" style="width: 150px;">

                    <option value="all" {{ $filter === 'all' ? 'selected' : '' }}>
                        All
                    </option>

                    <option value="watched" {{ $filter === 'watched' ? 'selected' : '' }}>
                        Watched
                    </option>

                    <option value="unwatched" {{ $filter === 'unwatched' ? 'selected' : '' }}>
                        Not Watched
                    </option>

                    <option value="rated" {{ $filter === 'rated' ? 'selected' : '' }}>
                        Rated
                    </option>

                    <option value="not_rated" {{ $filter === 'not_rated' ? 'selected' : '' }}>
                        Not Rated
                    </option>

                    <option value="favorites" {{ $filter === 'favorites' ? 'selected' : '' }}>
                        Favorites
                    </option>

                </select>


                <label class="text-muted mb-0">
                    Sort by:
                </label>

                <select name="sort" class="form-select form-select-sm" style="width: 175px;">

                    <option value="default" {{ $sort === 'default' ? 'selected' : '' }}>
                        Default
                    </option>

                    <option value="name_asc" {{ $sort === 'name_asc' ? 'selected' : '' }}>
                        Name: A → Z
                    </option>

                    <option value="name_desc" {{ $sort === 'name_desc' ? 'selected' : '' }}>
                        Name: Z → A
                    </option>

                    <option value="year_desc" {{ $sort === 'year_desc' ? 'selected' : '' }}>
                        Year: Newest → Oldest
                    </option>

                    <option value="year_asc" {{ $sort === 'year_asc' ? 'selected' : '' }}>
                        Year: Oldest → Newest
                    </option>

                    <option value="rating_desc" {{ $sort === 'rating_desc' ? 'selected' : '' }}>
                        Rating: High → Low
                    </option>

                    <option value="rating_asc" {{ $sort === 'rating_asc' ? 'selected' : '' }}>
                        Rating: Low → High
                    </option>

                    <option value="newest" {{ $sort === 'newest' ? 'selected' : '' }}>
                        Added: Newest
                    </option>

                    <option value="oldest" {{ $sort === 'oldest' ? 'selected' : '' }}>
                        Added: Oldest
                    </option>

                </select>


                <button type="submit" class="btn btn-dark btn-sm">
                    Go
                </button>

            </form>


        </div>

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


                            <div class="watchlist-card-info">

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


                        <div class="watchlist-card-actions">

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


                            <div class="watchlist-bottom-actions">

                                @if (in_array($movie->id, $favorites))
                                    <form action="{{ route('favorites.remove', $movie) }}" method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="watchlist-action-btn favorite-action active"
                                            title="Remove from Favorites">

                                            ★

                                        </button>

                                    </form>
                                @else
                                    <form action="{{ route('favorites.add', $movie) }}" method="POST">

                                        @csrf

                                        <button type="submit" class="watchlist-action-btn favorite-action"
                                            title="Add to Favorites">

                                            ☆

                                        </button>

                                    </form>
                                @endif


                                <form action="{{ route('watchlist.remove', $movie) }}" method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="watchlist-action-btn remove-action"
                                        title="Remove from WatchList">

                                        −

                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>
            @endforeach

        </div>


        <div class="mt-4">
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
