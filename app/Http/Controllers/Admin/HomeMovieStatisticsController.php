<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\HomeMovie;
use App\Models\Movie;
use App\Models\Favorite;
use Illuminate\Http\Request;

class HomeMovieStatisticsController extends Controller
{
    public function index(Category $category, Request $request)
    {
        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'desc');

        $allowedSorts = [
            'year',
            'created_at',
            'watchlist_count',
            'favorite_count',
        ];

        if (!in_array($sort, $allowedSorts)) {
            $sort = 'created_at';
        }

        if (!in_array($direction, ['asc', 'desc'])) {
            $direction = 'desc';
        }

        $movies = HomeMovie::where('category_id', $category->id)
            ->get();

        foreach ($movies as $movie) {

            $movie->watchlist_count = Movie::where(
                'home_movie_id',
                $movie->id
            )->distinct('user_id')->count('user_id');

            $movie->favorite_count = Favorite::whereHas('movie', function ($query) use ($movie) {
                $query->where('home_movie_id', $movie->id);
            })->distinct('user_id')->count('user_id');
        }

        $movies = $movies->sortBy(
            $sort === 'watchlist_count' || $sort === 'favorite_count'
                ? fn($movie) => $movie->{$sort}
                : fn($movie) => $movie->{$sort},
            SORT_REGULAR,
            $direction === 'desc'
        )->values();

        return view('admin.home-movies.statistics', compact(
            'category',
            'movies',
            'sort',
            'direction'
        ));
    }
}
