@extends('admin.adminDashboard')

@section('content')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('property.type.add') }}" class="btn btn-inverse-info">
                Ajouter un type de propriété
            </a>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Les types de propriétés</h6>
                    
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Types</th>
                                    <th>Icones</th>

                                    @if (Auth::user()->can('property.type.edit') || Auth::user()->can('property.type.delete'))
                                        <th class="text-center">Actions</th> 
                                    @endif
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($types as $key => $item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $item->type_name }}</td>
                                        <td>{{ $item->type_icon }}</td>

                                        <td class="text-center">

                                            @if (Auth::user()->can('property.type.edit'))
                                            <a href="{{ route('property.type.edit', $item->id) }}" class="btn btn-inverse-warning btn-sm" title="Modifier">
                                                <i data-feather="edit"></i>
                                            </a>
                                            @endif
                                                
                                            @if (Auth::user()->can('property.type.delete'))
                                            <a href="{{ route('property.type.delete', $item->id) }}" class="btn btn-inverse-danger btn-sm" id="delete" title="Supprimer">
                                                <i data-feather="trash-2"></i>
                                            </a>
                                            @endif
                                                
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
