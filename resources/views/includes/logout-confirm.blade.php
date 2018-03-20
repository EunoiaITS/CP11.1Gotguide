<!--=======================
        log out confirmation
        ==========================-->
<div class="log-out-confermation-popup">
    <div class="popup-base">
        <div class="popup-rateme-main">
            <i class="close fa fa-remove"></i>
            <div class="row">
                <div class="rateme-destination">
                    <h2 class="search-title">Confirmation Logout</h2>
                </div>
                <!-- header got seach area -->
                <div class="popup-got-search button-option-logout">
                    <form method="post" action="@if(Auth::user()->role =="traveller"){{ url('/ulogout') }}@else{{ url('/glogout') }}@endif">
                        <p class="text-center">Are you sure you want to logout ?</p>
                        <div class="new-button clearfix">
                            <button type="submit" class="btn btn-info btn-change">Ok</button>
                            <button type="button" class="btn btn-info btn-change close">Cancel</button>
                        </div>
                    </form>
                </div><!--// end header got search area -->
            </div>
        </div>

    </div>
</div><!-- Popup -->