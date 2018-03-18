@extends('layouts.layout')
@section('content')

    <section class="signin padding-top-100 padding-bottom-250">
        <div class="container">
            <div class="row">
                <div class="col-sm-offset-1 col-sm-10 col-md-offset-1 col-md-10 col-lg-offset-1 col-lg-10 col-xs-12">
                    <div class="reset-password tab-content">
                        <div class="p-text-link">
                            <p class="text-center">@if(isset($result->message)){{ $result->message }}@endif</p>
                            <p class="text-center"><b>Don’t forget to check your spam folder.</b></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @endsection