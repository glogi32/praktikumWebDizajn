@extends("layouts.adminTemplate")

@section("content")
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
                                @isset($messages)
                                    @foreach($messages as $m)
                                        @if($m->seen   == 0)
                                            <div class="card">
                                                <div class="card-header bg-info">
                                                    <li class="comment">
                                                        <div class="comment-body text-white">
                                                            <p>Name: {{$m->name}}</p>
                                                            <p>Email: {{$m->email}}</p>
                                                            <div class="meta">{{date("d-m-Y",strtotime($m->created_at))}} at {{date("H:i:s",strtotime($m->created_at))}}</div>
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
                                                        <div class="comment-body text-white">
                                                            <p>Name: {{$m->name}}</p>
                                                            <p>Email: {{$m->email}}</p>
                                                            <div class="meta">{{date("d-m-Y",strtotime($m->created_at))}} at {{date("H:i:s",strtotime($m->created_at))}}</div>
                                                        </div>
                                                </div>
                                                <div class="card-body">
                                                    <p>{{$m->text}}</p>

                                                </div>
                                                </li>

                                            </div>
                                        @endif
                                    @endforeach
                                @endisset
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
