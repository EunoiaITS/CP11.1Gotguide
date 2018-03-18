<!--==

               Breadcumb user profile area
              ===========================-->

<div class="user-edit-profile-area">
    <div class="container">
        <div class="row">
            <!--<form method="post" action="" enctype="multipart/form-data">-->
            <!--    <span style="color:#fff;margin-left:40%;">Profile :<input style="color:#fff;margin-top:2%;margin-left:46%;" type="file" name="profile_img"></span>-->
            <!--    <input style="color:#000;margin-top:.5%;margin-left:46%;" type="submit" value="upload" name="userImg">-->
            <!--</form>-->
            <!-- image upload section -->
            <div class="user-edit-picture img-result">
                <img class="image-upload-hide" src="{{ $result->profile_img }}" alt="">
                <img class="cropped" src="" alt="">
        		<div class="image-hover open-popup-image">
        			<i class="fa fa-upload" aria-hidden="true"></i>
        		</div>
             </div>
            <div class="user-edit-text text-center">
                <h3 class="user-edit-name">{{ $result->name }}</h3>
                <h4 class="user-title">@if($result->city != null){{ $result->city.', '}}@endif{{$result->country }}</h4>
                <ul class="user-social-media">
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--// header landing area -->

        <!--=============
        image upload popuppage 
        ==================-->
         <div class="popup-image-wrapper">
            <div class="popup-base">
                <div class="search-popup">
                    <i class="close fa fa-remove"></i>
                    <div class="row">
                        <!-- header got image area -->

                        <div class="popup-image-upload">
                            <form id="image_form" method="post" action="{{ url('/profile/edit/user') }}" enctype="multipart/form-data">
                                <h2 class="text-center">Upload Your Profile Picture</h2>
							<!-- input file -->
							<div class="box">
								<input type="file" id="file-input" name="profile_img">
							</div>
							<!-- leftbox -->
							<div class="box-2">
								<div class="result"></div>
							</div>
							<!-- input file -->
							<div class="box">
								<div class="options hide">
									<label for="width">Width</label>
									<input id="width" type="number" class="img-w" value="300" min="100" max="1200" />
								</div>
								<!-- save btn -->
                                <button onclick="form_submit()" name="userImg" class="btn save hide close">Save</button>
							</div>
                            </form>
                        </div>
                        <!--// end header got image area -->
                    </div>
                </div>

            </div>
        </div><!-- Popup -->
<script type="text/javascript">
    function form_submit() {
        document.getElementById("image_form").submit();
    }
</script>