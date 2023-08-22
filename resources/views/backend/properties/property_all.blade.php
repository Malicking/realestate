@extends('admin.adminDashboard')

@section('content')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('property.add') }}" class="btn btn-inverse-info">
                <i data-feather="plus"></i> 
                Ajouter une propriété
            </a>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Les propriétés</h6>
                    
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Images</th>
                                    <th>Propriétés</th>
                                    <th>Types propriétés</th>
                                    <th>Statuts (Type)</th>
                                    <th>Villes</th>
                                    <th>Code</th>
                                    <th>Statuts</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($properties as $key => $item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>
                                            <img src="{{ asset($item->property_thumbnail) }}" alt="{{ $item->property_name }}" style="width: 50px; height: 50px;">
                                        </td>
                                        <td>{{ $item->property_name }}</td>
                                        <td>{{ $item['Types']['type_name'] }}</td>
                                        <td>{{ $item->property_status }}</td>
                                        <td>{{ $item->city }}</td>
                                        <td>{{ $item->property_code }}</td>
                                        <td>
                                            @if ($item->status == 1)
                                                <span class="badge rounded-pill bg-success">Active</span>
                                            @else
                                                <span class="badge rounded-pill bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        
                                        <td class="text-center">
                                            <a href="{{ route('property.detail', $item->id) }}" class="btn btn-inverse-info btn-sm" title="Détails">
                                                <i data-feather="eye"></i>
                                            </a>
                                            <a href="{{ route('property.edit', $item->id) }}" class="btn btn-inverse-warning btn-sm" title="Modifier">
                                                <i data-feather="edit"></i>
                                            </a>
                                            <a href="{{ route('property.delete', $item->id) }}" class="btn btn-inverse-danger btn-sm" id="delete" title="Supprimer">
                                                <i data-feather="trash-2"></i>
                                            </a>
                                        </td>
                                    </tr>                                  
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

