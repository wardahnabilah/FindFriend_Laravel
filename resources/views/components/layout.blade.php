<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Stylesheet Link -->
    <link rel="icon" href="/favicon.svg">
    <link rel="stylesheet" href="/main.css">
    <title>FindFriend</title>
</head>
<body class="blue-bg">
    <header class="header">
        <img src="/icon-findfriend.svg" alt="">
        @auth
            {{-- If logged in, show the 'log out' button --}}
            <div class="account">
                <a href="/logout" class="account__logout-text">Log out</a>
                <img class="photo photo--small" src="/profile.jpg" alt="">
            </div>
        @else
            {{-- If not logged in, show 'log in' or 'sign up' button --}}
            <div class="button-link">Log In</div>
            <div class="button-link">Sign Up</div>
        @endauth
    </header>

    {{$slot}}

    <footer class="footer">
        Copyright 2023 FindFriendApp. All rights reserved.
    </footer>
</body>
</html>