<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Stylesheet Link -->
    <link rel="icon" href="/favicon.svg">
    {{-- Bootstrap CDN Link CSS--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/main.css">
    {{-- Bootstrap CDN Link JS--}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" defer></script>
    <title>FindFriend</title>
</head>
<body class={{auth()->check() ? "" : "blue-bg"}}>
    <header class="header">
        <a href="/"><img src="/icon-findfriend.svg" alt="find friend logo"></a>
        
        <!-- If logged in, show the 'log out' button -->
        @auth
            <!-- Profile and Log out -->
            <div class="account">
                <a href="/logout" class="account__logout-text">Log out</a>
                <a href="/profile/{{auth()->user()->username}}"><img class="photo photo--small" src="{{auth()->user()->avatar}}" alt="profile photo"></a>
            </div>
        
        <!-- If not logged in, show 'log in' or 'sign up' button -->
        @else
            <!-- Show 'login' on sign up page -->
            @if(Request::segment(1) == "")
                <a href="/login" class="button-link">Log In</a>
            <!-- Show 'sign up' on login page -->
            @elseif(Request::segment(1) == "login")
                <a href="/" class="button-link">Sign Up</a>
            @endif

        @endauth
    </header>

    <!-- Search User -->
    <div class="search-container">
        <div class="close-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="rgba(0, 0, 0, 1)">
                <path d="m16.192 6.344-4.243 4.242-4.242-4.242-1.414 1.414L10.535 12l-4.242 4.242 1.414 1.414 4.242-4.242 4.243 4.242 1.414-1.414L13.364 12l4.242-4.242z"></path>
            </svg>
        </div>

        <form class="form search-input">
            <input class="input input--blue input--search" type="text" name="searchFriends" placeholder="Search Friends">
        </form>

        <div class="loading"></div>
        <!-- Search Result -->
        <div class="search-result">
        </div>
    </div>

    <!-- Show success flash message -->
    @if (session()->has('success')) 
        <div class="alert-container success">
            {{session('success')}}
        </div>
    <!-- Show failed flash message -->
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