<x-layout>
    <main>
        <div class="container profile">
            <div class="profile__detail">
                <img src="{{$profileData['userAvatar']}}" alt="" class=" photo photo--medium profile__detail-image">
                <div class="profile__detail-text">
                    <h3 class="name">{{$profileData['username']}}</h3>
                    @if(auth()->check() && auth()->user()->username === $profileData['username'])
                        <a href="/manage-avatar" class="button button--blue">Change Avatar</a>
                    @elseif($profileData['alreadyFollowed'])
                        <form action="/profile/{{$profileData['username']}}/unfollow" method="POST">
                            @csrf
                            <button class="button button--red">Unfollow</button>
                        </form>
                    @else
                        <form action="/profile/{{$profileData['username']}}/follow" method="POST">
                            @csrf
                            <button class="button button--yellow">+ Follow</button>
                        </form>
                    @endif
                </div>
            </div>
            <div class="profile__menu">
                <a href="/profile/{{$profileData['username']}}" class="{{Request::segment(3) == '' ? 'active' : '' }}">{{$profileData['postCount']}} Posts</a>
                <a href="/profile/{{$profileData['username']}}/followers" class="{{Request::segment(3) == 'followers' ? 'active' : ''}}">{{$profileData['followersCount']}} Followers</a>
                <a href="/profile/{{$profileData['username']}}/following" class="{{Request::segment(3) == 'following' ? 'active' : ''}}">{{$profileData['followingCount']}} Following</a>
            </div>
            
            {{$slot}}

        </div>
    </main>
</x-layout>