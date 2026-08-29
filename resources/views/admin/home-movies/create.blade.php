@extends('admin.layout.master')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                Add Movie
            </h2>

            <p class="text-muted mb-0">
                Add a new movie or show to the homepage
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

            <form action="{{ route('home-movies.store') }}" method="POST" enctype="multipart/form-data">

                @csrf


                <div class="row">


                    <div class="col-12 col-md-6 mb-3">

                        <label class="form-label">
                            Poster
                        </label>

                        <input type="file" name="image" class="form-control" accept="image/*" required>

                    </div>


                    <div class="col-12 col-md-6 mb-3">

                        <label class="form-label">
                            Title
                        </label>

                        <input type="text" name="title" value="{{ old('title') }}" class="form-control"
                            placeholder="Movie title" required>

                    </div>


                    <div class="col-12 col-md-6 mb-3">

                        <label class="form-label">
                            Year
                        </label>

                        <input type="number" name="year" value="{{ old('year') }}" class="form-control"
                            placeholder="2026" min="1888" max="2100" required>

                    </div>


                    <div class="col-12 col-md-6 mb-3">

                        <label class="form-label">
                            Category
                        </label>

                        <select name="category_id" class="form-select" required>

                            <option value="">
                                Select category
                            </option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->title }}
                                </option>
                            @endforeach

                        </select>

                    </div>


                    <div class="col-12 mb-3">

                        <label class="form-label">
                            Genre
                        </label>

                        <div class="row g-2">

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
                                    'Mystery',
                                    'Romance',
                                    'Sci-Fi',
                                    'Thriller',
                                    'War',
                                    'Western',
                                ];
                            @endphp

                            @foreach ($genres as $genre)
                                <div class="col-6 col-md-4 col-lg-3">

                                    <div class="form-check">

                                        <input class="form-check-input" type="checkbox" name="genre[]"
                                            value="{{ $genre }}" id="genre-{{ Str::slug($genre) }}"
                                            {{ in_array($genre, old('genre', [])) ? 'checked' : '' }}>

                                        <label class="form-check-label" for="genre-{{ Str::slug($genre) }}">
                                            {{ $genre }}
                                        </label>

                                    </div>

                                </div>
                            @endforeach

                        </div>

                    </div>


                    <div class="col-12 mb-4">

                        <label class="form-label">
                            Description
                        </label>

                        <textarea name="description" class="form-control" rows="6" placeholder="Write a short description..." required>{{ old('description') }}</textarea>

                    </div>


                </div>


                <div class="d-flex justify-content-end gap-2">

                    <a href="{{ route('home-movies.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>

                    <button type="submit" class="btn btn-primary">
                        Add Movie
                    </button>

                </div>


            </form>

        </div>

    </div>

@endsection
