@if(!Auth::user())
    @include('includes/navbar-search')
    @endif

    <!--==
                   guide profile area
                    ===========================-->
<div class="breadcrumb-area">
    <div class="breadcumb-overlay">
        <div class="container">
            <div class="row">
                <div class="searh-result-header text-center">
                    <h4 class="chose-guide text-uppercase">Choose Guide</h4>
                    <h3 class="searh-location">{{ $_POST['city'] }}<br>
                        <span>{{ $_POST['country'] }}</span></h3>
                </div>
            </div>
        </div>
    </div>
</div><!--// header landing area -->