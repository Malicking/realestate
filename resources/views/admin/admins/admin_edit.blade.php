@extends('admin.adminDashboard')

@section('content')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('admin.all') }}" class="btn btn-inverse-info">
                <i data-feather="align-justify"></i>
                Afficher les admins
            </a>
        </ol>
    </nav>
    
    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">      
                        <h6 class="card-title">Editer un admin</h6>
                        <hr>
                        
                        <form id="myForm" class="forms-sample" method="POST" action="{{ route('admin.update') }}">
                            @csrf

                            <input type="hidden" name="id" value="{{ $user->id }}">
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="AdminUsername" class="form-label">
                                            Nom d'utilisateur
                                        </label>
                                        <input type="text" name="username" class="form-control" id="AdminUsername" autocomplete="off" autofocus value="{{ $user->username }}" placeholder="Entrez le nom d'utilisateur...">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="AdminName" class="form-label">
                                            Nom de l'admin
                                        </label>
                                        <input type="text" name="name" class="form-control" id="AdminName" autocomplete="off" autofocus value="{{ $user->name }}"  placeholder="Entrez le nom de l'admin...">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="AdminPhone" class="form-label">
                                            Téléphone
                                        </label>
                                        <input type="text" name="phone" class="form-control" id="AdminPhone" autocomplete="off" autofocus value="{{ $user->phone }}" placeholder="Entrez le téléphone...">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="AdminEmail" class="form-label">
                                            Email de l'admin
                                        </label>
                                        <input type="email" name="email" class="form-control" id="AdminEmail" autocomplete="off" autofocus value="{{ $user->email }}" placeholder="Entrez l'email de l'admin...">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="AdminRole" class="form-label">Rôle</label>
                                    <select name="roles" id="AdminRole" class="form-select">
                                        <option selected disabled>
                                            Choisissez le rôle...
                                        </option>
                                        
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="AdminAddress" class="form-label">
                                            Adresse de l'admin
                                        </label>
                                        <input type="text" name="address" class="form-control" id="AdminAddress" autocomplete="off" autofocus value="{{ $user->address }}" placeholder="Entrez l'adresse de l'admin...">
                                    </div>
                                </div>
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
                username: {
                    required : true,
                }, 
                name: {
                    required : true,
                }, 
                email: {
                    required : true,
                    email: true,
                }, 
                phone: {
                    required : true,
                }, 
                password: {
                    required : true,
                }, 
                
            },
            messages :{
                username: {
                    required : 'Veuillez créer un nom d\'utilisateur',
                },                  
                name: {
                    required : 'Veuillez entrer le nom de l\'admin',
                },                  
                email: {
                    required : 'Veuillez entrer l\'email de l\'admin',
                    email: 'Entrez une adresse email valide',
                },                  
                phone: {
                    required : 'Veuillez entrer le téléphone de l\'admin',
                },                  
                password: {
                    required : 'Veuillez créer un mot de passe pour l\'admin',
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

