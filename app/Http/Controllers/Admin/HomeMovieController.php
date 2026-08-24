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
            ->latest()
            ->paginate(12);

        return view('admin.home-movies.index', compact('movies'));
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
            'genre' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
        ]);


        $imageName = time() . '.' .
            $request->image->extension();


        $request->image->storeAs(
            'images',
            $imageName,
            'public'
        );


        HomeMovie::create([
            'image' => $imageName,
            'title' => $validated['title'],
            'year' => $validated['year'],
            'genre' => $validated['genre'],
            'category_id' => $validated['category_id'],
            'description' => $validated['description'],
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
            'genre' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
        ]);


        if ($request->hasFile('image')) {

            Storage::disk('public')
                ->delete('images/' . $homeMovie->image);


            $imageName = time() . '.' .
                $request->image->extension();


            $request->image->storeAs(
                'images',
                $imageName,
                'public'
            );


            $homeMovie->image = $imageName;
        }


        $homeMovie->update([
            'title' => $validated['title'],
            'year' => $validated['year'],
            'genre' => $validated['genre'],
            'category_id' => $validated['category_id'],
            'description' => $validated['description'],
        ]);


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
}