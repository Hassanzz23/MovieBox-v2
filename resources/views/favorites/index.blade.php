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
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 6px;
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
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
            margin-top: 6px;
        }

        .favorite-card-actions {
            margin-top: auto;
            min-height: 58px;
            display: flex;
            align-items: flex-end;
        }

        .favorite-card-actions form {
            margin: 0;
        }
    </style>


    {{-- Page Header --}}
    <div class="mb-4">

        <h2 class="mb-1 fw-bold">
            Favorites
        </h2>

        <p class="text-muted mb-0">
            Your favorite movies and shows
        </p>

    </div>


    {{-- Success Message --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    {{-- Info Message --}}
    @if (session('info'))
        <div class="alert alert-info">
            {{ session('info') }}
        </div>
    @endif


    {{-- Error Message --}}
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif


    @if ($favorites->count())
        <div class="row">

            @foreach ($favorites as $favorite)
                @php
                    $todo = $favorite->todo;
                @endphp


                <div class="col-12 col-sm-6 col-lg-4 mb-4">

                    <div class="card favorite-card shadow-sm rounded-0">


                        {{-- Movie --}}
                        <a href="{{ route('watchlist.show', $todo) }}"
                            class="text-decoration-none text-dark d-flex flex-column flex-grow-1">

                            {{-- Poster --}}
                            @if ($todo->image)
                                <img src="{{ asset('storage/images/' . $todo->image) }}"
                                    class="favorite-card-poster rounded-0" alt="{{ $todo->title }}">
                            @endif


                            {{-- Movie Information --}}
                            <div class="card-body favorite-card-info">

                                {{-- Title --}}
                                <h5 class="favorite-card-title fw-bold">

                                    {{ $todo->title }}

                                    @if ($todo->year)
                                        <span class="text-muted fw-normal">
                                            ({{ $todo->year }})
                                        </span>
                                    @endif

                                </h5>


                                {{-- Genre --}}
                                @if ($todo->genre)
                                    <p class="favorite-card-genre text-muted">
                                        {{ $todo->genre }}
                                    </p>
                                @endif


                                {{-- Status --}}
                                @if ($todo->status)
                                    <div class="favorite-card-status">

                                        {{-- Watched --}}
                                        <span class="badge bg-success">
                                            Watched
                                        </span>


                                        {{-- Rating --}}
                                        @if ($todo->rating)
                                            <span class="badge bg-dark">
                                                ⭐ {{ $todo->rating }}/10
                                            </span>
                                        @endif

                                    </div>
                                @endif

                            </div>

                        </a>


                        {{-- Remove Favorite --}}
                        <div class="card-body pt-0 favorite-card-actions">

                            <form action="{{ route('favorites.remove', $todo) }}" method="POST"
                                onsubmit="return confirm('Remove this movie from your Favorites?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    Remove from Favorites
                                </button>

                            </form>

                        </div>

                    </div>

                </div>
            @endforeach

        </div>


        {{-- Pagination --}}
        <div class="mt-3">

            {{ $favorites->links() }}

        </div>
    @else
        {{-- Empty Favorites --}}
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
