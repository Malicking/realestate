@extends('admin.adminDashboard')

@section('content')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('amenities.add') }}" class="btn btn-inverse-info">
                Ajouter une aménité
            </a>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Les aménités</h6>
                    
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Aménités</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($amenities as $key => $item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $item->amenitie_name }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('amenities.edit', $item->id) }}" class="btn btn-inverse-warning btn-sm" title="Modifier">
                                                <i data-feather="edit"></i>
                                            </a>
                                            <a href="{{ route('amenities.delete', $item->id) }}" class="btn btn-inverse-danger btn-sm" id="delete" title="Supprimer">
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
