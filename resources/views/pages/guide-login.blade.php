@extends('layouts.layout')
@section('content')
    <!--==
            Signin and signup area
            =============================-->
    <section class="signin padding-top-100 padding-bottom-250">
        <div class="container">
            <div class="row">
                <div class="col-sm-offset-1 col-sm-10 col-md-offset-1 col-md-10 col-lg-offset-1 col-lg-10 col-xs-12">
                    <div class="user-singin">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#g_signin">Sign in</a></li>
                            <li><a data-toggle="tab" href="#gsignup">Sign up</a></li>
                        </ul>

                        <!-- guide signin area -->
                        <div class="tab-content">
                            <div id="g_signin" class="tab-pane fade in active">
                                @if(session()->has('message'))
                                    <div class="alert alert-danger">
                                        {{ session()->get('message') }}
                                    </div>
                                @endif
                                    @if(session()->has('suc-message'))
                                        <div class="alert alert-success">
                                            {{ session()->get('suc-message') }}
                                        </div>
                                    @endif
                                <form method="post" action="{{ url('sign-in/guide') }}">
                                    <div class="form-group">
                                        <label for="guide-name">User name or email Address *</label>
                                        <input name="email" type="text" class="form-control user-input" id="guide-name" required="true">
                                    </div>
                                    <div class="form-group">
                                        <label for="g_password">Password *</label>
                                        <input name="password" type="password" id="g_password" class="form-control user-input" required="true">
                                    </div>
                                    <p class="lost-text"><a href="{{ url('forget-password') }}">Lost your password ?</a></p>
                                    <button type="submit" class="btn btn-info u_login">Login</button>
                                </form>
                            </div><!--/ user signin area -->


                            <!-- guide signup area -->
                            <div id="gsignup" class="tab-pane fade">
                                @if(session()->has('gs-message'))
                                    <div class="alert alert-danger">
                                        <p>{{ session()->get('gs-message') }}</p>
                                    </div>
                                @endif
                                <form method="post" action="{{ url('register/guide') }}">
                                    <!-- guide name area -->
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="g_frist_name">First Name *</label>
                                                <input name="fname" type="text" placeholder="Your First Name" id="g_frist_name" class="form-control user-signup-input" required="true">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="g_last_name">Last Name *</label>
                                                <input name="lname" type="text" placeholder="Your Last Name" id="g_last_name" class="form-control user-signup-input" required="true">
                                            </div>
                                        </div>
                                    </div><!-- /. guide name area -->
                                    <!--guide email area -->
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="g_email">Email *</label>
                                                <input name="email" type="email" placeholder="Enter Your Email" id="g_email" class="form-control user-signup-input" required="true">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="g_re_email" class="u-label-not"></label>
                                                <input name="remail" type="email" placeholder="re-enter Your Email" id="g_re_email" class="form-control user-signup-input" required="true">
                                            </div>
                                        </div>
                                    </div><!-- /. guide email area -->
                                    <!--guide passeord area -->
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="g_password_signup">Password *</label>
                                                <input name="password" type="password" placeholder="Enter Your Password" id="g_password_signup" class="form-control user-signup-input" required="true">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="g_re_password" class="u-label-not"></label>
                                                <input name="repass" type="password" placeholder="re-enter Your Password" id="g_re_password" class="form-control user-signup-input" required="true">
                                            </div>
                                        </div>
                                    </div><!--/. guide password area -->

                                    <!--guide country and city area -->
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="g_country">Country *</label>
                                                <div class="g-country clearfix">
                                                    <select name="country" class="selectpicker user-country u-upparcase" id="country" data-live-search="true" title="Country">
                                                        @foreach($countries as $country)
                                                            <option value="{{ $country->country_name }}" data-tokens="{{ $country->country_name }}">{{ $country->country_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="g_city" class="u-label-not">City *</label>
                                                <div class="g-city-info clearfix">
                                                    <select name="city" class="selectpicker user-country u-upparcase" id="city" data-live-search="true" title="City">
                                                        @foreach($cities as $ct)
                                                            <option value="{{ $ct->city_name }}" data-tokens="{{ $ct->city_name }}">{{ $ct->city_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!--/. guide password area -->

                                    <!-- Guide Date of birth area -->
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="g_day_of_birth">Date Of Birth *</label>
                                                <div class="birth-date-info clearfix">
                                                    <select name="day" class="selectpicker u-cap" id="g_day_of_birth" title="Date" data-width="29.5%" required="true">
                                                        @for($i = 1; $i <= 31; $i++)
                                                            <option value="{{ $i }}">{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                    <select name="month" class="selectpicker u-cap" id="g_month_of_birth" title="Month" data-width="30%" required="true" >
                                                        @for($i = 1; $i <= 12; $i++)
                                                            <option value="{{ $i }}">{{ $i }}</option>
                                                            @endfor
                                                    </select>
                                                    <select name="year" class="selectpicker u-cap" id="g_year_of_birth" title="Year" data-width="30%" required="true">
                                                        @for($i = 1917; $i <= date('Y'); $i++)
                                                            <option value="{{ $i }}">{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="g_language">Language *</label>
                                                <div class="u-language-info clearfix">
                                                    <select id="language" class="selectpicker u-upparcase" data-live-search="true" title="Language" name="language">
                                                        @foreach($languages as $lang)
                                                            <option value="{{ $lang->lang_name }}" data-tokens="{{ $lang->lang_name }}">{{ $lang->lang_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!--/. Date of birth area -->
                                    <div class="radio agre-condition">
                                        <input type="radio" id="f-option" name="selector" value="agreed" required><label for="f-option">I agree to the <a href="#">Privacy Agreement</a> & <a href="#">Terms and Conditions</a></label>
                                    </div>
                                    <button type="submit" class="btn btn-info u_login">Sign up</button>

                                </form>
                            </div><!--/. guide signup area -->
                        </div>
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
    </section>
    @include('includes.search-modal')

    @endsection
