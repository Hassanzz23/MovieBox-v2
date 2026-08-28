@extends('admin.layout.master')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-5">

        <div>
            <h2 class="mb-1">
                Users
            </h2>

            <p class="text-muted mb-0">
                Manage registered users
                · {{ $users->total() }} users
            </p>
        </div>

    </div>


    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif


    <div class="card border-0 shadow-sm">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Joined</th>
                        <th>Status</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($users as $user)
                        <tr>

                            <td>
                                {{ $user->name }}
                            </td>

                            <td>
                                {{ $user->email }}
                            </td>

                            <td>
                                {{ $user->created_at->format('M d, Y') }}
                            </td>

                            <td>

                                @if ($user->is_banned)
                                    <span class="badge bg-danger">
                                        Banned
                                    </span>
                                @else
                                    <span class="badge bg-success">
                                        Active
                                    </span>
                                @endif

                            </td>

                            <td class="text-end">

                                <a href="{{ route('admin.users.show', $user) }}" class="btn btn-primary btn-sm">
                                    Show
                                </a>

                                @if (!$user->is_admin)
                                    <form action="{{ route('admin.users.toggle-ban', $user) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('{{ $user->is_banned ? 'Unban this user?' : 'Ban this user?' }}')">

                                        @csrf
                                        @method('PATCH')


                                        @if ($user->is_banned)
                                            <button type="submit" class="btn btn-success btn-sm">
                                                Unban
                                            </button>
                                        @else
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                Ban
                                            </button>
                                        @endif

                                    </form>
                                @else
                                    <span class="text-muted">
                                        Admin
                                    </span>
                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="text-center py-4 text-muted">
                                No users found.
                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    <div class="mt-4">

        {{ $users->links() }}

    </div>

@endsection
