<x-layout>
    <main>
        <div class="container edit-profile">
            <h2>Change Avatar</h2>
            <div class="edit-profile__photo">
                <img class="photo photo--medium" src="{{auth()->user()->avatar}}" alt="" class="account__image">
            </div>
            <form class="form" action="/manage-avatar" method="POST" enctype="multipart/form-data">
                @csrf
                <input class="choose-file" name="avatar" type="file">
                @error('avatar')
                    <div class="alert-text small-text">{{$message}}</div>
                @enderror
                <button class="button button--blue">Update Avatar</button>
            </form>
        </div>
    </main>
</x-layout>