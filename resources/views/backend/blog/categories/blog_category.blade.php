@extends('admin.adminDashboard')

@section('content')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Ajouter une catégorie
            </button>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Les catégories de blog</h6>

                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Catégorie</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($categories as $key => $item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $item->category_name }}</td>

                                        <td class="text-center">
                                            <a href="{{ route('blog.category.edit', $item->id) }}" class="btn btn-inverse-warning btn-sm" title="Modifier">
                                                <i data-feather="edit"></i>
                                            </a>

                                            {{-- <button type="button" class="btn btn-inverse-warning" data-bs-toggle="modal" data-bs-target="#catEdit" id="{{ $item->id }}" onclick="categoryEdit(this.id)">
                                                <i data-feather="edit"></i>
                                                Editer
                                            </button> --}}

                                            <a href="{{ route('blog.category.delete', $item->id) }}" class="btn btn-inverse-danger btn-sm" id="delete" title="Supprimer">
                                                <i data-feather="trash-2"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal - Ajout d'une catégorie -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nouvelle catégorie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>

            <div class="modal-body">
                <form class="forms-sample" action="{{ route('blog.category.store') }}" method="POST">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="exampleInputEmail1" class="label-form mb-2">
                            Nom de la catégorie
                        </label>
                        <input type="text" name="category_name" class="form-control" selected>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal - Modification d'une catégorie -->
<div class="modal fade" id="catEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editer une catégorie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>

            <div class="modal-body">
                <form class="forms-sample" action="{{ route('blog.category.update') }}" method="POST">
                    @csrf

                    <input type="hidden" name="cat_id" id="cat_id">

                    <div class="form-group mb-3">
                        <label for="exampleInputEmail1" class="label-form mb-2">
                            Nom de la catégorie
                        </label>
                        <input type="text" name="category_name" class="form-control" id="cat">
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- charger les infos de la catégorie à éditer lorsqu'un clic sur le bouton -->
<script type="text/javascript">
    function categoryEdit(id) {
        $.ajax({
            type: 'GET',
            url: '/blog/category/'+id+'/edit',
            dataType: 'json',

            success:function (data) {
                // console.log(data)
                $('#cat').val(data.category_name);
                $('#cat_id').val(data.id);
            }
        })
    }
</script>

@endsection

