<x-layout>
    <main>
        <div class="container timeline">
            <h2 class="timeline__title">Timeline</h2>
            <p  class="timeline__subtitle">(Posts from people)</p>
            <a href="/create-post" class="button button--yellow button--small">+ Create New Post</a>

            <!-- Post Cards -->
            @foreach($allPosts as $post)
                <div class="card card__timeline">
                    <div class="card-header-container">
                        <a href="/profile/{{$post->user->username}}">
                            <div class="profile-detail">
                                <img class="profile-detail__image photo photo--small" src="{{$post->user->avatar}}" alt="">
                                <span class="profile-detail__name">{{$post->user->username}}</span>
                            </div>
                        </a>
                        <div class="small-text posted-on">posted on {{$post->created_at->format('d F Y')}}</div>
                    </div>
                    <div class="card-body-container">
                        <h6 class="post-title">{{$post->title}}</h6>
                        <p class="post-body">{{$post->body}}</p>
                    </div>
                </div>
            @endforeach

            <div class="mt-5">
                {{$allPosts->links()}}
            </div>

        </div>
    </main>
</x-layout>