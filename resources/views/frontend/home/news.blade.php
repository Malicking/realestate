@php
    $posts = App\Models\BlogPost::latest()->limit(3)->get();
@endphp


<section class="news-section sec-pad">
    <div class="auto-container">
        <div class="sec-title centred">
            <h5>Actualité & Articles</h5>
            <h2>Rester informé avec MalickRoi</h2>
            <p>Dans cette partie, nous affichons les dernières nouvelles consernant <br />l'immobilier, les finances, l'éducation, etc.</p>
        </div>
        <div class="row clearfix">

            @foreach ($posts as $item)
            <div class="col-lg-4 col-md-6 col-sm-12 news-block">
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
                                    <h5><a href="#">{{ $item->users->name }}</a></h5>
                                </li>
                                <li>{{ strftime('%d %B %Y', strtotime($item->created_at)) }}</li>
                                {{-- <li>{{ $item->created_at->format('d M Y') }}</li> --}}
                            </ul>
                            <div class="text">
                                <p>{{ $item->short_intro }}</p>
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
    </div>
</section>

