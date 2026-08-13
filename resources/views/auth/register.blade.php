@extends('layout.master')

@section('content')

<div class="row justify-content-center">

    <div class="col-12 col-md-6">

        <div class="card shadow-sm">

            <h5 class="card-header">
                Sign Up
            </h5>

            <div class="card-body">

                {{-- Error --}}
                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Success --}}
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif


                <form action="{{ route('register.post') }}" method="POST">

                    @csrf


                    {{-- Name --}}
                    <div class="mb-3">

                        <label class="form-label">
                            Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            class="form-control"
                        >

                        <div class="form-text text-danger">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </div>

                    </div>


                    {{-- Email --}}
                    <div class="mb-3">

                        <label class="form-label">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="form-control"
                        >

                        <div class="form-text text-danger">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </div>

                    </div>


                    {{-- Password --}}
                    <div class="mb-3">

                        <label class="form-label">
                            Password
                        </label>

                        <input
                            type="password"
                            name="password"
                            class="form-control"
                        >

                        <div class="form-text text-danger">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </div>

                    </div>


                    {{-- Confirm Password --}}
                    <div class="mb-3">

                        <label class="form-label">
                            Confirm Password
                        </label>

                        <input
                            type="password"
                            name="password_confirmation"
                            class="form-control"
                        >

                        <div class="form-text text-danger">
                            @error('password_confirmation')
                                {{ $message }}
                            @enderror
                        </div>

                    </div>


                    {{-- Already have account --}}
                    <div class="mt-3">

                        <span class="text-muted">
                            Already have an account?
                        </span>

                        <a href="{{ route('login') }}">
                            Login
                        </a>

                    </div>


                    {{-- Submit --}}
                    <div class="text-end mt-3">

                        <button
                            type="submit"
                            class="btn btn-dark"
                        >
                            Sign Up
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection