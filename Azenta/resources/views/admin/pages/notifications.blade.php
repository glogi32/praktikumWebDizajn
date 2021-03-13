@extends("layouts/admin")

@section("title")
    Notifications
@endsection

@section("middle")
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Messages</h4>
                            <p class="card-category">All messages from users</p>
                        </div>
                        <div class="card-body">
                            <ul class="comment-list">
                                @if(session("user")->role_id == 3)
                                    @foreach($messages as $m)
                                        @if($m->seen == 0)
                                            <div class="card">
                                                <div class="card-header bg-info">
                                                    <li class="comment">
                                                        <div class="vcard bio">
                                                            <img src="{{asset($m->src)}}" alt="{{$m->alt}}">
                                                        </div>
                                                        <div class="comment-body">
                                                            <h3>{{$m->firstName}} {{$m->lastName}}</h3>
                                                            <div class="meta">{{date("d-m-Y",$m->dateNotifyPost)}} at {{date("H:i:s",$m->dateNotifyPost)}}</div>
                                                            <br /><h5>For property: {{$m->name}}</h5>
                                                        </div>
                                                </div>
                                                <div class="card-body">
                                                    <p>{{$m->text}}</p>

                                                </div>
                                                </li>

                                            </div>
                                        @else
                                            <div class="card">
                                                <div class="card-header bg-success">
                                                    <li class="comment">
                                                        <div class="vcard bio">
                                                            <img src="{{asset($m->src)}}" alt="{{$m->alt}}">
                                                        </div>
                                                        <div class="comment-body">
                                                            <h3>{{$m->firstName}} {{$m->lastName}}</h3>
                                                            <div class="meta">{{date("d-m-Y",$m->dateNotifyPost)}} at {{date("H:i:s",$m->dateNotifyPost)}}</div>
                                                            <br /><h5>For property: {{$m->name}}</h5>
                                                        </div>
                                                </div>
                                                <div class="card-body">
                                                    <p>{{$m->text}}</p>

                                                </div>
                                                </li>

                                            </div>
                                        @endif
                                    @endforeach
                                @endif


                            @if(session("user")->role_id == 1)
                                    @foreach($messages as $m)
                                        @if($m->seen   == 0)
                                            <div class="card">
                                                <div class="card-header bg-info">
                                                    <li class="comment">
                                                        <div class="comment-body">
                                                            <h3>Name: {{$m->name}}</h3>
                                                            <h3>Email: {{$m->email}}</h3>
                                                            <div class="meta">{{date("d-m-Y",$m->datePost)}} at {{date("H:i:s",$m->datePost)}}</div>
                                                        </div>
                                                </div>
                                                <div class="card-body">
                                                    <p>{{$m->text}}</p>

                                                </div>
                                                </li>

                                            </div>
                                        @else
                                                <div class="card">
                                                    <div class="card-header bg-success">
                                                        <li class="comment">
                                                            <div class="comment-body">
                                                                <h3>Name: {{$m->name}}</h3>
                                                                <h3>Email: {{$m->email}}</h3>
                                                                <div class="meta">{{date("d-m-Y",$m->datePost)}} at {{date("H:i:s",$m->datePost)}}</div>
                                                            </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <p>{{$m->text}}</p>

                                                    </div>
                                                    </li>

                                                </div>
                                        @endif
                                    @endforeach
                                @endif
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
