@php
    $setting = App\Models\SiteSetting::first();
@endphp

<header class="main-header">
    <!-- header-top -->
    <div class="header-top">
        <div class="top-inner clearfix">
            <div class="left-column pull-left">
                <ul class="info clearfix">
                    <li>
                        <i class="far fa-map-marker-alt"></i>
                        {{ $setting->company_address }}
                    </li>
                    <li><i class="far fa-clock"></i>Lun - Sam  9.00 - 18.00</li>
                    <li>
                        <i class="far fa-phone"></i>
                        <a href="tel:{{ $setting->support_phone }}">
                            {{ $setting->support_phone }}
                        </a>
                    </li>
                </ul>
            </div>
            <div class="right-column pull-right">
                <ul class="social-links clearfix">
                    <li>
                        <a href="{{ $setting->facebook }}">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ $setting->twitter }}">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                </ul>

                <div class="sign-box">
                    @auth
                        <a href="{{ route('dashboard') }}">
                            <i class="fas fa-user"></i>
                            TDB
                        </a>
                        <a href="{{ route('user.logout') }}">
                            <i class="fas fa-user"></i>
                            Déconnexion
                        </a>
                    @else
                        <a href="{{ route('login') }}">
                            <i class="fas fa-user"></i>
                            Connexion
                        </a>
                    @endauth
                </div>

            </div>
        </div>
    </div>
    <!-- header-lower -->
    <div class="header-lower">
        <div class="outer-box">
            <div class="main-box">
                <div class="logo-box">
                    <figure class="logo">
                        <a href="{{ route('home.page') }}">
                            <img src="{{ url($setting->logo) }}" alt="" style="width: 100px;">
                        </a>
                    </figure>
                </div>
                <div class="menu-area clearfix">
                    <!--Mobile Navigation Toggler-->
                    <div class="mobile-nav-toggler">
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                    </div>
                    <nav class="main-menu navbar-expand-md navbar-light">
                        <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                            <ul class="navigation clearfix">
                                <li>
                                    <a href="{{ route('home.page') }}"><span>Accueil</span></a>
                                </li>
                                <li>
                                    <a href="#"><span>A propos</span></a>
                                </li>

                                <li class="dropdown">
                                    <a href="#"><span>Propriétés</span></a>
                                    <ul>
                                        <li>
                                            <a href="{{ route('buy.property') }}">En vente</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('rent.property') }}">En location</a>
                                        </li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="#"><span>Agents</span></a>
                                </li>

                                <li>
                                    <a href="{{ route('blog.page') }}"><span>Blog</span></a>
                                </li>

                                <li><a href="contact.html"><span>Contact</span></a></li>

                                <li>
                                    <a href="{{ route('agent.login') }}" class="theme-btn btn-one text-white">
                                        <i class="fa fa-plus"></i>
                                        <span>Nouvel agent</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="btn-box">
                    <a href="{{ route('home.page') }}" class="theme-btn btn-one">
                        <span>+</span>Add Listing
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!--sticky Header-->
    <div class="sticky-header">
        <div class="outer-box">
            <div class="main-box">
                <div class="logo-box">
                    <figure class="logo">
                        <a href="{{ route('home.page') }}">
                            <img src="{{ url($setting->logo) }}" alt="" style="width: 90px;">
                        </a>
                    </figure>
                </div>
                <div class="menu-area clearfix">
                    <nav class="main-menu clearfix">
                        <!--Keep This Empty / Menu will come through Javascript-->
                    </nav>
                </div>
                <div class="btn-box">
                    <a href="{{ route('home.page') }}" class="theme-btn btn-one">
                        <span>+</span>Add Listing
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
