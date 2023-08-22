@extends('frontend.frontend_dashboard')

@section('content')

@php
    $id = Auth::user()->id;
    $userData = App\Models\User::find($id);
@endphp

<!-- Titre de la page Start -->
@section('title')
    Ma liste de souhaits
@endsection
<!-- Titre de la page End -->

<!--Page Title-->
<section class="page-title centred" style="background-image: url({{ !empty($userData->cover_photo) ? url('upload/users/covers/'.$userData->cover_photo) : url('frontend/assets/images/background/page-title-5.jpg') }});">
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>Wishlist </h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home.page') }}">Accueil</a></li>
                <li>Ma wishlist </li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->


<!-- property-page-section -->
<section class="property-page-section property-list">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                <div class="blog-sidebar">
                    <div class="sidebar-widget post-widget">
                        <div class="widget-title">
                            <h4>Wishlist </h4>
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
                <div class="property-content-side">

                    <div class="wrapper list">
                        <div class="deals-list-content list-item">
                            <div class="deals-block-one">

                                @foreach ($wishlist as $item)
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image">
                                            <img src="{{ url($item['properties']['property_thumbnail']) }}" alt="{{ $item['properties']['property_name'] }}">
                                        </figure>
                                        <div class="batch">
                                            <i class="icon-11"></i>
                                        </div>

                                        @if($item['properties']['featured'])
                                            <span class="category">En vedette</span>
                                        @elseif ($item['properties']['hot'])
                                            <span class="category text-primary">
                                                En vente rapide
                                            </span>
                                        @endif

                                        <div class="buy-btn" style="margin-left: 5%">
                                            <a href="property-details.html">{{ $item['properties']['property_status'] }}</a>
                                        </div>
                                    </div>
                                    <div class="lower-content">
                                        <div class="title-text">
                                            <h4>
                                                <a href="property-details.html">
                                                    {{ $item['properties']['property_name'] }}
                                                </a>
                                            </h4>
                                        </div>
                                        <div class="price-box clearfix">
                                            <div class="price-info pull-left">
                                                <h6>A partir de: </h6>
                                                <h4>
                                                    ${{ number_format($item['properties']['lowest_price'], 0, ',', ' ') }}
                                                </h4>
                                            </div>
                                        </div>

                                        <ul class="more-details clearfix">
                                            <li><i class="icon-14"></i>
                                                {{ $item['properties']['bedrooms'] }}
                                            </li>
                                            <li><i class="icon-15"></i>{{ $item['properties']['bathrooms'] }}</li>
                                            <li>
                                                <i class="icon-16"></i>
                                                {{ number_format($item['properties']['property_size'], 0, ',', ' ') }} m2
                                            </li>
                                        </ul>
                                        <div class="other-info-box clearfix">
                                            <div class="btn-box pull-left">
                                                <a href="{{ route('propertyDetail', [$item['properties']['id'], $item['properties']['property_slug']]) }}" class="theme-btn btn-two">
                                                    Voir détails
                                                </a>
                                            </div>

                                            @php
                                                $u_id = Auth::id();
                                                $compare = App\Models\Compare::where(['user_id' => $u_id, 'property_id' => $item->id])->first();
                                            @endphp

                                            <ul class="other-option pull-right clearfix">
                                                <li>
                                                    @if ($compare && $compare != NULL)
                                                        <a href="{{ route('compare.remove', $item->id) }}">
                                                            <i class="icon-12 text-danger"></i>
                                                        </a>
                                                    @else
                                                        <a href="{{ route('compare.add', $item->id) }}" title="Comparer">
                                                            <i class="icon-12"></i>
                                                        </a>
                                                    @endif
                                                </li>
                                                <li>
                                                    <a href="{{ route('rm_from_wishlist', $item['properties']['id']) }}">
                                                        <i class="fa fa-trash text-danger"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- property-page-section end -->

<!-- subscribe-section -->
@include('frontend.home.subscribe')
<!-- subscribe-section end -->

@endsection

