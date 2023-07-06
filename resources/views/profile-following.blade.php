<x-profile-layout :profileData="$profileData">
    @if($profileData['followingCount'] === 0)
        <p class="profile-empty">You haven't followed anyone yet</p>
        <div id="emptyFollowingBtn" class="button button--yellow button--small profile-empty-btn"> Search New Friend</div>
    @endif
    <!-- Following Cards -->
    @foreach($following as $everyFollowing)
        <a href="/profile/{{$everyFollowing->followingUser->username}}">
            <div class="card card__followers">
                <div class="card-header-container">
                    <div class="profile-detail">
                        <img class="profile-detail__image photo photo--small" src="{{$everyFollowing->followingUser->avatar}}" alt="">
                        <span class="profile-detail__name">{{$everyFollowing->followingUser->username}}</span>
                    </div>
                    @if($everyFollowing->followingUser->username !== auth()->user()->username)
                        <form action="/profile/{{$everyFollowing->followingUser->username}}/unfollow" method="POST">
                            @csrf
                            <button class="button button--red">Unfollow</button>
                        </form>
                    @endif
                </div>    
            </div>
        </a>
    @endforeach
</x-profile-layout>