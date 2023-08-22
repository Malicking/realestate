@extends('admin.adminDashboard')

@section('content')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('agent.property.all') }}" class="btn btn-inverse-info">
                <i data-feather="align-justify"></i>
                Afficher les propriétés
            </a>
        </ol>
    </nav>

    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">

                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Ajouter une nouvelle propriété</h6>
                        <form method="post" class="forms-sample" action="{{ route('agent.property.store') }}" id="myForm" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group mb-3">
                                        <label class="form-label">
                                            Nom de la propriété
                                        </label>
                                        <input type="text" name="property_name" class="form-control" autocomplete="off" placeholder="Entrez le nom de la propriété...">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label">
                                            Statut de la propriété
                                        </label>
                                        <select name="property_status" id="PropertyStatus" class="form-select">
                                            <option selected disabled>
                                                Choisir le statut...
                                            </option>
                                            <option value="A louer">A louer</option>
                                            <option value="A vendre">A vendre</option>
                                        </select>
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">
                                            Prix minimum
                                        </label>
                                        <input type="number" name="lowest_price" class="form-control" autocomplete="off" placeholder="Entrez le prix minimum...">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">
                                            Prix maximum
                                        </label>
                                        <input type="number" name="max_price" class="form-control" autocomplete="off" placeholder="Entrez le prix maximum...">
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">
                                            Image principale
                                        </label>
                                        <input type="file" name="property_thumbnail" class="form-control mb-3" onchange="mainThumbUrl(this)">

                                        <img src="" id="mainThmb">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">
                                            Autres images
                                        </label>
                                        <input type="file" name="multi_img[]" class="form-control mb-3" id="multiImg" multiple>

                                        <div class="row" id="preview_img"> </div>
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->

                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Nombre de chambres
                                        </label>
                                        <input type="number" class="form-control" name="bedrooms">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Nombre de salles de bain
                                        </label>
                                        <input type="number" class="form-control" name="bathrooms">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Nombre de garages
                                        </label>
                                        <input type="text" class="form-control" name="garage">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Taille de l'espace parking
                                        </label>
                                        <input type="text" class="form-control" name="garage_size">
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->

                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Adresse
                                        </label>
                                        <input type="text" class="form-control" name="address">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Ville
                                        </label>
                                        <input type="text" class="form-control" name="city">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Région / Etat
                                        </label> 
                                        <select name="state_id" id="StateId" class="form-select">
                                            <option selected disabled>
                                                Choisir la région...
                                            </option>
                                            @foreach ($states as $item)
                                                <option name value="{{ $item->id }}">
                                                    {{ $item->state_name }} 
                                                </option> 
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Code postal
                                        </label>
                                        <input type="text" class="form-control" name="postal_code">
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Taille de la propriété
                                        </label>
                                        <input type="text" class="form-control" name="property_size">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Vidéo de la propriété
                                        </label>
                                        <input type="text" class="form-control" name="property_video">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Quartier / Voisinage
                                        </label>
                                        <input type="text" class="form-control" name="neighborhood">
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Latitude</label>
                                        <input type="text" name="latitude" class="form-control" autocomplete="off">
                                    </div>
                                    <a href="https://www.latlong.net/convert-address-to-lat-long.html" target="_blank">
                                        Cliquez ici pour chercher la latitude
                                    </a>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Longitude</label>
                                        <input type="text" class="form-control" autocomplete="off" name="longitude">
                                    </div>
                                    <a href="https://www.latlong.net/convert-address-to-lat-long.html" target="_blank">
                                        Cliquez ici pour chercher la longitude
                                    </a>
                                </div><!-- Col -->
                            </div><!-- Row -->

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="PropType">
                                            Type de propriété
                                        </label>
                                        <select name="ptype_id" id="PropType" class="form-select">
                                            <option selected disabled>
                                                Sélectionner le type...
                                            </option>
                                            @foreach ($propertyType as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->type_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Aménités de la propriété
                                        </label>
                                        <select name="amenities_id[]" class="js-example-basic-multiple form-select" multiple="multiple" data-width="100%">
                                            @foreach ($amenities as $item)
                                            <option value="{{ $item->amenitie_name }}" class="bg-none">
                                                {{ $item->amenitie_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->

                            <div class="col-sm-12 mb-3">
                                <label for="shortDesc" class="form-label">
                                    Petite description de la propriété (résumé)
                                </label>
                                <textarea name="short_desc" id="shortDesc" rows="3" class="form-control"></textarea>
                            </div>

                            <div class="col-md-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            Description de la propriété
                                        </h4>
                                        <textarea class="form-control" name="long_desc" id="tinymceExample" rows="10"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" class="form-check-input" id="checkInline1" name="featured" value="1">
                                    <label for="checkInline1">
                                        Propriété en vedette
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" class="form-check-input" id="checkInline2" name="hot" value="1">
                                    <label for="checkInline2">
                                        Propriété en vente rapide
                                    </label>
                                </div>
                            </div>

                            <!-- Facilities Start -->
                            <div class="row add_item mb-3">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="facility_name" class="form-label">
                                            Portée / Avantages
                                        </label>
                                        <select name="facility_name[]" id="facility_name" class="form-control">
                                            <option value="">
                                                Sélectionner un avantage
                                            </option>
                                            <option value="Hopital">Hopital</option>
                                            <option value="Super marché">Super Marché</option>
                                            <option value="Ecole">Ecole</option>
                                            <option value="Divertissement">Divertissement</option>
                                            <option value="Parmacie">Parmacie</option>
                                            <option value="Aéroport">Aéroport</option>
                                            <option value="Gare">Gare</option>
                                            <option value="Arrêt de bus">Arrêt de bus</option>
                                            <option value="Plage">Plage</option>
                                            <option value="Centre commercial">Centre commercial</option>
                                            <option value="Banque">Banque</option>
                                        </select>
                                        </div>
                                </div>
                                <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="distance" class="form-label"> Distance </label>
                                            <input type="number" name="distance[]" id="distance" class="form-control" placeholder="Distance (Km)">
                                        </div>
                                </div>
                                <div class="form-group col-md-4" style="padding-top: 30px;">
                                    <a class="btn btn-success addeventmore">
                                        <i class="fa fa-plus-circle"></i> + Ajouter..
                                    </a>
                                </div>
                            </div> <!---end row-->
                            <!-- Facilities Start -->

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


<!--========== Start of add multiple class with ajax (Facilities    ) ==============-->
<div style="visibility: hidden">
    <div class="whole_extra_item_add" id="whole_extra_item_add">
       <div class="whole_extra_item_delete" id="whole_extra_item_delete">
            <div class="container mt-2">
                <div class="row mb-3">

                    <div class="form-group col-md-4">
                        <label for="facility_name">Portée / Avantages</label>
                        <select name="facility_name[]" id="facility_name" class="form-control">
                            <option value="">Sélectionner un avantage</option>
                            <option value="Hopital">Hopital</option>
                            <option value="Super marché">Super Marché</option>
                            <option value="Ecole">Ecole</option>
                            <option value="Divertissement">Divertissement</option>
                            <option value="Parmacie">Parmacie</option>
                            <option value="Aéroport">Aéroport</option>
                            <option value="Gare">Gare</option>
                            <option value="Arrêt de bus">Arrêt de bus</option>
                            <option value="Plage">Plage</option>
                            <option value="Centre commercial">Centre commercial</option>
                            <option value="Banque">Banque</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="distance">Distance</label>
                        <input type="number" name="distance[]" id="distance" class="form-control" placeholder="Distance (Km)">
                    </div>
                    <div class="form-group col-md-4" style="padding-top: 20px">
                        <span class="btn btn-success btn-sm addeventmore">
                            <i class="fa fa-plus-circle">Ajouter</i>
                        </span>
                        <span class="btn btn-danger btn-sm removeeventmore">
                            <i class="fa fa-minus-circle">Retirer</i>
                        </span>
                    </div>
             </div>
          </div>
       </div>
    </div>
</div>



<!----For Section-------->
 <script type="text/javascript">
    $(document).ready(function(){
       var counter = 0;
        $(document).on("click",".addeventmore",function(){
            var whole_extra_item_add = $("#whole_extra_item_add").html();
            $(this).closest(".add_item").append(whole_extra_item_add);
            counter++;
        });
        $(document).on("click",".removeeventmore",function(event){
            $(this).closest("#whole_extra_item_delete").remove();
            counter -= 1
        });
    });
 </script>
 <!--========== End of add multiple class with ajax (Facilities ) ==============-->


<!-- Validation du formulaire -->
<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                property_name: {
                    required : true,
                },
                property_status: {
                    required : true,
                },
                lowest_price: {
                    required : true,
                },
                max_price: {
                    required : true,
                },
                property_thumbnail: {
                    required : true,
                },
                ptype_id: {
                    required : true,
                },
            },
            messages :{
                property_name: {
                    required : 'Veuillez entrer le nom de la propriété',
                },
                property_status: {
                    required : 'Sélectionnez un statut',
                },
                lowest_price: {
                    required : 'Entrez le prix minimum',
                },
                max_price: {
                    required : 'Entrez le prix maximum',
                },
                property_thumbnail: {
                    required : 'Chargez une image principale de la propriété',
                },
                ptype_id: {
                    required : 'Sélectionnez le type de la propriété',
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
    function mainThumbUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#mainThmb').attr('src', e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<!-- Affichage de l'image principale (thumbnail) -->

<!-- Affichage des autres images -->
<script>

    $(document).ready(function(){
        $('#multiImg').on('change', function(){ //on file input change
            if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
            {
                var data = $(this)[0].files; //this file data

                $.each(data, function(index, file){ //loop though each file
                    if(/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file.type)){ //check supported file type
                        var fRead = new FileReader(); //new filereader
                        fRead.onload = (function(file){ //trigger function on successful read
                            return function(e) {
                                var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(100).height(80); //create image element
                                $('#preview_img').append(img); //append image to output element
                            };
                        })(file);
                        fRead.readAsDataURL(file); //URL representing the file's data.
                    }
                });

            }else{
                alert("Votre navigateur ne supporte pas ce genre de fichier!"); //if File API is absent
            }
        });
    });
</script>
<!-- Affichage des autres images -->

@endsection

