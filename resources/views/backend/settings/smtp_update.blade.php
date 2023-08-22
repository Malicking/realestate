@extends('admin.adminDashboard')

@section('content')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="#" class="btn btn-inverse-info">
                <i data-feather="align-justify"></i>
                Paramètres SMTP
            </a>
        </ol>
    </nav>

    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Modifier les paramètres SMTP</h6>
                        <hr>

                        <form class="forms-sample" method="POST" action="{{ route('smtp.update', $setting->id) }}">
                            @csrf

                            <input type="hidden" name="id" value="{{ $setting->id }}">

                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label for="Mailer" class="form-label">
                                        Mailer
                                    </label>
                                    <input type="text" name="mailer" class="form-control" id="Mailer" autocomplete="off" autofocus value="{{ $setting->mailer }}" placeholder="Entrez le mailer...">
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <label for="Host" class="form-label">
                                        Host
                                    </label>
                                    <input type="text" name="host" class="form-control" id="Host" autocomplete="off" autofocus value="{{ $setting->host }}" placeholder="Entrez l'host...">
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <label for="Port" class="form-label">
                                        Port
                                    </label>
                                    <input type="text" name="port" class="form-control" id="Port" autocomplete="off" autofocus value="{{ $setting->port }}" placeholder="Entrez le port...">
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <label for="Username" class="form-label">
                                        Username
                                    </label>
                                    <input type="text" name="username" class="form-control" id="Username" autocomplete="off" autofocus value="{{ $setting->username }}" placeholder="Entrez le username...">
                                </div>
                                
                                <div class="col-sm-6 mb-3">
                                    <label for="Pwd" class="form-label">
                                        Password
                                    </label>
                                    <input type="text" name="password" class="form-control" id="Pwd" autocomplete="off" autofocus value="{{ $setting->password }}" placeholder="Entrez le mot de passe...">
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <label for="Encryption" class="form-label">
                                        Encryption
                                    </label>
                                    <input type="text" name="encryption" class="form-control" id="Encryption" autocomplete="off" autofocus value="{{ $setting->encryption }}" placeholder="Entrez l'encryption...">
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <label for="FromAddress" class="form-label">
                                        From Address
                                    </label>
                                    <input type="text" name="from_address" class="form-control" id="FromAddress" autocomplete="off" autofocus value="{{ $setting->from_address }}" placeholder="Entrez l'adresse de provenance...">
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

