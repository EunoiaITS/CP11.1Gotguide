@extends('layouts.layout')
@section('content')

    <!-- user profile edit details area -->
    <div class="comments-area">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-8 col-sm-offset-2 col-md-offset-3 col-xs-10 col-xs-offset-1 padding-left-0 padding-right-0">
                    <div class="comments">
                        @if($result->comments != null)
                            @foreach($result->comments as $comment)
                                <div class="single-comments">
                                    <div class="img-comments">
                                        <img src="{{ $comment->profile_img }}" alt="comments-pic">
                                    </div>
                                    <div class="comment-block">
                                        <h3 class="coments-name">{{ $comment->commenter }}</h3>
                                        <div class="my-rating-{{ $comment->id }}"></div>
                                        <p>{{ $comment->comment }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h4>No comments yet!</h4>
                        @endif
                        <div class="back-to-profileq">
                            <a href="{{ url('tour-guides/profile/'.$result->id) }}" style="text-decoration: none;"><button type="button" class="btn btn-info comments-button">Back to Profile</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--=============
            Search popuppage
            ==================-->
    @include('includes.search-modal')
@endsection
