@extends("layouts.template")

@section("title")
    Room {{$room->name}}
@endsection

@section("content")
    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>{{$room->name}}</h2>
                        <div class="bt-option">
                            <a href="{{route("rooms")}}">Rooms</a>
                            <span>Room details</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <!-- Room Details Section Begin -->
    <section class="room-details-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="room-details-item">
                        <img  src="{{asset($room->image->src)}}" alt="{{$room->image->alt}}">
                        <div class="rd-text">
                            <div class="rd-title">
                                <h3>{{$room->name}}</h3>
                                <div class="rdt-right">

                                    <div class="rating">
                                        <h5>Place your rating:</h5><br />
                                        <i class='far fa-star star-rating' data-rating="1"></i>
                                        <i class='far fa-star star-rating' data-rating="2"></i>
                                        <i class='far fa-star star-rating' data-rating="3"></i>
                                        <i class='far fa-star star-rating' data-rating="4"></i>
                                        <i class='far fa-star star-rating' data-rating="5"></i>
                                    </div>
                                </div>
                            </div>
                            <h2>{{$room->price}}$<span>/Pernight</span></h2>
                            <table>
                                <tbody>
                                <tr>
                                    <td class="r-o">Size:</td>
                                    <td>{{$room->size}} m<sup>2</sup></td>
                                </tr>
                                <tr>
                                    <td class="r-o">Capacity:</td>
                                    <td>Max persion {{$room->max_persons}}</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Bed:</td>
                                    <td>{{$room->beds}}</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Services:</td>
                                    <td>{{$room->services}}</td>
                                    <td> </td>
                                </tr>
                                <tr>
                                    <td class="r-o">Rating:</td>
                                    <td>
                                        @php echo html_entity_decode($room->html); @endphp
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <p class="r-o">Description:</p>
                            <p class="f-para">{{$room->description}}
                            </p>
                        </div>
                    </div>
                    <div class="rd-reviews">
                        <h4>Reviews</h4>
                        @foreach($room->comment as $c)
                            <div class="review-item">
                                <div class="ri-pic">
                                    <img src="{{asset($c->user->image->src)}}" alt="{{$c->user->image->alt}}">
                                </div>
                                <div class="ri-text">
                                    <span>{{ date("d-M-Y  H:i:s",strtotime($c->created_at)) }}</span>
                                    <div class="rating">
                                        @php echo html_entity_decode($c->voteHtml); @endphp
                                        @if(session()->has("user"))
                                            @if(session("user")->role->id == 1)
                                                &nbsp;&nbsp;&nbsp;<a href="#" data-id="{{$c->id}}"  class="btn btn-danger waves-effect btn-xs deleteComment"><i class="material-icons text-white">Delete</i></a>
                                            @endif
                                        @endif
                                    </div>
                                    <h5>{{$c->user->first_name}} {{$c->user->last_name}} </h5>
                                    <p>{{$c->text}}</p>
                                </div>
                            </div>

                        @endforeach
                    </div>
                    <div class="review-add">
                        <h4>Add Review</h4>
                        <form action="#" class="ra-form">
                            @if(session()->has("user"))
                            <div class="row">
                                <div class="col-lg-6">
                                    <p>Comment as: {{session("user")->first_name}} {{session("user")->last_name}}</p>
                                </div>
                                <div class="col-lg-12">
                                    <textarea id="taComment" placeholder="Your Review"></textarea>
                                    <button id="btnComment" type="button">Submit Now</button>
                                </div>
                            </div>
                            @else
                                <h3>You must be registered to post a comment!</h3>
                            @endif
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="room-booking">
                        <h3>Your Reservation</h3>
                        <form action="#">
                            @CSRF
                            <div class="check-date">
                                <label for="date-in">Check In:</label>
                                <input type="text" class="date-input" id="date-in">
                                <i class="icon_calendar"></i>
                            </div>
                            <div class="check-date">
                                <label for="date-out">Check Out:</label>
                                <input type="text" class="date-input" id="date-out">
                                <i class="icon_calendar"></i>
                            </div>
                            <div class="select-option">
                                <label for="adults">Adults:</label>
                                <select id="ddlAdults">
                                    <option value="1">1 Adults</option>
                                    <option value="2">2 Adults</option>
                                    <option value="3">3 Adults</option>
                                    <option value="4">4 Adults</option>
                                    <option value="5">5 Adults</option>
                                    <option value="6">6 Adults</option>
                                    <option value="7">7 Adults</option>
                                </select>
                            </div>
                            <div class="select-option">
                                <label for="ddlChildren">Children:</label>
                                <select id="ddlChildren">
                                    <option value="0">0 Child</option>
                                    <option value="1">1 Child</option>
                                    <option value="2">2 Child</option>
                                    <option value="3">3 Child</option>
                                </select>
                            </div>
                            <input type="hidden" id="roomId" name="room" value="{{$room->id}}">

                            <input type="hidden" id="userId" name="user" value="@if(session()->has("user")){{session("user")->id}}@endif">

                            <button type="button" id="btnReservation">Make reservation</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Room Details Section End -->
@endsection
