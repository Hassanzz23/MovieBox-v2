<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Todo;
use Illuminate\Support\Facades\Storage;

class TodoController extends Controller
{

    public function show(Todo $todo)
    {
        return view('todos.show', compact('todo'));
    }

    public function create()
    {
        $categories = Category::all();
        return view("todos.create", compact("categories"));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|max:2000|image',
            'title' => 'required|min:1',
            'year' => 'required|integer|min:1888|max:' . date('Y'),
            'genre' => 'required|string|min:2',
            'description' => 'required|min:5',
            'category_id' => 'required|integer|exists:categories,id',
        ]);

        $filename = time() . '_' . $request->image->getClientOriginalName();
        $request->image->storeAs('/images', $filename);

        Todo::create([
            'user_id' => auth()->id(),
            'image' => $filename,
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('home');
    }

    public function edit(Todo $todo)
    {
        $categories = Category::all();
        return view('todos.edit', compact('todo', 'categories'));
    }

    public function update(Request $request, Todo $todo)
    {
        $request->validate([
            'image' => 'nullable|max:2000|image',
            'title' => 'required|min:1',
            'year' => 'required|integer|min:1888|max:' . date('Y'),
            'genre' => 'required|string|min:2',
            'description' => 'required|min:5',
            'category_id' => 'required|integer|exists:categories,id',
        ]);

        if ($request->hasFile('image')) {
            Storage::delete('/images/' . $todo->image);

            $filename = time() . '_' . $request->image->getClientOriginalName();

            $request->image->storeAs('/images', $filename);
        }

        $todo->update([
            'image' => $request->hasFile('image') ? $filename : $todo->image,
            'title' => $request->title,
            'year' => $request->year,
            'genre' => $request->genre,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('home');
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->route('home');
    }
}
