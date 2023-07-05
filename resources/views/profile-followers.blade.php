<x-profile-layout :profileData="$profileData">
    @if($profileData['followersCount'] === 0)
        <p class="profile-empty">You don't have any followers yet</p>
    @endif
    <!-- Followers Cards -->
    @foreach($followers as $follower)
        <a href="/profile/{{$follower->followerUser->username}}">
            <div class="card card__followers">
                <div class="card-header-container">
                    <div class="profile-detail">
                        <img class="profile-detail__image photo photo--small" src="{{$follower->followerUser->avatar}}" alt="">
                        <span class="profile-detail__name">{{$follower->followerUser->username}}</span>
                    </div>
                    
                {{-- Follow or unfollow button --}}
                    {{-- If the user also following the follower, show unfollow button --}}
                    @if(in_array($follower->followerUser->id, $followingId))
                        <form action="/profile/{{$follower->followerUser->username}}/unfollow" method="POST">
                            @csrf
                            <button class="button button--red">Unfollow</button>
                        </form>
                    {{-- Otherwise, show follow button --}}
                    @else
                        <form action="/profile/{{$follower->followerUser->username}}/follow" method="POST">
                            @csrf
                            <button class="button button--yellow">+ Follow</button>
                        </form>
                    @endif 
                </div>    
            </div>
        </a>
    @endforeach
</x-profile-layout>