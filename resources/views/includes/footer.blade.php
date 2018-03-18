<!--==
Footer area
=======================-->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-offset-0 col-md-offset-1 col-lg-offset-1 col-sm-6 col-md-5 col-lg-5 col-xs-12">
                <p class="footer-text"> © 2017 - <a href="#">Got Guide</a> All Right Reserved</p>
            </div>
            <div class="col-sm-6 col-md-5 col-lg-5 col-xs-12">
                <p class="powerd-by"> Powered By <a href="#">Eunoia I.T Solutions</a></p>
            </div>
        </div>
    </div>
</footer>
</div>



<!--==
Js script
================-->
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script>window.jQuery || document.write('<script src="{{ URL::asset('web/js/vendor/jquery-2.2.4.min.js') }}"><\/script>')</script>
<!-- bootstrap js -->
<script src="{{ URL::asset('web/js/bootstrap.min.js') }}"></script>
<!-- bootstrap-select js -->
<script src="{{ URL::asset('web/js/bootstrap-select.min.js') }}"></script>
<!-- bootstrap-select js -->
<script src="{{ URL::asset('web/js/jquery.malihu.PageScroll2id.js') }}"></script>
<!-- nice-scroll-->
<script src="{{ URL::asset('web/js/jquery.nicescroll.min.js') }}"></script>
<!-- bootstrap datepicker -->
<script src="{{ URL::asset('web/js/moment.js') }}"></script>
<script src="{{ URL::asset('web/js/bootstrap-datetimepicker.js') }}"></script>
<!-- rating js -->
<script src="{{ URL::asset('web/js/jquery.star-rating-svg.js') }}"></script>
<!-- custom js -->
<script src="{{ URL::asset('web/js/plugins.js') }}"></script>
<!-- cropper js file -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/cropperjs/0.8.1/cropper.min.js'></script>
<!-- custom js -->
<script src="{{ URL::asset('web/js/custom.js') }}"></script>

<script>
    $(document).ready(function(){
        $('.edit-popup-option-available').on('click', function(){
            var dateValue = $('#date'+$(this).attr('rel')).text();
            $('#edit-guide-date').val(dateValue);
            var timeValue = $('#time'+$(this).attr('rel')).text();
            $('#edit-guide-time-ex').val(timeValue);
            $('#ad-id').val($(this).attr('rel'));
        });
        $('.delete-popup-option').on('click', function(){
            $('#ad-delete-id').val($(this).attr('rel'));
        });
        $('.edit-package').on('click', function(){
            var nameValue = $('#name'+$(this).attr('rel')).text();
            $('#edit-package-name').val(nameValue);
            var priceValue = $('#price'+$(this).attr('rel')).text();
            $('#edit-package-price').val(priceValue);
            var detailsValue = $('#details'+$(this).attr('rel')).text();
            $('#edit-package-details').val(detailsValue);
            $('#package-id').val($(this).attr('rel'));
        });
        $('.delete-package').on('click', function(){
            $('#package-delete-id').val($(this).attr('rel'));
        });
        $('#btn1').on('click', function(){
            $('#star1').attr('class', 'fa fa-star');
            $('#star2').attr('class', 'fa fa-star-o');
            $('#star3').attr('class', 'fa fa-star-o');
            $('#star4').attr('class', 'fa fa-star-o');
            $('#star5').attr('class', 'fa fa-star-o');
            $('#rate').val(1);
        });
        $('#btn2').on('click', function(){
            $('#star1').attr('class', 'fa fa-star');
            $('#star2').attr('class', 'fa fa-star');
            $('#star3').attr('class', 'fa fa-star-o');
            $('#star4').attr('class', 'fa fa-star-o');
            $('#star5').attr('class', 'fa fa-star-o');
            $('#rate').val(2);
        });
        $('#btn3').on('click', function(){
            $('#star1').attr('class', 'fa fa-star');
            $('#star2').attr('class', 'fa fa-star');
            $('#star3').attr('class', 'fa fa-star');
            $('#star4').attr('class', 'fa fa-star-o');
            $('#star5').attr('class', 'fa fa-star-o');
            $('#rate').val(3);
        });
        $('#btn4').on('click', function(){
            $('#star1').attr('class', 'fa fa-star');
            $('#star2').attr('class', 'fa fa-star');
            $('#star3').attr('class', 'fa fa-star');
            $('#star4').attr('class', 'fa fa-star');
            $('#star5').attr('class', 'fa fa-star-o');
            $('#rate').val(4);
        });
        $('#btn5').on('click', function(){
            $('#star1').attr('class', 'fa fa-star');
            $('#star2').attr('class', 'fa fa-star');
            $('#star3').attr('class', 'fa fa-star');
            $('#star4').attr('class', 'fa fa-star');
            $('#star5').attr('class', 'fa fa-star');
            $('#rate').val(5);
        });
        $('.package-popup-ip').on('click', function(){
            var id = $(this).attr('rel');
            $('#package_name_show').text($('#package_name'+id).text());
            $('#package_price_show').text($('#package_price'+id).text());
            $('#package_details_show').text($('#package_details'+id).text());
        });
    });
</script>

<script>
    /*--==========
     nice scroll
     ===================================--*/

    $(".availabity-scroll").niceScroll({
        cursorcolor:"#e9e9e9",
        cursorwidth:"8px"
    });

    /*=======================================
     Datepicker init
     =========================================*/

    $('.datepicker-f').datetimepicker({
        format: "DD-MM-YYYY",
        icons: {
            up: 'fa fa-angle-up',
            down: 'fa fa-angle-down',
            previous: 'fa fa-angle-left',
            next: 'fa fa-angle-right',
        }
    });

    /*=======================================
     Timepicker init
     =========================================*/

    $('.timepicker-f').datetimepicker({
        format: "HH:mm A",
        icons: {
            up: 'fa fa-angle-up',
            down: 'fa fa-angle-down',
            previous: 'fa fa-angle-left',
            next: 'fa fa-angle-right',
        }
    });
</script>

<script>
    // rating js
    @if(isset($result->avgRate))
    $(".my-rating").starRating({
        totalStars: 5,
        initialRating: {{ $result->avgRate }},
        readOnly: true,
        strokeWidth: 10,
        starSize: 22,
        starGradient: {
            start: '#fbbd00',
            end: '#fbbd00'
        }
    });

    // rating js 2
    @if(isset($result->comments))
    @foreach($result->comments as $comment)
    $(".my-rating-"+{{ $comment->id }}).starRating({
        totalStars: 5,
        initialRating: {{ $comment->rating }},
        readOnly: true,
        strokeWidth: 10,
        starSize: 18,
        starGradient: {
            start: '#fbbd00',
            end: '#fbbd00'
        }
    });
    @endforeach
    @endif
    @endif
</script>
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