@extends('layout.master')

@section('content')
    <style>
        .movie-slider {
            position: relative;
        }

        .movie-row {
            display: flex;
            gap: 20px;
            overflow-x: auto;
            scroll-behavior: smooth;
            padding-bottom: 15px;

            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .movie-row::-webkit-scrollbar {
            display: none;
        }

        .movie-card {
            flex: 0 0 180px;
            color: inherit;
        }

        .movie-card img {
            width: 180px;
            height: 260px;
            object-fit: cover;
            border-radius: 8px;
        }

        .movie-card h6 {
            margin-bottom: 0;
        }

        .movie-arrow {
            position: absolute;

            top: 125px;

            width: 47px;
            height: 47px;

            border: none;
            border-radius: 50%;

            background: rgba(0, 0, 0, 0.65);
            color: white;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 28px;
            line-height: 1;

            cursor: pointer;

            z-index: 10;

            transition:
                transform 0.2s ease,
                background 0.2s ease,
                opacity 0.2s ease;
        }


        .movie-arrow:hover {
            transform: scale(1.1);
            background: rgba(0, 0, 0, 0.85);
        }


        .movie-arrow:disabled {
            opacity: 0;
            pointer-events: none;
        }


        .movie-prev {
            left: 8px;
        }


        .movie-next {
            right: 8px;
        }




        [data-bs-theme="dark"] .movie-arrow {
            background: rgba(255, 255, 255, 0.18);
            color: white;
        }


        [data-bs-theme="dark"] .movie-arrow:hover {
            background: rgba(255, 255, 255, 0.30);
        }
    </style>



    <div class="mb-5">

        <h3 class="mb-3">
            Movies you may like
        </h3>


        <div class="movie-slider">

            <div class="movie-row">

                @foreach ($movies as $movie)
                    <a href="{{ route('home-movie.show', $movie) }}" class="movie-card text-decoration-none text-dark">

                        <img src="{{ asset('storage/images/' . $movie->image) }}" alt="{{ $movie->title }}">

                        <div class="mt-2">

                            <h6>
                                {{ $movie->title }}
                            </h6>

                            <small class="text-muted">
                                {{ $movie->year }}
                            </small>

                        </div>

                    </a>
                @endforeach

            </div>


            <button class="movie-arrow movie-prev" type="button">
                ‹
            </button>


            <button class="movie-arrow movie-next" type="button">
                ›
            </button>

        </div>

    </div>



    <div class="mb-5">

        <h3 class="mb-3">
            TV Shows you may like
        </h3>


        <div class="movie-slider">

            <div class="movie-row">

                @foreach ($tvShows as $show)
                    <a href="{{ route('home-movie.show', $show) }}" class="movie-card text-decoration-none text-dark">

                        <img src="{{ asset('storage/images/' . $show->image) }}" alt="{{ $show->title }}">

                        <div class="mt-2">

                            <h6>
                                {{ $show->title }}
                            </h6>

                            <small class="text-muted">
                                {{ $show->year }}
                            </small>

                        </div>

                    </a>
                @endforeach

            </div>


            <button class="movie-arrow movie-prev" type="button">
                ‹
            </button>


            <button class="movie-arrow movie-next" type="button">
                ›
            </button>

        </div>

    </div>




    <div class="mb-5">

        <h3 class="mb-3">
            Animations you may like
        </h3>


        <div class="movie-slider">

            <div class="movie-row">

                @foreach ($animations as $animation)
                    <a href="{{ route('home-movie.show', $animation) }}" class="movie-card text-decoration-none text-dark">

                        <img src="{{ asset('storage/images/' . $animation->image) }}" alt="{{ $animation->title }}">

                        <div class="mt-2">

                            <h6>
                                {{ $animation->title }}
                            </h6>

                            <small class="text-muted">
                                {{ $animation->year }}
                            </small>

                        </div>

                    </a>
                @endforeach

            </div>


            <button class="movie-arrow movie-prev" type="button">
                ‹
            </button>


            <button class="movie-arrow movie-next" type="button">
                ›
            </button>

        </div>

    </div>


    <div class="mb-5">

        <h3 class="mb-3">
            Anime you may like
        </h3>


        <div class="movie-slider">

            <div class="movie-row">

                @foreach ($anime as $item)
                    <a href="{{ route('home-movie.show', $item) }}" class="movie-card text-decoration-none text-dark">

                        <img src="{{ asset('storage/images/' . $item->image) }}" alt="{{ $item->title }}">

                        <div class="mt-2">

                            <h6>
                                {{ $item->title }}
                            </h6>

                            <small class="text-muted">
                                {{ $item->year }}
                            </small>

                        </div>

                    </a>
                @endforeach

            </div>


            <button class="movie-arrow movie-prev" type="button">
                ‹
            </button>


            <button class="movie-arrow movie-next" type="button">
                ›
            </button>

        </div>

    </div>




    <script>
        document.querySelectorAll('.movie-slider').forEach(slider => {

            const row = slider.querySelector('.movie-row');

            const prevButton = slider.querySelector('.movie-prev');

            const nextButton = slider.querySelector('.movie-next');


            function updateButtons() {

                const isAtStart =
                    row.scrollLeft <= 5;


                const isAtEnd =
                    row.scrollLeft + row.clientWidth >= row.scrollWidth - 5;


                const hasScroll =
                    row.scrollWidth > row.clientWidth;


                prevButton.disabled = !hasScroll || isAtStart;


                nextButton.disabled = !hasScroll || isAtEnd;

            }


            nextButton.addEventListener('click', () => {

                row.scrollBy({
                    left: row.clientWidth * 0.8,
                    behavior: 'smooth'
                });

            });


            prevButton.addEventListener('click', () => {

                row.scrollBy({
                    left: -(row.clientWidth * 0.8),
                    behavior: 'smooth'
                });

            });


            row.addEventListener('scroll', updateButtons);


            window.addEventListener('resize', updateButtons);


            updateButtons();

        });
    </script>
@endsection
