<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\HomeMovie;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class WatchlistController extends Controller
{
    public function index()
    {
        $todos = Todo::with('category')
            ->where('user_id', auth()->id())
            ->paginate(6);

        return view('watchlist.index', compact('todos'));
    }

    public function add($homeMovie)
    {
        $homeMovie = HomeMovie::findOrFail($homeMovie);

        $exists = Todo::where('user_id', auth()->id())
            ->where('home_movie_id', $homeMovie->id)
            ->exists();

        if ($exists) {
            return redirect()
                ->route('watchlist.index')
                ->with('info', 'This movie is already in your WatchList.');
        }

        Todo::create([
            'user_id' => auth()->id(),
            'home_movie_id' => $homeMovie->id,
            'title' => $homeMovie->title,
            'image' => $homeMovie->image,
            'year' => $homeMovie->year,
            'description' => $homeMovie->description,
            'genre' => $homeMovie->genre,
            'category_id' => $homeMovie->category_id,
            'status' => false,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Added to WatchList.');
    }

    public function remove(Todo $todo)
    {
        $this->authorizeTodo($todo);

        $todo->delete();

        return redirect()
            ->route('watchlist.index')
            ->with('success', 'Removed from WatchList.');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'imdb_id' => 'required|string|max:20',
            'title' => 'required|string|max:255',
            'year' => 'nullable|integer',
            'genre' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'poster_url' => 'nullable|url',
            'type' => 'required|in:movie,series,episode',
        ]);

        $exists = Todo::where('user_id', auth()->id())
            ->where('imdb_id', $validated['imdb_id'])
            ->exists();

        if ($exists) {
            return redirect()
                ->route('watchlist.index')
                ->with('info', 'This movie is already in your WatchList.');
        }

        $categoryTitle = match ($validated['type']) {
            'movie' => 'Movie',
            'series', 'episode' => 'TV Show',
        };

        $category = Category::where('title', $categoryTitle)->first();

        if (!$category) {
            return redirect()
                ->route('watchlist.index')
                ->with('error', 'Movie category not found.');
        }

        $imageName = $this->downloadPoster(
            $validated['poster_url'] ?? null
        );

        Todo::create([
            'user_id' => auth()->id(),
            'imdb_id' => $validated['imdb_id'],
            'title' => $validated['title'],
            'year' => $validated['year'] ?? null,
            'genre' => $validated['genre'] ?? null,
            'description' => $validated['description'] ?? null,
            'image' => $imageName,
            'status' => false,
            'category_id' => $category->id,
        ]);

        return redirect()
            ->route('watchlist.index')
            ->with('success', 'Added to WatchList.');
    }

    public function watched(Todo $todo)
    {
        $this->authorizeTodo($todo);

        $todo->update([
            'status' => true,
        ]);

        return redirect()
            ->route('watchlist.index')
            ->with('success', 'Marked as watched.');
    }

    public function rate(Request $request, Todo $todo)
    {
        $this->authorizeTodo($todo);

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:10',
        ]);

        $todo->update([
            'rating' => $validated['rating'],
        ]);

        return redirect()
            ->route('watchlist.index')
            ->with('success', 'Rating saved.');
    }

    public function selectOmdb($imdb_id)
    {
        $response = Http::timeout(10)->get(
            'https://www.omdbapi.com/',
            [
                'apikey' => config('services.omdb.key'),
                'i' => $imdb_id,
                'plot' => 'full',
            ]
        );

        if (!$response->successful()) {
            return redirect()
                ->route('watchlist.index')
                ->with('error', 'Movie information service is temporarily unavailable.');
        }

        $movie = $response->json();

        if (($movie['Response'] ?? 'False') === 'False') {
            return redirect()
                ->route('watchlist.index')
                ->with('error', 'Movie information not found.');
        }

        return view('watchlist.omdb-show', compact('movie'));
    }

    public function show(Todo $todo)
    {
        $this->authorizeTodo($todo);

        return view('watchlist.detail', compact('todo'));
    }

    public function search(Request $request)
    {
        $validated = $request->validate([
            'query' => 'required|string|max:255',
        ]);

        $query = trim($validated['query']);

        $response = Http::timeout(10)->get(
            'https://www.omdbapi.com/',
            [
                'apikey' => config('services.omdb.key'),
                's' => $query,
            ]
        );
        

        if (!$response->successful()) {
            return redirect()
                ->route('watchlist.index')
                ->with('error', 'Search service is temporarily unavailable.');
        }

        $data = $response->json();

        if (($data['Response'] ?? 'False') === 'False') {
            return redirect()
                ->route('watchlist.index')
                ->with('error', 'Movie or TV show not found.');
        }

        $results = $data['Search'] ?? [];

        return view('watchlist.search', compact('results', 'query'));
    }

    private function downloadPoster(?string $posterUrl): ?string
    {
        if (!$posterUrl) {
            return null;
        }

        try {
            $response = Http::timeout(15)->get($posterUrl);

            if (!$response->successful()) {
                return null;
            }

            $imageName = uniqid() . '.jpg';

            Storage::disk('public')->put(
                'images/' . $imageName,
                $response->body()
            );

            return $imageName;
        } catch (\Exception $e) {
            return null;
        }
    }

    private function authorizeTodo(Todo $todo): void
    {
        abort_if($todo->user_id !== auth()->id(), 403);
    }
}
