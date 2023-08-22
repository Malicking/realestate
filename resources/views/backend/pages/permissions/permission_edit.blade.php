@extends('admin.adminDashboard')

@section('content')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('permission.all') }}" class="btn btn-inverse-info">
                <i data-feather="align-justify"></i>
                Afficher les permissions
            </a>
        </ol>
    </nav>

    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Modifier un privilège</h6>
                        <hr>

                        <form id="myForm" class="forms-sample" method="POST" action="{{ route('permission.update') }}">
                            @csrf

                            <input type="hidden" name="id" value="{{ $permission->id }}">

                            <div class="form-group mb-3">
                                <label for="PermName" class="form-label">
                                    Privilèges
                                </label>
                                <input type="text" name="name" class="form-control" id="PermName" autocomplete="off" value="{{ $permission->name }}" placeholder="Entrez le nom du privilège...">
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">
                                    Groupe
                                </label>
                                <select name="group_name" id="GroupName" class="form-select">
                                    <option selected disabled>
                                        Choisissez le groupe...
                                    </option>

                                    <option value="type" {{ $permission->group_name == 'type' ? 'selected' : '' }}>
                                        Type de propriété
                                    </option>

                                    <option value="state" {{ $permission->group_name == 'state' ? 'selected' : '' }}>
                                        Régions
                                    </option>

                                    <option value="amenities" {{ $permission->group_name == 'amenities' ? 'selected' : '' }}>
                                        Aménités
                                    </option>

                                    <option value="property" {{ $permission->group_name == 'property' ? 'selected' : '' }}>
                                        Propriétés
                                    </option>

                                    <option value="agent" {{ $permission->group_name == 'agent' ? 'selected' : '' }}>
                                        Gestion Agents
                                    </option>

                                    <option value="history" {{ $permission->group_name == 'history' ? 'selected' : '' }}>
                                        Historique Forfait
                                    </option>

                                    <option value="message" {{ $permission->group_name == 'message' ? 'selected' : '' }}>
                                        Messages Propriété
                                    </option>

                                    <option value="testimonials" {{ $permission->group_name == 'testimonials' ? 'selected' : '' }}>Témoignages</option>

                                    <option value="category" {{ $permission->group_name == 'category' ? 'selected' : '' }}>Catégories Blog</option>

                                    <option value="post" {{ $permission->group_name == 'post' ? 'selected' : '' }}>Articles Blog</option>

                                    <option value="comment" {{ $permission->group_name == 'comment' ? 'selected' : '' }}>Commentaires Blog</option>

                                    <option value="smtp" {{ $permission->group_name == 'smtp' ? 'selected' : '' }}>Paramètres SMTP</option>

                                    <option value="site" {{ $permission->group_name == 'site' ? 'selected' : '' }}>Paramètres Site</option>

                                    <option value="role" {{ $permission->group_name == 'role' ? 'selected' : '' }}>Roles & Permissions</option>
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

