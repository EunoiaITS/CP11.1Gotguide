@extends('layouts.layout')
@section('content')
    <!-- user profile edit details area -->
    <div class="user-details">
        <div class="container">
            <div class="row">
                @if(session()->has('save-message'))
                    <div class="alert alert-success">
                        {{ session()->get('save-message') }}
                    </div>
                @endif
                <form method="post" action="{{ url('/profile/edit/guide') }}">
                    <div class="col-sm-5  col-xs-12">
                        <!-- full name area -->
                        <div class="form-group user-edit-group">
                            <label for="guide-description" class="text-uppercase">Description</label>
                            <textarea name="informations" class="guite-textarea" placeholder="type about yourself.." id="guide-description" cols="30" rows="5">{{ $result->informations }}</textarea>
                        </div>
                        <!-- Date of bith area -->
                        <div class="form-group user-edit-group">
                            <label for="guide-date-of-birth" class="text-uppercase">Date of Birth</label>
                            <div class="clearfix user-birth-date">
                                <div class="date from-left">
                                    <select name="day" class="selectpicker u-upparcase" data-live-search="false" title="{{ date_format(new DateTime($result->dob), 'd') }}">
                                        @for($i = 1; $i <= 31; $i++)
                                            <option value="{{ $i }}" @if(date_format(new DateTime($result->dob), 'd') == $i){{ 'selected'  }}@endif>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="month from-left">
                                    <select name="month" class="selectpicker u-upparcase" data-live-search="false" title="{{ date_format(new DateTime($result->dob), 'm') }}">
                                        @for($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}" @if(date_format(new DateTime($result->dob), 'm') == $i){{ 'selected'  }}@endif>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="year from-left">
                                    <select name="year" class="selectpicker u-upparcase" data-live-search="false" title="{{ date_format(new DateTime($result->dob), 'Y') }}">
                                        @for($i = 1930; $i <= date('Y'); $i++)
                                            <option value="{{ $i }}" @if(date_format(new DateTime($result->dob), 'Y') == $i){{ 'selected'  }}@endif>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Country area -->
                        <div class="form-group user-edit-group">
                            <label for="guide-city" class="text-uppercase">Country</label>
                            <div class="clearfix user-edit-select">
                                <select name="country" class="selectpicker user-country u-upparcase" id="country" data-live-search="true" title="{{$result->country}}">
                                    @foreach($result->countries as $country)
                                        <option value="{{ $country->country_name }}" data-tokens="{{ $country->country_name }}" @if($country->country_name == $result->country){{ 'selected' }}@endif>{{ $country->country_name }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- City area -->
                        <div class="form-group user-edit-group">
                            <label for="guide-city" class="text-uppercase">City</label>
                            <div class="clearfix user-edit-select">
                                <select name="city" class="selectpicker user-country u-upparcase" id="city" data-live-search="true" title="{{$result->city}}">
                                    @foreach($result->cities as $ct)
                                        <option value="{{ $ct->city_name }}" data-tokens="{{ $ct->city_name }}" @if($ct->city_name == $result->city){{ 'selected' }}@endif>{{ $ct->city_name }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- Language area -->
                        <div class="form-group user-edit-group">
                            <label for="user-language" class="text-uppercase">Language</label>
                            <div class="clearfix user-edit-select">
                                <select name="language[]" class="selectpicker user-language u-upparcase" id="user-language" data-live-search="true" title="Language" multiple>
                                    @foreach($result->languages as $lang)
                                        <option value="{{ $lang->lang_name }}" data-tokens="{{ $lang->lang_name }}" @if(in_array($lang->lang_name, explode(';', $result->language))){{ 'selected' }}@endif>{{ $lang->lang_name }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- email area -->
                        <div class="form-group user-edit-group">
                            <label for="guide-email" class="text-uppercase">Email</label>
                            <input name="email" type="text" id="guide-email" class="form-control" placeholder="Enter Your Email" value="{{ $result->email }}" readonly>
                        </div>
                        <!-- contact area -->
                        <div class="form-group user-edit-group">
                            <label for="contact" class="text-uppercase">Contact</label>
                            <input name="contact" type="text" id="contact" class="form-control" placeholder="Enter Your Number" value="{{ $result->contact }}">
                        </div>
                    </div>

                    <div class="col-sm-5 col-sm-offset-1 col-xs-12">
                        <!-- availability area -->
                        <div class="form-group user-edit-group clearfix">
                            <label for="guide-avilability" class="text-uppercase">Availability <i class="fa fa-plus available-popup"></i></label>
                            @if(session()->has('success-message'))
                                <div class="alert alert-success">
                                    {{ session()->get('success-message') }}
                                </div>
                            @endif
                            <div class="avilability-box availabity-scroll">
                                @if($result->availableDates != null)
                                <ul>
                                    @foreach($result->availableDates as $dates)
                                    <li>
                                        <span class="date" id="date{{ $dates->id }}">{{ $dates->available_dates }}</span> | <span class="time" id="time{{ $dates->id }}">{{ $dates->available_time }}</span>
                                        <ul class="edit-option">
                                            <li><i class="fa fa-edit edit-popup-option-available" rel="{{ $dates->id }}"></i></li>
                                            <li><i class="fa fa-trash-o delete-popup-option" rel="{{ $dates->id }}"></i></li>
                                        </ul>
                                    </li>
                                    @endforeach
                                </ul>
                                @else
                                    <p class="text-center">No Availabe Time to preview</p>
                                @endif
                            </div>
                        </div>
                        <!-- packeges area -->
                        <div class="form-group user-edit-group clearfix">
                            <label for="guide-avilability" class="text-uppercase">Packages <i class="fa fa-plus package-popup-ip"></i></label>
                            @if(session()->has('package-message'))
                                <div class="alert alert-success">
                                    {{ session()->get('package-message') }}
                                </div>
                            @endif
                            @if(session()->has('package-error-message'))
                                <div class="alert alert-success">
                                    {{ session()->get('package-error-message') }}
                                </div>
                            @endif
                            <div class="avilability-box availabity-scroll">
                                @if($result->packages != null)
                                <ul>
                                    @foreach($result->packages as $packs)
                                    <li>
                                        <span class="date" id="name{{ $packs->id }}">{{ $packs->package_name }}</span> | <span class="time" id="price{{ $packs->id }}">{{ $packs->package_price }}</span>
                                        <span class="hidden" id="details{{ $packs->id }}">{{ $packs->package_details }}</span>
                                        <ul class="edit-option">
                                            <li class="edit-popup-option"><i class="fa fa-edit edit-package" rel="{{ $packs->id }}"></i></li>
                                            <li><i class="fa fa-trash-o delete-package" rel="{{ $packs->id }}"></i></li>
                                        </ul>
                                    </li>
                                    @endforeach
                                </ul>
                                @else
                                    <p class="text-center">No package Available</p>
                                @endif
                            </div>
                        </div>
                        <!-- packeges area -->
                        <div class="form-group social-media-new user-edit-group clearfix">
                            <label for="guide-avilability" class="text-uppercase">Social Media</label>
                            <ul>
                                <li><a href="#"><i  class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-12">
                        <input type="submit" value="Save Change" class="btn btn-info btn-change" name="guideInfo">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--=============
        Search popuppage
        ==================-->
    @include('includes.search-modal')
    <!-- Popup -->

    <!--==============
        availablity popup
        ====================-->
    <div class="popup-available">
        <div class="popup-base">
            <div class="search-popup">
                <i class="close fa fa-remove"></i>
                <div class="row">
                    <!-- header got seach area -->
                    <div class="popup-got-search popup-available-picker">
                        <form method="post" action="{{ url('add-ad') }}">
                            <div class="form-group user-edit-group">
                                <label for="guide-date" class="text-uppercase">Date</label>
                                <input name="date" type="text" id="guide-date" class="form-control datepicker-f" required>
                            </div>
                            <div class="form-group user-edit-group">
                                <label for="guide-time-ex" class="text-uppercase">Time</label>
                                <input name="time" type="text" id="guide-time-ex" class="form-control timepicker-f" required>
                            </div>
                            <button type="submit" class="btn btn-info btn-change">Add</button>
                            <button type="button" class="btn btn-info btn-change close">Cancel</button>
                        </form>
                    </div><!--// end header got search area -->
                </div>
            </div>

        </div>
    </div><!-- Popup -->

    <!--==============
   Edit availablity popup
   ====================-->
    <div class="edit-popup-available">
        <div class="popup-base">
            <div class="search-popup">
                <i class="close fa fa-remove"></i>
                <div class="row">
                    <!-- header got seach area -->
                    <div class="popup-got-search popup-available-picker">
                        <form method="post" action="{{ url('edit-ad') }}">
                            <div class="form-group user-edit-group">
                                <label for="guide-date" class="text-uppercase">Date</label>
                                <input name="date" type="text" id="edit-guide-date" value="" class="form-control datepicker-f">
                            </div>
                            <div class="form-group user-edit-group">
                                <label for="guide-time-ex" class="text-uppercase">Time</label>
                                <input name="time" type="text" id="edit-guide-time-ex" class="form-control timepicker-f">
                            </div>
                            <input type="hidden" name="ad_id" id="ad-id" value="">
                            <button type="submit" class="btn btn-info btn-change">Save</button>
                            <button type="button" class="btn btn-info btn-change close">Cancel</button>
                        </form>
                    </div><!--// end header got search area -->
                </div>
            </div>

        </div>
    </div><!-- Popup -->

    <!--==============
    Delete availablity popup
    ====================-->
    <div class="delete-popup-available">
        <div class="popup-base">
            <div class="search-popup">
                <i class="close fa fa-remove"></i>
                <div class="row">
                    <!-- header got seach area -->
                    <div class="popup-got-search popup-available-picker">
                        <form method="post" action="{{ url('delete-ad') }}">
                            <p>Do you really want to delete ?</p>
                            <input type="hidden" name="ad_id" id="ad-delete-id" value="">
                            <button type="submit" class="btn btn-info btn-change">Yes</button>
                            <button type="button" class="btn btn-info btn-change close">No</button>
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
                        <form method="post" action="{{ url('add-packages') }}">
                            <div class="form-group user-edit-group">
                                <label for="guidetitlee" class="text-uppercase">Title</label>
                                <input name="package_name" type="text" id="guide-title" class="form-control" required>
                            </div>
                            <div class="form-group user-edit-group">
                                <label for="guide-time-price" class="text-uppercase">Price</label>
                                <input name="package_price" type="text" id="guide-time-price" class="form-control" required>
                            </div>
                            <div class="form-group user-edit-group">
                                <label for="description-popup" class="text-uppercase">Description</label>
                                <textarea name="package_details" id="description-popup" class="form-control" cols="30" rows="5" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-info btn-change">Add</button>
                            <button type="button" class="btn btn-info btn-change close">Cancel</button>
                        </form>
                    </div><!--// end header got search area -->
                </div>
            </div>

        </div>
    </div><!-- Popup -->

    <!--
    edit package popup
    ======================-->
    <div class="edit-popup-package">
        <div class="popup-base">
            <div class="search-popup">
                <i class="close fa fa-remove"></i>
                <div class="row">
                    <!-- header got seach area -->
                    <div class="popup-got-search popup-available-picker">
                        <form method="post" action="{{ url('edit-packages') }}">
                            <div class="form-group user-edit-group">
                                <label for="guidetitlee" class="text-uppercase">Title</label>
                                <input name="package_name" type="text" id="edit-package-name" class="form-control" value="">
                            </div>
                            <div class="form-group user-edit-group">
                                <label for="guide-time-price" class="text-uppercase">Price</label>
                                <input name="package_price" type="text" id="edit-package-price" class="form-control" value="">
                            </div>
                            <div class="form-group user-edit-group">
                                <label for="description-popup" class="text-uppercase">Description</label>
                                <textarea name="package_details" id="edit-package-details" class="form-control" cols="30" rows="5"></textarea>
                            </div>
                            <input type="hidden" name="package_id" id="package-id" value="">
                            <button type="submit" class="btn btn-info btn-change">Save</button>
                            <button type="button" class="btn btn-info btn-change close">Cancel</button>
                        </form>
                    </div><!--// end header got search area -->
                </div>
            </div>

        </div>
    </div><!-- Popup -->

    <!--==============
    Delete package popup
    ====================-->
    <div class="delete-popup-package">
        <div class="popup-base">
            <div class="search-popup">
                <i class="close fa fa-remove"></i>
                <div class="row">
                    <!-- header got seach area -->
                    <div class="popup-got-search popup-available-picker">
                        <form method="post" action="{{ url('delete-packages') }}">
                            <p>Are you sure you want to delete this Package?</p>
                            <input type="hidden" name="package_id" id="package-delete-id" value="">
                            <button type="submit" class="btn btn-info btn-change">Yes</button>
                            <button type="button" class="btn btn-info btn-change close">No</button>
                        </form>
                    </div><!--// end header got search area -->
                </div>
            </div>

        </div>
    </div><!-- Popup -->
    
    <!-- 
        shoping cart popup
        ======================-->
        <div class="popup-shopping-card">
            <div class="popup-base">
                <div class="search-popup">
                    <i class="close fa fa-remove"></i>
                    <div class="row">
                        <!-- header got seach area -->
                        <div class="popup-got-search search-destination">
                            <h2 class="search-title">Subscription</h2>
                            <p>Congratulations, You are currently subscribed !</p>
                            <div class="ui-list-scroll">
                                <ul class="subcription-list">
                                <li>
                                    <div class="left-offer-item">
                                        <span class="offer-title">Offer</span>
                                        <span class="offer-list-item">Subscription A</span>
                                        <div class="price-item">Price: <span class="bold-text">USD 5.99</span> | Validity: <span class="bold-text">365 Days</span></div>
                                    </div>
                                    <div class="selection">
                                        <input type="radio" name="optradio">
                                    </div>
                                </li>
                                 <li>
                                    <div class="left-offer-item">
                                        <span class="offer-title">Offer</span>
                                        <span class="offer-list-item">Subscription B</span>
                                        <div class="price-item">Price:  <strike>USD 2.99</strike> <span class="bold-text"> USD 1.99</span> | Validity: <span class="bold-text">180 Days</span></div>
                                    </div>
                                    <div class="selection">
                                       <input type="radio" name="optradio">
                                    </div>
                                </li>
                                 <li>
                                    <div class="left-offer-item">
                                        <span class="offer-title">Offer</span>
                                        <span class="offer-list-item">Trial</span>
                                        <div class="price-item">Price: <span class="bold-text">USD 1.00</span> | Validity: <span class="bold-text">7 Days</span></div>
                                    </div>
                                    <div class="selection">
                                        <input type="radio" name="optradio">
                                    </div>
                                </li>
                            </ul>
                            </div>
                           <div class="pay-button clearfix">
                                <button class="btn btn-info btn-change">Pay</button>
                           </div>
                        </div><!--// end header got search area -->
                    </div>
                </div>

            </div>
        </div><!-- Popup -->

    @endsection
