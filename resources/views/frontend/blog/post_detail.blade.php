@extends('frontend.frontend_dashboard')

@section('content')

<!-- Titre de la page Start -->
@section('title')
    Détails du post
@endsection
<!-- Titre de la page End -->

<!--Page Title-->
<section class="page-title centred" style="background-image: url({{ url('frontend/assets/images/background/page-title-5.jpg') }});">
    <div class="auto-container">
        <div class="content-box clearfix">
            <h2 class="fw-bold mb-3 h1" style="color:aliceblue;">{{ $postData->post_title }}</h2>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home.page') }}">Accueil</a></li>
                <li><a href="{{ route('blog.page') }}">Blog</a></li>
                <li>Détails</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->


<!-- sidebar-page-container -->
<section class="sidebar-page-container blog-details sec-pad-2">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="blog-details-content">
                    <div class="news-block-one">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image">
                                    <img src="{{ !empty($postData->post_image) ? url($postData->post_image) : url('upload/no_image.jpg') }}" alt="" style="width: 770px; height: 520px;">
                                </figure>
                                <span class="category">Nouveau</span>
                            </div>
                            <div class="lower-content">
                                <h3>{{ $postData->post_title }}</h3>
                                <ul class="post-info clearfix">
                                    <li class="author-box">
                                        <figure class="author-thumb">
                                            <img src="{{ url('upload/admin/'.$postData->users->photo) }}" alt="" style="width: 30px;">
                                        </figure>
                                        <h5><a href="#">{{ $postData->users->name }}</a></h5>
                                    </li>
                                    <li>
                                        {{ strftime('%d %B %Y', strtotime($postData->created_at)) }}
                                    </li>
                                </ul>
                                <div class="text">
                                    <p>{!! $postData->long_desc !!}</p>
                                </div>
                                <div class="post-tags">
                                    <ul class="tags-list clearfix">
                                        <li><h5>Tags:</h5></li>

                                        @foreach ($tags as $item)
                                            <li><a>{{ ucwords($item) }}</a></li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

@php
    $comments = App\Models\Comment::where(['post_id' => $postData->id, 'parent_id' => null])
                                    ->latest()->limit(5)->get();
@endphp

                    @if ($comments)
                    <div class="comments-area">
                        <div class="group-title">

                            @if (count($comments) > 1)
                                <h4>{{ count($comments) }} commentaires</h4>
                            @else
                                <h4>{{ count($comments) }} commentaire</h4>
                            @endif

                        </div>
                        <div class="comment-box">

                            @foreach ($comments as $item)
                                <div class="comment">
                                    <figure class="thumb-box">
                                        <img src="{{ !empty($item->users->photo) ? url('upload/users/'.$item->users->photo) : url('upload/no_image.jpg') }}" alt="" style="width: 60px; height: 60px;">
                                    </figure>
                                    <div class="comment-inner">
                                        <div class="comment-info clearfix">
                                            <h5>{{ $item->users->name }}</h5>
                                            <span>{{ strftime('%d %B %Y', strtotime($item->created_at)) }}</span>
                                        </div>
                                        <div class="text">
                                            <p>{!! $item->message !!}</p>
                                            <a href="blog-details.html">
                                                <i class="fas fa-share"></i>Répondre
                                            </a>
                                        </div>
                                    </div>
                                </div>

                        @php
                            $replay = App\Models\Comment::where('parent_id', $item->id)->get();
                        @endphp

                                @if ($replay)
                                    @foreach ($replay as $item)
                                    <div class="comment replay-comment">
                                        <figure class="thumb-box">
                                            <img src="{{ !empty($item->users->photo) ? url('upload/admin/'.$item->users->photo) : url('upload/no_image.jpg') }}" alt="" style="width: 40px">
                                        </figure>
                                        <div class="comment-inner">
                                            <div class="comment-info clearfix">
                                                <h5>{{ $item->users->name }}</h5>
                                                <span>{{ strftime('%d %B %Y', strtotime($item->created_at)) }}</span>
                                            </div>
                                            <div class="text">
                                                <p>{!! $item->message !!}</p>
                                                <a href="blog-details.html">
                                                    <i class="fas fa-share"></i>Répondre
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif

                            @endforeach
                        </div>
                    </div>
                    @endif

                    <div class="comments-form-area">
                        <div class="group-title">
                            <h4>Laisser un commentaire</h4>
                        </div>

                        @auth
                            <form action="{{ route('blog.comment.store') }}" method="post" class="comment-form default-form">
                                @csrf

                                <input type="hidden" name="post_id" value="{{ $postData->id }}">

                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <input type="text" name="subject" placeholder="Objet..." required="">
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <textarea name="message" placeholder="Votre message..."></textarea>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn">
                                        <button type="submit" class="theme-btn btn-one">
                                            Envoyer
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @else
                            <p>
                                <b>
                                    Pour commenter, vous devez vous
                                    <a href="{{ route('login') }}">connecter</a>
                                </b>
                            </p>
                        @endauth
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
                            <h4>Articles recents</h4>
                        </div>
                        <div class="post-inner">

                            @foreach ($lastPosts as $item)
                            <div class="post">
                                <figure class="post-thumb">
                                    <a href="{{ route('blog.page.detail', $item->post_slug) }}">
                                        <img src="{{ !empty($item->post_image) ? url($item->post_image) : url('upload/no_image.jpg') }}" alt="" style="width: 80px; height: 80px;">
                                    </a>
                                </figure>
                                <h5>
                                    <a href="{{ route('blog.page.detail', $item->post_slug) }}">
                                        {{ $item->post_title }}
                                    </a>
                                </h5>
                                <span class="post-date">
                                    {{ strftime('%d %B %Y', strtotime($item->created_at)) }}
                                </span>
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


