@extends('layouts.layout')
@section('content')

<!-- user profile edit details area -->
<div class="user-details">
    <div class="container">
        <div class="row">
            <form action="#">
                <div class="col-sm-5  col-xs-12">
                    <!-- Description area -->
                    <div class="user-edit-group">
                        <span class="guide-title text-uppercase">Description</span>
                        <p class="guide-details">{{ $result->informations }}</p>
                    </div>
                    <!-- Date of bith area -->
                    <div class="user-edit-group">
                        <span class="guide-title text-uppercase">Date of Birth</span>
                        <p class="guide-date">{{ date('d,M,Y', strtotime($result->dob)) }}</p>
                    </div>
                    <!-- city area -->
                    <div class="user-edit-group">
                        <span class="guide-title text-uppercase">City</span>
                        <p class="guide-date">{{ $result->city.', '.$result->country }}</p>
                    </div>
                    <!-- Language area -->
                    <div class="user-edit-group">
                        <span class="guide-title text-uppercase">Language</span>
                        <p class="guide-date">{{ $result->language }}</p>
                    </div>
                </div>
                <div class="col-sm-5 col-sm-offset-1 col-xs-12">
                    <!-- email area -->
                    <div class="user-edit-group">
                        <span class="guide-title text-uppercase">Email</span>
                        <p class="guide-date">{{ $result->email }}</p>
                    </div>
                    <!-- contact area -->
                    <div class="form-group user-edit-group">
                        <span class="guide-title text-uppercase">Contact</span>
                        <p class="guide-date">{{ $result->contact }}</p>
                    </div>
                    <!-- availabitiy area -->
                    <div class="form-group user-edit-group">
                        <span class="guide-title text-uppercase">Availability</span>
                        <div class="clearfix guide-profile-select">
                            <select class="selectpicker user-city u-upparcase" data-live-search="false" title="Availability">
                                @if($result->availableDates != null)
                                    @foreach($result->availableDates as $dates)
                                        <option>{{ $dates->available_dates.' | '.$dates->available_time }}</option>
                                    @endforeach
                                @else
                                    <option>No available date!!</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <!-- Packages area -->
                    <div class="form-group user-edit-group">
                        <span class="guide-title text-uppercase">packages</span>
                        <div class="clearfix guide-profile-select">
                            <select class="selectpicker user-city u-upparcase" data-live-search="false" title="Packages">
                                @if($result->packages != null)
                                    @foreach($result->packages as $packs)
                                        <option>{{ $packs->package_name.' | '.$packs->package_price }}</option>
                                    @endforeach
                                @else
                                    <option>No available package!!</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <a href="{{ url('profile/guide/check-reviews') }}" style="text-decoration: none;"><button type="button" class="btn btn-info check-review">Check Reviews</button></a>
                </div>
            </form>
        </div>
    </div>
</div>
@include('includes.search-modal')
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

         <!--=======================
        log out confirmation
        ==========================-->
         <div class="log-out-confermation-popup">
            <div class="popup-base">
                <div class="popup-rateme-main">
                    <i class="close fa fa-remove"></i>
                    <div class="row">
                        <div class="rateme-destination">
                            <h2 class="search-title">Confirmation Logout</h2>
                        </div>
                        <!-- header got seach area -->
                        <div class="popup-got-search button-option-logout">
                            <form action="#">
                               <p class="text-center">Are you sure you want to logout ?</p>
                               <div class="new-button clearfix">
                                   <button class="btn btn-info btn-change">Ok</button>
                                   <button class="btn btn-info btn-change close">Cancel</button>
                               </div>
                            </form>
                        </div><!--// end header got search area -->
                    </div>
                </div>

            </div>
        </div><!-- Popup -->

<script type="text/javascript">
    function sortCity(){
        var sel = document.getElementById('city');
        var ary = (function(nl) {
            var a = [];
            for (var i = 0, len = nl.length; i < len; i++)
                a.push(nl.item(i));
            return a;
        })(sel.options);
        ary.sort(function(a,b){

            var aText = a.text.toLowerCase();
            var bText = b.text.toLowerCase();
            return aText < bText ? -1 : aText > bText ? 1 : 0;
        });
        for (var i = 0, len = ary.length; i < len; i++)
            sel.remove(ary[i].index);
        for (var i = 0, len = ary.length; i < len; i++)
            sel.add(ary[i], null);
    }
    function sortLanguage(){
        var sel = document.getElementById('language');
        var ary = (function(nl) {
            var a = [];
            for (var i = 0, len = nl.length; i < len; i++)
                a.push(nl.item(i));
            return a;
        })(sel.options);
        ary.sort(function(a,b){

            var aText = a.text.toLowerCase();
            var bText = b.text.toLowerCase();
            return aText < bText ? -1 : aText > bText ? 1 : 0;
        });
        for (var i = 0, len = ary.length; i < len; i++)
            sel.remove(ary[i].index);
        for (var i = 0, len = ary.length; i < len; i++)
            sel.add(ary[i], null);
    }
    function sortCountry(){
        var sel = document.getElementById('country');
        var ary = (function(nl) {
            var a = [];
            for (var i = 0, len = nl.length; i < len; i++)
                a.push(nl.item(i));
            return a;
        })(sel.options);
        ary.sort(function(a,b){

            var aText = a.text.toLowerCase();
            var bText = b.text.toLowerCase();
            return aText < bText ? -1 : aText > bText ? 1 : 0;
        });
        for (var i = 0, len = ary.length; i < len; i++)
            sel.remove(ary[i].index);
        for (var i = 0, len = ary.length; i < len; i++)
            sel.add(ary[i], null);
    }
    sortCity();
    sortLanguage();
    sortCountry()
</script>
    @endsection
