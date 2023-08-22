@extends('admin.adminDashboard')

@section('content')

<div class="page-content">

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="position-relative">
                    <figure class="overflow-hidden mb-0 d-flex justify-content-center">
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
                        <h6 class="card-title">Actualiser mon compte</h6>
                        
                        <form class="forms-sample" method="POST" action="{{ route('admin.profile.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleInputName" class="form-label">
                                            Nom complet
                                        </label>
                                        <input type="text" name="name" value="{{ $profileData->name }}" class="form-control" id="exampleInputName" autocomplete="off" placeholder="Entrez votre nom...">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleInputUsername1" class="form-label">
                                            Nom d'utilisateur
                                        </label>
                                        <input type="text" name="username" value="{{ $profileData->username }}" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Entrez votre nom d'utilisateur...">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">
                                            Adresse email
                                        </label>
                                        <input type="email" name="email" value="{{ $profileData->email }}" class="form-control" id="exampleInputEmail1" placeholder="Entrez votre email...">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleInputPhone" class="form-label">
                                            Téléphone
                                        </label>
                                        <input type="text" name="phone" value="{{ $profileData->phone }}" class="form-control" id="exampleInputPhone" placeholder="Entrez votre téléphone...">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="exampleInputAddress" class="form-label">
                                    Adresse
                                </label>
                                <input type="text" name="address" value="{{ $profileData->address }}" class="form-control" id="exampleInputAddress" placeholder="Entrez votre adresse...">
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="image" class="form-label">
                                            Nouvelle photo de profil
                                        </label>
                                        <input type="file" name="photo" value="{{ $profileData->photo }}" id="image">
                                    </div>

                                    <div class="mb-3">
                                        <img class="wd-80 rounded" style="height: 75px;" src="{{ !empty($profileData->photo) ? url('upload/admin/'.$profileData->photo) : url('upload/no_image.jpg') }}" alt="profile" id="showImage">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="coverImg" class="form-label">
                                            Nouvelle photo de couverture
                                        </label>
                                        <input type="file" name="cover_photo" value="{{ $profileData->photo }}" id="coverImg">
                                    </div>

                                    <div class="mb-3">
                                        <img class="wd-80 rounded" style="height: 75px;" src="{{ !empty($profileData->cover_photo) ? url('upload/admin/covers/'.$profileData->cover_photo) : url('upload/cover_default.png') }}" alt="profile" id="showCoverImg">
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


<!-- affichage automatique de l'image (profil) -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#image').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

<!-- affichage automatique de l'image (profil) -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#coverImg').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showCoverImg').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>


@endsection

