<!--==
                    guide profile area
                    ===========================-->
<div class="user-edit-profile-area">
    <div class="container">
        <div class="row">
            <div class="user-edit-picture ">

                <img src="{{ $result->profile_img }}" alt="">
            </div>
            <div class="user-edit-text text-center">
                <h3 class="user-edit-name">{{ $result->name }}</h3>
                <h4 class="user-title">@if(isset($result['city'],$result['country'])){{ $result->city.' , '.$result->country }}@endif</h4>
                <div class="user-ratings">
                    <div class="my-rating"></div>
                </div>
                <ul class="user-social-media">
                    @if(isset($result->gl_fb->link) && $result->gl_fb->link != '')
                        <li><a href="{{ $result->gl_fb->link }}"><i class="fa fa-facebook"></i></a></li>
                    @endif
                    @if(isset($result->gl_tw->link) && $result->gl_tw->link != '')
                        <li><a href="{{ $result->gl_tw->link }}"><i class="fa fa-twitter"></i></a></li>
                    @endif
                    @if(isset($result->gl_yt->link) && $result->gl_yt->link != '')
                        <li><a href="{{ $result->gl_yt->link }}"><i class="fa fa-youtube"></i></a></li>
                    @endif
                </ul>
            </div>
            <div class="guide-settings">
                                <span class="guide-settings">
                                    <ul class="settings-menu">
                                        <li><i class="fa fa-cog" aria-hidden="true"></i>
                                            <ul>
                                                <li><a href="{{ url('/profile/edit/guide') }}">Edit Profile</a></li>
                                                <li><a class="log-out-confermation" href="{{ url('/glogout') }}">Log Out</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </span>
            </div>
        </div>
    </div>
</div><!--// header landing area -->
