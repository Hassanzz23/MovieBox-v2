@extends('admin.layout.master')


@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">
                Home Movies
            </h2>

            <p class="text-muted mb-0">
                Manage movies displayed on homepage
            </p>

        </div>


        <a href="{{ route('home-movies.create') }}" class="btn btn-primary">

            Add Movie

        </a>


    </div>



    @if (session('success'))
        <div class="alert alert-success">

            {{ session('success') }}

        </div>
    @endif



    <div class="row">


        @foreach ($movies as $movie)
            <div class="col-12 col-sm-6 col-lg-4 mb-4">


                <div class="card shadow-sm rounded-0 h-100">


                    <img src="{{ asset('storage/images/' . $movie->image) }}" class="card-img-top"
                        style="height:350px; object-fit:cover;">



                    <div class="card-body">


                        <h5 class="fw-bold">

                            {{ $movie->title }}

                            @if ($movie->year)
                                <span class="text-muted fw-normal">
                                    ({{ $movie->year }})
                                </span>
                            @endif

                        </h5>



                        <p class="text-muted mb-2">

                            {{ $movie->genre }}

                        </p>



                        <span class="badge bg-dark">

                            {{ $movie->category->title }}

                        </span>



                        <div class="mt-3 d-flex gap-2">


                            <a href="{{ route('home-movies.edit', $movie) }}" class="btn btn-warning btn-sm">

                                Edit

                            </a>



                            <form action="{{ route('home-movies.destroy', $movie) }}" method="POST"
                                onsubmit="return confirm('Delete this movie?')">


                                @csrf
                                @method('DELETE')


                                <button class="btn btn-danger btn-sm">

                                    Delete

                                </button>


                            </form>


                        </div>


                    </div>


                </div>


            </div>
        @endforeach


    </div>



    <div>

        {{ $movies->links() }}

    </div>
@endsection
