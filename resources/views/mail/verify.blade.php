<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify your Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1f1f1f;
            color: #fff;
            padding: 20px;
        }
        .container {
            border: 2px solid #9069a9;
            padding: 20px;
            max-width: 400px;
            margin: 0 auto;
            text-align: left; 
            border-radius: 20px;
            display: flex;
            flex-direction: column;
            align-items: left;
        }
        .container h1 {
            margin: 0;
        }
        .centered-text {
            text-align: center;
        }
        .otp-bg
        {
            text-align: center;
        }
        .otp {
            font-size: 2rem;
            font-weight: bold;
            margin: 5px 0;
            background-color: #9069a9;
            padding: 10px;
            border-radius: 5px;
        }
        .responsive-text {
            font-size: 1.2rem;
            margin-top: 20px;
            text-align: center;
        }
        .clickable {
            color: #ffffff;
            text-decoration: none;
        }
        .image-container {
            position: relative;
            width: 100%;
            margin-left: 70px;
            padding-bottom: 56.25%; 
        }
        .image-container img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .line {
            width: 100%;
            height: 2px;
            background-color: #9069a9;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="image-container">
            <img src="{{ $message->embed($image) }}" style="height: 240px; width: 240px;" alt="RGRP_LOGO">
        </div>
        <div class="line"></div>
        
        <div class="centered-text">
            <h1>Hi {{ $name }}!</h1>
            <p>Please click the link below to verify your account, This email expires in <b>20 minutes</b></p>
        </div>
        <div class = "otp-bg">
            <a href="{{ $verificationUrl }}" class="btn">Click me to verify</a>
        </div>
        <div class="responsive-text">
            <a class="clickable" href="samp://localhost:7777">Project Renegade</a><br>
            <a class="clickable" href="https://renegadecommunity.xyz">Renegade Community Website</a><br>
            <a class="clickable" href="https://renegadecommunity.xyz/discord">Renegade Community Discord</a><br>
            <a class="clickable" href="https://www.facebook.com/profile.php?id=61550099995060">Renegade Community Facebook</a>
        </div>
    </div>
</body>
</html>