@extends('frontend.frontend_dashboard')

@section('content')

@php
    $id = Auth::user()->id;
    $userData = App\Models\User::find($id);
@endphp

<!-- Titre de la page Start -->
@section('title')
    Mes de demandes de visite
@endsection
<!-- Titre de la page End -->

<!--Page Title-->
<section class="page-title centred" style="background-image: url({{ !empty($userData->cover_photo) ? url('upload/users/covers/'.$userData->cover_photo) : url('frontend/assets/images/background/page-title-5.jpg') }});">
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>Visites de propriétés </h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home.page') }}">Accueil</a></li>
                <li>Mes demandes de visite </li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->

<!-- sidebar-page-container -->
<section class="sidebar-page-container blog-details sec-pad-2">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                <div class="blog-sidebar">
                    <div class="sidebar-widget post-widget">
                        <div class="widget-title">
                            <h4>Visites de propriétés </h4>
                        </div>
                        <div class="post-inner">
                            <div class="post">
                                <figure class="post-thumb">
                                    <a href="blog-details.html">
                                        <img src="{{ !empty($userData->photo) ? url('upload/users/'.$userData->photo) : url('upload/no_image.jpg') }}" alt="">
                                    </a>
                                </figure>
                                <h5>
                                    <a href="blog-details.html">
                                        {{ $userData->name }}
                                    </a>
                                </h5>
                                <p>{{ $userData->email }} </p>
                            </div>
                        </div>
                    </div>

                    <div class="sidebar-widget category-widget">

                        @include('frontend.dashboard.dashboard_sidebar')

                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="blog-details-content">
                    <div class="news-block-one">
                        <div class="inner-box">

                            <div class="lower-content">
                                <h3>Mes demandes de visite de propriétés.</h3>

                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Propriété</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Heure</th>
                                            <th scope="col">Statut</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($schedules && count($schedules)>0)
                                            @foreach ($schedules as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->properties->property_name }}</td>

                                                <td>
                                                    {{ strftime('%d %B %Y', strtotime($item->tour_date)) }}
                                                </td>

                                                <td>{{ $item->tour_time }}</td>

                                                <td>
                                                    @if ($item->status)
                                                        <span class="badge rounded-pill badge-success py-1">
                                                            Confirmée
                                                        </span>
                                                    @else
                                                        <span class="badge rounded-pill badge-danger p-2">
                                                            En attente
                                                        </span>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- sidebar-page-container -->

@include('frontend.home.subscribe')


@endsection

