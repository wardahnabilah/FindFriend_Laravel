<x-profile-layout :profileData="$profileData">
    <!-- Following Cards -->
    @foreach($following as $everyFollowing)
        <a href="/profile/{{$everyFollowing->followingUser->username}}">
            <div class="card card__followers">
                <div class="card-header-container">
                    <div class="profile-detail">
                        <img class="profile-detail__image photo photo--small" src="{{$everyFollowing->followingUser->avatar}}" alt="">
                        <span class="profile-detail__name">{{$everyFollowing->followingUser->username}}</span>
                    </div>
                    <form action="/profile/{{$everyFollowing->followingUser->username}}/unfollow" method="POST">
                        @csrf
                        <button class="button button--red">Unfollow</button>
                    </form>   
                </div>    
            </div>
        </a>
    @endforeach
</x-profile-layout>