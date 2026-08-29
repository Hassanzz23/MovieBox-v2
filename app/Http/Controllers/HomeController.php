<?php

namespace App\Http\Controllers;

use App\Models\HomeMovie;
use App\Models\Movie;

class HomeController extends Controller
{
    public function index()
    {
        $movies = HomeMovie::with('category')
            ->whereHas('category', function ($query) {
                $query->where('title', 'Movie');
            })
            ->orderBy('sort_order')
            ->get();

        $tvShows = HomeMovie::with('category')
            ->whereHas('category', function ($query) {
                $query->where('title', 'TV Show');
            })
            ->orderBy('sort_order')
            ->get();

        $animations = HomeMovie::with('category')
            ->whereHas('category', function ($query) {
                $query->where('title', 'Animation');
            })
            ->orderBy('sort_order')
            ->get();

        $anime = HomeMovie::with('category')
            ->whereHas('category', function ($query) {
                $query->where('title', 'Anime');
            })
            ->orderBy('sort_order')
            ->get();

        return view('home', compact(
            'movies',
            'tvShows',
            'animations',
            'anime'
        ));
    }

    public function show(HomeMovie $homeMovie)
    {
        $homeMovie->load('category');

        $inWatchlist = false;

        if (auth()->check()) {
            $inWatchlist = Movie::where('user_id', auth()->id())
                ->where(function ($query) use ($homeMovie) {

                    $query->where('home_movie_id', $homeMovie->id)
                        ->orWhere('imdb_id', $homeMovie->imdb_id);
                })
                ->exists();
        }

        return view('home-movies.show', compact(
            'homeMovie',
            'inWatchlist'
        ));
    }
}
