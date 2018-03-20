<div class="popup-shopping-card">
    <div class="popup-base">
        <div class="search-popup">
            <i class="close fa fa-remove"></i>
            <div class="row">
                <!-- header got seach area -->
                <div class="popup-got-search search-destination">
                    <h2 class="search-title">Subscription</h2>
                    <p>@if(isset($myOffer) && $myOffer != ''){{ 'Congratulations, You are currently subscribed !' }}@else{{ 'Please, choose a subscription offer from below.' }}@endif</p>
                    <form method="post" action="{{ url('/subscription/buy') }}">
                    <div class="ui-list-scroll">
                        <ul class="subcription-list">
                            @foreach($offers as $offer)
                            <li>
                                <div class="left-offer-item">
                                    <span class="offer-title">Offer</span>
                                    <span class="offer-list-item">{{ $offer->details }}</span>
                                    <div class="price-item">Price: <span class="bold-text">{{ $offer->amount.$offer->currency }}</span> | Validity: <span class="bold-text">{{ $offer->duration }} Days</span></div>
                                </div>
                                <div class="selection">
                                    <input type="radio" name="optradio" value="{{ $offer->id }}" @if(isset($myOffer) && $myOffer != '' && $myOffer->offer_id == $offer->id){{ 'checked' }}@endif @if(isset($myOffer) && $myOffer != ''){{ 'disabled' }}@endif>
                                </div>
                            </li>
                                @endforeach
                        </ul>
                    </div>
                    <div class="pay-button clearfix">
                        <button type="submit" class="btn btn-info btn-change" @if(isset($myOffer) && $myOffer != ''){{ 'disabled' }}@endif>Pay</button>
                    </div>
                    </form>
                </div><!--// end header got search area -->
            </div>
        </div>

    </div>
</div>