<div class="popup-wrapper">
    <div class="popup-base">
        <div class="search-popup">
            <i class="close fa fa-remove"></i>
            <div class="row">
                <div class="search-destination">
                    <h2 class="search-title">Choose Destination</h2>
                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                    @foreach($errors->all() as $error)
                        <p class="alert-danger"><b>{{$error}}</b></p>
                    @endforeach
                </div>
                <!-- header got seach area -->
                <div class="popup-got-search">
                    <form method="post" action="{{ url('/search-result') }}">
                        {{ csrf_field() }}
                        <div class="country from-left">
                            <select id="s-country" class="selectpicker u-upparcase" data-live-search="true" title="Country" name="country">
                                @foreach($countries as $country)
                                    <option value="{{ $country->country_name }}" data-tokens="{{ $country->country_name }}">{{ $country->country_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="city from-left">
                            <select id="s-city" class="selectpicker u-upparcase"  data-live-search="true" title="City" name="city">
                                @foreach($cities as $ct)
                                    <option value="{{ $ct->city_name }}" data-tokens="{{ $ct->city_name }}">{{ $ct->city_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="language from-left">
                            <select id="s-language" class="selectpicker u-upparcase" data-live-search="true" title="Language" name="language">
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
        function sortSCity(){
            var sel = document.getElementById('s-city');
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
        function sortSLanguage(){
            var sel = document.getElementById('s-language');
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
        function sortSCountry(){
            var sel = document.getElementById('s-country');
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

        sortSCity();
        sortSLanguage();
        sortSCountry();
        </script>