@extends('agent.agentDashboard')

@section('content')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Les demandes de visite</h6>

                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Demandeurs</th>
                                    <th>Propriétés</th>
                                    <th>Dates</th>
                                    <th>Heures</th>
                                    <th>Statuts</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($userMsg as $key => $item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $item->users->name }}</td>
                                        <td>{{ $item->properties->property_name }}</td>
                                        <td>{{ strftime('%d-%m-%Y', strtotime($item->tour_date)) }}</td>
                                        <td>{{ $item->tour_time }}</td>

                                        <td>
                                            @if ($item->status == 1)
                                                <span class="badge rounded-pill bg-success">Confirmé</span>
                                            @else
                                                <span class="badge rounded-pill bg-danger">
                                                    En attente
                                                </span>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            <a href="{{ route('agent.property.schedule.details', $item->id) }}" class="btn btn-inverse-info btn-sm" title="Détails">
                                                <i data-feather="eye"></i>
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


