
    @extends("layouts/template")

    @section("title")
        Home
    @endsection

    @section("middle")
        <!-- Hero Section Begin -->
        <section class="hero-section">
            <div class="hero-items owl-carousel">
                @foreach($properties as $p)
                    @if($p->dateExpired > $currentDate)
                        @if($p->main == 1)
                            <div class="single-hero-item set-bg" data-setbg="{{asset($p->srcProperty)}}">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-8 offset-lg-2">
                                            <a href="{{url("/property-single/".$p->property_id)}}">
                                            <div class="hero-text">
                                                <p class="room-location"><i class="icon_pin"></i> {{$p->address}}, {{$p->cityName}}</p>
                                                <h2>{{$p->propertyName}}</h2>
                                                <div class="room-price">
                                                    @if($p->status == "sale")
                                                        <span>Start Form:</span>
                                                        <p>${{number_format($p->price)}}</p>
                                                    @else
                                                        <span>Start Form:</span>
                                                        <p>${{number_format($p->price)}} <span>/month</span></p>
                                                    @endif
                                                </div>
                                                <ul class="room-features">
                                                    <li>
                                                        <i class="fa fa-arrows"></i>
                                                        <p>{{$p->surfaceArea}} m2</p>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-bed"></i>
                                                        <p>{{$p->numRooms}} Rooms</p>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-bath"></i>
                                                        <p>{{$p->numBathrooms}} Bathrooms</p>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-car"></i>
                                                        <p>{{$p->numGarage}} Garage</p>
                                                    </li>
                                                </ul>
                                            </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                @endforeach
            </div>
            <div class="thumbnail-pic">
                <div class="thumbs owl-carousel">
                    @foreach($properties as $p)
                        @if($p->dateExpired > $currentDate)
                            @if($p->main == 1)
                                <div class="item">
                                    <img src="{{asset($p->srcProperty)}}" alt="">
                                </div>
                            @endif
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
        <!-- Hero Section End -->



        <!-- How It Works Section Begin -->
        <section class="howit-works spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <span>Find Your Dream House</span>
                            <h2>How It Work</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="single-howit-works">
                            <img src="img/howit-works/howit-works-1.png" alt="">
                            <h4>Search & Find Apertment</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="single-howit-works">
                            <img src="img/howit-works/howit-works-2.png" alt="">
                            <h4>Find Your Room</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="single-howit-works">
                            <img src="img/howit-works/howit-works-3.png" alt="">
                            <h4>Talk To Agent</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- How It Works Section End -->

        <!-- Feature Section Begin -->
        <section class="feature-section spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <span>Listing From Our Agents</span>
                            <h2>Featured Properties</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="feature-carousel owl-carousel">
                        @foreach($properties as $p)
                            @if($p->dateExpired > $currentDate)
                                @if($p->featured == 1)
                                    <div class="col-lg-4">
                                        <div class="feature-item">
                                            <a href="{{url("/property-single/".$p->property_id)}}">
                                                <div class="fi-pic set-bg" data-setbg="{{asset($p->srcProperty)}}">
                                                    <div class="pic-tag">
                                                        <div class="f-text">feauture</div>
                                                        @if($p->status == "sale")
                                                            <div class="s-text">For Sale</div>
                                                        @else
                                                            <div class="s-text">For Rent</div>
                                                        @endif
                                                    </div>
                                                    <div class="feature-author">
                                                        <div class="fa-pic">
                                                            <img src="{{$p->srcUser}}" alt="{{$p->altUser}}">
                                                        </div>
                                                        <div class="fa-text">
                                                            <span>{{$p->firstName}} {{$p->lastName}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="fi-text">
                                                <div class="inside-text">
                                                    <h4>{{$p->propertyName}}</h4>
                                                    <ul>
                                                        <li><i class="fa fa-map-marker"></i> {{$p->address}}, {{$p->shortName}}</li>
                                                        <li><i class="fa fa-tag"></i> {{$p->typeName}}</li>
                                                    </ul>
                                                    <h5 class="price">
                                                        @if($p->status == "sale")
                                                            ${{number_format($p->price)}}
                                                        @else
                                                            ${{number_format($p->price)}} <span>/month</span>
                                                        @endif</h5>
                                                </div>
                                                <ul class="room-features">
                                                    <li>
                                                        <i class="fa fa-arrows"></i>
                                                        <p>{{$p->surfaceArea}} k2</p>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-bed"></i>
                                                        <p>{{$p->numRooms}}</p>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-bath"></i>
                                                        <p>{{$p->numBathrooms}}</p>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-car"></i>
                                                        <p>{{$p->numGarage}}</p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!-- Feature Section End -->

        <!-- Video Section Begin -->
        <div class="video-section set-bg" data-setbg="img/video-bg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="video-text">
                            <a href="#" class="play-btn video-popup"><i class="fa fa-play"></i></a>
                            <h4>Find The Perfect</h4>
                            <h2>Real Estate Agent Near You</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Video Section End -->

        <!-- Top Properties Section Begin -->
        <div class="top-properties-section spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="properties-title">
                            <div class="section-title">
                                <span>Top Property For You</span>
                                <h2>Top Properties</h2>
                            </div>
                            <a href="{{url("/properties")}}" class="top-property-all">View All Properties</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="top-properties-carousel owl-carousel">
                    @foreach($top3Properties as $p)
                        @if($p->dateExpired > $currentDate)
                            <div class="single-top-properties">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <a href="{{url("/property-single/".$p->property_id)}}">
                                            <div class="stp-pic">
                                                <img src="{{asset($p->src)}}" alt="">
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="stp-text">
                                            <div class="s-text">For {{$p->status}}</div>
                                            <a href="{{url("/property-single/".$p->property_id)}}">
                                                <h2>{{$p->propertyName}}</h2>
                                            </a>
                                            <div class="room-price">
                                                <span>Start From:</span>
                                                <h4>${{number_format($p->price)}}</h4>
                                            </div>
                                            <div class="properties-location"><i class="icon_pin"></i> {{$p->address}}, {{$p->cityName}}</div>
                                            <p>{{$p->descriptionShort}}</p>
                                            <ul class="room-features">
                                                <li>
                                                    <i class="fa fa-arrows"></i>
                                                    <p>{{$p->surfaceArea}} k2</p>
                                                </li>
                                                <li>
                                                    <i class="fa fa-bed"></i>
                                                    <p>{{$p->numRooms}} Rooms</p>
                                                </li>
                                                <li>
                                                    <i class="fa fa-bath"></i>
                                                    <p>{{$p->numBathrooms}} Bathrooms</p>
                                                </li>
                                                <li>
                                                    <i class="fa fa-car"></i>
                                                    <p>{{$p->numGarage}} Garage</p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Top Properties Section End -->

        <!-- Agent Section Begin -->
        <section class="agent-section spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <span>We Are To Help You</span>
                            <h2>Our Agents</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="agent-carousel owl-carousel">
                        @foreach($agents as $a)
                            <div class="col-lg-3">
                                <div class="single-agent">
                                    <div class="sa-pic">
                                        <img src="{{asset($a->src)}}" alt="{{$a->alt}}">
                                        <div class="hover-social">
                                            <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                                            <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
                                            <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                                        </div>
                                    </div>
                                    <h5>{{$a->firstName}} {{$a->lastName}} <span>Company Agent</span></h5>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!-- Agent Section End -->

        <!-- Latest Blog Section Begin -->
        <section class="blog-section latest-blog spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <span>Blog & Events</span>
                            <h2>Latest posts</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($latest3Posts as $p)
                        <div class="col-lg-4">
                            <div class="single-blog-item">
                                <div class="sb-pic">
                                    <img src="{{$p->src}}" alt="{{$p->alt}}">
                                </div>
                                <div class="sb-text">
                                    <ul>
                                        <li><i class="fa fa-user"></i> {{$p->firstName}} {{$p->lastName}}</li>
                                        <li><i class="fa fa-clock-o"></i> {{date("d M, Y",$p->created_at)}}</li>
                                    </ul>
                                    <h4><a href="#">{{$p->title}}</a></h4>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- Latest Blog Section End -->
    @endsection

