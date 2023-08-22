@extends('admin.adminDashboard')

@section('content')

<div class="page-content">

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="position-relative">
                    <figure class="overflow-hidden mb-0 d-flex justify-content-center">
                        <img src="{{ (!empty($profileData->cover_photo) ? (url('upload/admin/covers/'.$profileData->cover_photo)) : url('upload/cover_default.png')) }}" class="rounded-top" alt="profile cover">
                    </figure>
                    <div class="d-flex justify-content-between align-items-center position-absolute top-90 w-100 px-2 px-md-4 mt-n4">
                        <div>
                            <img class="wd-80 rounded-circle" src="{{ !empty($profileData->photo) ? url('upload/admin/'.$profileData->photo) : url('upload/no_image.jpg') }}" alt="profile">
                            <span class="h4 ms-3 text-dark rounded bg-white p-2 fw-bolder">
                                {{ $profileData->name }}
                            </span>
                        </div>
                        <div class="d-none d-md-block">
                            <button class="btn btn-primary btn-icon-text">
                                <i data-feather="edit" class="btn-icon-prepend"></i> 
                                Editer mon compte
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row profile-body">
        <!-- left wrapper start -->
        <div class="d-none d-md-block col-md-4 col-xl-4 left-wrapper">
            <div class="card rounded">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-2 bg-white rounded">
                        <div class="py-3">
                            <span class="h4 ms-3 text-dark fw-bolder">
                                {{ $profileData->name }}
                            </span>
                        </div>
                    </div> 
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">
                            Nom d'utilisateur: 
                        </label>
                        <p class="text-muted">{{ $profileData->username }}</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Email:</label>
                        <p class="text-muted">{{ $profileData->email }}</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">
                            Téléphone: 
                        </label>
                        <p class="text-muted">{{ $profileData->phone }}</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Adresse:</label>
                        <p class="text-muted">{{ $profileData->address }}</p>
                    </div>
                    <div class="mt-3 d-flex social-links">
                        <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                            <i data-feather="linkedin"></i>
                        </a>
                        <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                            <i data-feather="facebook"></i>
                        </a>
                        <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                            <i data-feather="twitter"></i>
                        </a>
                        <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                            <i data-feather="instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- left wrapper end -->
        <!-- middle wrapper start -->
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">      
                        <h6 class="card-title">Changer de mot de passe</h6>
                        <hr>
                        
                        <form class="forms-sample" method="POST" action="{{ route('admin.update.password') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="exampleInputOldPwd" class="form-label">
                                    Mot de passe actuel
                                </label>
                                <input type="password" name="old_password" class="form-control @error('old_password')
                                    is-invalid
                                @enderror" id="exampleInputOldPwd" autocomplete="off" placeholder="Entrez votre mot de passe...">

                                @error('old_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleInputNewPwd" class="form-label">
                                            Nouveau mot de passe
                                        </label>
                                        <input type="password" name="new_password" class="form-control @error('new_password')
                                            is-invalid
                                        @enderror" id="exampleInputNewPwd" autocomplete="off" placeholder="Entrez votre nouveau mot de passe...">

                                        @error('new_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleInputConfirmPwd" class="form-label">
                                            Confirmation du mot de passe
                                        </label>
                                        <input type="password" name="confirm_password" class="form-control @error('confirm_password')
                                            is-invalid
                                        @enderror" id="exampleInputConfirmPwd" autocomplete="off" placeholder="Confirmez le nouveau mot de passe...">
                                        
                                        @error('confirm_password')
                                            <span class="text-danger">{{ $message }}</span>
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

