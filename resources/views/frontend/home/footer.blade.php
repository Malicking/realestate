@php
    $setting = App\Models\SiteSetting::first();
    $blog = App\Models\BlogPost::latest()->limit(2)->get();
@endphp

<footer class="main-footer">
    <div class="footer-top bg-color-2">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                    <div class="footer-widget about-widget">
                        <div class="widget-title">
                            <h3>About</h3>
                        </div>
                        <div class="text">
                            <p>Lorem ipsum dolor amet consetetur adi pisicing elit sed eiusm tempor in cididunt ut labore dolore magna aliqua enim ad minim venitam</p>
                            <p>Quis nostrud exercita laboris nisi ut aliquip commodo.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                    <div class="footer-widget links-widget ml-70">
                        <div class="widget-title">
                            <h3>Services</h3>
                        </div>
                        <div class="widget-content">
                            <ul class="links-list class">
                                <li><a href="index.html">About Us</a></li>
                                <li><a href="index.html">Listing</a></li>
                                <li><a href="index.html">How It Works</a></li>
                                <li><a href="index.html">Our Services</a></li>
                                <li><a href="index.html">Our Blog</a></li>
                                <li><a href="index.html">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                    <div class="footer-widget post-widget">
                        <div class="widget-title">
                            <h3>Top News</h3>
                        </div>
                        <div class="post-inner">

                            @foreach ($blog as $item)
                            <div class="post">
                                <figure class="post-thumb">
                                    <a href="{{ route('blog.page.detail', $item->post_slug) }}">
                                        <img src="{{ url($item->post_image) }}" alt="" style="width: 90px; height: 90px;">
                                    </a>
                                </figure>
                                <h5><a href="{{ route('blog.page.detail', $item->post_slug) }}">{{ $item->post_title }}</a></h5>
                                <p>{{ strftime('%d %B %Y', strtotime($item->created_at)) }}</p>
                            </div>
                            @endforeach
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                    <div class="footer-widget contact-widget">
                        <div class="widget-title">
                            <h3>Contacts</h3>
                        </div>
                        <div class="widget-content">
                            <ul class="info-list clearfix">
                                <li>
                                    <i class="fas fa-map-marker-alt"></i>
                                   {{ $setting->company_address }}
                                </li>
                                <li>
                                    <i class="fas fa-microphone"></i>
                                    <a href="tel:{{ $setting->support_phone }}">
                                        {{ $setting->support_phone }}
                                    </a>
                                </li>
                                <li><i class="fas fa-envelope"></i>
                                    <a href="mailto:{{ $setting->email }}">
                                        {{ $setting->email }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="auto-container">
            <div class="inner-box clearfix">
                <figure class="footer-logo">
                    <a href="{{ route('home.page') }}">
                        <img src="{{ url($setting->logo) }}" alt="" width="120px">
                    </a>
                </figure>
                <div class="copyright pull-left">
                    <p>
                        <a href="{{ route('home.page') }}">
                            MalickRoi
                        </a> &copy; {{ date('Y') }} Tous droits reservés.
                    </p>
                </div>
                <ul class="footer-nav pull-right clearfix">
                    <li><a href="{{ route('home.page') }}">Terms of Service</a></li>
                    <li><a href="{{ route('home.page') }}">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
