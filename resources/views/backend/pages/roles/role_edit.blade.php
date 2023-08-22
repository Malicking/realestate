@extends('admin.adminDashboard')

@section('content')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('roles.all') }}" class="btn btn-inverse-info">
                <i data-feather="align-justify"></i>
                Afficher les rôles
            </a>
        </ol>
    </nav>

    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Modifier un rôle</h6>
                        <hr>

                        <form id="myForm" class="forms-sample" method="POST" action="{{ route('roles.update') }}">
                            @csrf

                            <input type="hidden" name="id" value="{{ $role->id }}">

                            <div class="form-group mb-3">
                                <label for="RoleName" class="form-label">
                                    Rôle
                                </label>
                                <input type="text" name="name" class="form-control" id="RoleName" autocomplete="off" autofocus value="{{ $role->name }}" placeholder="Entrez le nom du rôle...">
                            </div>
                            
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary me-2 px-5">
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


<!-- Validation du formulaire -->
<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                name: {
                    required : true,
                },
                group_name: {
                    required : true,
                },
                
            },
            messages :{
                name: {
                    required : 'Veuillez entrer le nom du rôle',
                },

            },
            errorElement : 'span',
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });

</script>
<!-- Validation du formulaire -->


@endsection

