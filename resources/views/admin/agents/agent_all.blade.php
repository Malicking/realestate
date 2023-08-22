@extends('admin.adminDashboard')

@section('content')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('agent.add') }}" class="btn btn-inverse-info">
                <i data-feather="plus"></i> 
                Ajouter un agent
            </a>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Les agents</h6>
                    
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Images</th>
                                    <th>Agents</th>
                                    <th>Roles</th>
                                    <th>Statuts</th>
                                    <th class="text-center">Activer / Désactiver</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($agents as $key => $agent)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>
                                            <img src="{{ !empty($agent->photo) ? url('upload/agents/'.$agent->photo) : url('upload/no_image.jpg') }}" alt="{{ $agent->name }}" style="width: 50px; height: 50px;">
                                        </td>
                                        <td>{{ $agent->name }}</td>
                                        <td>{{ $agent->role }}</td>
                                        <td>
                                            @if ($agent->status == 'active')
                                                <span class="badge rounded-pill bg-success">Active</span>
                                            @else
                                                <span class="badge rounded-pill bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        
                                        <td class="text-center">
                                            <form action="{{ route('agent.manage', $agent->id) }}" method="post">
                                                @csrf

                                <input type="hidden" name="id" value="{{ $agent->id }}">
                                                
                                                @if ($agent->status == 'active')
                                                    <button class="btn btn-link btn-sm text-danger">Désactiver</button>
                                                @else
                                                    <button class="btn btn-link btn-sm text-success">Activer</button>
                                                @endif
                                            </form>
                                        </td>

                                        {{-- <td class="text-center">
                                            <input type="checkbox" data-id="{{ $agent->id }}" class="toggle-class" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="Inactive" {{ $agent->status ? 'checked' : '' }}>
                                        </td> --}}
                                        
                                        <td class="text-center">
                                            <a href="{{ route('agent.edit', $agent->id) }}" class="btn btn-inverse-warning btn-sm" title="Modifier">
                                                <i data-feather="edit"></i>
                                            </a>
                                            <a href="{{ route('agent.delete', $agent->id) }}" class="btn btn-inverse-danger btn-sm" id="delete" title="Supprimer">
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


<script type="text/javascript">
    $(function() {
        $('.toggle-class').change(function() {
            var status = $(this).prop('checked') == true ? 1 : 0; 
            var user_id = $(this).data('id'); 
           
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/changeStatus',
                data: {'status': status, 'user_id': user_id},
                success: function(data){
                // console.log(data.success)
    
                // Start Message     
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success', 
                    showConfirmButton: false,
                    timer: 3000 
                })
                if ($.isEmptyObject(data.error)) {
                        
                    Toast.fire({
                    type: 'success',
                    title: data.success, 
                    })
    
                }else{
                    
                    Toast.fire({
                            type: 'error',
                            title: data.error, 
                        })
                    }
                    
                    // End Message   
    
                }
            });
        })
    })
</script>

@endsection

