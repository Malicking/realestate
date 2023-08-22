@php
    $properties = App\Models\Property::where(['status' => 1, 'featured' => 1])
                                    ->latest()->limit(3)->get();
@endphp

<section class="feature-section sec-pad bg-color-1">
    <div class="auto-container">
        <div class="sec-title centred">
            <h5>En vedette</h5>
            <h2>Propriétés en vedette</h2>
            <p>
                Trouver ici nos dernières propriétés en vedette.<br /> Nous faisons tout notre possible pour vous permettre de devenir propriétaire de la demeure de vos rêves et au-délà même.
            </p>
        </div>

        <div class="row clearfix">

            @foreach ($properties as $item)
            <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                <div class="feature-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <a href="{{ route('propertyDetail', [$item->id, $item->property_slug]) }}">
                                <figure class="image">
                                    <img src="{{ url($item->property_thumbnail) }}" alt="">
                                </figure>
                            </a>
                            <div class="batch">
                                <i class="icon-11"></i>
                            </div>
                            <span class="category">En vedette</span>
                        </div>

                        <div class="lower-content">
                            <div class="author-info clearfix">
                                <div class="author pull-left">
                                    @if ($item->agent_id)
                                        <figure class="author-thumb">
                                            <img src="{{ !empty($item['Users']['photo']) ? url('upload/agents/'.$item->Users->photo) : url('upload/no_image.jpg') }}" alt="">
                                        </figure>
                                        <h6>{{ $item['Users']['name'] }}</h6>
                                    @else
                                        <figure class="author-thumb">
                                            <img src="{{ url('upload/no_image.jpg') }}" alt="">
                                        </figure>
                                        <h6>Admin</h6>
                                    @endif

                                </div>
                                <div class="buy-btn pull-right">
                                    <a href="@if ($item->property_status == 'A vendre')
                                        {{ route('buy.property') }}
                                    @else
                                        {{ route('rent.property') }}
                                    @endif">
                                        {{ $item->property_status }}
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
                                    <h6>A partir de</h6>
                                    <h4>
                                        ${{ number_format($item->lowest_price, 0, ',', ' ') }}
                                    </h4>
                                </div>
                                <ul class="other-option pull-right clearfix">
                                    
                                    @php
                                        $u_id = Auth::id();

                                        $wished = App\Models\Wishlist::where('property_id', $item->id)->where('user_id', $u_id)->first();

                                        $compare = App\Models\Compare::where(['property_id' => $item->id, 'user_id' => $u_id])->first();
                                    @endphp

                                    @isset($u_id)
                                    <li>
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
                                    </li>
                                    <li>
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
                                    </li>
                                    @endisset
                                </ul>
                            </div>

                            <p>
                                @if (strlen($item->short_desc >= 110))
                                    {{ substr($item->short_desc, 0, 110).'...' }}
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

                            <div class="btn-box">
                                <a href="{{ route('propertyDetail', [$item->id, $item->property_slug]) }}" class="theme-btn btn-two">
                                    <i data-feather="eye"></i>
                                    Voir plus
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>

        <div class="more-btn centred">
            <a href="property-list.html" class="theme-btn btn-one">View All Listing</a>
        </div>
    </div>
</section>
