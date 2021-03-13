@extends("layouts.template")

@section("title")
    Home
@endsection

@section("content")
    <section class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="hero-text">
                        <h1>Sona A Luxury Hotel</h1>
                        <p>Here are the best hotel booking sites, including recommendations for international
                            travel and for finding low-priced hotel rooms.</p>
                        <a href="#" class="primary-btn">Discover Now</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-slider owl-carousel">
            <div class="hs-item set-bg" data-setbg="img/hero/hero-1.jpg"></div>
            <div class="hs-item set-bg" data-setbg="img/hero/hero-2.jpg"></div>
            <div class="hs-item set-bg" data-setbg="img/hero/hero-3.jpg"></div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- About Us Section Begin -->
    <section class="aboutus-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-text">
                        <div class="section-title">
                            <span>About Us</span>
                            <h2>Intercontinental LA <br />Westlake Hotel</h2>
                        </div>
                        <p class="f-para">Sona.com is a leading online accommodation site. We’re passionate about
                            travel. Every day, we inspire and reach millions of travelers across 90 local websites in 41
                            languages.</p>
                        <p class="s-para">So when it comes to booking the perfect hotel, vacation rental, resort,
                            apartment, guest house, or tree house, we’ve got you covered.</p>
                        <a href="{{route("aboutUs")}}" class="primary-btn about-btn">Read More</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-pic">
                        <div class="row">
                            <div class="col-sm-6">
                                <img src="{{asset("img/about/about-1.jpg")}}" alt="">
                            </div>
                            <div class="col-sm-6">
                                <img src="{{asset("img/about/about-2.jpg")}}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Us Section End -->

    <!-- Services Section End -->
    <section class="services-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>What We Do</span>
                        <h2>Discover Our Services</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($services as $s)
                    <div class="col-lg-4 col-sm-6">
                        <div class="service-item">
                            <i class="{{$s->icon_class_name}}"></i>
                            <h4>{{$s->name}}</h4>
                            <p>{{$s->description}}</p>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </section>
    <!-- Services Section End -->

    <!-- Home Room Section Begin -->
    <section class="hp-room-section">
        <div class="container-fluid">
            <div class="hp-room-items">
                <div class="row">
                    @foreach($rooms as $r)
                        <div class="col-lg-3 col-md-6">
                            <div class="hp-room-item set-bg" data-setbg="{{$r->image->src}}">
                                <div class="hr-text">
                                    <h3 class="text-warning">{{$r->name}}</h3>
                                    <h2>{{$r->price}}$<span class="text-warning">/Per night</span></h2>
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td class="r-o text-warning">Size:</td>
                                            <td class="text-warning">{{$r->size}} m<sup class="text-warning">2</sup></td>
                                        </tr>
                                        <tr>
                                            <td class="r-o text-warning">Capacity:</td>
                                            <td class="text-warning">Max persion {{$r->max_persons}}</td>
                                        </tr>
                                        <tr>
                                            <td class="r-o text-warning">Bed:</td>
                                            <td class="text-warning">{{$r->beds}}</td>
                                        </tr>
                                        <tr>
                                            <td class="r-o text-warning">Services:</td>
                                            <td class="text-warning">{{$r->servicesShort}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <a class="text-warning" href="{{url("/room-details/".$r->id)}}" class="primary-btn">More Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach



                </div>
            </div>
        </div>
    </section>
    <!-- Home Room Section End -->

    <!-- Testimonial Section Begin -->
    <section class="testimonial-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Testimonials</span>
                        <h2>What Customers Say?</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="testimonial-slider owl-carousel">
                        @foreach($comments as $c)
                            <div class="ts-item">
                                <p>{{$c->text}}</p>
                                <div class="ti-author">
                                    <div class="rating">
                                        @php
                                            echo html_entity_decode($c->voteHtml);
                                        @endphp
                                    </div>
                                    <h5> - {{$c->user->first_name}} {{$c->user->last_name}}</h5>
                                </div>
                                <img src="{{asset("img/testimonial-logo.png")}}" alt="testimonial-logo">
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonial Section End -->

    <!-- Blog Section Begin -->
    <section class="blog-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Hotel News</span>
                        <h2>Our Blog & Event</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($posts as $p)
                    <div class="col-lg-4">
                        <div class="blog-item set-bg" data-setbg="{{asset($p->image->src)}}">
                            <div class="bi-text">
                                @foreach($p->topic as $t)
                                    <span class="b-tag">{{$t->name}}</span>
                                @endforeach
                                <h4><a href="{{route("post",$p->id)}}">{{$p->title}}</a></h4>
                                <div class="b-time"><i class="icon_clock_alt"></i>{{date("dS F, Y",strtotime($p->created_at))}}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
    @endsection
