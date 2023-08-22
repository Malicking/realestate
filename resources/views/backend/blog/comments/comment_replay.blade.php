@extends('admin.adminDashboard')

@section('content')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('blog.post.comment') }}" class="btn btn-inverse-info">
                <i data-feather="align-justify"></i>
                Afficher les commentaires
            </a>
        </ol>
    </nav>

    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">

                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Répondre à un commentaire</h6>
                        <form method="post" class="forms-sample" action="{{ route('blog.post.replay.message') }}" id="myForm">
                            @csrf
                            
                            <input type="hidden" name="post_id" value="{{ $comment->posts->id }}">
                            <input type="hidden" name="id" value="{{ $comment->id }}">

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label" style="font-weight: bold">
                                            Utilisateur :
                                        </label>
                                        <code>{{ $comment->users->name }}</code>
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label" style="font-weight: bold">
                                            Titre du post :
                                        </label>
                                        <code>{{ $comment->posts->post_title }}</code>
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label" style="font-weight: bold">
                                            Objet :
                                        </label>
                                        <code>{{ $comment->subject }}</code>
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label" style="font-weight: bold">
                                            Titre du post :
                                        </label> <br>
                                        <code>{{ $comment->message }}</code>
                                    </div>
                                </div><!-- Col -->

                                <div class="mb-3">
                                    <label for="Subject" class="form-label">Objet :</label>
                                    <input type="text" class="form-control" name="subject" id="Subject">
                                </div>

                                <div class="mb-3">
                                    <label for="Message" class="form-label">Message :</label>
                                    <textarea name="message" id="Message" rows="3" class="form-control"></textarea>
                                </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary me-2 px-3">
                                    Répondre
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
                subject: {
                    required : true,
                },
                message: {
                    required : true,
                },
            },
            messages :{
                subject: {
                    required : 'Veuillez entrer l\'objet de la réponse',
                },
                subject: {
                    required : 'Veuillez entrer la réponse',
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

@endsection




