@extends("layouts.adminTemplate")

@section("content")
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    <div class="card strpied-tabled-with-hover">
                        <div class="card-header ">
                            <h4 class="card-title">Table users</h4>
                        </div>
                        <div class="card-body table-full-width table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <th>No.</th>
                                    <th>Subject</th>
                                    <th>Url</th>
                                    <th>Method</th>
                                    <th>IP</th>
                                    <th>User agent</th>
                                    <th>User id</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                </thead>
                                @csrf
                                <tbody id="tableLogs">

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
                                        <td>{{$l->user_id}}</td>
                                        <td>@if($l->updated_at) {{date("d:m:Y,  G:i",strtotime($l->updated_at))}} @else / @endif</td>
                                        <td>@if($l->created_at) {{date("d:m:Y,  G:i",strtotime($l->created_at))}} @else / @endif</td>

                                    </tr>
                                    @php
                                        $i++;
                                    @endphp
                                @endforeach
                                </tbody>
                            </table>
                           <div>
                               {{$logs->links()}}
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
