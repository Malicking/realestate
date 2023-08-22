@extends('frontend.frontend_dashboard')

@section('content')

<!-- Titre de la page Start -->
@section('title')
    Posts par catégorie
@endsection
<!-- Titre de la page End -->

<!--Page Title-->
<section class="page-title centred" style="background-image: url({{ url('frontend/assets/images/background/page-title-5.jpg') }});">
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>Catégorie</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home.page') }}">Accueil</a></li>
                <li><a href="{{ route('blog.page') }}">Blog</a></li>

                @isset($posts[0]->categories)
                    <li>{{ $posts[0]->categories->category_name }}</li>
                @endisset

            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->


<!-- sidebar-page-container -->
<section class="sidebar-page-container blog-grid sec-pad-2">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="blog-grid-content">
                    <div class="row clearfix">

                        @foreach ($posts as $item)
                        <div class="col-lg-6 col-md-6 col-sm-12 news-block">
                            <div class="news-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image">
                                            <a href="{{ route('blog.page.detail', $item->post_slug) }}">
                                                <img src="{{ !empty($item->post_image) ? url($item->post_image) : url('upload/no_image.jpg') }}" alt="" style="width: 370px; height: 250px;">
                                            </a>
                                        </figure>
                                        <span class="category">Nouveau</span>
                                    </div>

                                    <div class="lower-content">
                                        <h4>
                                            <a href="{{ route('blog.page.detail', $item->post_slug) }}">
                                                {{ $item->post_title }}
                                            </a>
                                        </h4>
                                        <ul class="post-info clearfix">
                                            <li class="author-box">
                                                <figure class="author-thumb">
                                                    <img src="{{ url('upload/admin/'.$item->users->photo) }}" alt="" style="width: 30px;">
                                                </figure>
                                                <h5>
                                                    <a>{{ $item->users->name }}</a>
                                                </h5>
                                            </li>
                                            <li>
                                                {{ strftime('%d %B %Y', strtotime($item->created_at)) }}
                                            </li>
                                        </ul>
                                        <div class="text">
                                            <p>
                                                @if (strlen($item->short_desc) > 60)
                                                    {{ substr($item->short_desc, 0, 60).'...' }}
                                                @else
                                                    {{ $item->short_desc }}
                                                @endif
                                            </p>
                                        </div>

                                        <div class="btn-box">
                                            <a href="{{ route('blog.page.detail', $item->post_slug) }}" class="theme-btn btn-two">
                                                Voir détails
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>

                    <div class="pagination-wrapper">
                        <ul class="pagination clearfix">
                            {{ $posts->links('vendor.pagination.custom') }}
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                <div class="blog-sidebar">
                    <div class="sidebar-widget search-widget">
                        <div class="widget-title">
                            <h4>Search</h4>
                        </div>
                        <div class="search-inner">
                            <form action="blog-1.html" method="post">
                                <div class="form-group">
                                    <input type="search" name="search_field" placeholder="Search" required="">
                                    <button type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>


                    <div class="sidebar-widget category-widget">
                        <div class="widget-title">
                            <h4>Catégories</h4>
                        </div>

                        <div class="widget-content">
                            <ul class="category-list clearfix">

                                @foreach ($categories as $item)
                                    @php
                                        $results = count(App\Models\BlogPost::where('blogcat_id', $item->id)->get());
                                    @endphp

                                    <li>
                                        @if ($results > 0)
                                            <a href="{{ route('blog.page.category', $item->id) }}">
                                                {{ $item->category_name }}
                                                <span>({{ $results }})</span>
                                            </a>
                                        @else
                                            <a>
                                                {{ $item->category_name }}
                                                <span>({{ $results }})</span>
                                            </a>
                                        @endif
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>

                    <div class="sidebar-widget post-widget">
                        <div class="widget-title">
                            <h4>Posts recents</h4>
                        </div>

                        <div class="post-inner">

                            @foreach ($lastPosts as $item)
                            <div class="post">
                                <figure class="post-thumb">
                                    <a href="blog-details.html">
                                        <img src="{{ !empty($item->post_image) ? url($item->post_image) : url('upload/no_image.jpg') }}" alt="" style="width: 80px; height: 80px;">
                                    </a>
                                </figure>
                                <h5>
                                    <a href="blog-details.html">
                                        Best interior design idea for your home.
                                    </a>
                                </h5>
                                <span class="post-date">April 10, 2020</span>
                            </div>
                            @endforeach

                        </div>
                    </div>

                    <div class="sidebar-widget tags-widget">
                        <div class="widget-title">
                            <h4>Popular Tags</h4>
                        </div>
                        <div class="widget-content">
                            <ul class="tags-list clearfix">
                                <li><a href="blog-details.html">Real Estate</a></li>
                                <li><a href="blog-details.html">HouseHunting</a></li>
                                <li><a href="blog-details.html">Architecture</a></li>
                                <li><a href="blog-details.html">Interior</a></li>
                                <li><a href="blog-details.html">Sale</a></li>
                                <li><a href="blog-details.html">Rent Home</a></li>
                                <li><a href="blog-details.html">Listing</a></li>
                            </ul>
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


