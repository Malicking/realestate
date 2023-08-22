@extends('agent.agentDashboard')

@section('content')

<!-- Titre de la page Start -->
@section('title')
    Historique d'achat de pack
@endsection
<!-- Titre de la page End -->

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('buy.package') }}" class="btn btn-inverse-info">
                <i data-feather="plus"></i>
                Acheter un forfait
            </a>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Historique d'achat de forfait</h6>

                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Images</th>
                                    <th>Forfaits</th>
                                    <th>N°Factures</th>
                                    <th>Montants</th>
                                    <th>Dates</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($packages as $key => $item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>
                                            <img src="{{ !empty($item['Users']['photo']) ? url('upload/agents/'.$item['Users']['photo']) : url('upload/no_image.jpg') }}">
                                        </td>
                                        <td>{{ $item->package_name }}</td>
                                        <td>{{ $item->invoice }}</td>
                                        <td>
                                            $ {{ number_format($item->package_amount, 0, ',', ' ') }}
                                        </td>
                                        <td>
                                            {{ $item->created_at->format('l d M Y') }}
                                        </td>

                                        <td class="text-center">
                                            <a href="{{ route('package.invoice', $item->id) }}" class="btn btn-inverse-warning btn-sm" title="Télécharger">
                                                <i data-feather="download"></i>
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


