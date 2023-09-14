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
    {{-- Bootstrap CDN Link JS--}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" defer></script>
    @vite(['resources/css/app.css'])
    @vite(['resources/js/app.js'])
    <title>FindFriend</title>
</head>
<body class={{auth()->check() ? "" : "blue-bg"}}>
    <header class="header">
        <a href="/"><img src="/icon-findfriend.svg" alt="find friend logo"></a>
        @if(Request::segment(1) !== "login" && Request::segment(1) !== "register")
            <!-- Search Icon -->
            <div class="items-container">
                <div class="search" id="search-friends">
                    Search Friends
                    <svg class="search__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="rgba(0, 0, 0, 1)">
                        <path d="M10 18a7.952 7.952 0 0 0 4.897-1.688l4.396 4.396 1.414-1.414-4.396-4.396A7.952 7.952 0 0 0 18 10c0-4.411-3.589-8-8-8s-8 3.589-8 8 3.589 8 8 8zm0-14c3.309 0 6 2.691 6 6s-2.691 6-6 6-6-2.691-6-6 2.691-6 6-6z"></path>
                        <path d="M11.412 8.586c.379.38.588.882.588 1.414h2a3.977 3.977 0 0 0-1.174-2.828c-1.514-1.512-4.139-1.512-5.652 0l1.412 1.416c.76-.758 2.07-.756 2.826-.002z"></path>
                    </svg>
                </div>
            </div>
        @endif
        <!-- If logged in, show the profile and log out button -->
        @auth
            <div class="items-container">
                <!-- Profile and Log out -->
                <div class="account">
                    <a href="/logout" class="account__logout-text">Log out</a>
                    <a href="/profile/{{auth()->user()->username}}"><img class="photo photo--small" src="{{auth()->user()->avatar}}" alt="profile photo"></a>
                </div>
            </div>
        <!-- If not logged in, show 'log in' or 'sign up' button -->
        @else
            <!-- Show 'login' on sign up page -->
            @if(Request::segment(1) == "")
                <a href="/login" class="button-link">Log In</a>
            <!-- Show 'sign up' on login page -->
            @elseif(Request::segment(1) == "login")
                <a href="/signup" class="button-link">Sign Up</a>
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