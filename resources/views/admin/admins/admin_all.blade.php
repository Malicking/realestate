@extends('admin.adminDashboard')

@section('content')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('admin.add') }}" class="btn btn-inverse-info">
                <i data-feather="plus"></i> 
                Ajouter un admin
            </a>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Les admins</h6>
                    
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Images</th>
                                    <th>Noms</th>
                                    <th>Emails</th>
                                    <th>Téléphones</th>
                                    <th>Rôles</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($admins as $key => $item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        
                                        <td>
                                            <img src="{{ !empty($item->photo) ? url('upload/admin/'.$item->photo) : url('upload/no_image.jpg') }}" alt="{{ $item->name }}" style="width: 50px; height: 50px;">
                                        </td>

                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone }}</td>

                                        <td>
                                            @foreach ($item->roles as $role)
                                                <span class="badge badge-pill bg-danger">
                                                    {{ $role->name }}
                                                </span>
                                            @endforeach
                                        </td>
                                        
                                        <td class="text-center">
                                            <a href="{{ route('admin.edit', $item->id) }}" class="btn btn-inverse-warning btn-sm" title="Modifier">
                                                <i data-feather="edit"></i>
                                            </a>

                                            <a href="{{ route('admin.delete', $item->id) }}" class="btn btn-inverse-danger btn-sm" id="delete" title="Supprimer">
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

