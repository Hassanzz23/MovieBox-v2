<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Welcome to MovieBox</title>
</head>

<body style="
    margin: 0;
    padding: 30px;
    background-color: #f5f5f5;
    font-family: Arial, sans-serif;
">

    <div
        style="
        max-width: 600px;
        margin: 0 auto;
        background-color: #ffffff;
        padding: 35px;
        border-radius: 10px;
    ">
        <div style="
            text-align: center;
            margin-bottom: 30px;
        ">

            <h1
                style="
                margin: 0;
                color: #212529;
                font-size: 30px;
            ">
                🎬 MovieBox
            </h1>

            <p
                style="
                margin-top: 8px;
                color: #777;
                font-size: 14px;
            ">
                Your personal movie collection
            </p>

        </div>


        <h2 style="
            margin-bottom: 15px;
            color: #212529;
        ">
            Welcome, {{ $user->name }}! 👋
        </h2>


        <p style="
            color: #444;
            line-height: 1.7;
        ">
            We're happy to have you at MovieBox.
            Your account has been successfully created.
        </p>


        <p style="
            color: #444;
            line-height: 1.7;
        ">
            You can now build your WatchList, save your favorite
            movies and shows, mark what you've watched and rate them.
        </p>


        <div style="
            text-align: center;
            margin: 30px 0;
        ">

            <a href="{{ route('home') }}"
                style="
                    display: inline-block;
                    background-color: #212529;
                    color: #ffffff;
                    padding: 13px 24px;
                    text-decoration: none;
                    border-radius: 6px;
                    font-weight: bold;
                ">
                🎬 Go to MovieBox
            </a>

        </div>


        <div
            style="
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-top: 25px;
        ">

            <p
                style="
                margin-top: 0;
                font-weight: bold;
                color: #212529;
            ">
                What you can do:
            </p>

            <p style="color: #555; margin-bottom: 8px;">
                🎬 Add movies and TV shows to your WatchList
            </p>

            <p style="color: #555; margin-bottom: 8px;">
                ⭐ Save your favorite movies
            </p>

            <p style="color: #555; margin-bottom: 8px;">
                👀 Track what you've watched
            </p>

            <p style="color: #555; margin-bottom: 0;">
                🏆 Rate the movies you've watched
            </p>

        </div>


        <div
            style="
            margin-top: 35px;
            padding-top: 20px;
            border-top: 1px solid #eeeeee;
            text-align: center;
        ">

            <p
                style="
                margin: 0;
                color: #777;
                font-size: 13px;
            ">
                Thanks for joining MovieBox 🍿
            </p>

            <p
                style="
                margin-top: 8px;
                color: #999;
                font-size: 12px;
            ">
                Enjoy your movies and shows!
            </p>

        </div>

    </div>

</body>

</html>
