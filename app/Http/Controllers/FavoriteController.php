<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Movie;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Favorite::with('movie')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(6);

        return view('favorites.index', compact('favorites'));
    }


    public function add(Movie $movie)
    {
        if ($movie->user_id !== auth()->id()) {
            abort(403);
        }

        $exists = Favorite::where('user_id', auth()->id())
            ->where('movie_id', $movie->id)
            ->exists();

        if ($exists) {
            return redirect()
                ->back()
                ->with('info', 'This movie is already in your Favorites.');
        }

        Favorite::create([
            'user_id' => auth()->id(),
            'movie_id' => $movie->id,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Added to Favorites.');
    }


    public function remove(Movie $movie)
    {
        if ($movie->user_id !== auth()->id()) {
            abort(403);
        }

        Favorite::where('user_id', auth()->id())
            ->where('movie_id', $movie->id)
            ->delete();

        return redirect()
            ->back()
            ->with('success', 'Removed from Favorites.');
    }
}
