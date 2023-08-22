@extends('admin.adminDashboard')

@section('content')

<style>
    .form-check-label {
        text-transform: capitalize;
    }
</style>

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('roles.permission.all') }}" class="btn btn-inverse-info">
                <i data-feather="align-justify"></i>
                Afficher les affectations de privilèges
            </a>
        </ol>
    </nav>

    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Ajout des privilèges à un rôle</h6>
                        <hr>

                        <form id="myForm" class="forms-sample" method="POST" action="{{ route('roles.permission.store') }}">
                            @csrf

                            <div class="form-group mb-5">
                                <label class="form-label" for="GroupName">
                                    Rôle
                                </label>
                                <select name="role_id" id="GroupName" class="form-select">
                                    <option selected disabled>
                                        Choisissez le rôle...
                                    </option>
                                    
                                    @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                        
                                </select>
                            </div>
                           
                            <div class="form-check mb-5">
                                <input type="checkbox" class="form-check-input" id="AllPerms">
                                <label class="form-check-label" for="AllPerms">
                                    Tous les privilèges
                                </label>
                            </div>

                            <hr>

                            @foreach ($permission_groups as $grp) 
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" id="Grp{{ $grp->group_name }}">
                                        <label class="form-check-label" for="Grp{{ $grp->group_name }}">
                                            {{ $grp->group_name }}
                                        </label>
                                    </div>
                                </div>

            @php
                $permissions = App\Models\User::getpermissionByGroupName($grp->group_name);
            @endphp

                                <div class="col-9">
                                    @foreach ($permissions as $perm)
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" id="checkChecked{{ $perm->id }}" name="permission[]" value="{{ $perm->id }}">
                                        <label class="form-check-label" for="checkChecked{{ $perm->id }}">
                                            {{ $perm->name }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                    
                            </div>

                            <br>
                            @endforeach


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


<script type="text/javascript">
    $('#AllPerms').click(function (){

        if ($(this).is(':checked')) {
            $('input[type=checkbox]').prop('checked', true);
        } else {
            $('input[type=checkbox]').prop('checked', false);
        }   

    });
</script>


<!-- Validation du formulaire -->
<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                role_id: {
                    required : true,
                },
                
            },
            messages :{
                role_id: {
                    required : 'Veuillez sélectionner le rôle',
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

