@extends('frontend.frontend_dashboard')

@section('content')

<!-- Titre de la page Start -->
@section('title')
    Comparaison 
@endsection
<!-- Titre de la page End -->

@php
    $id = Auth::user()->id;
    $userData = App\Models\User::find($id);
@endphp

<!--Page Title-->
<section class="page-title centred" style="background-image: url({{ !empty($userData->cover_photo) ? url('upload/users/covers/'.$userData->cover_photo) : url('frontend/assets/images/background/page-title-5.jpg') }});">
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>Comparaison </h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home.page') }}">Accueil</a></li>
                <li>Comparaison des propriétés </li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->


@php
    $u_id = Auth::id();
    $compare = App\Models\Compare::where('user_id', $u_id)->latest()->limit(3)->get();
@endphp

<!-- properties-section -->
@if ($compare && $compare != NULL)
<section class="properties-section centred">
    <div class="auto-container">
        <div class="table-outer">
            <table class="properties-table">
                <thead class="table-header">
                    <tr>
                        <th>Infos sur la propriété</th>
                    @if ($compare)
                        @foreach ($compare as $item)
                        <th>
                            <figure class="image-box">
                                <img src="{{ url($item['property']['property_thumbnail']) }}" alt="">
                            </figure>

                            <div class="title">{{ $item->property->property_name }}</div>
                            <div class="price">
                                ${{ number_format($item['property']['lowest_price'], 0, ',', ' ') }}
                            </div>
                        </th>
                        @endforeach
                    @endif
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <p>Ville</p>
                        </td>

                        @if ($compare)
                            @foreach ($compare as $item)
                            <td>
                                <p>{{ $item->property->property_name }}</p>
                            </td>
                            @endforeach
                        @endif
                    </tr>
                    <tr>
                        <td>
                            <p>Quartier</p>
                        </td>

                        @if ($compare)
                            @foreach ($compare as $item)
                            <td>
                                <p>{{ $item->property->neighborhood }}</p>
                            </td>
                            @endforeach
                        @endif
                    </tr>
                    <tr>
                        <td>
                            <p>Superficie</p>
                        </td>

                        @if ($compare)
                            @foreach ($compare as $item)
                            <td>
                                <p>
                                    {{ number_format($item->property->property_size, 0, ',', ' ') }}
                                </p>
                            </td>
                            @endforeach
                        @endif
                    </tr>
                    <tr>
                        <td>
                            <p>Chambres</p>
                        </td>

                        @if ($compare)
                            @foreach ($compare as $item)
                            <td>
                                <p>{{ $item->property->bedrooms }}</p>
                            </td>
                            @endforeach
                        @endif
                    </tr>
                    <tr>
                        <td>
                            <p>Salles de bain</p>
                        </td>

                        @if ($compare)
                            @foreach ($compare as $item)
                            <td>
                                <p>{{ $item->property->bathrooms }}</p>
                            </td>
                            @endforeach
                        @endif
                    </tr>

                    <tr>
                        <td>Actions</td>

                        @if ($compare)
                            @foreach ($compare as $item)
                            <td>
                                <a href="{{ route('compare.remove', $item->id) }}" class="text-danger" style="font-size: 120%;">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                            @endforeach
                        @endif
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>
@endif
<!-- properties-section end -->


@include('frontend.home.subscribe')


@endsection
