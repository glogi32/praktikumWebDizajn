@extends("layouts/template")

@section("title")
    Single property
@endsection

@section("middle")
    <section class="pd-hero-section set-bg" data-setbg="{{asset("img/feature/product-content-bg.jpg")}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="pd-hero-text">
                        <p class="room-location"><i class="icon_pin"></i> {{$property->address}}, {{$property->cityName}}</p>
                        <h2>{{$property->propertyName}}</h2>
                        <div class="room-price">
                            <span>Start Form:</span>
                            @if($property->status == "sale")
                                <p>${{number_format($property->price)}}</p>
                            @else
                                <p>${{number_format($property->price)}} <span>/ month</span></p>
                            @endif
                        </div>
                        <ul class="room-features">
                            <li>
                                <i class="fa fa-arrows"></i>
                                <p>{{$property->surfaceArea}} m2</p>
                            </li>
                            <li>
                                <i class="fa fa-bed"></i>
                                <p>{{$property->numRooms}} Rooms</p>
                            </li>
                            <li>
                                <i class="fa fa-bath"></i>
                                <p>{{$property->numBathrooms}} Bathrooms</p>
                            </li>
                            <li>
                                <i class="fa fa-car"></i>
                                <p>{{$property->numGarage}} Garage</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Property Details Hero Section Begin -->

    <!-- Property Details Section Begin -->
    <section class="property-details-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="pd-details-text">
                        <div class="pd-details-social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-send"></i></a>
                            <a href="#"><i class="fa fa-star"></i></a>
                            <a href="#"><i class="fa fa-print"></i></a>
                            <a href="#"><i class="fa fa-cloud-download"></i></a>
                        </div>
                        <div class="property-more-pic">
                            <div class="product-pic-zoom">
                                <img class="product-big-img" src="{{asset($property->srcProperty)}}" alt="">
                            </div>

                        </div>
                        <div class="pd-details-tab">
                            <div class="tab-item">
                                <ul class="nav" role="tablist">
                                    <li>
                                        <a class="active" data-toggle="tab" href="#tab-1" role="tab">Overview</a>
                                    </li>
                                    <li>
                                        <a data-toggle="tab" href="#tab-2" role="tab">Description</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-item-content">
                                <div class="tab-content">
                                    <div class="tab-pane fade-in active" id="tab-1" role="tabpanel">
                                        <div class="property-more-table">
                                            <table class="left-table">
                                                <tbody>
                                                <tr>
                                                    <td class="pt-name">Name</td>
                                                    <td class="p-value">{{$property->propertyName}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="pt-name">Price</td>
                                                    @if($property->status == "sale")
                                                    <td class="p-value">$ {{number_format($property->price)}}</td>
                                                    @else
                                                        <td class="p-value">$ {{number_format($property->price)}}<span>/month</span></td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td class="pt-name">Property Type</td>
                                                    <td class="p-value">{{$property->typeName}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="pt-name">Bathrooms</td>
                                                    <td class="p-value">{{$property->numBathrooms}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="pt-name">Rooms</td>
                                                    <td class="p-value">{{$property->numRooms}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="pt-name">Surface area</td>
                                                    <td class="p-value">{{$property->surfaceArea}} m2</td>
                                                </tr>
                                                <tr>
                                                    <td class="pt-name">Garages</td>
                                                    <td class="p-value">{{$property->numGarage}}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <table class="right-table">
                                                <tbody>
                                                <tr>
                                                    <td class="pt-name">Agent</td>
                                                    <td class="p-value">{{$property->firstName}} {{$property->lastName}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="pt-name">Reference</td>
                                                    <td class="p-value">#2020</td>
                                                </tr>
                                                <tr>
                                                    <td class="pt-name">Contract type</td>
                                                    <td class="p-value">{{$property->status}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="pt-name">City</td>
                                                    <td class="p-value">{{$property->cityName}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="pt-name">Address</td>
                                                    <td class="p-value">{{$property->address}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="pt-name">Date post</td>
                                                    <td class="p-value">{{date("d-m-Y",$property->datePost)}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="pt-name">Date expire</td>
                                                    <td class="p-value">{{date("d-m-Y",$property->dateExpired)}}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab-2" role="tabpanel">
                                        <div class="pd-table-desc">
                                            <p>{{$property->description}}</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="property-map">
                            <h4>Map</h4>
                            <div class="map-inside">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2942.5524090066037!2d-71.10245469994108!3d42.47980730490846!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89e3748250c43a43%3A0xe1b9879a5e9b6657!2sWinter%20Street%20Public%20Parking%20Lot!5e0!3m2!1sen!2sbd!4v1577299251173!5m2!1sen!2sbd"
                                    height="320" style="border:0;" allowfullscreen=""></iframe>
                                <div class="icon">
                                    <i class="fa fa-home"></i>
                                </div>
                            </div>
                        </div>
                        <div class="property-contactus">
                            <h4>Contact agent</h4>
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="agent-desc">
                                        <img src="{{asset($property->srcUser)}}" alt="">
                                        <div class="agent-title">
                                            <h5>{{$property->firstName}} {{$property->lastName}}</h5>
                                            <span>Company Agent</span>
                                        </div>
                                        <div class="agent-social">
                                            <a href="#"><i class="fa fa-facebook"></i></a>
                                            <a href="#"><i class="fa fa-twitter"></i></a>
                                            <a href="#"><i class="fa fa-google-plus"></i></a>
                                            <a href="#"><i class="fa fa-envelope"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 offset-lg-1">
                                    @if(session()->has("user"))
                                        <form action="" method="post" class="agent-contact-form">

                                            <input type="hidden" name="Property" id="tbProperty" value="{{$property->property_id}}">
                                            <input type="hidden" name="Agent" id="tbAgent" value="{{$property->user_id}}">
                                            <input type="hidden" name="User" id="tbUser" value="@if(session()->has("user")) {{$property->user_id}} @endif">
                                            <label class="">Send message as @if(session()->has("user")) {{session("user")->firstName}} {{session("user")->lastName}} @endif</label>
                                            <textarea placeholder="Message" id="taMessage"  name="Message"></textarea>
                                            <button type="button" data-token="{{csrf_token()}}" id="btnSendMessage" class="site-btn">Send Message</button>
                                        </form>
                                    @else
                                        <h3>Log in to contact agent.</h3>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="property-sidebar">

                        <div class="best-agents">
                            <h4>Our Best Agents</h4>
                            <ul class="comment-list">
                                @foreach($bestAgents as $b)
                                    <li class="comment">
                                        <a href="#" class="ba-item comment">
                                            <div class="vcard bio">
                                                <img src="{{asset($b->srcUser)}}" alt="{{$b->altUser}}">
                                            </div>
                                            <div class="ba-text">
                                                <h5>{{$b->firstName}} {{$b->lastName}}</h5>
                                                <span>Company Agents</span>
                                                <p class="property-items">{{$b->propertiesNumber}} properties</p>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
