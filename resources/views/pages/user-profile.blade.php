@extends('layouts.layout')
@section('content')
<!-- user profile details area -->
<div class="user-details">
    <div class="container">
        <div class="row">
            <div class="user-main-details text-center">
                <h2 class="user-name">{{ $result->name }}</h2>
                <h3 class="user-place">@if($result->city != null){{ $result->city.', '}}@endif{{$result->country }}</h3>
                <p>{{ $result->informations }}</p>
                <button class="btn btn-info search-guide-s open-popup-rateme">Search Guide</button>
                <a href="{{ url('profile/edit/user/') }}" style="text-decoration: none;"><button type="button" class="btn btn-info log-out">Edit Profile</button></a>
                <form method="post" action="{{ url('/ulogout') }}">
                    <button type="submit" class="btn btn-btn-info log-out log-out-confermation">Log out</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="popup-rateme">
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
                    <form method="post" action="{{ url('/search-result') }}">
                        {{ csrf_field() }}
                        <div class="country from-left">
                            <select name="country" class="selectpicker user-country u-upparcase" id="country" data-live-search="true" title="Country">
                                @foreach($countries as $country)
                                    <option value="{{ $country->country_name }}" data-tokens="{{ $country->country_name }}">{{ $country->country_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="city from-left">
                            <select name="city" class="selectpicker user-country u-upparcase" id="city" data-live-search="true" title="City">
                                @foreach($cities as $ct)
                                    <option value="{{ $ct->city_name }}" data-tokens="{{ $ct->city_name }}">{{ $ct->city_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="language from-left">
                            <select name="language" class="selectpicker user-language u-upparcase" id="user-language" data-live-search="true" title="Language">
                                @foreach($languages as $lang)
                                    <option value="{{ $lang->lang_name }}" data-tokens="{{ $lang->lang_name }}">{{ $lang->lang_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="clearfix search-button-popup">
                            <button type="submit" class="search-guide from-left">
                                <img src="{{ URL::asset('web/img/search.png') }}" alt="">
                            </button>
                        </div>
                    </form>
                </div><!--// end header got search area -->
            </div>
        </div>

    </div>
</div>
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
    sortCountry();
</script>
<!--=============
    Search popuppage
    ==================-->
@include('includes.search-modal')
<!-- Popup -->
    @endsection
