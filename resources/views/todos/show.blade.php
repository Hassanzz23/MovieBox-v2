@extends('layout.master')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>{{ $todo->title }}</h5>
            <a href="{{ route('home') }}" class="btn btn-dark">
                Back
            </a>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <img width="230" class="rounded" src="{{ asset('images/' . $todo->image) }}" alt="{{ $todo->title }}">
            </div>
            <div class="row">
                <div class="col-12 col-md-4 mb-3">
                    <label class="form-label">
                        Title
                    </label>
                    <input disabled type="text" value="{{ $todo->title }}" class="form-control">
                </div>
                <div class="col-12 col-md-4 mb-3">
                    <label class="form-label">
                        Year
                    </label>
                    <input disabled type="text" value="{{ $todo->year }}" class="form-control">
                </div>
                <div class="col-12 col-md-4 mb-3">
                    <label class="form-label">
                        Category
                    </label>
                    <input disabled type="text" value="{{ $todo->category?->title ?? 'Deleted Category' }}"
                        class="form-control">
                </div>
                <div class="col-12 col-md-4 mb-3">
                    <label class="form-label">
                        Genre
                    </label>
                    <input disabled type="text" value="{{ $todo->genre }}" class="form-control">
                </div>
                <div class="col-12 col-md-4 mb-3">
                    <label class="form-label">
                        Status
                    </label>
                    <input disabled type="text" value="{{ $todo->status ? 'Watched' : 'Watch Later!' }}"
                        class="form-control">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">
                    Description
                </label>
                <textarea disabled class="form-control" rows="3">{{ $todo->description }}</textarea>
            </div>
            <div class="d-flex">
                <a href="{{ route('todo.edit', ['todo' => $todo->id]) }}" class="btn btn-secondary">
                    Edit
                </a>
                <form action="{{ route('todo.destroy', ['todo' => $todo->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger ms-2">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
