@extends('frontend.frontend_dashboard')

@section('content')

<!-- Titre de la page Start -->
@section('title')
    Informations de l'agent
@endsection
<!-- Titre de la page End -->

<!--Page Title-->
<section class="page-title centred" style="background-image: url({{ url('frontend/assets/images/background/page-title.jpg') }});">
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>Informations de l'agent</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home.page') }}">Accueil</a></li>
                <li>Informations de l'agent</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->


<!-- agent-details -->
<section class="agent-details">
    <div class="auto-container">
        <div class="agent-details-content">
            <div class="agents-block-one">
                <div class="inner-box mr-0">
                    <figure class="image-box">
                        <img src="{{ !empty($agent->photo) ? url('upload/agents/'.$agent->photo) : url('upload/no_image.jpg') }}" alt="" style="height: 330px; width: 270px;">
                    </figure>
                    <div class="content-box">
                        <div class="upper clearfix">
                            <div class="title-inner pull-left">
                                <h4>{{ $agent->name }}</h4>
                                <span class="designation">Tél: {{ $agent->phone }}</span>
                            </div>
                            <ul class="social-list pull-right clearfix">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                        <div class="text">
                            <p>Success isn’t really that difficult. There is a significant portion of the population here in North America, that actually want and need success to be hard! Why? So they then have a built-in excuse.when things don’t go their way! Pretty sad situation, to say the least. Have some fun and hypnotize yourself to be your very own Ghost of Christmas future”</p>
                        </div>
                        <ul class="info clearfix mr-0">
                            <li>
                                <i class="fab fa fa-envelope"></i>
                                <a href="mailto:{{ $agent->email }}">
                                    {{ $agent->email }}
                                </a>
                            </li>
                            <li>
                                <i class="fab fa fa-phone"></i>
                                <a href="tel:{{ $agent->phone }}">
                                    {{ $agent->phone }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- agent-details end -->


<!-- agents-page-section -->
<section class="agents-page-section agent-details-page">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="agents-content-side tabs-box">
                    <div class="group-title">
                        <h3>Publié par {{ $agent->name }}</h3>
                    </div>
                    <div class="item-shorting clearfix">
                        <div class="left-column pull-left">
                            <div class="tab-btn-box">
                                <ul class="tab-btns tab-buttons centred clearfix">
                                    <li class="tab-btn active-btn" data-tab="#tab-1">Apartments</li>
                                    <li class="tab-btn" data-tab="#tab-2">TownHouse</li>
                                    <li class="tab-btn" data-tab="#tab-3">Office</li>
                                </ul>
                            </div>
                        </div>
                        <div class="right-column pull-right clearfix">
                            <div class="short-box clearfix">
                                <div class="select-box">
                                    <select class="wide">
                                       <option data-display="Sort by: Newest">Sort by: Newest</option>
                                       <option value="1">New Arrival</option>
                                       <option value="2">Top Rated</option>
                                       <option value="3">Offer Place</option>
                                       <option value="4">Most Place</option>
                                    </select>
                                </div>
                            </div>
                            <div class="short-menu clearfix">
                                <button class="list-view on"><i class="icon-35"></i></button>
                                <button class="grid-view"><i class="icon-36"></i></button>
                            </div>
                        </div>
                    </div>


                    <div class="tabs-content">

                        @foreach ($agentProperties as $item)
                        <div class="tab active-tab" id="tab-1">
                            <div class="wrapper list">
                                <div class="deals-list-content list-item">
                                    <div class="deals-block-one">
                                        <div class="inner-box">
                                            <div class="image-box">
                                                <a href="{{ route('propertyDetail', [$item->id, $item->property_slug]) }}">
                                                <figure class="image">
                                                        <img src="{{ url($item->property_thumbnail) }}" alt="" style="width: 300; height:350px;">
                                                    </figure>
                                                </a>
                                                <div class="batch"><i class="icon-11"></i></div>

                                                @if ($item->featured)
                                                    <span class="category"  style="font-size: 9px;">
                                                        En vedette
                                                    </span>
                                                @elseif ($item->hot)
                                                    <span class="category"  style="font-size: 9px;">
                                                        Vente rapide
                                                    </span>
                                                @endif

                                                <div class="buy-btn">
                                                    <a href="{{ route('propertyDetail', [$item->id, $item->property_slug]) }}"  style="font-size: 9px;">
                                                        {{ $item->property_status }}
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="lower-content">
                                                <div class="title-text">
                                                    <h4>
                                                        <a href="{{ route('propertyDetail', [$item->id, $item->property_slug]) }}">
                                                            {{ $item->property_name }}
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div class="price-box clearfix">
                                                    <div class="price-info pull-left">
                                                        <h6>A partir de </h6>
                                                        <h4>
                                                            ${{ number_format($item->lowest_price, 0, ',', ' ') }}
                                                        </h4>
                                                    </div>
                                                    <div class="author-box pull-right">
                                                        <figure class="author-thumb">
                                                            <img src="{{ !empty($item->users->photo) ? url('upload/agents/'.$item['users']['photo']) : url('upload/no_image.jpg') }}" alt="" style="width: 40px; height:40px;">
                                                            <span style="font-size: 11px;">
                                                                {{ $item->users->name }}
                                                            </span>
                                                        </figure>
                                                    </div>
                                                </div>

                                                <p class="text-justify">
                                                    @if (strlen($item->short_desc >= 110))
                                                        {{ substr($item->short_desc, 0, 110).'...' }}
                                                    @else
                                                        {{ $item->short_desc }}
                                                    @endif
                                                </p>

                                                <ul class="more-details clearfix">
                                                    <li>
                                                        <i class="icon-14"></i>
                                                        {{ $item->bedrooms }}
                                                    </li>
                                                    <li>
                                                        <i class="icon-15"></i>
                                                        {{ $item->bathrooms }}
                                                    </li>
                                                    <li>
                                                        <i class="icon-16"></i>
                                    {{ number_format($item['property_size'], 0, ',', ' ') }} m2
                                                    </li>
                                                </ul>
                                                <div class="other-info-box clearfix">
                                                    <div class="btn-box pull-left">
                                                        <a href="{{ route('propertyDetail', [$item->id, $item->property_slug]) }}" class="theme-btn btn-two">
                                                            Voir détails
                                                        </a>
                                                    </div>
                                                    <ul class="other-option pull-right clearfix">
                                                        @php
                                                            $u_id = Auth::id();

                                                            $wished = App\Models\Wishlist::where('property_id', $item->id)->where('user_id', $u_id)->first();

                                                            $compare = App\Models\Compare::where(['property_id' => $item->id, 'user_id' => $u_id])->first();
                                                        @endphp

                                                        <li>
                                                            @isset($u_id)
                                                                @if ($compare)
                                                                    <a href="{{ route('compare.remove', $item->id) }}"
                                                                        title="Supprimer la comparaison">
                                                                        <i class="icon-12 text-danger"></i>
                                                                    </a>
                                                                @else
                                                                    <a href="{{ route('compare.add', $item->id) }}"
                                                                        title="Comparer">
                                                                        <i class="icon-12"></i>
                                                                    </a>
                                                                @endif
                                                            @endisset
                                                        </li>
                                                        <li>
                                                            @isset($u_id)

                                                                @if (isset($wished))
                                                                    <a href="{{ route('rm_from_wishlist', $item->id) }}" class="action-btn @isset($wished)
                                                                        text-danger
                                                                    @endisset" title="Supprimer de la wishlist">
                                                                        <i class="fa fa-trash"></i>
                                                                    </a>
                                                                @else
                                                                    <a href="{{ route('add_to_wishlist', $item->id) }}" class="action-btn" title="Ajouter à la wishlist">
                                                                        <i class="icon-13"></i>
                                                                    </a>
                                                                @endif

                                                            @endisset
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="deals-grid-content">
                                    <div class="row clearfix">
                                        <div class="col-lg-6 col-md-6 col-sm-12 feature-block">
                                            <div class="feature-block-one">
                                                <div class="inner-box">
                                                    <div class="image-box">
                                                        <figure class="image">
                                                            <img src="{{ url('frontend/assets/images/feature/feature-1.jpg') }}" alt="">
                                                        </figure>
                                                        <div class="batch">
                                                            <i class="icon-11"></i>
                                                        </div>
                                                        <span class="category">Featured</span>
                                                    </div>
                                                    <div class="lower-content">
                                                        <div class="author-info clearfix">
                                                            <div class="author pull-left">
                                                                <figure class="author-thumb">
                                                                    <img src="{{ url('frontend/assets/images/feature/author-1.jpg') }}" alt="">
                                                                </figure>
                                                                <h6>Michael Bean</h6>
                                                            </div>
                                                            <div class="buy-btn pull-right">
                                                                <a href="property-details.html">For Buy</a>
                                                            </div>
                                                        </div>
                                                        <div class="title-text">
                                                            <h4>
                                                                <a href="property-details.html">
                                                                    Luxury Villa With Pool
                                                                </a>
                                                            </h4>
                                                        </div>
                                                        <div class="price-box clearfix">
                                                            <div class="price-info pull-left">
                                                                <h6>Start From</h6>
                                                                <h4>$30,000.00</h4>
                                                            </div>
                                                            <ul class="other-option pull-right clearfix">
                                                                <li>
                                                                    <a href="property-details.html">
                                                                        <i class="icon-12"></i>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="property-details.html">
                                                                        <i class="icon-13"></i>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <p>
                                                            Lorem ipsum dolor sit amet consectetur adipisicing sed.
                                                        </p>
                                                        <ul class="more-details clearfix">
                                                            <li>
                                                                <i class="icon-14"></i>3 Beds
                                                            </li>
                                                            <li>
                                                                <i class="icon-15"></i>2 Baths
                                                            </li>
                                                            <li>
                                                                <i class="icon-16"></i>600 Sq Ft
                                                            </li>
                                                        </ul>
                                                        <div class="btn-box">
                                                            <a href="property-details.html" class="theme-btn btn-two">
                                                                See Details
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 feature-block">
                                            <div class="feature-block-one">
                                                <div class="inner-box">
                                                    <div class="image-box">
                                                        <figure class="image">
                                                            <img src="{{ url('frontend/assets/images/feature/feature-2.jpg') }}" alt="">
                                                        </figure>
                                                        <div class="batch">
                                                            <i class="icon-11"></i>
                                                        </div>
                                                        <span class="category">Featured</span>
                                                    </div>
                                                    <div class="lower-content">
                                                        <div class="author-info clearfix">
                                                            <div class="author pull-left">
                                                                <figure class="author-thumb"><img src="{{ url('frontend/assets/images/feature/author-2.jpg') }}" alt=""></figure>
                                                                <h6>Robert Niro</h6>
                                                            </div>
                                                            <div class="buy-btn pull-right">
                                                                <a href="property-details.html">A vendre</a>
                                                            </div>
                                                        </div>
                                                        <div class="title-text">
                                                            <h4>
                                                                <a href="property-details.html">
                                                                    Contemporary Apartment
                                                                </a>
                                                            </h4>
                                                        </div>
                                                        <div class="price-box clearfix">
                                                            <div class="price-info pull-left">
                                                                <h6>Start From</h6>
                                                                <h4>$45,000.00</h4>
                                                            </div>
                                                            <ul class="other-option pull-right clearfix">
                                                                <li>
                                                                    <a href="property-details.html">
                                                                        <i class="icon-12"></i>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="property-details.html">
                                                                        <i class="icon-13"></i>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <p>
                                                            Lorem ipsum dolor sit amet consectetur adipisicing sed.
                                                        </p>
                                                        <ul class="more-details clearfix">
                                                            <li>
                                                                <i class="icon-14"></i>3 Beds
                                                            </li>
                                                            <li>
                                                                <i class="icon-15"></i>2 Baths
                                                            </li>
                                                            <li>
                                                                <i class="icon-16"></i>600 Sq Ft
                                                            </li>
                                                        </ul>
                                                        <div class="btn-box">
                                                            <a href="property-details.html" class="theme-btn btn-two">See Details</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 feature-block">
                                            <div class="feature-block-one">
                                                <div class="inner-box">
                                                    <div class="image-box">
                                                        <figure class="image">
                                                            <img src="{{ url('frontend/assets/images/feature/feature-3.jpg') }}" alt="">
                                                        </figure>
                                                        <div class="batch">
                                                            <i class="icon-11"></i>
                                                        </div>
                                                        <span class="category">Featured</span>
                                                    </div>
                                                    <div class="lower-content">
                                                        <div class="author-info clearfix">
                                                            <div class="author pull-left">
                                                                <figure class="author-thumb">
                                                                    <img src="{{ url('frontend/assets/images/feature/author-3.jpg') }}" alt="">
                                                                </figure>
                                                                <h6>Keira Mel</h6>
                                                            </div>
                                                            <div class="buy-btn pull-right">
                                                                <a href="property-details.html">Sold Out</a>
                                                            </div>
                                                        </div>
                                                        <div class="title-text">
                                                            <h4>
                                                                <a href="property-details.html">Villa on Grand Avenue</a>
                                                            </h4>
                                                        </div>
                                                        <div class="price-box clearfix">
                                                            <div class="price-info pull-left">
                                                                <h6>Start From</h6>
                                                                <h4>$63,000.00</h4>
                                                            </div>
                                                            <ul class="other-option pull-right clearfix">
                                                                <li>
                                                                    <a href="property-details.html">
                                                                        <i class="icon-12"></i>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="property-details.html">
                                                                        <i class="icon-13"></i>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing sed.</p>
                                                        <ul class="more-details clearfix">
                                                            <li>
                                                                <i class="icon-14"></i>3 Beds
                                                            </li>
                                                            <li><i class="icon-15"></i>2 Baths</li>
                                                            <li><i class="icon-16"></i>600 Sq Ft</li>
                                                        </ul>
                                                        <div class="btn-box">
                                                            <a href="property-details.html" class="theme-btn btn-two">See Details</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 feature-block">
                                            <div class="feature-block-one">
                                                <div class="inner-box">
                                                    <div class="image-box">
                                                        <figure class="image">
                                                            <img src="{{ url('frontend/assets/images/feature/feature-4.jpg') }}" alt="">
                                                        </figure>
                                                        <div class="batch">
                                                            <i class="icon-11"></i>
                                                        </div>
                                                        <span class="category">Featured</span>
                                                    </div>
                                                    <div class="lower-content">
                                                        <div class="author-info clearfix">
                                                            <div class="author pull-left">
                                                                <figure class="author-thumb">
                                                                    <img src="{{ url('frontend/assets/images/feature/author-1.jpg') }}" alt="">
                                                                </figure>
                                                                <h6>Michael Bean</h6>
                                                            </div>
                                                            <div class="buy-btn pull-right"><a href="property-details.html">For Buy</a></div>
                                                        </div>
                                                        <div class="title-text">
                                                            <h4>
                                                                <a href="property-details.html">Home in Merrick Way</a>
                                                            </h4>
                                                        </div>
                                                        <div class="price-box clearfix">
                                                            <div class="price-info pull-left">
                                                                <h6>Start From</h6>
                                                                <h4>$30,000.00</h4>
                                                            </div>
                                                            <ul class="other-option pull-right clearfix">
                                                                <li><a href="property-details.html"><i class="icon-12"></i></a></li>
                                                                <li><a href="property-details.html"><i class="icon-13"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing sed.</p>
                                                        <ul class="more-details clearfix">
                                                            <li><i class="icon-14"></i>3 Beds</li>
                                                            <li><i class="icon-15"></i>2 Baths</li>
                                                            <li><i class="icon-16"></i>600 Sq Ft</li>
                                                        </ul>
                                                        <div class="btn-box"><a href="property-details.html" class="theme-btn btn-two">See Details</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 feature-block">
                                            <div class="feature-block-one">
                                                <div class="inner-box">
                                                    <div class="image-box">
                                                        <figure class="image">
                                                            <img src="{{ url('frontend/assets/images/feature/feature-5.jpg') }}" alt="">
                                                        </figure>
                                                        <div class="batch">
                                                            <i class="icon-11"></i>
                                                        </div>
                                                        <span class="category">Featured</span>
                                                    </div>
                                                    <div class="lower-content">
                                                        <div class="author-info clearfix">
                                                            <div class="author pull-left">
                                                                <figure class="author-thumb">
                                                                    <img src="{{ url('frontend/assets/images/feature/author-2.jpg') }}" alt="">
                                                                </figure>
                                                                <h6>Robert Niro</h6>
                                                            </div>
                                                            <div class="buy-btn pull-right"><a href="property-details.html">For Rent</a></div>
                                                        </div>
                                                        <div class="title-text">
                                                            <h4>
                                                                <a href="property-details.html">Apartment in Glasgow</a>
                                                            </h4>
                                                        </div>
                                                        <div class="price-box clearfix">
                                                            <div class="price-info pull-left">
                                                                <h6>Start From</h6>
                                                                <h4>$45,000.00</h4>
                                                            </div>
                                                            <ul class="other-option pull-right clearfix">
                                                                <li><a href="property-details.html"><i class="icon-12"></i></a></li>
                                                                <li><a href="property-details.html"><i class="icon-13"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing sed.</p>
                                                        <ul class="more-details clearfix">
                                                            <li><i class="icon-14"></i>3 Beds</li>
                                                            <li><i class="icon-15"></i>2 Baths</li>
                                                            <li><i class="icon-16"></i>600 Sq Ft</li>
                                                        </ul>
                                                        <div class="btn-box"><a href="property-details.html" class="theme-btn btn-two">See Details</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 feature-block">
                                            <div class="feature-block-one">
                                                <div class="inner-box">
                                                    <div class="image-box">
                                                        <figure class="image">
                                                            <img src="{{ url('frontend/assets/images/feature/feature-6.jpg') }}" alt="">
                                                        </figure>
                                                        <div class="batch">
                                                            <i class="icon-11"></i>
                                                        </div>
                                                        <span class="category">Featured</span>
                                                    </div>
                                                    <div class="lower-content">
                                                        <div class="author-info clearfix">
                                                            <div class="author pull-left">
                                                                <figure class="author-thumb"><img src="{{ url('frontend/assets/images/feature/author-3.jpg') }}" alt=""></figure>
                                                                <h6>Keira Mel</h6>
                                                            </div>
                                                            <div class="buy-btn pull-right">
                                                                <a href="property-details.html">Sold Out</a>
                                                            </div>
                                                        </div>
                                                        <div class="title-text">
                                                            <h4><a href="property-details.html">Family Home For Sale</a>
                                                            </h4>
                                                        </div>
                                                        <div class="price-box clearfix">
                                                            <div class="price-info pull-left">
                                                                <h6>Start From</h6>
                                                                <h4>$63,000.00</h4>
                                                            </div>
                                                            <ul class="other-option pull-right clearfix">
                                                                <li><a href="property-details.html"><i class="icon-12"></i></a></li>
                                                                <li><a href="property-details.html"><i class="icon-13"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing sed.</p>
                                                        <ul class="more-details clearfix">
                                                            <li><i class="icon-14"></i>3 Beds</li>
                                                            <li><i class="icon-15"></i>2 Baths</li>
                                                            <li><i class="icon-16"></i>600 Sq Ft</li>
                                                        </ul>
                                                        <div class="btn-box"><a href="property-details.html" class="theme-btn btn-two">See Details</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                <div class="default-sidebar agent-sidebar">
                    <div class="agents-contact sidebar-widget">
                        <div class="widget-title">
                            <h5>Contacter {{ $agent->name }}</h5>
                        </div>

                        @auth
                            @php
                                $u_id = Auth::user()->id;
                                $userData = App\Models\User::find($u_id);
                            @endphp

                            <div class="form-inner">
                                <form action="{{ route('agent.details.message') }}" method="post" class="default-form">
                                    @csrf

                                    <input type="hidden" name="agent_id" value="{{ $agent->id }}">

                                    <div class="form-group">
                                        <input type="text" name="msg_name" placeholder="Entrez votre nom..." value="{{ $userData->name }}" required="">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="msg_email" placeholder="Entrez votre email..." value="{{ $userData->email }}" required="">
                                    </div>
                                    <div class="form-group">
                                        <input type="tel" name="msg_phone" placeholder="Téléphone..." value="{{ $userData->phone }}" required="">
                                    </div>
                                    <div class="form-group">
                                        <textarea name="message" placeholder="Votre message..."></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="theme-btn btn-one">
                                            Envoyer
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endauth

                    </div>
                    <div class="category-widget sidebar-widget">
                        <div class="widget-title">
                            <h5>Statuts des propriétés</h5>
                        </div>

                        <ul class="category-list clearfix">
                            <li>
                                <a href="{{ route('rent.property') }}">
                                    A louer <span>({{ (count($rentProps)) }})</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('buy.property') }}">
                                    A vendre <span>({{ (count($buyProps)) }})</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="featured-widget sidebar-widget">
                        <div class="widget-title">
                            <h5>Propertiés en vedette</h5>
                        </div>
                        <div class="single-item-carousel owl-carousel owl-theme owl-nav-none dots-style-one">

                            @if($agentProperties)
                                @foreach ($agentProperties as $item)
                                    @if ($item->featured)
                                    <div class="feature-block-one">
                                        <div class="inner-box">
                                            <div class="image-box">
                                                <a href="{{ route('propertyDetail', [$item->id, $item->property_slug]) }}">
                                                    <figure class="image">
                                                        <img src="{{ url($item->property_thumbnail) }}" alt="" style="width: 370px; heigth:250px;">
                                                    </figure>
                                                </a>
                                                <div class="batch"><i class="icon-11"></i></div>
                                                <span class="category">En vedette</span>
                                            </div>
                                            <div class="lower-content">
                                                <div class="title-text">
                                                    <h4>
                                                        <a href="{{ route('propertyDetail', [$item->id, $item->property_slug]) }}">
                                                            {{ $item->property_name }}
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div class="price-box clearfix">
                                                    <div class="price-info">
                                                        <h6>A partir de:</h6>
                                                        <h4>${{ number_format($item->lowest_price, 0, ',', ' ') }}</h4>
                                                    </div>
                                                </div>
                                                <p>
                                                    @if (strlen($item->short_desc >= 60))
                                                        {{ substr($item->short_desc, 0, 60).'...' }}
                                                    @else
                                                        {{ $item->short_desc }}
                                                    @endif
                                                </p>
                                                <div class="btn-box">
                                                    <a href="{{ route('propertyDetail', [$item->id, $item->property_slug]) }}" class="theme-btn btn-two">
                                                        Voir détails
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- agents-page-section end -->

@include('frontend.home.subscribe')

@endsection
