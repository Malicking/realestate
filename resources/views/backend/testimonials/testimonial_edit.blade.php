@extends('admin.adminDashboard')

@section('content')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('testimonial.all') }}" class="btn btn-inverse-info">
                <i data-feather="align-justify"></i>
                Afficher les témoignages
            </a>
        </ol>
    </nav>

    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Modification d'un témoignage</h6>
                        <hr>

                        <form class="forms-sample" method="POST" action="{{ route('testimonial.update') }}" id="myForm" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="id" value="{{ $testimData->id }}">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="Name">
                                            Nom du témoigneur
                                        </label>
                                        <input type="text" name="name" class="form-control" autocomplete="off" value="{{ $testimData->name }}" placeholder="Entrez le nom du témoigneur..." id="Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="Img">
                                            Photo du témoigneur
                                        </label>
                                        <input type="file" name="image" class="form-control mb-3" onchange="testimImgUrl(this)" id="Img">

                                        <img src="{{ !empty($testimData->image) ? url($testimData->image) : url('upload/no_image.jpg') }}" id="testimImg" style="width: 80px;">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="Position">
                                            Fonction du témoigneur
                                        </label>
                                        <input type="text" name="position" class="form-control" autocomplete="off" value="{{ $testimData->position }}" placeholder="Entrez le nom du témoigneur..." id="Position">
                                    </div>
                                </div>

                                <div class="col-md-12 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title" for="Message">
                                                Témoignage
                                            </h4>
                                            <textarea class="form-control" name="message" id="tinymceExample" rows="10" id="Message">
                                                {{ $testimData->message }}
                                            </textarea>
                                        </div>
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
            },
            messages :{
                name: {
                    required : 'Veuillez entrer le nom du témoigneur',
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

