<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rate {{ $todo->title }}</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f5f5f5; padding: 30px;">

    <div style="
        max-width: 600px;
        margin: auto;
        background: white;
        padding: 30px;
        border-radius: 10px;
    ">

        <h2>
            🎬 What did you think about {{ $todo->title }}?
        </h2>

        <p>
            You marked <strong>{{ $todo->title }}</strong> as watched.
        </p>

        <p>
            We'd love to know your opinion!
        </p>

        <p>
            You haven't rated this movie yet.
        </p>

        <a href="{{ route('watchlist.show', $todo) }}"
           style="
                display: inline-block;
                background: #212529;
                color: white;
                padding: 12px 20px;
                text-decoration: none;
                border-radius: 6px;
           ">
            ⭐ Rate This Movie
        </a>

        <p style="margin-top: 30px; color: #777;">
            Thanks for using MovieBox 🎬
        </p>

    </div>

</body>
</html>