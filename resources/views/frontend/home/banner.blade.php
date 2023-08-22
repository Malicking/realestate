@php
    $states = App\Models\State::orderBy('state_name', 'ASC')->get();
    $ptypes = App\Models\PropertyType::orderBy('type_name', 'ASC')->get();
@endphp


<!-- banner-section -->
<section class="banner-section" style="background-image: url({{ url('frontend/assets/images/banner/banner-1.jpg') }});">
    <div class="auto-container">
        <div class="inner-container">
            <div class="content-box centred">
                <h2>Créez une richesse durable grâce à <br>MalickRoi</h2>
                <p>
                    Devenir propriétaire de la maison de vos rêves devient une réalité pour vous.
                </p>
            </div>
            <div class="search-field">
                <div class="tabs-box">
                    <div class="tab-btn-box">
                        <ul class="tab-btns tab-buttons centred clearfix">
                            <li class="tab-btn active-btn" data-tab="#tab-1">VENTE</li>
                            <li class="tab-btn" data-tab="#tab-2">LOCATION</li>
                        </ul>
                    </div>
                    <div class="tabs-content info-group">
                        <div class="tab active-tab" id="tab-1">
                            <div class="inner-box">
                                <div class="top-search">
                                    <form action="{{ route('buy.property.search') }}" method="post" class="search-form">
                                        @csrf

                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-12 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Rechercher un propriété</label>
                                                    <div class="field-input">
                                                        <i class="fas fa-search"></i>
                                                        <input type="search" name="search" placeholder="Recherche par le nom, l'emplacement..." required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Emplacement</label>
                                                    <div class="select-box">
                                                        <i class="far fa-compass"></i>
                                                        <select name="state_id" class="wide">
                                                            <option data-display="Entrez un emplacement">Entrez un emplacement</option>

                                                            @foreach ($states as $item)
                                                                <option value="{{ $item->state_name }}">
                                                                    {{ $item->state_name }}
                                                                </option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Type de propriété</label>
                                                    <div class="select-box">
                                                        <select name="ptype_id" class="wide">
                                                           <option data-display="Tous les types">Tous les types</option>

                                                           @foreach ($ptypes as $item)
                                                           <option value="{{ $item->type_name }}">{{ $item->type_name }}</option>
                                                           @endforeach

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="search-btn">
                                            <button type="submit">
                                                <i class="fas fa-search"></i>Rechercher
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab" id="tab-2">
                            <div class="inner-box">
                                <div class="top-search">
                                    <form action="{{ route('rent.property.search') }}" method="post" class="search-form">
                                        @csrf

                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-12 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Rechercher un propriété</label>
                                                    <div class="field-input">
                                                        <i class="fas fa-search"></i>
                                                        <input type="search" name="search" placeholder="Recherche par le nom, l'emplacement..." required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Emplacement</label>
                                                    <div class="select-box">
                                                        <i class="far fa-compass"></i>
                                                        <select name="state_id" class="wide">
                                                            <option data-display="Entrez un emplacement">Entrez un emplacement</option>

                                                            @foreach ($states as $item)
                                                                <option value="{{ $item->state_name }}">
                                                                    {{ $item->state_name }}
                                                                </option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Type de propriété</label>
                                                    <div class="select-box">
                                                        <select name="ptype_id" class="wide">
                                                           <option data-display="Tous les types">Tous les types</option>

                                                           @foreach ($ptypes as $item)
                                                           <option value="{{ $item->type_name }}">{{ $item->type_name }}</option>
                                                           @endforeach

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="search-btn">
                                            <button type="submit">
                                                <i class="fas fa-search"></i>Rechercher
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
    </div>
</section>
<!-- banner-section end -->
