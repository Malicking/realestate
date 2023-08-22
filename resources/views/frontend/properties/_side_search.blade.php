@php
    $states = App\Models\State::orderBy('state_name', 'ASC')->get();
    $ptypes = App\Models\PropertyType::orderBy('type_name', 'ASC')->get();
@endphp

<div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
    <div class="default-sidebar property-sidebar">

        <form action="{{ route('all.property.search') }}" method="POST">
            @csrf

            <div class="filter-widget sidebar-widget">
                <div class="widget-title">
                    <h5>Propriétés</h5>
                </div>
                <div class="widget-content">
                    <div class="select-box">
                        <select name="property_status" class="wide">
                           <option data-display="Statuts">Statuts</option>
                           <option value="A louer">A louer</option>
                           <option value="A vendre">A vendre</option>
                        </select>
                    </div>

                    <div class="select-box">
                        <select name="ptype_id" class="wide">
                            <option data-display="Sélectionner le type" selected disabled>
                                Sélectionner le type
                            </option>

                            @foreach ($ptypes as $item)
                            <option value="{{ $item->type_name }}">{{ $item->type_name }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="select-box">
                        <select name="state_id" class="wide">
                            <option data-display="Sélectionner l'emplacement" selected disabled>
                                Sélectionner l'emplacement
                            </option>

                            @foreach ($states as $item)
                            <option value="{{ $item->state_name }}">{{ $item->state_name }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="select-box">
                        <select name="bedrooms" class="wide">
                            <option data-display="Nombre max de chambres">
                                Nombre max de chambres
                            </option>
                            <option value="1">1 Chambre</option>
                            <option value="2">2 Chambres</option>
                            <option value="3">3 Chambres</option>
                            <option value="4">4 Chambres</option>
                            <option value="5">5 Chambres</option>
                        </select>
                    </div>

                    <div class="select-box">
                        <select name="bathrooms" class="wide">
                            <option data-display="Nombre max. de salles de bain">
                                Nombre max. de salles de bain
                            </option>
                            <option value="1">1 salle de bain</option>
                            <option value="2">2 salles de bain</option>
                            <option value="3">3 salles de bain</option>
                            <option value="4">4 salles de bain</option>
                            <option value="5">5 salles de bain</option>
                        </select>
                    </div>

                    <div class="filter-btn">
                        <button type="submit" class="theme-btn btn-one"><i class="fas fa-filter"></i>&nbsp;Filtrer</button>
                    </div>
                </div>
            </div>
        </form>


        <div class="price-filter sidebar-widget">
            <div class="widget-title">
                <h5>Sélectionner l'intervalle de prix</h5>
            </div>
            <div class="range-slider clearfix">
                <div class="clearfix">
                    <div class="input">
                        <input type="text" class="property-amount" name="field-name" readonly="">
                    </div>
                </div>
                <div class="price-range-slider"></div>
            </div>
        </div>
        <div class="category-widget sidebar-widget">
            <div class="widget-title">
                <h5>Statuts</h5>
            </div>
            <ul class="category-list clearfix">
                
                @php
                    $rentProps = App\Models\Property::where(['status' => 1, 'property_status' => 'A louer'])->latest()->get();
                    $buyProps = App\Models\Property::where(['status' => 1, 'property_status' => 'A vendre'])->latest()->get();
                @endphp

                <li>
                    <a href="{{ route('rent.property') }}">A louer
                        <span>({{ count($rentProps) }})</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('buy.property') }}">A vendre
                        <span>({{ count($buyProps) }})</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
