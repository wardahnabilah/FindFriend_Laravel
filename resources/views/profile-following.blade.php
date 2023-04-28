<x-profile-layout :profileData="$profileData">
    <!-- Following Cards -->
    @foreach($following as $followinguser)
        <div class="card card__followers">
            <div class="card-header-container">
                <div class="profile-detail">
                    <img class="profile-detail__image photo photo--small" src="{{$followinguser->followingUser->avatar}}" alt="">
                    <span class="profile-detail__name">{{$followinguser->followingUser->username}}</span>
                </div>
                <button class="button button--red">Unfollow</button>    
            </div>    
        </div>
    @endforeach
</x-profile-layout>