<!-- header-menu area -->
<navbar class="navbar navbar-default navbar-home navbar-fixed-top">
    <!-- header-top -->
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-sm-offset-8 col-md-offset-8 col-lg-offset-8 col-sm-4 col-md-4 col-lg-4 col-xs-12 padding-right-0">
                    <div class="social-media">
                        <ul>
                            <li><a href="https://www.facebook.com/gotguidetrave"><i class="fa fa-facebook"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--// header-top area -->
    <div class="container">
        <div class="row">
            <!-- navbar menu -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand logo" href="{{ url('/') }}"><img src="{{ URL::asset('web/img/logo.png') }}" alt=""></a>
                <a class="navbar-brand stick-logo" href="{{ url('/') }}"><img src="{{ URL::asset('web/img/stick-logo.png') }}" alt=""></a>
            </div><!-- /.navbar-header -->

            <!-- social media mobile screen -->
            <div class="social-media-sm">
                <ul>
                    <li><a href="{{ url('/') }}"><i class="fa fa-facebook"></i></a></li>
                    <li><a class="open-popup" href="#"><i class="fa fa-search"></i></a></li>
                </ul>
            </div>

            <!--menu area -->
            <div id="navigation-menu">
                <nav class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="{{ url('/') }}#header">home</a></li>
                        <li><a href="{{ url('/') }}#about-us">about us</a></li>
                        <li><a href="{{ url('sign-in/user') }}">User</a></li>
                        <li><a href="{{ url('sign-in/guide') }}">Guide</a></li>
                        <li><a href="{{ url('/') }}#contact-us">contact us</a></li>
                    </ul>
                </nav>
            </div><!-- /. end menu area -->
        </div>
    </div>
</navbar><!--/. end navbar menu -->