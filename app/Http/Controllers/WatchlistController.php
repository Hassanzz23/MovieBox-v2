<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\HomeMovie;
use App\Models\Movie;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class WatchlistController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'all');
        $sort = $request->get('sort', 'default');

        $query = Movie::with('category')
            ->where('user_id', auth()->id());

        switch ($filter) {

            case 'watched':
                $query->where('status', true);
                break;

            case 'unwatched':
                $query->where('status', false);
                break;

            case 'rated':
                $query->whereNotNull('rating');
                break;

            case 'not_rated':
                $query->whereNull('rating');
                break;

            case 'favorites':
                $query->whereHas('favorites', function ($favoriteQuery) {
                    $favoriteQuery->where('user_id', auth()->id());
                });
                break;
        }

        switch ($sort) {

            case 'name_asc':
                $query->orderBy('title', 'asc');
                break;

            case 'name_desc':
                $query->orderBy('title', 'desc');
                break;

            case 'year_desc':
                $query->orderBy('year', 'desc');
                break;

            case 'year_asc':
                $query->orderBy('year', 'asc');
                break;

            case 'rating_desc':
                $query->orderBy('rating', 'desc');
                break;

            case 'rating_asc':
                $query->orderBy('rating', 'asc');
                break;

            case 'newest':
                $query->latest();
                break;

            case 'oldest':
                $query->oldest();
                break;

            default:
                $query->oldest();
                break;
        }

        $movies = $query->paginate(6)->withQueryString();

        $favorites = Favorite::where('user_id', auth()->id())
            ->whereIn('movie_id', $movies->pluck('id'))
            ->pluck('movie_id')
            ->toArray();

        return view('watchlist.index', compact(
            'movies',
            'favorites',
            'filter',
            'sort'
        ));
    }

    public function add($homeMovie)
    {
        $homeMovie = HomeMovie::findOrFail($homeMovie);

        $exists = Movie::where('user_id', auth()->id())
            ->where('home_movie_id', $homeMovie->id)
            ->exists();

        if ($exists) {
            return redirect()
                ->route('watchlist.index')
                ->with('info', 'This movie is already in your WatchList.');
        }

        Movie::create([
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

    public function remove(Movie $movie)
    {
        $this->authorizeMovie($movie);

        $movie->delete();

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

        $exists = Movie::where('user_id', auth()->id())
            ->where('imdb_id', $validated['imdb_id'])
            ->exists();

        if ($exists) {
            return redirect()
                ->route('watchlist.index')
                ->with('info', 'This movie is already in your WatchList.');
        }

        $response = Http::timeout(10)->get(
            'https://www.omdbapi.com/',
            [
                'apikey' => config('services.omdb.key'),
                'i' => $validated['imdb_id'],
                'plot' => 'full',
            ]
        );

        if (!$response->successful()) {
            return redirect()
                ->route('watchlist.index')
                ->with('error', 'Movie information service is temporarily unavailable.');
        }

        $omdbMovie = $response->json();

        if (($omdbMovie['Response'] ?? 'False') === 'False') {
            return redirect()
                ->route('watchlist.index')
                ->with('error', 'Movie information not found.');
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

        $posterUrl = $omdbMovie['Poster'] ?? null;

        if (!$posterUrl || $posterUrl === 'N/A') {
            return redirect()
                ->route('watchlist.index')
                ->with('error', 'Movie poster is not available.');
        }

        $imageName = $this->downloadPoster($posterUrl);

        if (!$imageName) {
            return redirect()
                ->route('watchlist.index')
                ->with('error', 'Movie poster could not be downloaded.');
        }


        $year = null;

        if (!empty($omdbMovie['Year'])) {
            preg_match('/^\d{4}/', $omdbMovie['Year'], $matches);
            $year = $matches[0] ?? null;
        }

        Movie::create([
            'user_id' => auth()->id(),
            'imdb_id' => $validated['imdb_id'],
            'title' => $omdbMovie['Title'],
            'year' => $year,
            'genre' => $omdbMovie['Genre'] ?? null,
            'description' => $omdbMovie['Plot'] ?? '',
            'image' => $imageName,
            'status' => false,
            'category_id' => $category->id,
        ]);

        return redirect()
            ->route('watchlist.index')
            ->with('success', 'Added to WatchList.');
    }

    public function watched(Movie $movie)
    {
        $this->authorizeMovie($movie);

        $movie->update([
            'status' => true,
        ]);

        return redirect()
            ->route('watchlist.index')
            ->with('success', 'Marked as watched.');
    }

    public function rate(Request $request, Movie $movie)
    {
        $this->authorizeMovie($movie);

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:10',
        ]);

        $movie->update([
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

        $alreadyInWatchlist = Movie::where('user_id', auth()->id())
            ->where('imdb_id', $movie['imdbID'])
            ->exists();

        return view('watchlist.omdb-show', compact(
            'movie',
            'alreadyInWatchlist'
        ));
    }


    public function show(Movie $movie)
    {
        $this->authorizeMovie($movie);

        $isFavorite = Favorite::where('user_id', auth()->id())
            ->where('movie_id', $movie->id)
            ->exists();

        return view('watchlist.detail', compact('movie', 'isFavorite'));
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

        $imdbIds = collect($results)
            ->pluck('imdbID')
            ->filter()
            ->values();

        $watchlistMovies = Movie::where('user_id', auth()->id())
            ->whereIn('imdb_id', $imdbIds)
            ->get()
            ->keyBy('imdb_id');

        $favoriteMovieIds = Favorite::where('user_id', auth()->id())
            ->whereIn('movie_id', $watchlistMovies->pluck('id'))
            ->pluck('movie_id')
            ->toArray();

        return view(
            'watchlist.search',
            compact('results', 'query', 'watchlistMovies', 'favoriteMovieIds')
        );
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

    private function authorizeMovie(Movie $movie): void
    {
        abort_if($movie->user_id !== auth()->id(), 403);
    }
}
