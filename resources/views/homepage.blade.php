<x-layout>
    <main>
        <div class="container signup">
            <h1 class="homepage__text">Connect With New Friends Around The World</h1>
            <form class="form" action="/signup" method="POST">
                @csrf
                <div class="input-container">
                    <input class="input input--blue" type="text" value="{{old('username')}}" name="username" placeholder="Username">
                    @error('username')
                        <div class="alert-text small-text">{{$message}}</div>
                    @enderror
                </div>
                <div class="input-container">
                    <input class="input input--blue" type="text" value="{{old('email')}}" name="email" placeholder="Email">
                    @error('email')
                        <div class="alert-text small-text">{{$message}}</div>
                    @enderror
                </div>
                <div class="input-container">
                    <input class="input input--blue" type="password" name="password" placeholder="Password (min. 8 characters)">
                    @error('password')
                        <div class="alert-text small-text">{{$message}}</div>
                    @enderror
                </div>
                <div class="input-container">
                    <input class="input input--blue" type="password" name="password_confirmation" placeholder="Password Confirmation">
                    @error('password_confirmation')
                        <div class="alert-text small-text">{{$message}}</div>
                    @enderror
                </div>
                <button class="button button--yellow">Sign Up</button>
            </form>
            <p class="small-text">Already have an account? <a href="/login" class="button-link">Log In</a></p>
        </div>
    </main>
</x-layout>