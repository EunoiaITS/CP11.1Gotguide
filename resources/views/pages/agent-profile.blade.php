@extends('layouts.layout')
@section('content')
<!-- user profile edit details area -->
<div class="user-details">
    <div class="container">
        <div class="row">
            @if(session()->has('success-message'))
                <div class="alert alert-success">
                    {{ session()->get('success-message') }}
                </div>
            @endif
                @if(session()->has('error-message'))
                    <div class="alert alert-danger">
                        {{ session()->get('error-message') }}
                    </div>
                @endif
            <form action="#">
                <div class="col-sm-5  col-xs-12">
                    <!-- Language area -->
                    <div class="user-edit-group">
                        <span class="guide-title text-uppercase">Language</span>
                        <p class="guide-date">{{ $result->language }}</p>
                    </div>
                    <!-- Description area -->
                    <div class="user-edit-group">
                        <span class="guide-title text-uppercase">Description</span>
                        <p class="guide-details">{{ $result->informations }}</p>
                    </div>
                    <!-- email area -->
                    <div class="user-edit-group">
                        <span class="guide-title text-uppercase">Email</span>
                        <p class="guide-date">{{ $result->email }}</p>
                    </div>
                </div>
                <div class="col-sm-5 col-sm-offset-1 col-xs-12">
                    <!-- availabitiy area -->
                    <div class="form-group user-edit-group">
                        <span class="guide-title text-uppercase">Availability</span>
                        <div class="avilability-box availabity-scroll">
                            @if($result->availableDates != null)
                            <ul>
                                @foreach($result->availableDates as $dates)
                                    <li>
                                        <span class="date">{{ $dates->available_dates }} </span> | <span class="time">{{ $dates->available_time }}</span>
                                    </li>
                                @endforeach
                            </ul>
                            @else
                                <p class="text-center">No available date!!</p>
                            @endif
                        </div>
                    </div>
                    <!-- Packages area -->
                    <div class="form-group user-edit-group">
                        <span class="guide-title text-uppercase">packages</span>
                        <div class="avilability-box availabity-scroll scroll-hover">
                            @if($result->packages != null)
                                <ul>
                                @foreach($result->packages as $packs)
                                    <li  class="package-popup-ip" rel="{{ $packs->id }}">
                                        <span class="date" id="package_name{{ $packs->id }}">{{ $packs->package_name }}</span> | <span class="time" id="package_price{{ $packs->id }}">{{ $packs->package_price }}</span>
                                        <span class="details-class">Details</span><span class="hidden" id="package_details{{ $packs->id }}">{{ $packs->package_details }}</span>
                                    </li>
                                @endforeach
                                </ul>
                            @else
                                <p class="text-center">No available package!!</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <button class="btn btn-info profile-preview-button open-popup-rateme">Rate me !</button>
                    <a href="{{ url('reviews/'.$result->id) }}" class="btn btn-btn-info log-out">Check Reviews</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!--=============
    Search popuppage
    ==================-->
@include('includes.search-modal')


<!--=======================
rate me popupbox
==========================-->
<div class="popup-rateme">
    <div class="popup-base">
        <div class="popup-rateme-main">
            <i class="close fa fa-remove"></i>
            <div class="row">
                <div class="rateme-destination">
                    <h2 class="search-title">{{ $result->name }}</h2>
                    <div class="rateme-rattings">
                        <ul class="rate-icon">
                            <li><a role="button" id="btn1"><i class="fa fa-star-o" id="star1"></i></a></li>
                            <li><a role="button" id="btn2"><i class="fa fa-star-o" id="star2"></i></a></li>
                            <li><a role="button" id="btn3"><i class="fa fa-star-o" id="star3"></i></a></li>
                            <li><a role="button" id="btn4"><i class="fa fa-star-o" id="star4"></i></a></li>
                            <li><a role="button" id="btn5"><i class="fa fa-star-o" id="star5"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- header got seach area -->
                <div class="popup-got-search">
                    <form method="post" action="{{ url('/rate-guide') }}">
                        <div class="form-group">
                            <label class="rate-me-comments" for="rateme-comment">Comment :</label>
                            <div class="clearfix">
                                <textarea name="comment" placeholder="write your comments...." id="rateme-comment" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                        <input type="hidden" name="agent_id" value="{{ $result->id }}">
                        <input type="hidden" name="rating" id="rate" value="0">
                        <button type="submit" class="btn btn-info profile-preview-button">Submit</button>
                    </form>
                </div><!--// end header got search area -->
            </div>
        </div>

    </div>
</div><!-- Popup -->

<!--
    package popup
    ======================-->
<div class="popup-package">
    <div class="popup-base">
        <div class="search-popup">
            <i class="close fa fa-remove"></i>
            <div class="row">
                <!-- header got seach area -->
                <div class="popup-got-search popup-available-picker">
                    <form action="#">
                        <div class="popup-title">
                            <span class="tiltle-popup-name">Title <span class="fright">:</span></span>
                            <span class="tiltle-popup-description" id="package_name_show">Text text text</span>
                        </div>
                        <div class="clearfix"></div>
                        <div class="popup-title">
                            <span class="tiltle-popup-name">Price <span class="fright">:</span></span>
                            <span class="tiltle-popup-description" id="package_price_show">RM 250</span>
                        </div>
                        <div class="clearfix"></div>
                        <div class="popup-title">
                            <span class="tiltle-popup-name">Description <span class="fright">:</span></span>
                            <span class="tiltle-popup-description" id="package_details_show">In publishing and graphic design, lorem ipsum is a filler text or greeking commonly used to demonstrate the textual elements of a graphic document or visual presentation. Replacing meaningful content with placeholder text allows designers to design the form of the content before the content itself has been produced.
                                    </span>
                        </div>
                        <button type="button" class="btn btn-info btn-change close">Cancel</button>
                    </form>
                </div><!--// end header got search area -->
            </div>
        </div>

    </div>
</div><!-- Popup -->

    @endsection