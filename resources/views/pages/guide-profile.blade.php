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


    @endsection
