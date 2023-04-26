<x-layout>
    <main>
        <div class="container login">
            <h3>Log In</h3>
            <form class="form" action="/login" method="POST">
                @csrf
                <input class="input input--blue" type="text" name="usernameLogin" placeholder="Username">
                <input class="input input--blue" type="password" name="passwordLogin" placeholder="Password">
                <button class="button button--yellow" type="submit">Login</button>
            </form>
            <p class="small-text">Don't have an account? <a href="/" class="button-link">Sign Up</a></p>
        </div>
    </main>
</x-layout>