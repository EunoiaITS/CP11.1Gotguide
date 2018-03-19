
@include('includes.head')
<?php
$id = request()->route('id');
$tpath = 'tour-guides/profile/'.$id;
$search_path = 'search-result';
?>

<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<div class="wrapper">
    <!--==
    header area
    =====================-->
    <header class="header" id="header">
        <div class="header-overlay">
		 @if(!Auth::user())
		     @if(request()->path() == $search_path)
                @include('includes.navbar-search')
             @elseif(request()->path() == $tpath)
                @include('includes.navbar-search')
             @else
                 @include('includes.navbar')
             @endif
         @else
            @if(Auth::check())
                    @if(Auth::user()->role =="traveller")
						@include('includes.navbar-user')
					@elseif(Auth::user()->role =="agent")
						@include('includes.navbar-guide')
					@else
						@include('includes.navbar')
					@endif
			@endif
		 @endif
            <!-- header landing area -->
            <div class="header-landing-area">
                <div class="container">
                    <div class="row">
                        <div class="header-landing-text text-center">
                            <h2>WELCOME TO GOT GUIDE</h2>
                            <!-- header got search area -->
                            <div class="header-got-search">
                                <form method="post" action="{{ url('/search-result') }}">
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
                                    <button type="submit" class="search-guide from-left">
                                        <img src="{{ URL::asset('web/img/search.png') }}" alt="">
                                    </button>
                                </form>
                            </div><!--// end header got search area -->
                        </div>
                    </div>
                </div>
            </div><!--// header landing area -->

            <!-- scroll down -->
            <a href="#about-us" id="slide-scroll">
                <div class="scroll-down">
                    <!-- Scroll Down -->
                    <div class="vline"><span></span></div>
                </div>
            </a><!-- end scroll down area -->
        </div>
    </header><!--// header area -->
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
@yield('content')
@include('includes.search-modal')
@include('includes.footer')
