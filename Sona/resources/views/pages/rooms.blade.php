@extends("layouts.template")

@section("title")
    Rooms
    @endsection

@section("content")
    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>Our Rooms</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <!-- Rooms Section Begin -->
    <section class="rooms-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="property-sidebar">
                        <h4>Search Rooms</h4>
                        <form action="#" class="sidebar-search">
                            <div class="sidebar-btn">
                                <input class="form-control mr-sm-2" name="tbSearchRooms" id="tbSearchRooms" type="text" placeholder="Search by room name" aria-label="Search">
                            </div>
                            <select id="ddlBeds">
                                <option value="null">Number of beds</option>
                                <option value="1-2">1-2</option>
                                <option value="2-4">2-4</option>
                                <option value="4-6">4-6</option>
                                <option value="6-8">6-8</option>
                            </select>
                            <select id="ddlMaxPersons">
                                <option value="null">Max persons</option>
                                <option value="1-2">1-2</option>
                                <option value="2-4">2-4</option>
                                <option value="4-6">4-6</option>
                                <option value="6-8">6-8</option>
                                <option value="8-10">8-10</option>
                            </select>

                            <div class="room-size-range">
                                <div class="price-text">
                                    <label for="roomsizeRangeP">Size:</label>
                                    <input type="text" id="roomsizeRangeP" readonly>
                                </div>
                                <div id="roomsize-range-P" class="slider"></div>
                            </div>
                            <div class="price-range-wrap">
                                <div class="price-text">
                                    <label for="priceRangeP">Price:</label>
                                    <input type="text" id="priceRangeP" readonly>
                                </div>
                                <div id="price-range-P" class="slider"></div>
                            </div>
                            <h4>Services:</h4>
                            <div class="form-check">

                                <div class="row">
                                    @foreach($services as $s)
                                        <div class="col-lg-6">
                                            <input class="form-check-input services" type="checkbox" name="services" value="{{$s->id}}" >
                                            <label class="form-check-label" for="flexCheckDefault">
                                                {{$s->name}}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <button type="button" id="btnSubmitSearch" class="search-btn">Search Rooms</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row rooms">

                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="room-pagination">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Rooms Section End -->
    @endsection
