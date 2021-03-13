@extends("layouts.template")

@section("title")
    Reservations
@endsection

@section("content")
    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>Reservations</h2>
                        <div class="bt-option">
                            <a href="{{route("home")}}">Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card strpied-tabled-with-hover">
                        <div class="card-header ">
                            <h4 class="card-title">Table users</h4>
                        </div>
                        <div class="card-body table-full-width table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                <th>No.</th>
                                <th>User name</th>
                                <th>Room name</th>
                                <th>Check in date</th>
                                <th>Check out date</th>
                                <th>Adults</th>
                                <th>Children</th>
                                <th>Total price</th>
                                <th>Reservation created at</th>
                                <th>Cancel reservation</th>
                                </thead>
                                @csrf
                                <tbody id="tableReservations">
                                    @php
                                        $i=1;
                                    @endphp
                                @isset($user)
                                    @foreach($user->reservation as $r)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$user->first_name}} {{$user->last_name}}</td>
                                            <td>{{$r->name}}</td>
                                            <td>{{date("d:m:Y",strtotime($r->pivot->check_in))}}</td>
                                            <td>{{date("d:m:Y",strtotime($r->pivot->check_out))}}</td>
                                            <td>{{$r->pivot->adults}}</td>
                                            <td>{{$r->pivot->children}}</td>
                                            <td>{{$r->pivot->total_price}}$</td>
                                            <td>{{date("d:m:Y",strtotime($r->pivot->created_at))}}</td>
                                            <td><a href="#" data-id="{{$r->pivot->id}}"  class="btn btn-danger waves-effect btn-xs cancelReservation"><i class="material-icons">Cancel</i></a></td>

                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach
                                @endisset
                                </tbody>
                                <input type="hidden" id="userId" name="user" value="@if(session()->has("user")){{session("user")->id}}@endif">
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Video Section Begin -->
    <section class="video-section set-bg" data-setbg="img/video-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="video-text">
                        <h2>Discover Our Hotel & Services.</h2>
                        <p>It S Hurricane Season But We Are Visiting Hilton Head Island</p>
                        <a href="https://www.youtube.com/watch?v=EzKkl64rRbM" class="play-btn video-popup"><img
                                src="img/play.png" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Video Section End -->


@endsection
