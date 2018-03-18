<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Got Guide HTML template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->
    <!--==
    Css stylesheet
    =============-->
    <!--bootstrap css -->
    <link rel="stylesheet" href="{{ URL::asset('web/css/bootstrap.min.css') }}">
    <!--bootstrap-select css -->
    <link rel="stylesheet" href="{{ URL::asset('web/css/bootstrap-select.min.css') }}">
    <!-- font-awsome css-->
    <link rel="stylesheet" href="{{ URL::asset('web/css/font-awesome.min.css') }}">
    <!-- custom css -->
    <link rel="stylesheet" href="{{ URL::asset('web/css/normalize.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('web/css/style.css') }}">
    <!-- mordernizer js -->
    <script src="{{ URL::asset('web/js/vendor/modernizr-2.8.3.min.js') }}"></script>
</head>
<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<div class="wrapper signin">
    <section class="reset-email-new">
        <div class="container">
            <div class="row">
                <div class="col-sm-offset-1 col-sm-10 col-md-offset-1 col-md-10 col-lg-offset-1 col-lg-10 col-xs-12">
                    <div class="reset-password-border">
                        <h2 class="text-center">Reset Password</h2>
                        @if(session()->has('err-message'))
                            <div class="alert alert-danger">
                                {{ session()->get('err-message') }}
                            </div>
                        @endif
                        <form method="post" action="{{ url('api/v1/forgot-password/'.$link) }}">
                            <div class="form-group">
                                <label for="guide-name">New Password</label>
                                <input name="password" type="password" class="form-control user-input" id="guide-name" required="true">
                            </div>
                            <div class="form-group">
                                <label for="guide-name">Re-type New Password</label>
                                <input name="repass" type="password" class="form-control user-input" id="guide-name" required="true">
                            </div>
                            <input type="text" name="email" value="{{ $email }}" hidden>
                            <button type="submit" class="btn btn-info u_login popup-reset-password">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



<!--==
Js script
================-->
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script>window.jQuery || document.write('<script src="{{ URL::asset('web/js/vendor/jquery-1.12.0.min.js') }}"><\/script>')</script>
<!-- bootstrap js -->
<script src="{{ URL::asset('web/js/bootstrap.min.js') }}"></script>
<!-- bootstrap-select js -->
<script src="{{ URL::asset('web/js/bootstrap-select.min.js') }}"></script>
<!-- bootstrap-select js -->
<script src="{{ URL::asset('web/js/jquery.malihu.PageScroll2id.js') }}"></script>
<!-- custom js -->
<script src="{{ URL::asset('web/js/plugins.js') }}"></script>
<script src="{{ URL::asset('web/js/custom.js') }}"></script>

<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
    (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
        e=o.createElement(i);r=o.getElementsByTagName(i)[0];
        e.src='https://www.google-analytics.com/analytics.js';
        r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
    ga('create','UA-XXXXX-X','auto');ga('send','pageview');
</script>
</body>
</html>