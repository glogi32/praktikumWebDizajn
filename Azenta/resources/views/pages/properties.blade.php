    @extends("layouts/template")

    @section("title")
        Properties
    @endsection

    @section("middle")
        <!-- Map Section Begin -->
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
        <!-- Map Section End -->

        <!-- Property Section Begin -->
        <section class="property-section spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="property-sidebar">
                            <h4>Search Property</h4>
                            <form action="#" class="sidebar-search md-4 mr-auto ">
                                <div class="sidebar-btn">
                                    <input class="form-control mr-sm-2" name="tbSearchProperty" id="tbSearchProperty" type="text" placeholder="Search by name or address" aria-label="Search">
                                </div>
                                <div class="sidebar-btn">
                                    <div class="bt-item">
                                        <input type="radio" name="status" id="st-buy" value="sale">
                                        <label for="st-buy">Sale</label>
                                    </div>
                                    <div class="bt-item">
                                        <input type="radio" name="status" id="st-rent" value="rent">
                                        <label for="st-rent">Rent</label>
                                    </div>
                                </div>
                                <select id="ddlCities" name="Cities">
                                    <option value="">Location</option>
                                    @foreach($cities as $c)
                                        <option value="{{$c->city_id}}">{{$c->name}}</option>
                                    @endforeach
                                </select>
                                <select id="ddlRooms" name="Rooms">
                                    <option value="null">No. of Rooms</option>
                                    <option value="0-3">0-2</option>
                                    <option value="2-5">2-4</option>
                                    <option value="4-7">4-6</option>
                                    <option value="6-9">6-8</option>
                                    <option value="8-1000">8+</option>
                                </select>
                                <select id="ddlBathrooms" name="Bathrooms">
                                    <option value="null">No. of Bathrooms</option>
                                    <option value="0-3">0-2</option>
                                    <option value="2-5">2-4</option>
                                    <option value="4-7">4-6</option>
                                    <option value="6-9">6-8</option>
                                    <option value="8-1000">8+</option>
                                </select>
                                <select id="ddlGarages" name="Garages">
                                    <option value="null">No. of Garages</option>
                                    <option value="0-3">0-2</option>
                                    <option value="2-5">2-4</option>
                                    <option value="4-7">4-6</option>
                                    <option value="6-9">6-8</option>
                                    <option value="8-1000">8+</option>
                                </select>
                                <div class="room-size-range">
                                    <div class="price-text">
                                        <label for="roomsizeRangeP">Size:</label>
                                        <input type="text" id="roomsizeRangeP" name="Size" readonly>
                                    </div>
                                    <div id="roomsize-range-P" class="slider"></div>
                                </div>
                                <div class="price-range-wrap">
                                    <div class="price-text">
                                        <label for="priceRangeP">Price:</label>
                                        <input type="text" id="priceRangeP" name="Price" readonly>
                                    </div>
                                    <div id="price-range-P" class="slider"></div>
                                </div>
                                <button type="button" id="btnSubmitSearch" class="search-btn">Search Properties</button>
                            </form>
                            <div class="best-agents">
                                <h4>Best Agents</h4>
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
                    <div class="col-lg-9" id="properties">
                        <h4 class="property-title">Property</h4>
                        <div class="property-list" id="propertiesData">
                            @foreach($properties as $p)
                                @if($p->dateExpired > $currentDate)
                                    @component("components.properties.properties",["p" => $p])
                                    @endcomponent
                                @endif
                            @endforeach
                        </div>
                        <div class="property-pagination" id="propertyPagination">
                            {{$properties->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Property Section End -->

    @endsection
