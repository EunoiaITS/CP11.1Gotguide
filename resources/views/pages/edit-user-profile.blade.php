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
                <form method="post" action="{{ url('/profile/edit/user') }}" enctype="multipart/form-data">
                    <div class="col-sm-5  col-xs-12">
                        <!-- full name area -->

                        <div class="form-group user-edit-group">
                            <label for="full-name" class="text-uppercase">Full Name</label>
                            <input type="text" name="name" id="full-name" class="form-control" placeholder="Enter Your Name" value="{{ $result->name }}">
                        </div>
                        <!-- Date of bith area -->
                        <div class="form-group user-edit-group">
                            <label for="guide-date-of-birth" class="text-uppercase">Date of Birth</label>
                            <div class="clearfix user-birth-date">
                                <div class="year from-left">
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
                                <div class="date from-left">
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
                            <label for="user-country" class="text-uppercase">Country</label>
                            <div class="clearfix user-edit-select">
                                <select name="country" class="selectpicker user-country u-upparcase" id="country" data-live-search="true" title="{{$result->country}}">
                                    @foreach($result->countries as $country)
                                        <option value="{{ $country->country_name }}" data-tokens="{{ $country->country_name }}" @if($country->country_name == $result->country){{ 'selected' }}@endif>{{ $country->country_name }}</option>
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
                    </div>
                    <div class="col-sm-5 col-sm-offset-1 col-xs-12">
                        <!-- email area -->
                        <div class="form-group user-edit-group">
                            <label for="user-email" class="text-uppercase">Email</label>
                            <input type="text" name="email" id="user-email" class="form-control" placeholder="Enter Your Email" value="{{ $result->email }}" readonly>
                        </div>
                        <!-- contact area -->
                        <div class="form-group user-edit-group">
                            <label for="contact" class="text-uppercase">Contact</label>
                            <input type="text" name="contact" id="contact" class="form-control" placeholder="Enter Your Number" value="{{ $result->contact }}">
                        </div>
                        <!-- city area -->
                        <div class="form-group user-edit-group">
                            <label for="user-city" class="text-uppercase">City</label>
                            <div class="clearfix user-edit-select">
                                <select name="city" class="selectpicker user-country u-upparcase" id="city" data-live-search="true" title="{{$result->city}}">
                                    @foreach($result->cities as $ct)
                                        <option value="{{ $ct->city_name }}" data-tokens="{{ $ct->city_name }}" @if($ct->city_name == $result->city){{ 'selected' }}@endif>{{ $ct->city_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <input type="submit" name="userInfo" class="btn btn-info btn-change" value="Save Change">
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
    @endsection