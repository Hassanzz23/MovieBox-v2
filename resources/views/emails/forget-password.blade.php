<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Reset Your MovieBox Password</title>
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
            Reset Your Password 🔐
        </h2>


        <p style="
            color: #444;
            line-height: 1.7;
        ">
            Hello {{ $user->name }},
        </p>


        <p style="
            color: #444;
            line-height: 1.7;
        ">
            We received a request to reset your MovieBox password.
            Click the button below to create a new password.
        </p>


        <div style="
            text-align: center;
            margin: 30px 0;
        ">

            <a href="{{ route('reset.password', ['token' => $token]) }}"
                style="
                    display: inline-block;
                    background-color: #212529;
                    color: #ffffff;
                    padding: 13px 24px;
                    text-decoration: none;
                    border-radius: 6px;
                    font-weight: bold;
                ">
                🔐 Reset My Password
            </a>

        </div>


        <div
            style="
            background-color: #f8f9fa;
            padding: 18px;
            border-radius: 8px;
            margin-top: 25px;
        ">

            <p
                style="
                margin: 0;
                color: #555;
                line-height: 1.6;
            ">
                ⏱️ This password reset link will expire in
                <strong>60 minutes</strong>.
            </p>

        </div>


        <p
            style="
            color: #777;
            font-size: 14px;
            line-height: 1.6;
            margin-top: 25px;
        ">
            If you didn't request a password reset, you can safely
            ignore this email. Your password will remain unchanged.
        </p>


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
                MovieBox 🍿
            </p>

            <p
                style="
                margin-top: 8px;
                color: #999;
                font-size: 12px;
            ">
                Your personal movie collection
            </p>

        </div>

    </div>

</body>

</html>
