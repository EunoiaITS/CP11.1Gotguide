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
                        <li class="active"><a data-toggle="tab" href="#signin">Sign in</a></li>
                        <li><a data-toggle="tab" href="#signup">Sign up</a></li>
                    </ul>

                    <!-- user signin area -->
                    <div class="tab-content">
                        <div id="signin" class="tab-pane fade in active">
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
                            <form method="post" action="{{ url('sign-in/user') }}">
                                <div class="form-group">
                                    <label for="user-name">User name or email Address *</label>
                                    <input type="text" name="email" class="form-control user-input" id="user-name" required="true">
                                </div>
                                <div class="form-group">
                                    <label for="u_password">Password *</label>
                                    <input type="password" name="password" id="u_password" class="form-control user-input" required="true">
                                </div>
                                <p class="lost-text"><a href="{{ url('forget-password') }}">Lost your password ?</a></p>
                                <button type="submit" class="btn btn-info u_login">Login</button>
                            </form>
                        </div><!--/ user signin area -->
                        <!-- user signup area -->
                        <div id="signup" class="tab-pane fade">
                            @if(session()->has('gs-message'))
                                <div class="alert alert-danger">
                                    {{ session()->get('gs-message') }}
                                </div>
                            @endif
                            <form method="post" action="{{ url('register/user') }}">
                                <!-- name area -->
                                <div class="row">
                                    <div class="col-sm-6 col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="u_frist_name">First Name *</label>
                                            <input name="fname" type="text" placeholder="Your First Name" id="u_frist_name" class="form-control user-signup-input" required="true">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="u_last_name">Last Name *</label>
                                            <input name="lname" type="text" placeholder="Your Last Name" id="u_last_name" class="form-control user-signup-input" required="true">
                                        </div>
                                    </div>
                                </div><!-- /. name area -->
                                <!-- email area -->
                                <div class="row">
                                    <div class="col-sm-6 col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="u_email">Email *</label>
                                            <input name="email" type="email" placeholder="Enter Your Email" id="u_email" class="form-control user-signup-input" required="true">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="u_re_email" class="u-label-not"></label>
                                            <input name="remail" type="email" placeholder="re-enter Your Email" id="u_re_email" class="form-control user-signup-input" required="true">
                                        </div>
                                    </div>
                                </div><!-- /. email area -->
                                <!-- passeord area -->
                                <div class="row">
                                    <div class="col-sm-6 col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="u_password_signup">Password *</label>
                                            <input name="password" type="password" placeholder="Enter Your Password" id="u_password_signup" class="form-control user-signup-input" required="true">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="u_re_password" class="u-label-not"></label>
                                            <input name="repass" type="password" placeholder="re-enter Your Password" id="u_re_password" class="form-control user-signup-input" required="true">
                                        </div>
                                    </div>
                                </div><!--/. password area -->
                                <!-- Date of birth area -->
                                <div class="row">
                                    <div class="col-sm-6 col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="date_of_birth">Date Of Birth *</label>
                                            <div class="birth-date-info clearfix">
                                                <select name="day" class="selectpicker u-cap" id="date_of_birth" title="Date" data-width="29.5%" required="true">
                                                    @for($i = 1; $i <= 31; $i++)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                                <select name="month" class="selectpicker u-cap" id="date_of_birth" title="Month" data-width="30%" required="true">
                                                    @for($i = 1; $i <= 12; $i++)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                        @endfor
                                                </select>
                                                <select name="year" class="selectpicker u-cap" id="date_of_birth" title="Year" data-width="30%" required="true">
                                                    @for($i = 1917; $i <= date('Y'); $i++)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="u_language">Language *</label>
                                            <div class="u-language-info clearfix">
                                                <select id="language" name="language" class="selectpicker u-cap" id="u_language" data-live-search="true" title="Language" data-width="100%" required="true">
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
                        </div><!--/. user signup area -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
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
        sortLanguage();
    </script>
</section>
@include('includes.search-modal')
    @endsection