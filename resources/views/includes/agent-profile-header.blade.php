<!--=====================
                profile preview area
                ===========================-->
<div class="user-edit-profile-area">
    <div class="container">
        <div class="row">
            <div class="user-edit-picture ">
                <img src="{{ $result->profile_img }}" alt="">
            </div>
            <div class="user-edit-text text-center">
                <h3 class="user-edit-name">{{ $result->name }}</h3>
                <h4 class="user-title">{{ $result->city.', '.$result->country }}</h4>
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
        </div>
    </div>
</div><!--// header landing area -->