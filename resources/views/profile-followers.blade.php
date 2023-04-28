<x-profile-layout :profileData="$profileData">
    <!-- Followers Cards -->
    @foreach($followers as $follower)
        <div class="card card__followers">
            <div class="card-header-container">
                <div class="profile-detail">
                    <img class="profile-detail__image photo photo--small" src="{{$follower->followerUser->avatar}}" alt="">
                    <span class="profile-detail__name">{{$follower->followerUser->username}}</span>
                </div>
                <button class="button button--red">Unfollow</button>    
            </div>    
        </div>
    @endforeach
</x-profile-layout>