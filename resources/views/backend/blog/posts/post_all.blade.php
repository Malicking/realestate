@extends('admin.adminDashboard')

@section('content')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('blog.post.add') }}" class="btn btn-inverse-info">
                Poster un article au blog
            </a>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Articles du blog</h6>

                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Images</th>
                                    <th>Titres</th>
                                    <th>Catégories</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($posts as $key => $item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>
                                            <img src="{{ !empty($item->post_image) ? url($item->post_image) : url('upload/no_image.jpg') }}" alt="{{ $item->post_title }}">
                                        </td>

                                        <td>{{ $item->post_title }}</td>
                                        <td>{{ $item->categories->category_name }}</td>

                                        <td class="text-center">
                                            <a href="{{ route('blog.post.edit', $item->id) }}" class="btn btn-inverse-warning btn-sm" title="Modifier">
                                                <i data-feather="edit"></i>
                                            </a>
                                            <a href="{{ route('blog.post.delete', $item->id) }}" class="btn btn-inverse-danger btn-sm" id="delete" title="Supprimer">
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

@endsection
