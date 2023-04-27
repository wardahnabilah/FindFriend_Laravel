<x-layout>
    <main>
        <div class="container profile">
            <div class="profile__detail">
                <img src="/profile.jpg" alt="" class=" photo photo--medium profile__detail-image">
                <div class="profile__detail-text">
                    <h3 class="name">{{$username}}</h3>
                    <button class="button button--yellow">+ Follow</button>
                </div>
            </div>
            <div class="profile__menu">
                <a href="" class="posts">{{$posts->count()}} Posts</a>
                <a href="" class="followers">Followers</a>
                <a href="" class="following">Following</a>
            </div>
            <!-- Post Cards -->
            @foreach($posts as $post)
                <a href="/post/{{$post->id}}">
                    <div class=" card card__timeline">
                        <div class="card-header-container">
                            <div class="profile-detail">
                                <img class="profile-detail__image photo photo--small" src="/profile.jpg" alt="">
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
        </div>
    </main>
</x-layout>