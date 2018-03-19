
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
                                    <div class="city from-left">
                                        <select name="city" class="selectpicker user-country u-upparcase" id="city" data-live-search="true" title="">
                                            @foreach($cities as $ct)
                                                <option value="{{ $ct->city_name }}" data-tokens="{{ $ct->city_name }}">{{ $ct->city_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="country from-left">
                                        <select id="country" class="selectpicker u-upparcase" data-live-search="true" title="Country" name="country">
                                            <option value="Afghanistan" data-tokens="Afghanistan">Afghanistan</option>
                                            <option value="Albania" data-tokens="Albania">Albania</option>
                                            <option value="Algeria" data-tokens="Algeria">Algeria</option>
                                            <option value="Andorra" data-tokens="Andorra">Andorra</option>
                                            <option value="Angola" data-tokens="Angola">Angola</option>
                                            <option value="Antigua and Barbuda" data-tokens="Antigua and Barbuda">Antigua and Barbuda</option>
                                            <option value="Argentina" data-tokens="Argentina">Argentina</option>
                                            <option value="Armenia" data-tokens="Armenia">Armenia</option>
                                            <option value="Australia" data-tokens="Australia">Australia</option>
                                            <option value="Austria" data-tokens="Austria">Austria</option>
                                            <option value="Azerbaijan" data-tokens="Azerbaijan">Azerbaijan</option>
                                            <option value="Bahamas" data-tokens="Bahamas">Bahamas</option>
                                            <option value="Bahrain" data-tokens="Bahrain">Bahrain</option>
                                            <option value="Bangladesh" data-tokens="Bangladesh">Bangladesh</option>
                                            <option value="Barbados" data-tokens="Barbados">Barbados</option>
                                            <option value="Belarus" data-tokens="Belarus">Belarus</option>
                                            <option value="Belgium" data-tokens="Belgium">Belgium</option>
                                            <option value="Belize" data-tokens="Belize">Belize</option>
                                            <option value="Benin" data-tokens="Benin">Benin</option>
                                            <option value="Bhutan" data-tokens="Bhutan">Bhutan</option>
                                            <option value="Bosnia and Herzegovina" data-tokens="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                            <option value="Botswana" data-tokens="Botswana">Botswana</option>
                                            <option value="Brazil" data-tokens="Brazil">Brazil</option>
                                            <option value="Brunei" data-tokens="Brunei">Brunei</option>
                                            <option value="Bulgaria" data-tokens="Bulgaria">Bulgaria</option>
                                            <option value="Burkina Faso" data-tokens="Burkina Faso">Burkina Faso</option>
                                            <option value="Burundi" data-tokens="Burundi">Burundi</option>
                                            <option value="Cabo Verde" data-tokens="Cabo Verde">Cabo Verde</option>
                                            <option value="Cambodia" data-tokens="Cambodia">Cambodia</option>
                                            <option value="Cameroon" data-tokens="Cameroon">Cameroon</option>
                                            <option value="Canada" data-tokens="Canada">Canada</option>
                                            <option value="Central African Republic" data-tokens="Central African Republic">Central African Republic</option>
                                            <option value="Chad" data-tokens="Chad">Chad</option>
                                            <option value="Chile"data-tokens="Chile">Chile</option>
                                            <option value="China"data-tokens="China">China</option>
                                            <option value="Colombia"data-tokens="Colombia">Colombia</option>
                                            <option value="Comoros"data-tokens="Comoros">Comoros</option>
                                            <option value="Democratic Republic of the Congo"data-tokens="Democratic Republic of the Congo">Democratic Republic of the Congo</option>
                                            <option value="Republic of the Congo"data-tokens="Republic of the Congo">Republic of the Congo</option>
                                            <option value="Costa Rica" data-tokens="Costa Rica">Costa Rica</option>
                                            <option value="Croatia"data-tokens="Croatia">Croatia</option>
                                            <option value="Cuba"data-tokens="Cuba">Cuba</option>
                                            <option value="Cyprus"data-tokens="Cyprus">Cyprus</option>
                                            <option value="Czech Republic"data-tokens="Czech Republic">Czech Republic</option>
                                            <option value="Denmark"data-tokens="Denmark">Denmark</option>
                                            <option value="Djibouti"data-tokens="Djibouti">Djibouti</option>
                                            <option value="Dominica"data-tokens="Dominica">Dominica</option>
                                            <option value="Dominican Republic" data-tokens="Dominican Republic">Dominican Republic</option>
                                            <option value="Ecuador"data-tokens="Ecuador">Ecuador</option>
                                            <option value="Egypt"data-tokens="Egypt">Egypt</option>
                                            <option value="El Salvador"data-tokens="El Salvador">El Salvador</option>
                                            <option value="Equatorial Guinea"data-tokens="Equatorial Guinea">Equatorial Guinea</option>
                                            <option value="Eritrea"data-tokens="Eritrea">Eritrea</option>
                                            <option value="Estonia"data-tokens="Estonia">Estonia</option>
                                            <option value="Ethiopia" data-tokens="Ethiopia">Ethiopia</option>
                                            <option value="Fiji" data-tokens="Fiji">Fiji</option>
                                            <option value="Finland" data-tokens="Finland">Finland</option>
                                            <option value="France" data-tokens="France">France</option>
                                            <option value="Gabon" data-tokens="Gabon">Gabon</option>
                                            <option value="Gambia" data-tokens="Gambia">Gambia</option>
                                            <option value="Georgia" data-tokens="Georgia">Georgia</option>
                                            <option value="Germany" data-tokens="Germany">Germany</option>
                                            <option value="Ghana" data-tokens="Ghana">Ghana</option>
                                            <option value="Greece" data-tokens="Greece">Greece</option>
                                            <option value="Grenada" data-tokens="Grenada">Grenada</option>
                                            <option value="Guatemala" data-tokens="Guatemala">Guatemala</option>
                                            <option value="Guinea" data-tokens="Guinea">Guinea</option>
                                            <option value="Guinea-Bissau" data-tokens="Guinea-Bissau">Guinea-Bissau</option>
                                            <option value="Guyana" data-tokens="Guyana">Guyana</option>
                                            <option value="Haiti" data-tokens="Haiti">Haiti</option>
                                            <option value="Honduras" data-tokens="Honduras">Honduras</option>
                                            <option value="Hungary" data-tokens="Hungary">Hungary</option>
                                            <option value="Iceland" data-tokens="Iceland">Iceland</option>
                                            <option value="India" data-tokens="India">India</option>
                                            <option value="Indonesia" data-tokens="Indonesia">Indonesia</option>
                                            <option value="Iran" data-tokens="Iran">Iran</option>
                                            <option value="Iraq" data-tokens="Iraq">Iraq</option>
                                            <option value="Ireland" data-tokens="Ireland">Ireland</option>
                                            <option value="Israel" data-tokens="Israel">Israel</option>
                                            <option value="Italy" data-tokens="Italy">Italy</option>
                                            <option value="Ivory Coast(Cote d'Ivoire)" data-tokens="Ivory Coast(Cote d'Ivoire)">Ivory Coast(Cote d'Ivoire)</option>
                                            <option value="Jamaica" data-tokens="Jamaica">Jamaica</option>
                                            <option value="Japan" data-tokens="Japan">Japan</option>
                                            <option value="Jordan" data-tokens="Jordan">Jordan</option>
                                            <option value="Kazakhstan" data-tokens="Kazakhstan">Kazakhstan</option>
                                            <option value="Kenya" data-tokens="Kenya">Kenya</option>
                                            <option value="Kiribati" data-tokens="Kiribati">Kiribati</option>
                                            <option value="Kosovo" data-tokens="Kosovo">Kosovo</option>
                                            <option value="Kuwait" data-tokens="Kuwait">Kuwait</option>
                                            <option value="Kyrgyzstan" data-tokens="Kyrgyzstan">Kyrgyzstan</option>
                                            <option value="Laos" data-tokens="Laos">Laos</option>
                                            <option value="Latvia" data-tokens="Latvia">Latvia</option>
                                            <option value="Lebanon" data-tokens="Lebanon">Lebanon</option>
                                            <option value="Liechtenstein" data-tokens="Liechtenstein">Liechtenstein</option>
                                            <option value="Lesotho" data-tokens="Lesotho">Lesoth</option>
                                            <option value="Liberia" data-tokens="Liberia">Liberia</option>
                                            <option value="Libya" data-tokens="Libya">Libya</option>
                                            <option value="Lithuania" data-tokens="Lithuania">Lithuania</option>
                                            <option value="Luxembourg" data-tokens="Luxembourg">Luxembourg</option>
                                            <option value="Macedonia" data-tokens="Macedonia">Macedonia</option>
                                            <option value="Madagascar" data-tokens="Madagascar">Madagascar</option>
                                            <option value="Malawi" data-tokens="Malawi">Malawi</option>
                                            <option value="Malaysia" data-tokens="Malaysia">Malaysia</option>
                                            <option value="Maldives" data-tokens="Maldives">Maldives</option>
                                            <option value="Mali" data-tokens="Mali">Mali</option>
                                            <option value="Malta" data-tokens="Malta">Malta</option>
                                            <option value="Marshall Islands" data-tokens="Marshall Islands">Marshall Islands</option>
                                            <option value="Mauritania" data-tokens="Mauritania">Mauritania</option>
                                            <option value="Mauritius" data-tokens="Mauritius">Mauritius</option>
                                            <option value="Mexico" data-tokens="Mexico">Mexico</option>
                                            <option value="Micronesia" data-tokens="Micronesia">Micronesia</option>
                                            <option value="Moldova" data-tokens="Moldova">Moldova</option>
                                            <option value="Monaco" data-tokens="Monaco">Monaco</option>
                                            <option value="Mongolia" data-tokens="Mongolia">Mongolia</option>
                                            <option value="Montenegro" data-tokens="Montenegro">Montenegro</option>
                                            <option value="Morocco" data-tokens="Morocco">Morocco</option>
                                            <option value="Mozambique" data-tokens="Mozambique">Mozambique</option>
                                            <option value="Myanmar (Burma)" data-tokens="Myanmar (Burma)">Myanmar (Burma)</option>
                                            <option value="Namibia" data-tokens="Namibia">Namibia</option>
                                            <option value="Nauru" data-tokens="Nauru">Nauru</option>
                                            <option value="Nepal" data-tokens="Nepal">Nepal</option>
                                            <option value="Netherlands" data-tokens="Netherlands">Netherlands</option>
                                            <option value="New Zealand" data-tokens="New Zealand">New Zealand</option>
                                            <option value="Niger" data-tokens="Niger">Niger</option>
                                            <option value="Nigeria" data-tokens="Nigeria">Nigeria</option>
                                            <option value="North Korea" data-tokens="North Korea">North Korea</option>
                                            <option value="Norway" data-tokens="Norway">Norway</option>
                                            <option value="Oman" data-tokens="Oman">Oman</option>
                                            <option value="Pakistan" data-tokens="Pakistan">Pakistan</option>
                                            <option value="Palau" data-tokens="Palau">Palau</option>
                                            <option value="Palestine" data-tokens="Palestine">Palestine</option>
                                            <option value="Panama" data-tokens="Panama">Panama</option>
                                            <option value="Papua New Guinea" data-tokens="Papua New Guinea">Papua New Guinea</option>
                                            <option value="Paraguay" data-tokens="Paraguay">Paraguay</option>
                                            <option value="Peru" data-tokens="Peru">Peru</option>
                                            <option value="Philippines" data-tokens="Philippines">Philippines</option>
                                            <option value="Poland" data-tokens="Poland">Poland</option>
                                            <option value="Portugal" data-tokens="Portugal">Portugal</option>
                                            <option value="Qatar" data-tokens="Qatar">Qatar</option>
                                            <option value="Romania" data-tokens="Romania">Romania</option>
                                            <option value="Russia" data-tokens="Russia">Russia</option>
                                            <option value="Rwanda" data-tokens="Rwanda">Rwanda</option>
                                            <option value="Saint Kitts and Nevis" data-tokens="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                            <option value="Saint Lucia" data-tokens="Saint Lucia">Saint Lucia</option>
                                            <option value="Saint Vincent and the Grenadines" data-tokens="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                            <option value="Samoa" data-tokens="Samoa">Samoa</option>
                                            <option value="San Marino" data-tokens="San Marino">San Marino</option>
                                            <option value="Sao Tome and Principe" data-tokens="Sao Tome and Principe">Sao Tome and Principe</option>
                                            <option value="Saudi Arabia" data-tokens="Saudi Arabia">Saudi Arabia</option>
                                            <option value="Senegal" data-tokens="Senegal">Senegal</option>
                                            <option value="Serbia" data-tokens="Serbia">Serbia</option>
                                            <option value="Seychelles" data-tokens="Seychelles">Seychelles</option>
                                            <option value="Sierra Leone" data-tokens="Sierra Leone">Sierra Leone</option>
                                            <option value="Singapore" data-tokens="Singapore">Singapore</option>
                                            <option value="Slovakia" data-tokens="Slovakia">Slovakia</option>
                                            <option value="Slovenia" data-tokens="Slovenia">Slovenia</option>
                                            <option value="Solomon Islands" data-tokens="Solomon Islands">Solomon Islands</option>
                                            <option value="Somalia" data-tokens="Somalia">Somalia</option>
                                            <option value="South Africa" data-tokens="South Africa">South Africa</option>
                                            <option value="South Korea" data-tokens="South Korea">South Korea</option>
                                            <option value="South Sudan" data-tokens="South Sudan">South Sudan</option>
                                            <option value="Spain" data-tokens="Spain">Spain</option>
                                            <option value="Sri Lanka" data-tokens="Sri Lanka">Sri Lanka</option>
                                            <option value="Sudan" data-tokens="Sudan">Sudan</option>
                                            <option value="Suriname" data-tokens="Suriname">Suriname</option>
                                            <option value="Swaziland" data-tokens="Swaziland">Swaziland</option>
                                            <option value="Sweden" data-tokens="Sweden">Sweden</option>
                                            <option value="Switzerland" data-tokens="Switzerland">Switzerland</option>
                                            <option value="Syria" data-tokens="Syria">Syria</option>
                                            <option value="Taiwan" data-tokens="Taiwan">Taiwan</option>
                                            <option value="Tajikistan" data-tokens="Tajikistan">Tajikistan</option>
                                            <option value="Tanzania" data-tokens="Tanzania">Tanzania</option>
                                            <option value="Thailand" data-tokens="Thailand">Thailand</option>
                                            <option value="Timor-Leste" data-tokens="Timor-Leste">Timor-Leste</option>
                                            <option value="Togo" data-tokens="Togo">Togo</option>
                                            <option value="Tonga" data-tokens="Tonga">Tonga</option>
                                            <option value="Trinidad and Tobago" data-tokens="Trinidad and Tobago">Trinidad and Tobago</option>
                                            <option value="Tunisia" data-tokens="Tunisia">Tunisia</option>
                                            <option value="Turkey" data-tokens="Turkey">Turkey</option>
                                            <option value="Turkmenistan" data-tokens="Turkmenistan">Turkmenistan</option>
                                            <option value="Tuvalu" data-tokens="Tuvalu">Tuvalu</option>
                                            <option value="Uganda" data-tokens="Uganda">Uganda</option>
                                            <option value="Ukraine" data-tokens="Ukraine">Ukraine</option>
                                            <option value="United Arab Emirates" data-tokens="United Arab Emirates">United Arab Emirates</option>
                                            <option value="United Kingdom" data-tokens="United Kingdom">United Kingdom</option>
                                            <option value="United States of America" data-tokens="United States of America">United States of America</option>
                                            <option value="Uruguay" data-tokens="Uruguay">Uruguay</option>
                                            <option value="Uzbekistan" data-tokens="Uzbekistan">Uzbekistan</option>
                                            <option value="Vanuatu" data-tokens="Vanuatu">Vanuatu</option>
                                            <option value="Vatican City (Holy See)" data-tokens="Vatican City (Holy See)">Vatican City (Holy See)</option>
                                            <option value="Venezuela" data-tokens="Venezuela">Venezuela</option>
                                            <option value="Vietnam" data-tokens="Vietnam">Vietnam</option>
                                            <option value="Yemen" data-tokens="Yemen">Yemen</option>
                                            <option value="Zambia" data-tokens="Zambia">Zambia</option>
                                            <option value="Zimbabwe" data-tokens="Zimbabwe">Zimbabwe</option>
                                        </select>
                                    </div>
                                    <div class="language from-left">
                                        <select id="language" class="selectpicker u-upparcase" data-live-search="true" title="Language" name="language" required>
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
