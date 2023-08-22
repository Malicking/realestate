@extends('admin.adminDashboard')

@section('content')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('permission.all') }}" class="btn btn-inverse-info">
                <i data-feather="align-justify"></i>
                Afficher les privilèges
            </a>
        </ol>
    </nav>

    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Ajout d'un nouveau privilège</h6>
                        <hr>

                        <form id="myForm" class="forms-sample" method="POST" action="{{ route('permission.store') }}">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="PermName" class="form-label">
                                    Privilèges
                                </label>
                                <input type="text" name="name" class="form-control" id="PermName" autocomplete="off" autofocus value="{{ old('name') }}" placeholder="Entrez le nom du privilège...">
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">
                                    Groupe
                                </label>
                                <select name="group_name" id="GroupName" class="form-select">
                                    <option selected disabled>
                                        Choisissez le groupe...
                                    </option>
                                    <option value="type">Type de propriété</option>
                                    <option value="state">Régions</option>
                                    <option value="amenities">Aménités</option>
                                    <option value="property">Propriétés</option>
                                    <option value="agent">Gestion Agents</option>
                                    <option value="history">Historique Forfait</option>
                                    <option value="message">Messages Propriété</option>
                                    <option value="testimonials">Témoignages</option>
                                    <option value="category">Catégories Blog</option>
                                    <option value="post">Articles Blog</option>
                                    <option value="comment">Commentaires Blog</option>
                                    <option value="smtp">Paramètres SMTP</option>
                                    <option value="site">Paramètres Site</option>
                                    <option value="role">Roles & Permissions</option>
                                </select>
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
                    required : 'Veuillez entrer le nom du privilège',
                },
                group_name: {
                    required : 'Veuillez sélectionner le groupe du privilège',
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

