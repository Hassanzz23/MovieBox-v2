@extends('layout.master')

@section('content')

<div class="row justify-content-center">

    <div class="col-12 col-md-6">

        <div class="card shadow-sm">

            <h5 class="card-header">
                Login
            </h5>

            <div class="card-body">

                {{-- Error Message --}}
                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Success Message --}}
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif


                <form action="{{ route('login.post') }}" method="POST">

                    @csrf


                    {{-- Email --}}
                    <div class="mb-3">

                        <label class="form-label">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email') }}"
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


                        {{-- Forgot Password --}}
                        <div class="text-end mt-2">

                            <a href="{{ route('forget.password') }}">
                                Forgot Password?
                            </a>

                        </div>

                    </div>


                    {{-- Create Account --}}
                    <div class="mt-3">

                        <span class="text-muted">
                            Don't have an account?
                        </span>

                        <a href="{{ route('register') }}">
                            Create account?
                        </a>

                    </div>


                    {{-- Login Button --}}
                    <div class="text-end mt-3">

                        <button
                            type="submit"
                            class="btn btn-dark"
                        >
                            Login
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection