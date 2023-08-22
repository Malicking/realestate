@extends('agent.agentDashboard')

@section('content')

<!-- Titre de la page Start -->
@section('title')
    Pack business
@endsection
<!-- Titre de la page End -->

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb"> </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <div class="card pb-3">

                <form action="{{ route('store.business.plan') }}" method="post">
                    @csrf

                    <div class="card-body">
                        <div class="container-fluid d-flex justify-content-between">
                            <div class="col-lg-3 ps-0">
                                <a href="#" class="noble-ui-logo logo-light d-block mt-3">Malick<span>Roi</span></a>
                                <p class="mt-1 mb-1"><b>MalickRoi BTP</b></p>
                                <p>108,<br> Koloma Soloprimo,<br>Conakry, Rép. de Guinée.</p>
                                <h5 class="mt-5 mb-2 text-muted">Facturé à :</h5>
                                <p>{{ $agent->name }}<br> {{ $agent->email }},<br> {{ $agent->address }}</p>
                            </div>
                            <div class="col-lg-3 pe-0">
                                <h4 class="fw-bolder text-uppercase text-end mt-4 mb-2">Facture </h4>
                                <h6 class="text-end mb-5 pb-4"> </h6>
                                <p class="text-end mb-1 text-capitalize">Montant dû</p>
                                <h4 class="text-end fw-normal">
                                    $ 20
                                </h4>
                                <h6 class="mb-0 mt-3 text-end fw-normal mb-2">
                                    <span class="text-muted"> </span>
                                </h6>
                            </div>
                        </div>

                        <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                            <div class="table-responsive w-100">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Package </th>
                                            <th class="text-end">
                                                Nbre de propriétés
                                            </th>
                                            <th class="text-end">
                                                Prix unitaire
                                            </th>
                                            <th class="text-end">
                                                Montant total
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <tr class="text-end">
                                            <td class="text-start">1</td>
                                            <td class="text-start">
                                                Business
                                            </td>
                                            <td>3</td>
                                            <td>$20</td>
                                            <td>$20</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="container-fluid mt-5 w-100">
                            <div class="row">
                                <div class="col-md-6 ms-auto">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>Sous-total</td>
                                                    <td class="text-end">$ 20</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-bold-800">Total</td>
                                                    <td class="text-bold-800 text-end"> $ 20</td>
                                                </tr>
                                                <tr>
                                                    <td>Paiement effectué</td>
                                                    <td class="text-danger text-end">(-) $ 20</td>
                                                </tr>
                                                <tr class="bg-dark">
                                                    <td class="text-bold-800">Montant dû</td>
                                                    <td class="text-bold-800 text-end">$ 20</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="container-fluid w-100">
                            <button type="submit" class="btn btn-primary float-end mt-4 ms-2">
                                <i data-feather="send" class="me-3 icon-md"></i>
                                Enregistrer la facture
                            </button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
@endsection