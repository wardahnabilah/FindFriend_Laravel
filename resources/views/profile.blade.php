<x-profile-layout :profileData="$profileData">
    <!-- Post Cards -->
    @foreach($posts as $post)
        <a href="/post/{{$post->id}}">
            <div class=" card card__timeline">
                <div class="card-header-container">
                    <div class="profile-detail">
                        <img class="profile-detail__image photo photo--small" src="{{$post->author->avatar}}" alt="">
                        <span class="profile-detail__name">{{$post->author->username}}</span>
                    </div>
                    <div class="small-text posted-on">posted on {{$post->created_at->format('d F Y')}}</div>
                </div>
                <div class="card-body-container">
                    <h6 class="post-title">{{$post->title}}</h6>
                    <p class="post-body">{{$post->body}}</p>
                </div>
            </div>
        </a>
    @endforeach
</x-profile-layout>