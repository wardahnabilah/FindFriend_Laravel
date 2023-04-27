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
<body class={{auth()->check() ? "" : "blue-bg"}}>
    <header class="header">
        <a href="/"><img src="/icon-findfriend.svg" alt="find friend logo"></a>
        @auth
            {{-- If logged in, show the 'log out' button --}}
            <div class="account">
                <a href="/logout" class="account__logout-text">Log out</a>
                <a href="/profile/{{auth()->user()->username}}"><img class="photo photo--small" src="/profile.jpg" alt="profile photo"></a>
            </div>
        @else
            {{-- If not logged in, show 'log in' or 'sign up' button --}}
            <a href="/login" class="button-link">Log In</a>
            <a href="/" class="button-link">Sign Up</a>
        @endauth
    </header>

    {{-- Show success flash message --}}
    @if (session()->has('success')) 
        <div class="alert-container success">
            {{session('success')}}
        </div>
    {{-- Show failed flash message --}}
    @elseif (session()->has('failed'))
        <div class="alert-container failed">
            {{session('failed')}}
        </div>
    @endif

    {{$slot}}

    <footer class="footer">
        Copyright 2023 FindFriendApp. All rights reserved.
    </footer>
</body>
</html>