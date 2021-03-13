@extends("layouts/admin")

@section("title")
    Notifications
@endsection

@section("middle")
    <div class="col-md-12">
        <div class="card strpied-tabled-with-hover">
            <div class="card-header ">
                <h4 class="card-title">Table users</h4>
                <p class="card-category">All active users</p>
            </div>
            <div class="card-body table-full-width table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                    <th>No.</th>
                    <th>Subject</th>
                    <th>URL</th>
                    <th>Method</th>
                    <th>Ip</th>
                    <th>User agent</th>
                    <th>User id</th>
                    <th>Date</th>
                    </thead>
                    <tbody id="tablePosts">
                    @php
                        $i=1;
                    @endphp
                    @foreach($logs as $l)

                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$l->subject}}</td>
                            <td>{{$l->url}}</td>
                            <td>{{$l->method}}</td>
                            <td>{{$l->ip}}</td>
                            <td>{{$l->user_agent}}</td>
                            <td>@if($l->user_id) {{$l->user_id}} @else / @endif</td>
                            <td>{{date("d-M-Y",$l->time)}} at {{date("H:i:s",$l->time)}}</td>
                        </tr>
                        @php
                            $i++;
                        @endphp
                    @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
