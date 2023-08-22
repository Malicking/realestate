@extends('frontend.frontend_dashboard')

@section('content')

@php
    $id = Auth::user()->id;
    $userData = App\Models\User::find($id);
@endphp

<!-- Titre de la page Start -->
@section('title')
    Changer mon mot de passe
@endsection
<!-- Titre de la page End -->

<!--Page Title-->
<section class="page-title centred" style="background-image: url({{ !empty($userData->cover_photo) ? url('upload/users/covers/'.$userData->cover_photo) : url('frontend/assets/images/background/page-title-5.jpg') }});">
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>Mon compte </h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home.page') }}">Accueil</a></li>
                <li>Actualiser mon mot de passe </li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->

<!-- sidebar-page-container -->
<section class="sidebar-page-container blog-details sec-pad-2">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                <div class="blog-sidebar">
                    <div class="sidebar-widget post-widget">
                        <div class="widget-title">
                            <h4>Mon compte </h4>
                        </div>
                        <div class="post-inner">
                            <div class="post">
                                <figure class="post-thumb">
                                    <a href="blog-details.html">
                                        <img src="{{ !empty($userData->photo) ? url('upload/users/'.$userData->photo) : url('upload/no_image.jpg') }}" alt="">
                                    </a>
                                </figure>
                                <h5>
                                    <a href="blog-details.html">
                                        {{ $userData->name }}
                                    </a>
                                </h5>
                                <p>{{ $userData->email }} </p>
                            </div>
                        </div>
                    </div>

                    <div class="sidebar-widget category-widget">

                        @include('frontend.dashboard.dashboard_sidebar')

                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="blog-details-content">
                    <div class="news-block-one">
                        <div class="inner-box">

                            <div class="lower-content">
                                <h3>Mettre à jour mes informations.</h3>

                                <form action="{{ route('user.update.pwd') }}" method="post" class="default-form"">
                                    @csrf

                                    <div class="form-group">
                                        <label>Mot de passe actuel </label>
                                        <input type="password" name="old_password">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nouveau mot de passe </label>
                                                <input type="password" name="new_password">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>
                                                    Confirmation du mot de passe
                                                </label>
                                                <input type="password" name="confirm_password">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group message-btn mt-5">
                                        <button type="submit" class="theme-btn btn-one">
                                            Enregistrer les modifications
                                        </button>
                                    </div>
                                </form>
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

