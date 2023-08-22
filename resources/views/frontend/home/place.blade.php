@php
    $state_1 = App\Models\State::skip(0)->first();
    $properties_1 = App\Models\Property::where('state_id', $state_1->id)->get();

    $state_2 = App\Models\State::skip(1)->first();
    $properties_2 = App\Models\Property::where('state_id', $state_2->id)->get();

    $state_3 = App\Models\State::skip(2)->first();
    $properties_3 = App\Models\Property::where('state_id', $state_3->id)->get();

    $state_4 = App\Models\State::skip(3)->first();
    $properties_4 = App\Models\Property::where('state_id', $state_4->id)->get();
@endphp


<section class="place-section sec-pad">
    <div class="auto-container">
        <div class="sec-title centred">
            <h5>Les meilleurs emplacements</h5>
            <h2>Les régions les plus sollicitées</h2>
            <p>
                Nous vous présentons ici les zones (régions) les plus convoitées par clients. <br />Découvrez les raisons qui les poussent à les aimer.
            </p>  
        </div>  
        <div class="sortable-masonry">
            <div class="items-container row clearfix">

                <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all illustration brand marketing software">
                    <div class="place-block-one">
                        <div class="inner-box">
                            <figure class="image-box">
                                <img src="{{ !empty($state_1->state_image) ? url($state_1->state_image) : url('upload/no_image.jpg') }}" style="width: 370px; height: 580px;" alt="{{ $state_1->state_name }}">
                            </figure>
                            <div class="text">
                                <h4>
                                    <a href="{{ route('state.details', $state_1->id) }}">
                                        {{ $state_1->state_name }}
                                    </a>
                                </h4>
                                <p>
                                    {{ count($properties_1) }} 

                                    @if (count($properties_1) > 1)
                                        Propriétés                                         
                                    @else
                                        Propriété
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all brand illustration print software logo">
                    <div class="place-block-one">
                        <div class="inner-box">
                            <a href="{{ route('state.details', $state_2->id) }}">
                                <figure class="image-box">
                                    <img src="{{ !empty($state_2->state_image) ? url($state_2->state_image) : url('upload/no_image.jpg') }}" alt="{{ $state_2->state_name }}">
                                </figure>
                            </a>

                            <div class="text">
                                <h4>
                                    <a href="{{ route('state.details', $state_2->id) }}">
                                        {{ $state_2->state_name }}
                                    </a>
                                </h4>
                                <p>
                                    {{ count($properties_2) }} 

                                    @if (count($properties_2) > 1)
                                        Propriétés                                         
                                    @else
                                        Propriété
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all illustration marketing logo">
                    <div class="place-block-one">
                        <div class="inner-box">
                            <a href="{{ route('state.details', $state_3->id) }}">
                                <figure class="image-box">
                                    <img src="{{ !empty($state_3->state_image) ? url($state_3->state_image) : url('upload/no_image.jpg') }}" alt="{{ $state_3->state_name }}">
                                </figure>
                            </a>
                            <div class="text">
                                <h4>
                                    <a href="{{ route('state.details', $state_3->id) }}">
                                        {{ $state_3->state_name }}
                                    </a>
                                </h4>
                                <p>
                                    {{ count($properties_3) }} 

                                    @if (count($properties_3) > 1)
                                        Propriétés                                         
                                    @else
                                        Propriété
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-8 col-md-6 col-sm-12 masonry-item small-column all brand marketing print software">
                    <div class="place-block-one">
                        <div class="inner-box">
                            <a href="{{ route('state.details', $state_4->id) }}">
                                <figure class="image-box">
                                    <img src="{{ !empty($state_4->state_image) ? url($state_4->state_image) : url('upload/no_image.jpg') }}" alt="{{ $state_4->state_name }}" style="width: 770px; height: 275px;">
                                </figure>
                            </a>  
                            <div class="text">
                                <h4>
                                    <a href="{{ route('state.details', $state_4->id) }}">
                                        {{ $state_4->state_name }}
                                    </a>
                                </h4>
                                <p>
                                    {{ count($properties_4) }} 

                                    @if (count($properties_4) > 1)
                                        Propriétés                                         
                                    @else
                                        Propriété  
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>
