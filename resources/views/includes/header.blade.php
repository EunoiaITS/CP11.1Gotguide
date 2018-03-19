<?php
$id = request()->route('id');
$tpath = 'tour-guides/profile/'.$id;
$search_path = 'search-result';
?>
<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<div class="wrapper">

    <!--==
    header area
    =====================-->
    <header class="header-user clearfix">
        <div class="header-overlay">
            <!-- header-menu area -->
            @if(Auth::check())
                @if(Auth::user()->role =="traveller")
                    @include('includes.navbar-user')
                @elseif(Auth::user()->role =="agent")
                    @include('includes.navbar-guide')
                @else
                    @include('includes.navbar')
                @endif
            @else
                @if(!Auth::user())
                    @if(request()->path() == $search_path)
                        @include('includes.navbar-search')
                    @elseif(request()->path() == $tpath)
                        @include('includes.navbar-search')
                    @else
                        @include('includes.navbar')
                    @endif
                @endif
            @endif

            {{--@if(isset($page_target))--}}
                {{--@if($page_target == "traveller")--}}
                    {{--@include('includes.navbar-user')--}}
                {{--@elseif($page_target=="agent")--}}
                    {{--@include('includes.navbar-guide')--}}
                {{--@else--}}
                    {{--@include('includes.navbar');--}}
            {{--@endif--}}
            {{--@endif--}}
            @include($result->header)
        </div>
    </header><!--// header area -->