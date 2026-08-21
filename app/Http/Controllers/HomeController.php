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
            ->limit(6)
            ->get();

        $tvShows = HomeMovie::with('category')
            ->whereHas('category', function ($query) {
                $query->where('title', 'TV Show');
            })
            ->limit(6)
            ->get();

        $animations = HomeMovie::with('category')
            ->whereHas('category', function ($query) {
                $query->where('title', 'Animation');
            })
            ->limit(6)
            ->get();

        $anime = HomeMovie::with('category')
            ->whereHas('category', function ($query) {
                $query->where('title', 'Anime');
            })
            ->limit(6)
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
                ->where('home_movie_id', $homeMovie->id)
                ->exists();
        }

        return view('home-movies.show', compact(
            'homeMovie',
            'inWatchlist'
        ));
    }
}
