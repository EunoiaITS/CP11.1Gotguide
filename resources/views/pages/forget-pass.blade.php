@extends('layouts.layout')
@section('content')

    <section class="signin padding-top-100 padding-bottom-250">
        <div class="container">
            <div class="row">
                <div class="col-sm-offset-1 col-sm-10 col-md-offset-1 col-md-10 col-lg-offset-1 col-lg-10 col-xs-12">
                    <div class="reset-password tab-content">
                        @if(session()->has('err-message'))
                            <div class="alert alert-danger">
                                {{ session()->get('err-message') }}
                            </div>
                        @endif
                        <form method="post" action="{{ url('forget-password') }}">
                            <p class="text-center p-text">Enter your e-mail address to get reset password link</p>
                            <div class="form-group">
                                <label for="guide-name">Email Address *</label>
                                <input name="email" type="email" class="form-control user-input" id="guide-name" required="true" placeholder="example@gmail.com">
                            </div>
                            <button type="submit" class="btn btn-info u_login">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @endsection