@extends('admin.layout.master')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                Edit Movie
            </h2>

            <p class="text-muted mb-0">
                Edit homepage movie information
            </p>
        </div>

        <a href="{{ route('home-movies.index') }}" class="btn btn-dark">
            Back
        </a>

    </div>


    @if ($errors->any())
        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>
    @endif


    <div class="card shadow-sm rounded-0">

        <div class="card-body p-4">

            <form action="{{ route('home-movies.update', $homeMovie) }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')


                <div class="row">


                    <div class="col-12 col-md-4 mb-4">

                        <label class="form-label">
                            Current Poster
                        </label>

                        <img src="{{ asset('storage/images/' . $homeMovie->image) }}" alt="{{ $homeMovie->title }}"
                            class="img-fluid rounded mb-3" style="max-height: 400px; width: 100%; object-fit: cover;">


                        <label class="form-label">
                            Change Poster
                        </label>

                        <input type="file" name="image" class="form-control" accept="image/*">

                        <small class="text-muted">
                            Leave empty to keep the current poster.
                        </small>

                    </div>



                    <div class="col-12 col-md-8">


                        <div class="mb-3">

                            <label class="form-label">
                                Title
                            </label>

                            <input type="text" name="title" value="{{ old('title', $homeMovie->title) }}"
                                class="form-control" required>

                        </div>



                        <div class="row">


                            <div class="col-12 col-md-6 mb-3">

                                <label class="form-label">
                                    Year
                                </label>

                                <input type="number" name="year" value="{{ old('year', $homeMovie->year) }}"
                                    class="form-control" min="1888" max="2100" required>

                            </div>



                            <div class="col-12 col-md-6 mb-3">

                                <label class="form-label">
                                    Category
                                </label>

                                <select name="category_id" class="form-select" required>

                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id', $homeMovie->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->title }}
                                        </option>
                                    @endforeach

                                </select>

                            </div>

                        </div>



                        <div class="mb-3">

                            <label class="form-label">
                                Genre
                            </label>

                            @php
                                $genres = [
                                    'Action',
                                    'Adventure',
                                    'Animation',
                                    'Comedy',
                                    'Crime',
                                    'Documentary',
                                    'Drama',
                                    'Family',
                                    'Fantasy',
                                    'History',
                                    'Horror',
                                    'Music',
                                    'Sport',
                                    'Mystery',
                                    'Romance',
                                    'Sci-Fi',
                                    'Thriller',
                                    'War',
                                    'Western',
                                ];

                                $selectedGenres = old(
                                    'genre',
                                    $homeMovie->genre ? array_map('trim', explode(',', $homeMovie->genre)) : [],
                                );
                            @endphp

                            <div class="row g-2">

                                @foreach ($genres as $genre)
                                    <div class="col-6 col-md-4 col-lg-3">

                                        <div class="form-check">

                                            <input class="form-check-input" type="checkbox" name="genre[]"
                                                value="{{ $genre }}" id="genre-{{ Str::slug($genre) }}"
                                                {{ in_array($genre, $selectedGenres) ? 'checked' : '' }}>

                                            <label class="form-check-label" for="genre-{{ Str::slug($genre) }}">
                                                {{ $genre }}
                                            </label>

                                        </div>

                                    </div>
                                @endforeach

                            </div>

                        </div>



                        <div class="mb-4">

                            <label class="form-label">
                                Description
                            </label>

                            <textarea name="description" class="form-control" rows="7" required>{{ old('description', $homeMovie->description) }}</textarea>

                        </div>


                        <div class="d-flex justify-content-end gap-2">

                            <a href="{{ route('home-movies.index') }}" class="btn btn-secondary">
                                Cancel
                            </a>


                            <button type="submit" class="btn btn-primary">
                                Save Changes
                            </button>

                        </div>


                    </div>


                </div>


            </form>

        </div>

    </div>

@endsection
