<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Todo;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Favorite::with('todo')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(6);

        return view('favorites.index', compact('favorites'));
    }


    public function add(Todo $todo)
    {
        if ($todo->user_id !== auth()->id()) {
            abort(403);
        }

        $exists = Favorite::where('user_id', auth()->id())
            ->where('todo_id', $todo->id)
            ->exists();

        if ($exists) {
            return redirect()
                ->back()
                ->with('info', 'This movie is already in your Favorites.');
        }

        Favorite::create([
            'user_id' => auth()->id(),
            'todo_id' => $todo->id,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Added to Favorites.');
    }


    public function remove(Todo $todo)
    {
        if ($todo->user_id !== auth()->id()) {
            abort(403);
        }

        Favorite::where('user_id', auth()->id())
            ->where('todo_id', $todo->id)
            ->delete();

        return redirect()
            ->back()
            ->with('success', 'Removed from Favorites.');
    }
}
