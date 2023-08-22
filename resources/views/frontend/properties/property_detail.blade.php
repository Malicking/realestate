@extends('frontend.frontend_dashboard')

@section('content')

<!-- Titre de la page Start -->
@section('title')
    Détails de la propriété
@endsection
<!-- Titre de la page End -->


<!--Page Title-->
<section class="page-title-two bg-color-1 centred">
    <div class="pattern-layer">
        <div class="pattern-1" style="background-image: url('{{ asset('frontend/assets/images/shape/shape-9.png') }}');"></div>
        <div class="pattern-2" style="background-image: url({{ asset('frontend/assets/images/shape/shape-10.png') }});"></div>
    </div>
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>{{ $propData->property_name }}</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home.page') }}">Accueil</a></li>
                <li>{{ $propData->property_name }}</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->


<!-- property-details -->
<section class="property-details property-details-one">
    <div class="auto-container">
        <div class="top-details clearfix">
            <div class="left-column pull-left clearfix">
                <h3>{{ $propData->property_name }}</h3>
                <div class="author-info clearfix">
                    <div class="author-box pull-left">
                        @if ($propData->agent_id)
                            <figure class="author-thumb">
                                <img src="{{ !empty($propData['Users']['photo']) ? url('upload/agents/'.$propData['Users']['photo']) : url('upload/no_image.jpg') }}" alt="">
                            </figure>
                            <h6>{{ $propData['Users']['name'] }}</h6>
                        @else
                            <figure class="author-thumb">
                                <img src="{{ url('upload/no_image.jpg') }}" alt="">
                            </figure>
                            <h6>Admin</h6>
                        @endif
                    </div>
                    <ul class="rating clearfix pull-left">
                        <li><i class="icon-39"></i></li>
                        <li><i class="icon-39"></i></li>
                        <li><i class="icon-39"></i></li>
                        <li><i class="icon-39"></i></li>
                        <li><i class="icon-40"></i></li>
                    </ul>
                </div>
            </div>
            <div class="right-column pull-right clearfix">
                <div class="price-inner clearfix">
                    <ul class="category clearfix pull-left">
                        <li>
                            <a href="#">
                                {{ $propData['Types']['type_name'] }}
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                {{ $propData['property_status'] }}
                            </a>
                        </li>
                    </ul>
                    <div class="price-box pull-right">
                        <h3>
                            ${{ number_format($propData->lowest_price, 0, ',', ' ') }}
                        </h3>
                    </div>
                </div>
                <ul class="other-option pull-right clearfix">
                    <li><a href="#"><i class="icon-37"></i></a></li>
                    <li><a href="#"><i class="icon-38"></i></a></li>
                    <li><a href="#"><i class="icon-12"></i></a></li>
                    <li><a href="#"><i class="icon-13"></i></a></li>
                </ul>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="property-details-content">
                    <div class="carousel-inner">
                        <div class="single-item-carousel owl-carousel owl-theme owl-dots-none">

                            @isset($multiImgs)
                                @foreach ($multiImgs as $item)
                                    <figure class="image-box">
                                        <img src="{{ url($item->photo_name) }}" alt="">
                                    </figure>
                                @endforeach
                            @endisset

                        </div>
                    </div>

                    <div class="discription-box content-widget">
                        <div class="title-box">
                            <h4>Description de la propriété</h4>
                        </div>
                        <div class="text">
                            {!! $propData->long_desc !!}
                        </div>
                    </div>

                    <div class="details-box content-widget">
                        <div class="title-box">
                            <h4>Autres infos sur la propriété</h4>
                        </div>
                        <ul class="list clearfix">
                            <li>Identifiant: <span>{{ $propData->property_code }}</span></li>
                            <li>
                                Nombre de pièces:
                                @php
                                    $nb = $propData['bedrooms'] + $propData['bathrooms'] + $propData['garage'];
                                @endphp

                                <span>{{ $nb }}</span>
                            </li>
                            <li>
                                Taille du garage:
                                <span>{{ $propData['garage_size'] }} m2</span>
                            </li>

                            <li>
                                Prix minimum :
                                <span>
                                    ${{ number_format($propData['lowest_price'], 0, ',', ' ') }}
                                </span>
                            </li>
                            <li>
                                Nombre de chambres :
                                <span>{{ $propData['bedrooms'] }}</span>
                            </li>
                            <li>
                                Nombre de salles de bain:
                                <span>{{ $propData['bathrooms'] }}</span>
                            </li>
                            <li>
                                Date pub.:
                                <span>{{ $propData['created_at']->format('d-M-Y') }}</span>
                            </li>
                            <li>
                                Type :
                                <span>{{ $propData['Types']['type_name'] }}</span>
                            </li>
                            <li>
                                Statut :
                                <span>{{ $propData['property_status'] }}</span>
                            </li>
                            <li>
                                Taille totale :
                                <span>{{ number_format($propData['property_size'], 0, ',', ' ') }}</span>
                            </li>
                            <li>
                                Nombre de garages :
                                <span>{{ $propData['garage'] }}</span>
                            </li>
                        </ul>
                    </div>

                    <div class="amenities-box content-widget">
                        <div class="title-box">
                            <h4>Aménités</h4>
                        </div>
                        <ul class="list clearfix">
                            @isset($amenities)
                                @foreach ($amenities as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            @endisset
                        </ul>
                    </div>

                    <div class="location-box content-widget">
                        <div class="title-box">
                            <h4>Localisation</h4>
                        </div>
                        <ul class="info clearfix">
                            <li><span>Adresse :</span> {{ $propData['address'] }}</li>
                            <li>
                                <span>Quartier / Voisinage :</span>
                                {{ $propData['neighborhood'] }}
                            </li>
                            <li><span>Ville :</span> {{ $propData['city'] }}</li>
                            <li><span>Région / Etat :</span> {{ $propData['states']['state_name'] }}</li>
                            <li><span>Code Postal : </span> {{ $propData['postal_code'] }}</li>
                        </ul>
                        <div class="google-map-area">
                            <div
                                class="google-map"
                                id="contact-google-map"
                                data-map-lat="{{ $propData['latitude'] }}"
                                data-map-lng="{{ $propData['longitude'] }}"
                                data-icon-path="{{ url('frontend/assets/images/icons/map-marker.png') }}"
                                data-map-title="Brooklyn, New York, United Kingdom"
                                data-map-zoom="12"
                                data-markers='{
                                    "marker-1": [40.712776, -74.005974, "<h4>Branch Office</h4><p>77/99 New York</p>","{{ url('frontend/assets/images/icons/map-marker.png') }}"]
                                }'>

                            </div>
                        </div>
                    </div>

                    <div class="nearby-box content-widget">
                        <div class="title-box">
                            <h4>Portée / Avantage de cette propriété</h4>
                        </div>
                        <div class="inner-box">
                            <div class="single-item">
                                <div class="icon-box">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="inner">
                                    <h5>Position / emplacement : </h5>

                                    @isset($facilities)
                                        @foreach ($facilities as $item)
                                            <div class="box clearfix">
                                                <div class="text pull-left">
                                                    <h6>
                                                        {{ $item->facility_name }}
                                                        <span>({{ $item->distance }} km)</span>
                                                    </h6>
                                                </div>
                                                <ul class="rating pull-right clearfix">
                                                    <li><i class="icon-39"></i></li>
                                                    <li><i class="icon-39"></i></li>
                                                    <li><i class="icon-39"></i></li>
                                                    <li><i class="icon-39"></i></li>
                                                    <li><i class="icon-40"></i></li>
                                                </ul>
                                            </div>
                                        @endforeach
                                    @endisset

                                </div>
                            </div>

                        </div>
                    </div>

                    @isset($propData->property_video)
                        <div class="statistics-box content-widget">
                            <div class="title-box">
                                <h4>Vidéo de la propriété</h4>
                            </div>
                            <figure class="image-box">
                                <iframe width="800" height="500" src="{{ $propData->property_video }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; enctyped-media; gyroscope; picture-in-picture; web-share;" allowfillscreen title="{{ $propData->property_name }}"></iframe>
                            </figure>
                        </div>
                    @endisset

                    <div class="schedule-box content-widget">
                        <div class="title-box">
                            <h4>Programmer une visite</h4>
                        </div>
                        <div class="form-inner">
                            <form action="{{ route('schedule.store') }}" method="post">
                                @csrf

                                <input type="hidden" name="property_id" value="{{ $propData->id }}">
                                <input type="hidden" name="agent_id" value="{{ $propData->agent_id }}">

                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-12 col-sm-12 column">
                                        <div class="form-group">
                                            {{-- <i class="far fa-calendar-alt"></i> --}}
                                            <input type="date" name="tour_date" class="form-control" placeholder="Entrez la date..." id="datepicker">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12 col-sm-12 column">
                                        <div class="form-group">
                                            {{-- <i class="far fa-clock"></i> --}}
                                            <input type="time" name="tour_time" class="form-control" placeholder="Entrez l'heure...">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 column">
                                        <div class="form-group">
                                            <textarea name="message" placeholder="Votre message..."></textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 column">
                                        <div class="form-group message-btn">
                                            <button type="submit" class="theme-btn btn-one">
                                                Enregistrer
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                <div class="property-sidebar default-sidebar">
                    <div class="author-widget sidebar-widget">
                        <div class="author-box">

                            @if (isset($propData->agent_id))
                                <a href="{{ route('agent.details', $propData->agent_id) }}">
                                    <figure class="author-thumb">
                                        <img src="{{ !empty($propData['Users']['photo']) ? url('upload/agents/'.$propData->Users->photo) : url('upload/no_image.jpg') }}" alt="">
                                    </figure>
                                </a>
                                <div class="inner">
                                    <h4>{{ $propData['Users']['name'] }}</h4>
                                    <ul class="info clearfix">
                                        <li>
                                            <i class="fas fa-map-marker-alt"></i>
                                            {{ $propData['Users']['address'] }}
                                        </li>
                                        <li>
                                            <i class="fas fa-phone"></i>
                                            <a href="tel:{{ $propData['Users']['phone'] }}">
                                                {{ $propData['Users']['phone'] }}
                                            </a>
                                        </li>
                                    </ul>
                                    
                                    <!-- Vue JS - Start -->
                                    @auth
                                        <div id="app">
                                            <send-message :receiverid="{{ $propData->agent_id }}" receivername="{{ $propData->Users->name }}">
                                            </send-message>
                                        </div>
                                    @else
                                        <a href="{{ route('login') }}" class="text-warning" style="font-size: 13px;">
                                            Connectez-vous pour chatter
                                        </a>
                                    @endauth
                                    <!-- Vue JS - End -->
                                </div>
                            @else
                                <figure class="author-thumb">
                                    <img src="{{ asset('upload/no_image.jpg') }}" alt="">
                                </figure>
                                <div class="inner">
                                    <h4>Admin</h4>
                                    <ul class="info clearfix">
                                        <li>
                                            <i class="fas fa-map-marker-alt"></i>
                                            Conakry, Guinée
                                        </li>
                                        <li>
                                            <i class="fas fa-phone"></i>
                                            <a href="tel:628000000">+224 628 000 000</a>
                                        </li>
                                    </ul>
                                    <div class="btn-box">
                                        <a href="agents-details.html">View Listing</a>
                                    </div>
                                </div>
                            @endif

                        </div>

                        <div class="form-inner">

                            @auth

                                @php
                                    $auth_id = Auth::user()->id;
                                    $userData = App\Models\User::where('id', $auth_id)->first();
                                @endphp

                                <form action="{{ route('property.message') }}" method="post" class="default-form">
                                    @csrf

                                <input type="hidden" name="property_id" value="{{ $propData->id }}">

                                    @if ($propData->agent_id)
                                        <input type="hidden" name="agent_id" value="{{ $propData->agent_id }}">
                                    @else
                                        <input type="hidden" name="agent_id" value="">
                                    @endif

                                    <div class="form-group">
                                        <input type="text" name="msg_name" placeholder="Entrez votre nom complet..." value="{{ $userData->name }}" required="">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="msg_email" placeholder="Entrez votre email..." value="{{ $userData->email }}" required="">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="msg_phone" placeholder="Entrez votre téléphone..." value="{{ $userData->phone }}" required="">
                                    </div>
                                    <div class="form-group">
                                        <textarea name="message" placeholder="Message"></textarea>
                                    </div>
                                    <div class="form-group message-btn">
                                        <button type="submit" class="theme-btn btn-one">
                                            Envoyer le message
                                        </button>
                                    </div>
                                </form>
                            @else
                                <form action="{{ route('property.message') }}" method="post" class="default-form">
                                    @csrf

                                <input type="hidden" name="property_id" value="{{ $propData->id }}">

                                @if ($propData->agent_id)
                                <input type="hidden" name="agent_id" value="{{ $propData->agent_id }}">
                                @else
                                    <input type="hidden" name="agent_id" value="">
                                @endif

                                    <div class="form-group">
                                        <input type="text" name="msg_name" placeholder="Entrez votre nom..." required="">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="msg_email" placeholder="Entrez votre email..." required="">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="msg_phone" placeholder="Téléphone..." required="">
                                    </div>
                                    <div class="form-group">
                                        <textarea name="message" placeholder="Message..."></textarea>
                                    </div>
                                    <div class="form-group message-btn">
                                        <button type="submit" class="theme-btn btn-one">
                                            Envoyer le message
                                        </button>
                                    </div>
                                </form>

                            @endauth
                        </div>

                    </div>
                    <div class="calculator-widget sidebar-widget">
                        <div class="calculate-inner">
                            <div class="widget-title">
                                <h4>Mortgage Calculator</h4>
                            </div>
                            <form method="post" action="mortgage-calculator.html" class="default-form">
                                <div class="form-group">
                                    <i class="fas fa-dollar-sign"></i>
                                    <input type="number" name="total_amount" placeholder="Total Amount">
                                </div>
                                <div class="form-group">
                                    <i class="fas fa-dollar-sign"></i>
                                    <input type="number" name="down_payment" placeholder="Down Payment">
                                </div>
                                <div class="form-group">
                                    <i class="fas fa-percent"></i>
                                    <input type="number" name="interest_rate" placeholder="Interest Rate">
                                </div>
                                <div class="form-group">
                                    <i class="far fa-calendar-alt"></i>
                                    <input type="number" name="loan" placeholder="Loan Terms(Years)">
                                </div>
                                <div class="form-group">
                                    <div class="select-box">
                                        <select class="wide">
                                           <option data-display="Monthly">Monthly</option>
                                           <option value="1">Yearly</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group message-btn">
                                    <button type="submit" class="theme-btn btn-one">
                                        Calculate Now
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="similar-content">
            <div class="title">
                <h4>Propriétés similaires</h4>
            </div>
            <div class="row clearfix">

                @isset($similarProps)
                    @foreach ($similarProps as $item)
                        <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                            <div class="feature-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <a href="{{ route('propertyDetail', [$item->id, $item->property_slug]) }}">
                                            <figure class="image">
                                                <img src="{{ url($item->property_thumbnail) }}" alt="">
                                            </figure>
                                        </a>
                                        <div class="batch"><i class="icon-11"></i></div>
                                        @if (isset($item->featured))
                                            <span class="category">En vedette</span>
                                            @elseif (isset($item->hot))
                                            <span class="category bg-primary">
                                                Acquisition rapide
                                            </span>
                                        @endif
                                    </div>

                                    <div class="lower-content">
                                        <div class="author-info clearfix">
                                            <div class="author pull-left">

                                                @if (isset($item->agent_id))
                                                    <a href="{{ route('agent.details', $item->agent_id) }}">
                                                        <figure class="author-thumb">
                                                            <img src="{{ !empty($item['Users']['photo']) ? url('upload/agents/'.$item['Users']['photo']) : url('upload/no_image.jpg') }}" alt="">
                                                        </figure>
                                                        <h6>{{ $item['Users']['name'] }}</h6>
                                                    </a>
                                                @else
                                                    <figure class="author-thumb">
                                                        <img src="{{ url('uplod/no_image.jpg') }}" alt="">
                                                    </figure>
                                                    <h6>Admin</h6>
                                                @endif

                                            </div>
                                            <div class="buy-btn pull-right">
                                                <a href="{{ route('propertyDetail', [$item->id, $item->property_slug]) }}">
                                                    {{ $item['property_status'] }}
                                                </a>
                                            </div>
                                        </div>
                                        <div class="title-text">
                                            <h4>
                                                <a href="{{ route('propertyDetail', [$item->id, $item->property_slug]) }}">
                                                    {{ $item->property_name }}
                                                </a>
                                            </h4>
                                        </div>
                                        <div class="price-box clearfix">
                                            <div class="price-info pull-left">
                                                <h6>A partir de:</h6>
                                                <h4>
                                                    ${{ number_format($item['lowest_price'], 0, ',', ' ') }}
                                                </h4>
                                            </div>
                                            <ul class="other-option pull-right clearfix">
                                                <li>
                                                    <a href="{{ route('propertyDetail', [$item->id, $item->property_slug]) }}">
                                                        <i class="icon-12"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('propertyDetail', [$item->id, $item->property_slug]) }}">
                                                        <i class="icon-13"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>


                                        <p>
                                            @if (strlen($item->short_desc) >= 110)
                                                {!! substr($item['short_desc'], 0, 110).'...' !!}
                                            @else
                                                {!! $item['short_desc'] !!}
                                            @endif
                                        </p>

                                        <ul class="more-details clearfix">
                                            <li>
                                                <i class="icon-14"></i>{{ $item->bedrooms }}
                                            </li>
                                            <li>
                                                <i class="icon-15"></i>
                                                {{ $item['bathrooms'] }}
                                            </li>
                                            <li>
                                                <i class="icon-16"></i>
                                                {{ number_format($item['property_size'], 0, ',', ' ') }}
                                            </li>
                                        </ul>
                                        <div class="btn-box">
                                            <a href="{{ route('propertyDetail', [$item->id, $item->property_slug]) }}" class="theme-btn btn-two">
                                                Voir détails
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endisset

            </div>
        </div>
    </div>
</section>
<!-- property-details end -->


@include('frontend.home.subscribe')

@endsection


