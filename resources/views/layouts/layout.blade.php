@include('includes.head')
@include('includes.header')
    @yield('content')
@if(Auth::check())
    @include('includes.logout-confirm')
    @if(Auth::user()->role =="agent")
        @include('includes.sub-cart')
        @endif
    @endif
    @include('includes.footer')
