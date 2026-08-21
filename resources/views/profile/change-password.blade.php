@extends('layout.master')

@section('content')
    @include('profile.nav')

    <div class="mb-4">

        <h2 class="mb-1 fw-bold">
            Change Password
        </h2>

        <p class="text-muted mb-0">
            Update your account password
        </p>

    </div>


    <div class="card shadow-sm rounded-0">

        <div class="card-header fw-bold">
            Change Password
        </div>

        <div class="card-body">

            <form action="{{ route('profile.update-password') }}" method="POST">

                @csrf
                @method('PUT')


                <div class="mb-3">

                    <label for="old_password" class="form-label">
                        Old Password
                    </label>

                    <input type="password" name="old_password" id="old_password"
                        class="form-control @error('old_password') is-invalid @enderror" required>

                    @error('old_password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="mb-3">

                    <label for="new_password" class="form-label">
                        New Password
                    </label>

                    <input type="password" name="new_password" id="new_password"
                        class="form-control @error('new_password') is-invalid @enderror" required>

                    @error('new_password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="mb-4">

                    <label for="new_password_confirmation" class="form-label">
                        Confirm New Password
                    </label>

                    <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                        class="form-control" required>

                </div>


                <div class="d-flex gap-2">

                    <button type="submit" class="btn btn-dark">
                        Change Password
                    </button>

                    <a href="{{ route('profile.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>

                </div>

            </form>

        </div>

    </div>
@endsection