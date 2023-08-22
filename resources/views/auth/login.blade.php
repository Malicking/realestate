@extends('frontend.frontend_dashboard')

@section('content')

<!-- Titre de la page Start -->
@section('title')
    Authentification
@endsection
<!-- Titre de la page End -->

    <!--Page Title-->
<section class="page-title-two bg-color-1 centred">
    <div class="pattern-layer">
        <div class="pattern-1" style="background-image: url({{ asset('frontend/assets/images/shape/shape-9.png') }});"></div>
        <div class="pattern-2" style="background-image: url({{ asset('frontend/assets/images/shape/shape-10.png') }});"></div>
    </div>
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>Authentification</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home.page') }}">Accueil</a></li>
                <li>S'authentifier</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->


<!-- ragister-section -->
<section class="ragister-section centred sec-pad">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-xl-8 col-lg-12 col-md-12 offset-xl-2 big-column">
                <div class="sec-title">
                    <h5>Authentification</h5>
                    <h2>S'authentifier avec MalickRoi</h2>
                </div>
                <div class="tabs-box">
                    <div class="tab-btn-box">
                        <ul class="tab-btns tab-buttons centred clearfix">
                            <li class="tab-btn active-btn" data-tab="#tab-1">Connexion</li>
                            <li class="tab-btn" data-tab="#tab-2">Inscription</li>
                        </ul>
                    </div>

                    <div class="tabs-content">
                        <div class="tab active-tab" id="tab-1">
                            <div class="inner-box">
                                <h4>Connexion</h4>
                                <form action="{{ route('login') }}" method="post" class="default-form">
                                    @csrf

                                    <div class="form-group">
                                        <label for="Identifiant">
                                            Identifiant (Email/Nom d'utilisateur/Téléphone)
                                        </label>
                                        <input type="text" name="login" id="Identifiant">
                                    </div>
                                    <div class="form-group">
                                        <label for="Pwd">Mot de passe</label>
                                        <input type="password" name="password" id="Pwd">
                                    </div>
                                    <div class="form-group message-btn">
                                        <button type="submit" class="theme-btn btn-one">
                                            Se connecter
                                        </button>
                                    </div>
                                </form>
                                <div class="othre-text">
                                    <p>Mot de passe oublié ?
                                        <a href="{{ route('password.request') }}">
                                            Cliquez-ici
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="tab" id="tab-2">
                            <div class="inner-box">
                                <h4>Inscription</h4>
                                <form action="{{ route('register') }}" method="post" class="default-form">
                                    @csrf

                                    <div class="form-group">
                                        <label for="Name">Nom complet</label>
                                        <input type="text" name="name" id="Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="Email">Email</label>
                                        <input type="email" name="email" id="Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="NewPwd">Mot de passe</label>
                                        <input type="password" name="password" id="NewPwd">
                                    </div>
                                    <div class="form-group">
                                        <label for="ConfirmPwd">
                                            Confirmer le mot de passe
                                        </label>
                                        <input type="password" name="password_confirmation" id="ConfirmPwd">
                                    </div>
                                    <div class="form-group message-btn">
                                        <button type="submit" class="theme-btn btn-one">
                                            S'incrire
                                        </button>
                                    </div>
                                </form>
                                <div class="othre-text">
                                    <p>Déjà inscrit ?
                                        <a href="signup.html">
                                            Se connecter
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ragister-section end -->


<!-- subscribe-section -->
<section class="subscribe-section bg-color-3">
    <div class="pattern-layer" style="background-image: url({{ asset('frontend/assets/images/shape/shape-2.png') }});"></div>
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-6 col-md-6 col-sm-12 text-column">
                <div class="text">
                    <span>Souscrire</span>
                    <h2>
                        Inscrivez-vous à notre newsletter pour recevoir les dernières nouvelles et offres.
                    </h2>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 form-column">
                <div class="form-inner">
                    <form action="contact.html" method="post" class="subscribe-form">
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Enter your email" required="">
                            <button type="submit">Souscrire maintenant</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- subscribe-section end -->
@endsection
