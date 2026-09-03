@extends('admin.layout.master')

@section('content')
    <style>
        .sort-arrow {
            text-decoration: none;
            font-size: 13px;
            margin-left: 3px;
            opacity: 0.6;
        }

        .sort-arrow:hover {
            opacity: 1;
        }

        .sort-arrow.active {
            opacity: 1;
            font-weight: bold;
        }
    </style>

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="mb-1">
                {{ $category->title }} Statistics
            </h2>

            <p class="text-muted mb-0">
                Statistics for homepage {{ strtolower($category->title) }}s
            </p>
        </div>

        <a href="{{ route('home-movies.index') }}" class="btn btn-dark">
            Back
        </a>

    </div>


    <div class="table-responsive">

        <table class="table table-bordered align-middle">

            <thead>
                <tr>

                    <th>Name</th>

                    <th>
                        Year

                        <a href="{{ route('home-movies.statistics', [
                            'category' => $category->id,
                            'sort' => 'year',
                            'direction' => 'asc',
                        ]) }}"
                            class="sort-arrow {{ $sort === 'year' && $direction === 'asc' ? 'active' : '' }}">
                            ↑
                        </a>

                        <a href="{{ route('home-movies.statistics', [
                            'category' => $category->id,
                            'sort' => 'year',
                            'direction' => 'desc',
                        ]) }}"
                            class="sort-arrow {{ $sort === 'year' && $direction === 'desc' ? 'active' : '' }}">
                            ↓
                        </a>
                    </th>

                    <th>Genre</th>

                    <th>
                        Added

                        <a href="{{ route('home-movies.statistics', [
                            'category' => $category->id,
                            'sort' => 'created_at',
                            'direction' => 'asc',
                        ]) }}"
                            class="sort-arrow {{ $sort === 'created_at' && $direction === 'asc' ? 'active' : '' }}">
                            ↑
                        </a>

                        <a href="{{ route('home-movies.statistics', [
                            'category' => $category->id,
                            'sort' => 'created_at',
                            'direction' => 'desc',
                        ]) }}"
                            class="sort-arrow {{ $sort === 'created_at' && $direction === 'desc' ? 'active' : '' }}">
                            ↓
                        </a>
                    </th>

                    <th>
                        Watchlist

                        <a href="{{ route('home-movies.statistics', [
                            'category' => $category->id,
                            'sort' => 'watchlist_count',
                            'direction' => 'asc',
                        ]) }}"
                            class="sort-arrow {{ $sort === 'watchlist_count' && $direction === 'asc' ? 'active' : '' }}">
                            ↑
                        </a>

                        <a href="{{ route('home-movies.statistics', [
                            'category' => $category->id,
                            'sort' => 'watchlist_count',
                            'direction' => 'desc',
                        ]) }}"
                            class="sort-arrow {{ $sort === 'watchlist_count' && $direction === 'desc' ? 'active' : '' }}">
                            ↓
                        </a>
                    </th>

                    <th>
                        Favorites

                        <a href="{{ route('home-movies.statistics', [
                            'category' => $category->id,
                            'sort' => 'favorite_count',
                            'direction' => 'asc',
                        ]) }}"
                            class="sort-arrow {{ $sort === 'favorite_count' && $direction === 'asc' ? 'active' : '' }}">
                            ↑
                        </a>

                        <a href="{{ route('home-movies.statistics', [
                            'category' => $category->id,
                            'sort' => 'favorite_count',
                            'direction' => 'desc',
                        ]) }}"
                            class="sort-arrow {{ $sort === 'favorite_count' && $direction === 'desc' ? 'active' : '' }}">
                            ↓
                        </a>
                    </th>

                    <th>Visibility</th>

                </tr>
            </thead>

            <tbody>

                @forelse ($movies as $movie)
                    <tr>

                        <td>
                            {{ $movie->title }}
                        </td>

                        <td>
                            {{ $movie->year }}
                        </td>

                        <td>
                            {{ $movie->genre }}
                        </td>

                        <td>
                            {{ $movie->created_at->format('Y-m-d') }}
                        </td>

                        <td>
                            {{ $movie->watchlist_count }}
                        </td>

                        <td>
                            {{ $movie->favorite_count }}
                        </td>

                        <td>

                            @if ($movie->is_visible)
                                <span class="badge bg-success">
                                    Visible
                                </span>
                            @else
                                <span class="badge bg-secondary">
                                    Hidden
                                </span>
                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="7" class="text-center text-muted">
                            No movies found.
                        </td>
                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>
@endsection
