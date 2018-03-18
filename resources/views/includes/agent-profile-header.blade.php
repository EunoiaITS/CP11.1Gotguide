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
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div><!--// header landing area -->