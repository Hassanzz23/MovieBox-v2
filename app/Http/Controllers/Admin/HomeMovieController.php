<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\HomeMovie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeMovieController extends Controller
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

        return view('admin.home-movies.index', compact(
            'movies',
            'tvShows',
            'animations',
            'anime'
        ));
    }


    public function create()
    {
        $categories = Category::all();

        return view('admin.home-movies.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image',
            'title' => 'required|string|max:255',
            'year' => 'required|integer',
            'genre' => 'required|array|min:1',
            'genre.*' => 'string|in:Action,Adventure,Animation,Comedy,Crime,Documentary,Drama,Family,Fantasy,History,Horror,Music,Sport,Mystery,Romance,Sci-Fi,Thriller,War,Western',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
        ]);

        $imageName = time() . '.' . $request->image->extension();

        $request->image->storeAs(
            'images',
            $imageName,
            'public'
        );

        HomeMovie::create([
            'image' => $imageName,
            'title' => $validated['title'],
            'year' => $validated['year'],
            'genre' => implode(', ', $validated['genre']),
            'category_id' => $validated['category_id'],
            'description' => $validated['description'],
            'sort_order' => HomeMovie::max('sort_order') + 1,
        ]);

        return redirect()
            ->route('home-movies.index')
            ->with('success', 'Movie added successfully.');
    }


    public function edit(HomeMovie $homeMovie)
    {
        $categories = Category::all();

        return view(
            'admin.home-movies.edit',
            compact('homeMovie', 'categories')
        );
    }


    public function update(Request $request, HomeMovie $homeMovie)
    {
        $validated = $request->validate([
            'image' => 'nullable|image',
            'title' => 'required|string|max:255',
            'year' => 'required|integer',
            'genre' => 'required|array|min:1',
            'genre.*' => 'string|in:Action,Adventure,Animation,Comedy,Crime,Documentary,Drama,Family,Fantasy,History,Horror,Music,Sport,Mystery,Romance,Sci-Fi,Thriller,War,Western',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
        ]);


        if ($request->hasFile('image')) {
            Storage::disk('public')
                ->delete('images/' . $homeMovie->image);

            $imageName = time() . '.' . $request->image->extension();

            $request->image->storeAs(
                'images',
                $imageName,
                'public'
            );

            $homeMovie->image = $imageName;
        }

        $homeMovie->title = $validated['title'];
        $homeMovie->year = $validated['year'];
        $homeMovie->genre = implode(', ', $validated['genre']);
        $homeMovie->category_id = $validated['category_id'];
        $homeMovie->description = $validated['description'];

        $homeMovie->save();


        return redirect()
            ->route('home-movies.index')
            ->with('success', 'Movie updated successfully.');
    }


    public function destroy(HomeMovie $homeMovie)
    {
        Storage::disk('public')
            ->delete('images/' . $homeMovie->image);


        $homeMovie->delete();


        return redirect()
            ->route('home-movies.index')
            ->with('success', 'Movie deleted successfully.');
    }

    public function reorder(Request $request)
    {
        $items = $request->input('items', []);

        foreach ($items as $item) {
            HomeMovie::where('id', $item['id'])
                ->update([
                    'sort_order' => $item['sort_order'],
                ]);
        }

        return response()->json([
            'success' => true,
        ]);
    }

    public function toggleVisibility(HomeMovie $homeMovie)
    {
        $homeMovie->is_visible = !$homeMovie->is_visible;
        $homeMovie->save();

        return back()->with('success', 'Movie visibility updated successfully.');
    }
}
