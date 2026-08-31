@extends('layout.master')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>{{ $homeMovie->title }}</h5>

            <a href="{{ route('home') }}" class="btn btn-dark">
                Back
            </a>
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-12 col-md-4 mb-4">
                    <img src="{{ asset('storage/images/' . $homeMovie->image) }}" alt="{{ $homeMovie->title }}"
                        class="img-fluid rounded">
                </div>

                <div class="col-12 col-md-8">

                    <div class="mb-3">
                        <label class="form-label">Title</label>

                        <input disabled type="text" value="{{ $homeMovie->title }}" class="form-control">
                    </div>

                    <div class="row">

                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label">Year</label>

                            <input disabled type="text" value="{{ $homeMovie->year }}" class="form-control">
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label">Category</label>

                            <input disabled type="text" value="{{ $homeMovie->category->title }}" class="form-control">
                        </div>

                    </div>

                    <div class="mb-3">
                        <label class="form-label">Genre</label>

                        <input disabled type="text" value="{{ $homeMovie->genre }}" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>

                        <textarea disabled class="form-control" rows="5">{{ $homeMovie->description }}</textarea>
                    </div>
                    
                    @if ($inWatchlist)
                        <button type="button" class="btn btn-secondary" disabled>
                            Already in Watchlist
                        </button>
                    @else
                        <form action="{{ route('watchlist.add', ['homeMovie' => $homeMovie->id]) }}" method="POST">
                            @csrf

                            <button type="submit" class="btn btn-primary">
                                Add to Watchlist
                            </button>
                        </form>
                    @endif

                </div>

            </div>

        </div>
    </div>
@endsection
