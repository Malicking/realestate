@extends('agent.agentDashboard')

@section('content')

<!-- Titre de la page Start -->
@section('title')
    Achat de pack
@endsection
<!-- Titre de la page End -->

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center mb-3 mt-4">Choisir un forfait</h3>
                    <p class="text-muted text-center mb-4 pb-2 mx-5">
                        Choisissez les caractéristiques et fonctionnalités dont votre équipe a besoin aujourd'hui. Effectuez facilement une mise à niveau au fur et à mesure que votre entreprise grandit.
                    </p>

                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 stretch-card grid-margin grid-margin-md-0">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="text-center mt-3 mb-4">Basic</h4>
                                        <i data-feather="award" class="text-primary icon-xxl d-block mx-auto my-3"></i>
                                        <h1 class="text-center">$0</h1>
                                        <p class="text-muted text-center mb-4 fw-light">Limité</p>
                                        <h5 class="text-primary text-center mb-4">
                                            Une seule propriété
                                        </h5>
                                        <table class="mx-auto">
                                            <tr>
                                                <td>
                                                    <i data-feather="check" class="icon-md text-primary me-2"></i>
                                                </td>
                                                <td><p>Jusqu'à 1 propriété</p></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <i data-feather="x" class="icon-md text-danger me-2"></i>
                                                </td>
                                                <td>
                                                    <p class="text-muted">
                                                        Support premium
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="d-grid">
                                            <a class="btn btn-primary mt-4" disabled>
                                                Acheter maintenant
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 stretch-card grid-margin grid-margin-md-0">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="text-center mt-3 mb-4">Business</h4>
                                        <i data-feather="gift" class="text-success icon-xxl d-block mx-auto my-3"></i>
                                        <h1 class="text-center">$20</h1>
                                        <p class="text-muted text-center mb-4 fw-light">Illimité</p>
                                        <h5 class="text-success text-center mb-4">
                                            Jusqu'à 3 propriétés
                                        </h5>
                                        <table class="mx-auto">
                                            <tr>
                                                <td>
                                                    <i data-feather="check" class="icon-md text-primary me-2"></i>
                                                </td>
                                                <td>
                                                    <p>Jusqu'à 3 propriétés</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <i data-feather="check" class="icon-md text-primary me-2"></i>
                                                </td>
                                                <td><p>Support premium</p></td>
                                            </tr>
                                        </table>
                                        <div class="d-grid">
                                            <a href="{{ route('buy.business.plan') }}" class="btn btn-success mt-4">
                                                Acheter maintenant
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="text-center mt-3 mb-4">
                                            Professionel
                                        </h4>
                                        <i data-feather="briefcase" class="text-primary icon-xxl d-block mx-auto my-3"></i>
                                        <h1 class="text-center">$50</h1>
                                        <p class="text-muted text-center mb-4 fw-light">Illimité</p>
                                        <h5 class="text-primary text-center mb-4">
                                            Jusqu'à 10 propriétés
                                        </h5>
                                        <table class="mx-auto">
                                            <tr>
                                                <td>
                                                    <i data-feather="check" class="icon-md text-primary me-2"></i>
                                                </td>
                                                <td><p>Jusqu'à 10 propriétés</p></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <i data-feather="check" class="icon-md text-primary me-2"></i>
                                                </td>
                                                <td><p>Support premium</p></td>
                                            </tr>
                                        </table>
                                        <div class="d-grid">
                                            <a href="{{ route('buy.professional.plan') }}" class="btn btn-primary mt-4">
                                                Acheter maintenant
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection



