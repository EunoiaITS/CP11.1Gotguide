@extends('layouts.layout-home')
@section('content')
<!--===
    About us
    =======================-->
<section class="about-us" id="about-us">
    <div class="container">
        <div class="row">
            <div class="section-title padding-top-100 padding-bottom-100 text-center">
                <h3>about us</h3>
                <p> Taking the hassle out of your travels and be part of the local culture.</p>
            </div>
            <div class="col-sm-offset-1 col-md-offset-1 col-lg-offset-1 col-sm-10 col-md-5 col-lg-5 col-xs-12">
                <div class="about-us-details">
                     <h4 class="about-us-h4">The Story</h4>
                    <p>Idea for a tour guide platform hatched while doing research for an upcoming trip to South Korea late 2015. With a beginner-level Korean, hiring a tour guide was never in the plan. Problem arises when researching about Jeju Island off the coast of the Korean Peninsula. The island is huge and public transport was not a smart option to explore the whole Island.</p>

                    <p>While researching for private day tour options with drivers, we found numerous Instagram pages of students offering affordable tour services in Seoul and Jeju Island. The problem is, they only advertised in Instagram and Facebook occasionally. Soon after, Instagram started changing its algorithm and we find the need for a better platform for these tour guides to promote their...</p>
                    <button class="view-more-button btn btn-info open-popup-about">View More</button>
                </div>
            </div>
            <div class="col-md-offset-0 col-md-6 col-sm-offset-3 col-sm-6">
                <div class="about-us-thumb">
                    <img src="{{ URL::asset('web/img/about_phone.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>

<!--==
Contact us area
=======================-->
<div class="contact-us padding-bottom-100" id="contact-us">
    <div class="container">
        <div class="row">
            <div class="section-title padding-top-100 padding-bottom-100 text-center">
                <h3>contact us</h3>
                <p>Please fill in the form below for any enquiries.</p>
            </div>
            <div class="col-sm-offset-1 col-md-offset-1 col-lg-offset-1 col-sm-7 col-md-7 col-lg-7 col-xs-12">
                <div class="contact-from">
                    <form action="#">
                        <div class="from-group">
                            <input type="text" placeholder="Your Name" class="form-control" required>
                        </div>
                        <div class="from-group">
                            <input type="email" placeholder="Your Mail" class="form-control" required>
                        </div>
                        <div class="from-group">
                            <textarea name="" id="" class="form-control" placeholder="Your message" cols="30" rows="9"></textarea>
                        </div>
                        <button class="btn btn-info send-sms pull-right">send Message</button>
                    </form>
                </div>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
                <div class="contact-details">
                    <div class="contact-details-text">
                        <h2>get-in-touch</h2>
                        <div class="contact-phone-address">
                            <p>+60 16 887 7675</p>
                            <p>+60 12 887 8031</p>
                        </div>
                    </div>
                    <div class="contact-details-text padding-top-100">
                        <h2>where we are</h2>
                        <div class="contact-phone-address">
                            <p>Kuching The Cat City,</p>
                            <p>SARAWAK</p>
                            <p>MYS</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!--=============
    about popuppage 
    ==================-->
     <div class="popup-about">
        <div class="popup-base">
            <div class="search-popup">
                <i class="close fa fa-remove"></i>
                <div class="row">
                    <div class="about-us-popup">
                         <h4 class="about-us-h4">The Story</h4>
                    <p>Idea for a tour guide platform hatched while doing research for an upcoming trip to South Korea late 2015. With a beginner-level Korean, hiring a tour guide was never in the plan. Problem arises when researching about Jeju Island off the coast of the Korean Peninsula. The island is huge and public transport was not a smart option to explore the whole Island.</p>

                    <p>While researching for private day tour options with drivers, we found numerous Instagram pages of students offering affordable tour services in Seoul and Jeju Island. The problem is, they only advertised in Instagram and Facebook occasionally. Soon after, Instagram started changing its algorithm and we find the need for a better platform for these tour guides to promote their services and to ease the research process for travelers.</p>
                    <p>Proceeding with the trip and travelling to Jeju Island, the founder unfortunately couldn’t find any suitable guides for their dates. The 3 days in Jeju was fun, tiring and long. Buses are infrequent and the stops are nowhere near the tourists’ attractions. After being scammed of  $50 by a taxi driver, having to walk for almost half an hour to reach their fishing place from the nearest bus stop and finally hitch-hiking to get back to the bus stop, the founder regretted not having tour guide during the Jeju Island leg of the trip. </p>
                    <p>Soon after the trip, we wanted to materialize our idea. We want to gather tour and local guides in one marketplace. They can be overseas students working the weekends, local residents wanting to meet new people, freelance tour guides and even housewife with plenty of time to spare; as long as they know the destination and the language, it’s not a problem.</p>
                    <p>Finally, got guide mobile app was launched in January 2017 and we are dedicated in continuing to cater to the ever-growing tourism industry and international travelers.</p>
                    <h4 class="about-us-h4">But How? </h4>
                    <p>got guide is a platform for you to find the perfect tour guides according to your preferences. Every trip begins with itinerary planning, which sometimes are too much to handle and sometimes you just don’t want to be stuck in a tour group of 20 other strangers.</p>
                    <p>You’ll be able to find the perfect tour and local guide that can cater to your travelling needs. You can choose tours, travel and cultural packages as flexible as your preferences. Be it in a private tour or in a small group of 2-5 people. Nothing beats the ability to join in guided tours or travel packages that moves around your needs.</p>
                    <p>Choose a tour or a local guide and travel as you would on your own and immerse in local culture, without the communication difficulties and being lost in confusing map. got guide is here for you.</p>
                    <button class="close btn btn-more btn-close">Close</button>
                    </div>
                </div>
            </div>

        </div>
    </div><!-- Popup -->

    @endsection