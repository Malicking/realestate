@extends('admin.adminDashboard')

@section('content')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('agent.all') }}" class="btn btn-inverse-info">
                <i data-feather="align-justify"></i>
                Afficher les agents
            </a>
        </ol>
    </nav>
    
    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">      
                        <h6 class="card-title">Ajout d'un nouvel agent</h6>
                        <hr>
                        
                        <form id="myForm" class="forms-sample" method="POST" action="{{ route('agent.store') }}">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="AgentName" class="form-label">
                                            Nom de l'agent
                                        </label>
                                        <input type="text" name="name" class="form-control" id="AgentName" autocomplete="off" autofocus value="{{ old('name') }}" placeholder="Entrez le nom de l'agent...">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="AgentEmail" class="form-label">
                                            Email de l'agent
                                        </label>
                                        <input type="email" name="email" class="form-control" id="AgentEmail" autocomplete="off" autofocus value="{{ old('email') }}" placeholder="Entrez l'email de l'agent...">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="AgentPhone" class="form-label">
                                            Téléphone
                                        </label>
                                        <input type="text" name="phone" class="form-control" id="AgentPhone" autocomplete="off" autofocus value="{{ old('phone') }}" placeholder="Entrez le téléphone...">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="AgentPwd" class="form-label">
                                            Mot de passe
                                        </label>
                                        <input type="password" name="password" class="form-control" id="AgentPwd" autocomplete="off" autofocus value="{{ old('password') }}" placeholder="Créez un mot de passe...">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="AgentPwd" class="form-label">
                                            Adresse de l'agent
                                        </label>
                                        <input type="text" name="address" class="form-control" id="AgentPwd" autocomplete="off" autofocus value="{{ old('address') }}" placeholder="Entrez l'adresse de l'agent...">
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
                name: {
                    required : 'Veuillez entrer le nom de l\'agent',
                },                  
                email: {
                    required : 'Veuillez entrer l\'email de l\'agent',
                    email: 'Entrez une adresse email valide',
                },                  
                phone: {
                    required : 'Veuillez entrer le téléphone de l\'agent',
                },                  
                password: {
                    required : 'Veuillez créer un mot de passe pour l\'agent',
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

