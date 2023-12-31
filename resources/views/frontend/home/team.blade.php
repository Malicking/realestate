@php
    $agents = App\Models\User::where(['role' => 'agent', 'status' => 'active'])->latest()
                            ->limit(5)->get();
@endphp

<section class="team-section sec-pad centred bg-color-1">
    <div class="pattern-layer" style="background-image: url({{ asset('frontend/assets/images/shape/shape-1.png') }});"></div>
    <div class="auto-container">
        <div class="sec-title">
            <h5>Nos Agents</h5>
            <h2>Rentrer en contact avec nos meilleurs agents</h2>
        </div>
        <div class="single-item-carousel owl-carousel owl-theme owl-dots-none nav-style-one">

            @if ($agents)
                @foreach ($agents as $agent)
                <div class="team-block-one">
                    <div class="inner-box">
                        <figure class="image-box">
                            <img src="{{ !empty($agent->photo) ? url('upload/agents/'.$agent->photo) : url('upload/no_image.jpg') }}" alt="" style="width:370px; height: 370px;">
                        </figure>
                        <div class="lower-content">
                            <div class="inner">
                                <h4>
                                    <a href="{{ route('agent.details', $agent->id) }}">{{ $agent->name }}</a>
                                </h4>
                                <span class="designation">{{ $agent->email }}</span>
                                <ul class="social-links clearfix">
                                    <li>
                                        <a href="index.html">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="index.html">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="index.html">
                                            <i class="fab fa-google-plus-g"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif

        </div>
    </div>
</section>



