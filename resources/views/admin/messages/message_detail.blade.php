@extends('admin.messages.layoutMsg')

@section('contenu')

<div class="p-3 border-bottom d-flex align-items-center justify-content-between flex-wrap"></div>

<div class="email-list">

    @isset($msgData)
    <div class="table-responsive">
        <table class="table">
            <tbody>
                <tr>
                    <th>Nom du client :</th>
                    <td>{{ $msgData->users->name }}</td>
                </tr>

                <tr>
                    <th>Email du client :</th>
                    <td>{{ $msgData->users->email }}</td>
                </tr>

                <tr>
                    <th>Téléphone du client :</th>
                    <td>{{ $msgData->users->phone }}</td>
                </tr>

                <tr>
                    <th>Propriété :</th>
                    <td>{{ $msgData->properties->property_name }}</td>
                </tr>

                <tr>
                    <th>Statut de la propriété :</th>
                    @php
                        $status = $msgData->properties->status
                    @endphp

                    @if ($status)
                        <td>
                            <span class="badge bg-success fw-bolder ms-auto">Active</span>
                        </td>
                    @else
                        <td>
                            <span class="badge bg-danger fw-bolder ms-auto">Active</span>
                        </td>
                    @endif
                </tr>

                <tr>
                    <th>Agent :</th>
                    <td>
                        {{ $msgData->users->name }}
                        @if ($msgData->users->phone)
                            ({{ $msgData->users->phone }})
                        @endif
                    </td>
                </tr>

                <tr>
                    <th>Message :</th>
                    <td>{{ $msgData->message }}</td>
                </tr>

                <tr>
                    <th>Date d'envoie :</th>
                    <td>{{ $msgData->created_at->formatLocalized('%d %B %Y') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    @endisset

</div>

@endsection

