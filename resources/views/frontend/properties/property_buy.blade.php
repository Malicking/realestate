@extends('frontend.frontend_dashboard')

@section('content')

<!-- Titre de la page Start -->
@section('title')
    Propriétés en vente
@endsection
<!-- Titre de la page End -->

<!--Page Title-->
<section class="page-title-two bg-color-1 centred">
    <div class="pattern-layer">
        <div class="pattern-1" style="background-image: url(assets/images/shape/shape-9.png);"></div>
        <div class="pattern-2" style="background-image: url(assets/images/shape/shape-10.png);"></div>
    </div>
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>Nos propriétés</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home.page') }}">Accueil</a></li>
                <li>Propriétés en vente</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->


<!-- property-page-section -->
<section class="property-page-section property-list">
    <div class="auto-container">
        <div class="row clearfix">

            <!-- recherche -->
            @include('frontend.properties._side_search')
            <!-- recherche -->

            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="property-content-side">
                    <div class="item-shorting clearfix">
                        <div class="left-column pull-left">
                            <h5>{{ count($buyProps) }} <span>résultats trouvés</span></h5>
                        </div>
                    </div>
                    <div class="wrapper list">
                        <div class="deals-list-content list-item">

                            @foreach ($buyProps as $item)
                            <div class="deals-block-one">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <a href="{{ route('propertyDetail', [$item->id, $item->property_slug]) }}">
                                            <figure class="image">
                                                <img src="{{ url($item->property_thumbnail) }}" alt="" style="width: 300px; height: 350px;">
                                            </figure>
                                        </a>
                                        <div class="batch"><i class="icon-11"></i></div>

                                        @if ($item->featured)
                                            <span class="category" style="font-size: 9px;">
                                                En vedette
                                            </span>
                                        @elseif ($item->hot)
                                            <span class="category bg-success" style="font-size: 9px;">
                                                Vente rapide
                                            </span>
                                        @endif

                                        <div class="buy-btn">
                                            <a href="#" style="font-size:9px;">
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
                                                <h6>A partir de</h6>
                                                <h4>
                                                    ${{ number_format($item->lowest_price, 0, ',', ' ') }}
                                                </h4>
                                            </div>
                                            <div class="author-box pull-right">
                                                <a href="{{ route('agent.details', $item['users']['id']) }}">
                                                    <figure class="author-thumb">

                                                        @if ($item->agent_id)
                                                            <img src="{{ !empty($item->users->photo) ? url('upload/agents/'.$item['users']['photo']) : url('upload/no_image.jpg') }}" alt="">
                                                            <span style="font-size: 11px;">
                                                                {{ $item['users']['name'] }}
                                                            </span>
                                                        @else
                                                            <img src="{{ url('upload/no_image.jpg') }}" alt="">
                                                            <span>Admin</span>
                                                        @endif

                                                    </figure>
                                                </a>
                                            </div>
                                        </div>
                                        <p>
                                            @if (strlen($item->short_desc > 70))
                                                {{ substr($item->short_desc, 0, 70).'...' }}
                                            @else
                                                {{ $item->short_desc }}
                                            @endif
                                        </p>
                                        <ul class="more-details clearfix">
                                            <li><i class="icon-14"></i>{{ $item->bedrooms }}</li>
                                            <li><i class="icon-15"></i>{{ $item->bathrooms }}</li>
                                            <li>
                                                <i class="icon-16"></i>
                                                {{ number_format($item->property_size, 0, ',', ' ') }} m2
                                            </li>
                                        </ul>
                                        <div class="other-info-box clearfix">
                                            <div class="btn-box pull-left">
                                                <a href="{{ route('propertyDetail', [$item->id, $item->property_slug]) }}" class="theme-btn btn-two">Voir détails</a>
                                            </div>
                                            <ul class="other-option pull-right clearfix">

                                                @auth

                            @php
                                $u_id = Auth::id();

                                $wished = App\Models\Wishlist::where('property_id', $item->id)->where('user_id', $u_id)->first();

                                $compare = App\Models\Compare::where(['property_id' => $item->id, 'user_id' => $u_id])->first();
                            @endphp

                                                <li>
                                                    @if ($wished)
                                                        <a href="{{ route('rm_from_wishlist', $item->id) }}">
                                                            <i class="icon-12 text-danger"></i>
                                                        </a>
                                                    @else
                                                        <a href="{{ route('add_to_wishlist', $item->id) }}">
                                                            <i class="icon-12"></i>
                                                        </a>
                                                    @endif
                                                </li>

                                                <li>
                                                    @if ($compare)
                                                        <a href="{{ route('compare.remove', $item->id) }}">
                                                            <i class="icon-13 text-danger"></i>
                                                        </a>
                                                    @else
                                                        <a href="{{ route('compare.add', $item->id) }}">
                                                            <i class="icon-13"></i>
                                                        </a>
                                                    @endif
                                                </li>
                                                @endauth

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>

                    <div class="pagination-wrapper">
                        {{ $buyProps->links('vendor.pagination.custom') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- property-page-section end -->

@include('frontend.home.subscribe')

@endsection


