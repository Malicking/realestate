@extends('admin.adminDashboard')

@section('content')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="#" class="btn btn-inverse-info">
                <i data-feather="align-justify"></i>
                Paramètres Site
            </a>
        </ol>
    </nav>

    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Modifier les paramètres du site</h6>
                        <hr>

                        <form class="forms-sample" method="POST" action="{{ route('site.update', $setting->id) }}" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="id" value="{{ $setting->id }}">

                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label">
                                        Logo
                                    </label>
                                    <input type="file" name="logo" class="form-control mb-3" onchange="logoImgUrl(this)">
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <img src="{{ !empty($setting->logo) ? url($setting->logo) : url('upload/no_image.jpg') }}" id="logoImg" style="width: 150px;">
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <label for="Host" class="form-label">
                                        Téléphone
                                    </label>
                                    <input type="text" name="support_phone" class="form-control" id="Host" autocomplete="off" autofocus value="{{ $setting->support_phone }}" placeholder="Entrez le téléphone support...">
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <label for="CompAddress" class="form-label">
                                        Adresse de l'entreprise
                                    </label>
                                    <input type="text" name="company_address" class="form-control" id="CompAddress" autocomplete="off" autofocus value="{{ $setting->company_address }}" placeholder="Entrez l'adresse de l'entreprise...">
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <label for="Email" class="form-label">
                                        Adresse email
                                    </label>
                                    <input type="text" name="email" class="form-control" id="Email" autocomplete="off" autofocus value="{{ $setting->email }}" placeholder="Entrez l'email...">
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <label for="Facebook" class="form-label">
                                        Lien facebook
                                    </label>
                                    <input type="text" name="facebook" class="form-control" id="Facebook" autocomplete="off" autofocus value="{{ $setting->facebook }}" placeholder="Entrez le lien facebook...">
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <label for="Twitter" class="form-label">
                                        Twitter
                                    </label>
                                    <input type="text" name="twitter" class="form-control" id="Twitter" autocomplete="off" autofocus value="{{ $setting->twitter }}" placeholder="Entrez le lien twitter...">
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <label for="Copyright" class="form-label">
                                        Copyright
                                    </label>
                                    <input type="text" name="copyright" class="form-control" id="Copyright" autocomplete="off" autofocus value="{{ $setting->copyright }}" placeholder="Entrez le copyright de l'entreprise...">
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-outline-primary me-2 px-5">
                                    Enregistrer
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


<!-- Affichage de l'image principale (thumbnail) -->
<script type="text/javascript">
    function logoImgUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#logoImg').attr('src', e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<!-- Affichage de l'image principale (thumbnail) -->

@endsection

