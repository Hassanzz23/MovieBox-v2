@extends('admin.layout.master')

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
            padding: 5px 0 15px;

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

        .movie-poster {
            position: relative;
            width: 180px;
            height: 260px;
        }

        .movie-poster img {
            width: 180px;
            height: 260px;
            object-fit: cover;
            border-radius: 8px;
            display: block;
        }

        /* Edit / Delete buttons */
        .movie-actions {
            position: absolute;
            bottom: 8px;
            left: 8px;
            right: 8px;

            display: flex;
            gap: 6px;

            opacity: 0;
            transition: opacity 0.2s ease;
        }

        .movie-poster:hover .movie-actions {
            opacity: 1;
        }

        .movie-actions form {
            flex: 1;
            margin: 0;
            display: flex;
        }

        .movie-actions .btn {
            width: 100%;
            height: 32px;
            padding: 4px 0;

            font-size: 13px;
            line-height: 1;

            display: flex;
            align-items: center;
            justify-content: center;
        }

        .movie-actions>a {
            flex: 1;
        }

        .movie-card {
            flex: 0 0 180px;
            color: inherit;
            cursor: grab;
        }

        .movie-card:active {
            cursor: grabbing;
        }

        .movie-card.dragging {
            opacity: 0.5;
        }

        /* Slider arrows */
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

        /* Dark mode */
        [data-bs-theme="dark"] .movie-arrow {
            background: rgba(255, 255, 255, 0.18);
            color: white;
        }

        [data-bs-theme="dark"] .movie-arrow:hover {
            background: rgba(255, 255, 255, 0.30);
        }
    </style>

    <div class="d-flex justify-content-between align-items-center mb-5">

        <div>
            <h2 class="mb-1">
                Home Movies
            </h2>

            <p class="text-muted mb-0">
                Manage movies displayed on the homepage
            </p>
        </div>

        <a href="{{ route('home-movies.create') }}" class="btn btn-primary">
            + Add Movie
        </a>

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


    @if ($movies->count())
        <div class="mb-5">

            <h3 class="mb-3">
                Movies you may like
            </h3>

            <div class="movie-slider">

                <div class="movie-row">

                    @foreach ($movies as $movie)
                        <div class="movie-card" draggable="true" data-id="{{ $movie->id }}">

                            <div class="movie-poster">

                                <img src="{{ asset('storage/images/' . $movie->image) }}" alt="{{ $movie->title }}">

                                <div class="movie-actions">

                                    <a href="{{ route('home-movies.edit', $movie) }}" class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    <form action="{{ route('home-movies.destroy', $movie) }}" method="POST"
                                        class="flex-fill" onsubmit="return confirm('Delete this movie?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger btn-sm w-100">
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            </div>

                            <div class="mt-2">

                                <h6>
                                    {{ $movie->title }}
                                </h6>

                                <small class="text-muted">
                                    {{ $movie->year }}
                                </small>

                            </div>

                        </div>
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
    @endif


    @if ($tvShows->count())
        <div class="mb-5">

            <h3 class="mb-3">
                TV Shows you may like
            </h3>

            <div class="movie-slider">

                <div class="movie-row">

                    @foreach ($tvShows as $show)
                        <div class="movie-card" draggable="true" data-id="{{ $show->id }}">

                            <div class="movie-poster">

                                <img src="{{ asset('storage/images/' . $show->image) }}" alt="{{ $show->title }}">

                                <div class="movie-actions">

                                    <a href="{{ route('home-movies.edit', $show) }}" class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    <form action="{{ route('home-movies.destroy', $show) }}" method="POST"
                                        class="flex-fill" onsubmit="return confirm('Delete this movie?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger btn-sm w-100">
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            </div>

                            <div class="mt-2">

                                <h6>
                                    {{ $show->title }}
                                </h6>

                                <small class="text-muted">
                                    {{ $show->year }}
                                </small>

                            </div>

                        </div>
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
    @endif


    @if ($animations->count())
        <div class="mb-5">

            <h3 class="mb-3">
                Animations you may like
            </h3>

            <div class="movie-slider">

                <div class="movie-row">

                    @foreach ($animations as $animation)
                        <div class="movie-card" draggable="true" data-id="{{ $animation->id }}">

                            <div class="movie-poster">

                                <img src="{{ asset('storage/images/' . $animation->image) }}"
                                    alt="{{ $animation->title }}">

                                <div class="movie-actions">

                                    <a href="{{ route('home-movies.edit', $animation) }}" class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    <form action="{{ route('home-movies.destroy', $animation) }}" method="POST"
                                        class="flex-fill" onsubmit="return confirm('Delete this movie?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger btn-sm w-100">
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            </div>

                            <div class="mt-2">

                                <h6>
                                    {{ $animation->title }}
                                </h6>

                                <small class="text-muted">
                                    {{ $animation->year }}
                                </small>

                            </div>

                        </div>
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
    @endif


    @if ($anime->count())
        <div class="mb-5">

            <h3 class="mb-3">
                Anime you may like
            </h3>

            <div class="movie-slider">

                <div class="movie-row">

                    @foreach ($anime as $item)
                        <div class="movie-card" draggable="true" data-id="{{ $item->id }}">
                            <div class="movie-poster">

                                <img src="{{ asset('storage/images/' . $item->image) }}" alt="{{ $item->title }}">

                                <div class="movie-actions">

                                    <a href="{{ route('home-movies.edit', $item) }}" class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    <form action="{{ route('home-movies.destroy', $item) }}" method="POST"
                                        class="flex-fill" onsubmit="return confirm('Delete this movie?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger btn-sm w-100">
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            </div>

                            <div class="mt-2">

                                <h6>
                                    {{ $item->title }}
                                </h6>

                                <small class="text-muted">
                                    {{ $item->year }}
                                </small>

                            </div>

                        </div>
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
    @endif


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



            // =========================
            // Drag & Drop
            // =========================

            const cards = row.querySelectorAll('.movie-card');

            cards.forEach(card => {

                card.setAttribute('draggable', 'true');


                card.addEventListener('dragstart', () => {

                    card.classList.add('dragging');

                });


                card.addEventListener('dragend', () => {

                    card.classList.remove('dragging');

                });

            });


            row.addEventListener('dragover', event => {

                event.preventDefault();

                const draggingCard =
                    row.querySelector('.movie-card.dragging');

                if (!draggingCard) {
                    return;
                }


                const cards = [...row.querySelectorAll('.movie-card:not(.dragging)')];


                const nextCard =
                    cards.find(card => {

                        const rect =
                            card.getBoundingClientRect();

                        return event.clientX < rect.left + rect.width / 2;

                    });


                if (nextCard) {

                    row.insertBefore(
                        draggingCard,
                        nextCard
                    );

                } else {

                    row.appendChild(
                        draggingCard
                    );

                }

            });


            row.addEventListener('drop', event => {

                event.preventDefault();

                updateButtons();

            });

        });

        // Drag & Drop
        document.querySelectorAll('.movie-row').forEach(row => {

            let draggedCard = null;


            row.querySelectorAll('.movie-card').forEach(card => {

                card.addEventListener('dragstart', function() {

                    draggedCard = this;

                    this.classList.add('dragging');

                });


                card.addEventListener('dragend', function() {

                    this.classList.remove('dragging');

                    draggedCard = null;

                });

            });


            row.addEventListener('dragover', function(event) {

                event.preventDefault();


                if (!draggedCard) {
                    return;
                }


                const cards = [
                    ...row.querySelectorAll('.movie-card:not(.dragging)')
                ];


                const nextCard = cards.find(card => {

                    const rect = card.getBoundingClientRect();

                    return event.clientX <
                        rect.left + rect.width / 2;

                });


                if (nextCard) {

                    row.insertBefore(
                        draggedCard,
                        nextCard
                    );

                } else {

                    row.appendChild(
                        draggedCard
                    );

                }

            });


            row.addEventListener('drop', function() {

                if (!draggedCard) {
                    return;
                }


                const items = [
                    ...row.querySelectorAll('.movie-card')
                ];


                const data = items.map((card, index) => {

                    return {
                        id: card.dataset.id,
                        sort_order: index + 1
                    };

                });


                fetch('{{ route('home-movies.reorder') }}', {

                        method: 'POST',

                        headers: {
                            'Content-Type': 'application/json',

                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]'
                            ).getAttribute('content'),

                            'Accept': 'application/json'
                        },

                        body: JSON.stringify({
                            items: data
                        })

                    })
                    .then(response => {

                        if (!response.ok) {
                            throw new Error('Reorder failed');
                        }

                        return response.json();

                    })
                    .then(data => {

                        console.log('Order saved:', data);

                    })
                    .catch(error => {

                        console.error(
                            'Error saving order:',
                            error
                        );

                    });

            });

        });
    </script>

@endsection
