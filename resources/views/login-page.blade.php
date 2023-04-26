<x-layout>
    <main class="blue-bg">
        <div class="container login">
            <h3>Log In</h3>
            <form class="form" action="/login" method="POST">
                @csrf
                <div class="input-container">
                    <input class="input input--blue" type="text" name="usernameLogin" placeholder="Username">
                    @error('usernameLogin')
                        <div class="alert-text small-text">{{$message}}</div>
                    @enderror
                </div>
                <div class="input-container">
                    <input class="input input--blue" type="password" name="passwordLogin" placeholder="Password">
                    @error('passwordLogin')
                        <div class="alert-text small-text">{{$message}}</div>
                    @enderror
                </div>
                <button class="button button--yellow" type="submit">Login</button>
            </form>
            <p class="small-text">Don't have an account? <a href="/" class="button-link">Sign Up</a></p>
        </div>
    </main>
</x-layout>