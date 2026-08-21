@extends('layout.master')

@section('content')
    @include('profile.nav')

    <div class="row justify-content-center g-4">

        <div class="col-12 col-md-6">

            <div class="card shadow-sm">

                <h5 class="card-header">
                    Change Password
                </h5>

                <div class="card-body">

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif


                    <form action="{{ route('profile.update-password') }}" method="POST">

                        @csrf
                        @method('PUT')


                        <div class="mb-3">

                            <label for="old_password" class="form-label">
                                Old Password
                            </label>

                            <input type="password" name="old_password" id="old_password"
                                class="form-control @error('old_password') is-invalid @enderror">

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
                                class="form-control @error('new_password') is-invalid @enderror">

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
                                class="form-control @error('new_password_confirmation') is-invalid @enderror">

                            @error('new_password_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <div class="d-flex justify-content-between align-items-center">

                            <a href="{{ route('profile.index') }}" class="btn btn-secondary">
                                Cancel
                            </a>

                            <button type="submit" class="btn btn-dark">
                                Change Password
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>


        <div class="col-12 col-md-5">

            <div class="card shadow-sm">

                <div class="card-header fw-bold">
                    Password Requirements
                </div>

                <div class="card-body">

                    <p class="mb-2">
                        ● Old password is required
                    </p>

                    <p class="mb-2">
                        ● New password is required
                    </p>

                    <p class="mb-2">
                        ● New password must be at least 4 characters
                    </p>

                    <p class="mb-0">
                        ● New password confirmation must match
                    </p>

                </div>

            </div>

        </div>

    </div>
@endsection
