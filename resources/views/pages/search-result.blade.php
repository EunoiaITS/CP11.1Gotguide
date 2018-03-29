@extends('layouts.layout')
@section('content')
<!-- user profile edit details area -->
<div class="search-result-skill">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-8 col-sm-offset-2 col-md-offset-3 col-xs-10 col-xs-offset-1 padding-left-0 padding-right-0">
                <div class="search-result-query clearfix">
                    @foreach($result->users as $res)
                        <a href="{{ url('tour-guides/profile/'.$res->id) }}">
                            <div class="search-item search-item-3 clearfix">
                                <div class="search-overlay">
                                    <div class="col-sm-12">
                                        <div class="search-position">
                                            <div class="guide-thumb">
                                                <img src="{{ (@getimagesize(URL::asset('/uploads/'.$res->profile_img))) ? URL::asset('/uploads/'.$res->profile_img) : URL::asset('/images/random_pp/profile-icon.png') }}" alt="">
                                            </div>
                                            <div class="guide-search-details">
                                                <h3 class="guide-searh-title">{{ $res->name }}</h3>
                                                <h2 class="guide-searh-location">{{ $res->city.", ".$res->country }}</h2>
                                                <p class="guide-searh-language">{{ $res->language }}</p>
                                            </div>
                                            <div class="coments">
                                                <p><i class="fa fa-comments-o" aria-hidden="true"></i>{{ $res->total_comments }} Comments</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div></a>
                        @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

    @endsection
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
                            <button id="submit" type="submit" class="search-guide from-left">
                                <img src="{{ URL::asset('web/img/search.png') }}" alt="">
                            </button>
                        </div>
                    </form>
                </div><!--// end header got search area -->
            </div>
        </div>

    </div>
</div>
<script>
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