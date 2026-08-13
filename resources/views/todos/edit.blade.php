@extends('layout.master')

@section('content')
    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Edit</h5>

            <a href="{{ route('home') }}" class="btn btn-dark">
                Back
            </a>
        </div>

        <div class="card-body">

            <form action="{{ route('todo.update', ['todo' => $todo->id]) }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Poster</label>

                    <input type="file" name="image" class="form-control">

                    <div class="form-text text-danger">
                        @error('image')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Title</label>

                    <input type="text" name="title" value="{{ old('title', $todo->title) }}" class="form-control">

                    <div class="form-text text-danger">
                        @error('title')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Year</label>

                    <input type="number" name="year" value="{{ old('year', $todo->year) }}" class="form-control">

                    <div class="form-text text-danger">
                        @error('year')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Genre</label>

                    <input type="text" name="genre" value="{{ old('genre', $todo->genre) }}" class="form-control"
                        placeholder="Action, Drama, Sci-Fi...">

                    <div class="form-text text-danger">
                        @error('genre')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Category</label>

                    <select class="form-select" name="category_id">

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $todo->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->title }}
                            </option>
                        @endforeach

                    </select>

                    <div class="form-text text-danger">
                        @error('category_id')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>

                    <textarea class="form-control" name="description" rows="3">{{ old('description', $todo->description) }}</textarea>

                    <div class="form-text text-danger">
                        @error('description')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-secondary">
                    Submit
                </button>

            </form>

        </div>

    </div>
@endsection
