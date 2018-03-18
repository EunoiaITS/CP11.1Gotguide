@extends('layouts.layout')
@section('content')

    <!-- user profile edit details area -->
    <div class="comments-area">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-8 col-sm-offset-2 col-md-offset-3 col-xs-10 col-xs-offset-1 padding-left-0 padding-right-0">
                    <div class="comments">
                        @if($result->comments != null)
                            @foreach($result->comments as $comment)
                                <div class="single-comments">
                                    <div class="img-comments">
                                        <img src="{{ $comment->profile_img }}" alt="comments-pic">
                                    </div>
                                    <div class="comment-block">
                                        <h3 class="coments-name">{{ $comment->commenter }}</h3>
                                        <div class="my-rating-{{ $comment->id }}"></div>
                                        <p>{{ $comment->comment }}</p>
                                    </div>
                                </div>
                            @endforeach
                            @else
                            <h4>No comments yet!</h4>
                            @endif
                    <div class="back-to-profileq">
                        <a href="{{ url('profile/guide') }}" style="text-decoration: none;"><button type="button" class="btn btn-info comments-button">Back to Profile</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--=============
        Search popuppage
        ==================-->
    <div class="popup-wrapper">
        <div class="popup-base">
            <div class="search-popup">
                <i class="close fa fa-remove"></i>
                <div class="row">
                    <div class="search-destination">
                        <h2 class="search-title">Choose Destination</h2>
                        <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                    </div>
                    <!-- header got seach area -->
                    <div class="popup-got-search">
                        <form action="#">
                            <div class="city from-left">
                                <select class="selectpicker u-upparcase" data-live-search="true" title="City">
                                    <option data-tokens="dhaka">Dhaka</option>
                                    <option data-tokens="Newyourk">Newyork</option>
                                    <option data-tokens="dilli">Dilli</option>
                                    <option data-tokens="sidny">Sidny</option>
                                    <option data-tokens="melborne">Melborne</option>
                                </select>
                            </div>
                            <div class="country from-left">
                                <select class="selectpicker u-upparcase" data-live-search="true" title="Country">
                                    <option data-tokens="Bangladesh">Bangladesh</option>
                                    <option data-tokens="Usa">Usa</option>
                                    <option data-tokens="India">India</option>
                                    <option data-tokens="Australia">Australia</option>
                                    <option data-tokens="Italy">Italy</option>
                                </select>
                            </div>
                            <div class="language from-left">
                                <select class="selectpicker u-upparcase" data-live-search="true" title="Language">
                                    <option data-tokens="Bangla">Bangla</option>
                                    <option data-tokens="English">English</option>
                                    <option data-tokens="Arabic">Arabic</option>
                                    <option data-tokens="Bosnian">Bosnian</option>
                                    <option data-tokens="Nepali">Nepali</option>
                                </select>
                            </div>
                            <div class="clearfix search-button-popup">
                                <a href="#" class="search-guide from-left">
                                    <img src="img/search.png" alt="">
                                </a>
                            </div>
                        </form>
                    </div><!--// end header got search area -->
                </div>
            </div>

        </div>
    </div><!-- Popup -->

    @endsection