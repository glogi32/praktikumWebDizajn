<div class="single-property-item">
    <a href="{{url("/property-single/".$p->property_id)}}">
        <div class="row">
            <div class="col-md-4">
                <div class="property-pic">
                    <img src="{{$p->srcProperty}}" alt="{{$p->altProperty}}">
                </div>
            </div>
            <div class="col-md-8">
                <div class="property-text">
                    <div class="s-text">For {{$p->status}}</div>
                    <h5 class="r-title">{{$p->propertyName}}</h5>
                    <div class="room-price">
                        <span>Start From:</span>
                        @if($p->status == "sale")
                            <h5>${{number_format($p->price)}}</h5>
                        @else
                            <h5>${{number_format($p->price)}} <span> / month</span></h5>
                        @endif
                    </div>
                    <div class="properties-location"><i class="icon_pin"></i> {{$p->address}}, {{$p->cityName}}</div>
                    <p>{{$p->descriptionShort}}</p>
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
            </div>
        </div>
    </a>
</div>
