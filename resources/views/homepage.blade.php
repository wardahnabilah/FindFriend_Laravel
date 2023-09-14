<x-layout>
    @if($posts->isEmpty())
        <main>
            <div class="container home-empty">
                <h2>Welcome, {{auth()->user()->username}} !</h2>
                <p >Let’s embark on an exciting journey to connect with people across the globe. Begin your journey by finding friends or you can kickstart by crafting your very first post and sharing it with the world by clicking the button below.</p>
                <a href="create-post" class="button button--yellow">Create Your First Post</a>
            </div>
        </main>
    @else
    <main>
        <div class="container timeline">
            <h2 class="timeline__title">Timeline</h2>
            <p  class="timeline__subtitle">(Posts from people you followed)</p>
            <a href="/create-post" class="button button--yellow button--small">+ Create New Post</a>

            <!-- Post Cards -->
            @foreach($posts as $post)
                <a href="">
                    <div class=" card card__timeline">
                        <div class="card-header-container">
                            <div class="profile-detail">
                                <img class="profile-detail__image photo photo--small" src="{{$post->user->avatar}}" alt="">
                                <span class="profile-detail__name">{{$post->user->username}}</span>
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

            <div class="mt-5">
                {{$posts->links()}}
            </div>

        </div>
    </main>
    @endif
</x-layout>