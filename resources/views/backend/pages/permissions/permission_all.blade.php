@extends('admin.adminDashboard')

@section('content')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('permission.add') }}" class="btn btn-inverse-info">
                Ajouter un privilège
            </a>
            &nbsp; &nbsp;
            <a href="{{ route('permission.import') }}" class="btn btn-inverse-warning">
                Importer
            </a>
            &nbsp; &nbsp;
            <a href="{{ route('permission.export') }}" class="btn btn-inverse-danger">
                Exporter
            </a>
        </ol>
    </nav>
    
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Les privilèges</h6>

                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Privilèges</th>
                                    <th>Groupes</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($permissions as $key => $item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->group_name }}</td>

                                        <td class="text-center">
                                            <a href="{{ route('permission.edit', $item->id) }}" class="btn btn-inverse-warning btn-sm" title="Modifier">
                                                <i data-feather="edit"></i>
                                            </a>
                                            <a href="{{ route('permission.delete', $item->id) }}" class="btn btn-inverse-danger btn-sm" id="delete" title="Supprimer">
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
