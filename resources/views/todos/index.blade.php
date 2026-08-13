@extends('layout.master')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="">My Watchlist</h5>
            <a href="{{ route('todo.create') }}" class="btn btn-dark">Add</a>
        </div>
        <div class="card-body">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>Poster</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($todos as $todo)
                        <tr>
                            <td>
                                <img width="90" class="rounded" src="{{ asset('images/' . $todo->image) }}" alt="image">
                            </td>
                            <td>{{ $todo->title }}</td>
                            <td>{{ $todo->category?->title ?? 'Deleted Category' }}</td>
                            <td>
                                <a href="{{ route('todo.show', ['todo' => $todo->id]) }}"
                                    class="btn btn-sm btn-secondary">Show</a>
                                @if ($todo->status)
                                    <span class="badge bg-success">
                                        Watched
                                    </span>
                                @else
                                    <a href="{{ route('todo.completed', $todo) }}" class="btn btn-sm btn-warning">
                                        Mark as Watched
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $todos->links() }}
        </div>
    </div>
@endsection
