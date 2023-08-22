@extends('admin.adminDashboard')

@section('content')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('blog.category.all') }}" class="btn btn-inverse-info">
                <i data-feather="align-justify"></i>
                Afficher les catégories
            </a>
        </ol>
    </nav>

    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Editer d'une catégorie</h6>
                        <hr>

                        <form class="forms-sample" method="POST" action="{{ route('blog.category.update') }}" id="myForm" enctype="multipart/form-data">
                            @csrf
                            
                            <input type="hidden" name="id" value="{{ $catData->id }}">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="Name">
                                            Nom de la catégorie
                                        </label>
                                        <input type="text" name="category_name" class="form-control" autocomplete="off" value="{{ $catData->category_name }}" placeholder="Entrez le nom de la catégorie..." id="Name">
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
                category_name: {
                    required : true,
                },
            },
            messages :{
                category_name: {
                    required : 'Veuillez entrer le nom de la catégorie',
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
    Url
</script>
<!-- Validation du formulaire -->


<!-- Affichage de l'image principale (thumbnail) -->
<script type="text/javascript">
    function testimImgUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#testimImg').attr('src', e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<!-- Affichage de l'image principale (thumbnail) -->


@endsection

