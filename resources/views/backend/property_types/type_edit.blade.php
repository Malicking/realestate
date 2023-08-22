@extends('admin.adminDashboard')

@section('content')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('property.type.all') }}" class="btn btn-inverse-info">
                <i data-feather="align-justify"></i>
                Afficher les types de propriétés
            </a>
        </ol>
    </nav>
    
    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">      
                        <h6 class="card-title">Editer un type de propriété</h6>
                        <hr>
                        
                        <form class="forms-sample" method="POST" action="{{ route('property.type.update') }}">
                            @csrf

                            <input name="id" type="hidden" value="{{ $typeData->id }}">

                            <div class="row">
                                <div class="col-md-7">
                                    <div class="mb-3">
                                        <label for="TypeName" class="form-label">
                                            Type de propriété
                                        </label>
                                        <input type="text" name="type_name" value="{{ $typeData->type_name }}" class="form-control @error('type_name')
                                            is-invalid
                                        @enderror" id="TypeName" autocomplete="off" placeholder="Entrez le type de propriété...">
        
                                        @error('type_name')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="mb-3">
                                        <label for="TypeIcon" class="form-label">
                                            Icone du type
                                        </label>
                                        <input type="text" name="type_icon" value="{{ $typeData->type_icon }}" class="form-control @error('type_icon')
                                            is-invalid
                                        @enderror" id="TypeIcon" autocomplete="off" placeholder="Entrez une icône du type de propriété...">
                                        
                                        @error('type_icon')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary me-2 px-5">
                                    Enregistrer
                                </button>
                                {{-- <button class="btn btn-secondary">Annuler</button> --}}
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

