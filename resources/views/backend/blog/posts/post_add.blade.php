@extends('admin.adminDashboard')

@section('content')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('blog.post.all') }}" class="btn btn-inverse-info">
                <i data-feather="align-justify"></i>
                Afficher les articles du blog
            </a>
        </ol>
    </nav>

    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">

                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Poster un article</h6>
                        <form method="post" class="forms-sample" action="{{ route('blog.post.store') }}" id="myForm" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label">
                                            Titre de l'article
                                        </label>
                                        <input type="text" name="post_title" class="form-control" autocomplete="off" placeholder="Entrez le titre de l'article...">
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Catégorie
                                        </label>
                                        <select name="blogcat_id" id="BlogCat" class="form-select">
                                            <option selected disabled>
                                                Sélectionner la catégorie...
                                            </option>
                                            @foreach ($blogCat as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->category_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">
                                            Image
                                        </label>
                                        <input type="file" name="post_image" class="form-control mb-3" onchange="postImgUrl(this)">

                                        <img src="" id="postImg">
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-12 mb-3">
                                    <label for="shortDesc" class="form-label">
                                        Petite description de l'article (résumé)
                                    </label>
                                    <textarea name="short_desc" id="shortDesc" rows="3" class="form-control"></textarea>
                                </div>

                                <div class="col-md-12 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">
                                                Description de l'article
                                            </h4>
                                            <textarea class="form-control" name="long_desc" id="tinymceExample" rows="10"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">
                                                Tags
                                            </h4>
                                            <input name="post_tags" id="tags" value="Immobilier," />
                                        </div>
                                    </div>
                                </div>
                            </div><!-- Row -->

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary me-2 px-3">
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


<!-- Validation du formulaire -->
<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                post_title: {
                    required : true,
                },
            },
            messages :{
                post_title: {
                    required : 'Veuillez entrer le titre de l\'article',
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


<!-- Affichage de l'image principale -->
<script type="text/javascript">
    function postImgUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#postImg').attr('src', e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<!-- Affichage de l'image principale -->

@endsection




