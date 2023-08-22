@extends('frontend.frontend_dashboard')

@section('content')

@php
    $id = Auth::user()->id;
    $userData = App\Models\User::find($id);
@endphp

<!-- Titre de la page Start -->
@section('title')
    Live Chat
@endsection
<!-- Titre de la page End -->

<!--Page Title-->
<section class="page-title centred" style="background-image: url({{ !empty($userData->cover_photo) ? url('upload/users/covers/'.$userData->cover_photo) : url('frontend/assets/images/background/page-title-5.jpg') }});">
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>Mon compte </h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home.page') }}">Accueil</a></li>
                <li>Mon Chat Live </li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->

<!-- sidebar-page-container -->
<section class="sidebar-page-container blog-details sec-pad-2">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-3 col-md-12 col-sm-12 sidebar-side">
                <div class="blog-sidebar">
                    <div class="sidebar-widget post-widget">
                        <div class="widget-title">
                            <h4>Mon compte </h4>
                        </div>
                        <div class="post-inner">
                            <div class="post">
                                <figure class="post-thumb">
                                    <a href="{{ route('dashboard') }}">
                                        <img src="{{ !empty($userData->photo) ? url('upload/users/'.$userData->photo) : url('upload/no_image.jpg') }}" alt="" style="width: 40px;">
                                    </a>
                                </figure>
                                <h5 style="font-size: 85%; margin-left: -40%">
                                    <a href="{{ route('dashboard') }}">
                                        {{ $userData->name }}
                                    </a>
                                </h5>
                                <p style="font-size: 80%; margin-left: -40%">{{ $userData->email }} </p>
                            </div>
                        </div>
                    </div>

                    <div class="sidebar-widget category-widget">

                        @include('frontend.dashboard.dashboard_sidebar')

                    </div>
                </div>
            </div>

            <div class="col-lg-9 col-md-12 col-sm-12 content-side mt-3">
                <div class="blog-details-content">
                    <div class="news-block-one">
                        <div class="inner-box">

                            <div class="lower-content">
                                <h3>Mes échanges sur Chat Live</h3>

                                <div id="app">
                                    <chat-message></chat-message>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- sidebar-page-container -->

@include('frontend.home.subscribe')


@endsection

