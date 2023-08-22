@extends('admin.adminDashboard')

@section('content')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('permission.export') }}" class="btn btn-inverse-danger">
                <i data-feather="file"></i>
                Exporter en XLSX
            </a>
        </ol>
    </nav>

    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Importation de privilèges</h6>
                        <hr>

                        <form id="myForm" class="forms-sample" method="POST" action="{{ route('permission.import.save') }}" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="form-group mb-3">
                                <label for="PermImport" class="form-label">
                                    Importer un fichier au format XLSX
                                </label>
                                <input type="file" name="import_file" class="form-control" id="PermImport">
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-inverse-warning px-3">
                                    Importer
                                </button>
                            </div>

                        </form>

                    </div>
                  </div>
            </div>
        </div>
        <!-- middle wrapper end -->
    </div>
</div>


@endsection

