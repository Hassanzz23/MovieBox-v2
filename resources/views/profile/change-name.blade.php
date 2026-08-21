@extends('layout.master')

@section('content')
    @include('profile.nav')

    <div class="row justify-content-center">

        <div class="col-12 col-md-6">

            <div class="card shadow-sm rounded">

                <div class="card-header fw-bold">
                    Change Name
                </div>

                <div class="card-body">

                    <p class="text-muted mb-4">
                        Change the name displayed on your MovieBox account.
                    </p>

                    <form action="{{ route('profile.update-name') }}" method="POST">

                        @csrf
                        @method('PUT')


                        <div class="mb-3">

                            <label for="name" class="form-label">
                                New Name
                            </label>

                            <input type="text" name="name" id="name"
                                value="{{ old('name', auth()->user()->name) }}"
                                class="form-control @error('name') is-invalid @enderror">

                            @error('name')
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
                                Change Name
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>
@endsection
