@extends('frontend.frontend_dashboard')

@section('content')

@php
    $id = Auth::user()->id;
    $userData = App\Models\User::find($id);
@endphp

<!-- Titre de la page Start -->
@section('title')
    Editer mon profil
@endsection
<!-- Titre de la page End -->

<!--Page Title-->
<section class="page-title centred" style="background-image: url({{ !empty($userData->cover_photo) ? url('upload/users/covers/'.$userData->cover_photo) : url('frontend/assets/images/background/page-title-5.jpg') }});">
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>Mon compte </h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home.page') }}">Accueil</a></li>
                <li>Actualiser mes infos </li>
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

                                <form action="{{ route('user.profile.store') }}" method="post" class="default-form" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nom complet </label>
                                                <input type="text" name="name" value="{{ $userData->name }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nom d'utilisateur </label>
                                                <input type="text" name="username" value="{{ $userData->username }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Email address</label>
                                        <input type="email" name="email" value="{{ $userData->email }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Téléphone</label>
                                        <input type="text" name="phone" value="{{ $userData->phone }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Adresse</label>
                                        <input type="text" name="address" value="{{ $userData->address }}">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div>
                                                    <img src="{{ !empty($userData->photo) ? url('upload/users/'.$userData->photo) : url('upload/no_image.jpg') }}" alt="{{ $userData->name }}" style="width: 100px; height: 100px;" id="showImage">
                                                </div>

                                                <label for="image" class="form-label">
                                                    Nouvelle photo de profil
                                                </label>
                                                <input type="file" name="photo" id="image">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div>
                                                    <img src="{{ (!empty($userData->cover_photo) ? (url('upload/users/covers/'.$userData->cover_photo)) : url('upload/cover_default.png')) }}" alt="{{ $userData->name }}" style="height: 100px;" id="showCoverImg">
                                                </div>

                                                <label for="coverImg" class="form-label">
                                                    Nouvelle photo de couverture
                                                </label>
                                                <input type="file" name="cover_photo" id="coverImg">
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


<!-- affichage automatique de l'image (profil) -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#image').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

<!-- affichage automatique de l'image (profil) -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#coverImg').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showCoverImg').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>


@endsection

