@php
    $pTypes = App\Models\PropertyType::limit(5)->get();
@endphp

<section class="category-section centred">
    <div class="auto-container">
        <div class="inner-container wow slideInLeft animated" data-wow-delay="00ms" data-wow-duration="1500ms">
            <ul class="category-list clearfix">

                @foreach ($pTypes as $item)

                @php
                    $property = App\Models\Property::where('ptype_id', $item->id)->get();
                @endphp

                <li>
                    <div class="category-block-one">
                            <a href="{{ route('property.type', $item->id) }}">
                            <div class="inner-box">
                                <div class="icon-box">
                                    <i class="{{ $item->type_icon }}"></i>
                                </div>
                                <p class="pb-3" style="font-weight: bold;">
                                    {{ $item->type_name }}
                                </p>

                    @php
                        $properties = App\Models\Property::where('ptype_id', $item->id)->get();
                    @endphp
                                
                                <span>{{ count($properties) }}</span>
                            </div>
                        </a>
                        </div>
                </li>
                @endforeach

            </ul>

            <div class="more-btn">
                <a href="categories.html" class="theme-btn btn-one">Toutes les categories</a>
            </div>
        </div>
    </div>
</section>


