<x-layout>
    <main>
        <div class="container">
            <h3>Create Post</h3>
            <form class="form form--createpost" action="/create-post" method="POST" autocomplete="off">
                @csrf
                <div class="input-container">
                    <input class="input input--white" type="text" name="postTitle" placeholder="Title">
                    @error('postTitle')
                        <div class="alert-text small-text">{{$message}}</div>
                    @enderror
                </div>
                <div class="input-container">
                    <textarea class="textarea" rows="12" name="postBody" placeholder="Body"></textarea>
                    @error('postBody')
                        <div class="alert-text small-text">{{$message}}</div>
                    @enderror
                </div>
                <button class="button button--yellow">Add Post</button>
            </form>
        </div>
    </main>
</x-layout>