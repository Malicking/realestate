@extends('admin.messages.layoutMsg')

@section('contenu')

<div class="p-3 border-bottom d-flex align-items-center justify-content-between flex-wrap"></div>

<div class="email-list">

    @if (count($messages))
        <!-- email list item -->
        @foreach ($messages as $msg)
            <div class="email-list-item email-list-item--unread">
                <a href="{{ route('admin.property.message.details', $msg->id) }}" class="email-list-detail">
                    <div class="content">
                        <span class="from">
                            {{ $msg['users']['name'] }}
                        </span>
                        <p class="msg">
                            {!! $msg->message !!}
                        </p>
                    </div>
                    <span class="date">
                        {{ $msg->created_at->formatLocalized('%d %B %Y') }}
                    </span>
                </a>
            </div>
        @endforeach
    @else
    <p class="text-info h5" style="margin-left: 2%;">Aucun message</p>
    @endif

</div>

@endsection


