@extends('agent.agentDashboard')

@section('content')
<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb"> </ol>
    </nav>

    <div class="row">
        <div class="col-md-8">
            <div class="card">

                <div class="p-3">
                    <h6 class="card-title">Détails: Demande de visite</h6>
                </div>

                <form action="{{ route('agent.property.schedule.update') }}" method="post">
                    @csrf

                    <input type="hidden" name="id" value="{{ $schedule->id }}">
                    <input type="hidden" name="email" value="{{ $schedule->users->email }}">

                    <div class="table-responsive mb-2">
                        <table class="table table-bordered">
                            <tbody>
                                
                                <tr>
                                    <td>Expéditeur</td>
                                    <td>{{ $schedule->users->name }}</td>
                                </tr>
                                <tr>
                                    <td>Propriété</td>
                                    <td>{{ $schedule->properties->property_name }}</td>
                                </tr>
                                <tr>
                                    <td>Date de visite</td>
                                    <td>{{ strftime('%d %B %Y', strtotime($schedule->tour_date)) }}</td>
                                </tr>
                                <tr>
                                    <td>Heure de visite</td>
                                    <td>{{ $schedule->tour_time }}</td>
                                </tr>
                                <tr>
                                    <td>Message</td>
                                    <td>{{ $schedule->message }}</td>
                                </tr>
                                <tr>
                                    <td>Heure d'envoi</td>
                                    <td>{{ strftime('%A %d-%B-%Y, %H:%M:%S', strtotime($schedule->created_at)) }}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    @if ($schedule->status == 0)
                        <div class="p-3">
                            <button type="submit" class="btn btn-outline-success text-uppercase">
                                Confirmer la visite
                            </button>
                        </div>
                    @endif

                </form>

            </div>
        </div>
    </div>
</div>
@endsection
