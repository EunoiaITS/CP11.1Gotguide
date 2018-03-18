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
                                                    <option value="BENGALI" data-tokens="BENGALI">BENGALI</option>
                                                    <option value="ENGLISH" data-tokens="ENGLISH">ENGLISH</option>
                                                    <option value="ARABIC" data-tokens="ARABIC">ARABIC</option>
                                                    <option value="CHINESE" data-tokens="CHINESE">CHINESE</option>
                                                    <option value="MANDARIN" data-tokens="MANDARIN">MANDARIN</option>
                                                    <option value="SPANISH" data-tokens="SPANISH">SPANISH</option>
                                                    <option value="PORTUGUESE" data-tokens="PORTUGUESE">PORTUGUESE</option>
                                                    <option value="RUSSIAN" data-tokens="RUSSIAN">RUSSIAN</option>
                                                    <option value="JAPANESE" data-tokens="JAPANESE">JAPANESE</option>
                                                    <option value="KOREAN" data-tokens="KOREAN">KOREAN</option>
                                                    <option value="FRENCH" data-tokens="FRENCH">FRENCH</option>
                                                    <option value="WU JAVANESE" data-tokens="WU JAVANESE">WU JAVANESE</option>
                                                    <option value="STANDARD CHINESE" data-tokens="STANDARD CHINESE">STANDARD CHINESE</option>
                                                    <option value="VIETNAMESE" data-tokens="VIETNAMESE">VIETNAMESE</option>
                                                    <option value="TELUGU" data-tokens="TELUGU">TELUG</option>
                                                    <option value="CHINESE,YUE" data-tokens="CHINESE,YUE">CHINESE,YUE</option>
                                                    <option value="MARATHI" data-tokens="MARATHI">MARATHI</option>
                                                    <option value="TAMIL" data-tokens="TAMIL">TAMIL</option>
                                                    <option value="TURKISH" data-tokens="TURKISH">TURKISH</option>
                                                    <option value="URDU" data-tokens="URDU">URDU</option>
                                                    <option value="CHINESE, MIN NAN" data-tokens="CHINESE, MIN NAN">CHINESE, MIN NAN</option>
                                                    <option value="CHINESE, JINYU" data-tokens="CHINESE, JINYU">CHINESE, JINYU</option>
                                                    <option value="GUJARATI" data-tokens="GUJARATI">GUJARATI</option>
                                                    <option value="POLISH" data-tokens="POLISH">POLISH</option>
                                                    <option value="ARABIC, EGYPTIAN SPOKEN" data-tokens="ARABIC, EGYPTIAN SPOKEN">ARABIC, EGYPTIAN SPOKEN</option>
                                                    <option value="UKRAINIAN" data-tokens="UKRAINIAN">UKRAINIAN</option>
                                                    <option value="ITALIAN" data-tokens="ITALIAN">ITALIAN</option>
                                                    <option value="CHINESE, XIANG" data-tokens="CHINESE, XIANG">CHINESE, XIANG</option>
                                                    <option value="MALAYALAM" data-tokens="MALAYALAM">MALAYALAM</option>
                                                    <option value="CHINESE, HAKKA" data-tokens="CHINESE, HAKKA">CHINESE, HAKKA</option>
                                                    <option value="KANNADA" data-tokens="KANNADA">KANNADA</option>
                                                    <option value="ORIYA" data-tokens="ORIYA">ORIYA</option>
                                                    <option value="PANJABI, WESTERN" data-tokens="PANJABI, WESTERN">PANJABI, WESTERN</option>
                                                    <option value="SUNDA" data-tokens="SUNDA">SUNDA</option>
                                                    <option value="PANJABI, EASTERN" data-tokens="PANJABI, EASTERN">PANJABI, EASTERN</option>
                                                    <option value="ROMANIAN" data-tokens="ROMANIAN">ROMANIAN</option>
                                                    <option value="BHOJPURI" data-tokens="BHOJPURI">BHOJPURI</option>
                                                    <option value="AZERBAIJANI, SOUTH" data-tokens="AZERBAIJANI, SOUTH">AZERBAIJANI, SOUTH</option>
                                                    <option value="FARSI" data-tokens="FARSI">MANDARIN</option>
                                                    <option value="MAITHILI" data-tokens="MAITHILI">MAITHILI</option>
                                                    <option value="HAUSA" data-tokens="HAUSA">HAUSA</option>
                                                    <option value="ARABIC, ALGERIAN SPOKEN" data-tokens="ARABIC, ALGERIAN SPOKEN">ARABIC, ALGERIAN SPOKEN</option>
                                                    <option value="BURMESE" data-tokens="BURMESE">BURMESE</option>
                                                    <option value="SERBO-CROATIAN" data-tokens="SERBO-CROATIAN">SERBO-CROATIAN</option>
                                                    <option value="CHINESE, GAN" data-tokens="CHINESE, GAN">CHINESE, GAN</option>
                                                    <option value="AWADHI" data-tokens="AWADHI">AWADHI</option>
                                                    <option value="THAI" data-tokens="THAI">THAI</option>
                                                    <option value="DUTCH" data-tokens="DUTCH">DUTCH</option>
                                                    <option value="YORUBA" data-tokens="YORUBA">YORUBA</option>
                                                    <option value="SINDHI" data-tokens="SINDHI">SINDHI</option>
                                                    <option value="ARABIC, MOROCCAN SPOKEN" data-tokens="ARABIC, MOROCCAN SPOKEN">ARABIC, MOROCCAN SPOKEN</option>
                                                    <option value="ARABIC, SAIDI SPOKEN" data-tokens="ARABIC, SAIDI SPOKEN">ARABIC, SAIDI SPOKEN</option>
                                                    <option value="UZBEK, NORTHERN" data-tokens="UZBEK, NORTHERN">UZBEK, NORTHERN</option>
                                                    <option value="MALAY" data-tokens="MALAY">MALAY</option>
                                                    <option value="AMHARIC" data-tokens="AMHARIC">AMHARIC</option>
                                                    <option value="INDONESIAN" data-tokens="INDONESIAN">INDONESIAN</option>
                                                    <option value="IGBO" data-tokens="IGBO">IGBO</option>
                                                    <option value="TAGALOG" data-tokens="TAGALOG">TAGALOG</option>
                                                    <option value="NEPALI" data-tokens="NEPALI">NEPALI</option>
                                                    <option value="ARABIC, SUDANESE SPOKEN" data-tokens="ARABIC, SUDANESE SPOKEN">ARABIC, SUDANESE SPOKEN</option>
                                                    <option value="SARAIKI" data-tokens="SARAIKI">SARAIKI</option>
                                                    <option value="CEBUANO" data-tokens="CEBUANO">CEBUANO</option>
                                                    <option value="ARABIC, NORTH LEVANTINE SPOKEN" data-tokens="ARABIC, NORTH LEVANTINE SPOKEN">ARABIC, NORTH LEVANTINE SPOKEN</option>
                                                    <option value="THAI, NORTHEASTERN" data-tokens="THAI, NORTHEASTERN">THAI, NORTHEASTERN</option>
                                                    <option value="ASSAMESE" data-tokens="ASSAMESE">ASSAMESE</option>
                                                    <option value="HUNGARIAN" data-tokens="HUNGARIAN">HUNGARIAN</option>
                                                    <option value="CHITTAGONIAN" data-tokens="CHITTAGONIAN">CHITTAGONIAN</option>
                                                    <option value="ARABIC, MESOPOTAMIAN SPOKEN" data-tokens="ARABIC, MESOPOTAMIAN SPOKEN">ARABIC, MESOPOTAMIAN SPOKEN</option>
                                                    <option value="MADURA" data-tokens="MADURA">MADURA</option>
                                                    <option value="SINHALA" data-tokens="SINHALA">SINHALA</option>
                                                    <option value="HARYANVI" data-tokens="HARYANVI">HARYANVI</option>
                                                    <option value="MARWARI" data-tokens="MARWARI">MARWARI</option>
                                                    <option value="CZECH" data-tokens="CZECH">CZECH</option>
                                                    <option value="GREEK" data-tokens="GREEK">GREEK</option>
                                                    <option value="MAGAHI" data-tokens="MAGAHI">MAGAHI</option>
                                                    <option value="CHHATTISGARHI" data-tokens="CHHATTISGARHI">CHHATTISGARHI</option>
                                                    <option value="DECCAN" data-tokens="DECCAN">DECCAN</option>
                                                    <option value="CHINESE, MIN BEI" data-tokens="CHINESE, MIN BEI">CHINESE, MIN BEI</option>
                                                    <option value="BELARUSAN" data-tokens="BELARUSAN">BELARUSAN</option>
                                                    <option value="ZHUANG, NORTHERN" data-tokens="ZHUANG, NORTHERN">ZHUANG, NORTHERN</option>
                                                    <option value="ARABIC, NAJDI SPOKEN" data-tokens="ARABIC, NAJDI SPOKEN">ARABIC, NAJDI SPOKEN</option>
                                                    <option value="PASHTO, NORTHERN" data-tokens="PASHTO, NORTHERN">PASHTO, NORTHERN</option>
                                                    <option value="SOMALI" data-tokens="SOMALI">SOMALI</option>
                                                    <option value="MALAGASY" data-tokens="MALAGASY">MALAGASY</option>
                                                    <option value="ARABIC, TUNISIAN SPOKEN" data-tokens="ARABIC, TUNISIAN SPOKEN">ARABIC, TUNISIAN SPOKEN</option>
                                                    <option value="RWANDA" data-tokens="RWANDA">RWANDA</option>
                                                    <option value="ZULU" data-tokens="ZULU">ZULU</option>
                                                    <option value="BULGARIAN" data-tokens="BULGARIAN">BULGARIAN</option>
                                                    <option value="SWEDISH" data-tokens="SWEDISH">SWEDISH</option>
                                                    <option value="LOMBARD" data-tokens="LOMBARD">LOMBARD</option>
                                                    <option value="OROMO, WEST-CENTRAL" data-tokens="OROMO, WEST-CENTRAL">OROMO, WEST-CENTRAL</option>
                                                    <option value="PASHTO, SOUTHERN" data-tokens="PASHTO, SOUTHERN">PASHTO, SOUTHERN</option>
                                                    <option value="KAZAKH" data-tokens="KAZAKH">KAZAKH</option>
                                                    <option value="ILOCANO" data-tokens="ILOCANO">ILOCANO</option>
                                                    <option value="TATAR" data-tokens="TATAR">TATAR</option>
                                                    <option value="FULFULDE, NIGERIAN" data-tokens="FULFULDE, NIGERIAN">FULFULDE, NIGERIAN</option>
                                                    <option value="ARABIC, SANAANI SPOKEN" data-tokens="ARABIC, SANAANI SPOKEN">ARABIC, SANAANI SPOKEN</option>
                                                    <option value="UYGHUR" data-tokens="UYGHUR">UYGHUR</option>
                                                    <option value="HAITIAN CREOLE FRENCH" data-tokens="HAITIAN CREOLE FRENCH">HAITIAN CREOLE FRENCH</option>
                                                    <option value="AZERBAIJANI, NORTH" data-tokens="AZERBAIJANI, NORTH">AZERBAIJANI, NORTH</option>
                                                    <option value="NAPOLETANO-CALABRESE" data-tokens="NAPOLETANO-CALABRESE">NAPOLETANO-CALABRESE</option>
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