@extends('admin.adminDashboard')

@section('content')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('agent.property.all') }}" class="btn btn-inverse-info">
                <i data-feather="align-justify"></i>
                Afficher propriétés
            </a>
        </ol>
    </nav>

</div>


<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Détail de la propriété</h6>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td>Nom de la propriété</td>
                                <td>
                                    <code>{{ $propertyData->property_name }}</code>
                                </td>
                            </tr>
                            <tr>
                                <td>Statut de la propriété</td>
                                <td>
                                    <code>{{ $propertyData->property_status }}</code>
                                </td>
                            </tr>
                            <tr>
                                <td>Prix minimum</td>
                                <td>
                                    <code>
                                        ${{ number_format($propertyData->lowest_price, 0, ',', ' ') }}
                                    </code>
                                </td>
                            </tr>
                            <tr>
                                <td>Prix maximum</td>
                                <td>
                                    <code>
                                        ${{ number_format($propertyData->max_price, 0, ',', ' ') }}
                                    </code>
                                </td>
                            </tr>
                            <tr>
                                <td>Nombre de chambres</td>
                                <td>
                                    <code>{{ $propertyData->bedrooms }}</code>
                                </td>
                            </tr>
                            <tr>
                                <td>Nombre de salles de bain</td>
                                <td>
                                    <code>{{ $propertyData->bathrooms }}</code>
                                </td>
                            </tr>
                            <tr>
                                <td>Garages</td>
                                <td>
                                    <code>{{ $propertyData->garage }}</code>
                                </td>
                            </tr>
                            <tr>
                                <td>Taille du garage</td>
                                <td>
                                    <code>{{ $propertyData->garage_size }} m2</code>
                                </td>
                            </tr>
                            <tr>
                                <td>Adresse</td>
                                <td>
                                    <code>{{ $propertyData->address }}</code>
                                </td>
                            </tr>
                            <tr>
                                <td>Ville</td>
                                <td>
                                    <code>{{ $propertyData->city }}</code>
                                </td>
                            </tr>
                            <tr>
                                <td>Région / Etat</td>
                                <td>
                                    <code>{{ $propertyData->states->state_name }}</code>
                                </td>
                            </tr>
                            <tr>
                                <td>Code Postal</td>
                                <td>
                                    <code>{{ $propertyData->postal_code }}</code>
                                </td>
                            </tr>
                            <tr>
                                <td>Image principale</td>
                                <td>
                                    <img src="{{ url($propertyData->property_thumbnail) }}" alt="" style="width: 100px; height: 100px;">
                                </td>
                            </tr>
                            <tr>
                                <td>Statut</td>
                                <td>
                                    @if ($propertyData->status == 1)
                                        <span class="badge rounded-pill bg-success">Active</span>
                                    @else
                                        <span class="badge rounded-pill bg-danger">Inactive</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title"></h6>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td>Code de la propriété</td>
                                <td>
                                    <code>{{ $propertyData->property_code }}</code>
                                </td>
                            </tr>
                            <tr>
                                <td>Taille de la propriété</td>
                                <td>
                                    <code>
                                        {{ number_format($propertyData->property_size, 0, ',', ' ') }} m2
                                    </code>
                                </td>
                            </tr>
                            <tr>
                                <td>Vidéo de la propriété</td>
                                <td>
                                    <code>{{ $propertyData->property_video }}</code>
                                </td>
                            </tr>
                            <tr>
                                <td>Quartier / Voisinage</td>
                                <td>
                                    <code>{{ $propertyData->neighborhood }}</code>
                                </td>
                            </tr>
                            <tr>
                                <td>Latitude</td>
                                <td>
                                    <code>{{ $propertyData->latitude }}</code>
                                </td>
                            </tr>
                            <tr>
                                <td>Longitude</td>
                                <td>
                                    <code>{{ $propertyData->longitude }}</code>
                                </td>
                            </tr>
                            <tr>
                                <td>Type de propriété</td>
                                <td>
                                    <code>{{ $propertyData['Types']['type_name'] }}</code>
                                </td>
                            </tr>
                            <tr>
                                <td>Aménités de la propriété</td>
                                <td>
                                    <select name="amenities_id[]" class="js-example-basic-multiple form-select" multiple="multiple" data-width="100%">
                                        @foreach ($amenities as $item)
                                            <option value="{{ $item->amenite_name }}" class="bg-none" {{ in_array($item->amenite_name, $property_ami) ? 'selected' : '' }}>
                                                {{ $item->amenitie_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Agent</td>

                                <td>
                                    @if ($propertyData->agent_id == NULL)
                                        <code>Admin</code>
                                    @else
                                        <code>{{ $propertyData['Users']['name'] }}</code>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <form action="{{ route('agent.property.manage.status') }}" method="post" class="mt-4">
                        @csrf

                        <input type="hidden" name="id" value="{{ $propertyData->id }}">

                        @if ($propertyData->status == 1)
                            <button type="submit" class="btn btn-danger">
                                Désactiver
                            </button>
                        @else
                            <button type="submit" class="btn btn-success">
                                Activer
                            </button>
                        @endif

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
