@extends('admin.adminDashboard')

@section('content')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('state.all') }}" class="btn btn-inverse-info">
                <i data-feather="align-justify"></i>
                Afficher les régions
            </a>
        </ol>
    </nav>
    
    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">      
                        <h6 class="card-title">Editer une région</h6>
                        <hr>
                        
                        <form class="forms-sample" method="POST" action="{{ route('state.update') }}" id="myForm" enctype="multipart/form-data">
                            @csrf
                            
                            <input type="hidden" name="id" value="{{ $stateData->id }}">

                            <div class="row">
                                <div class="col-md-7">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Nom de la région
                                        </label>
                                        <input type="text" name="state_name" class="form-control" autocomplete="off" value="{{ $stateData->state_name }}" placeholder="Entrez le nom de la région...">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Image de la région
                                        </label>
                                        <input type="file" name="state_image" class="form-control mb-3" onchange="stateImgUrl(this)">

                                        <img src="{{ !empty($stateData->state_image) ? url($stateData->state_image) : url('upload/no_image.jpg') }}" id="stateImg" style="width: 150px;">
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
                state_name: {
                    required : true,
                },
            },
            messages :{
                state_name: {
                    required : 'Veuillez entrer le nom de la région',
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
    function stateImgUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#stateImg').attr('src', e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<!-- Affichage de l'image principale (thumbnail) -->


@endsection

