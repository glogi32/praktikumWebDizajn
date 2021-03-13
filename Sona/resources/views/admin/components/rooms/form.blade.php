<div class="card strpied-tabled-with-hover">
    <div class="card-header ">
        <h4 class="card-title">Table rooms</h4>
    </div>
    <div class="card-body table-full-width table-responsive">
        <table class="table table-hover table-striped" >
            <thead>
            <th>No.</th>
            <th>Name</th>
            <th>Size</th>
            <th>Max persons</th>
            <th>Beds</th>
            <th>Price</th>
            <th>Available rooms</th>
            <th>Created at</th>
            <th>Last updated</th>
            <th>Featured</th>
            <th>Update</th>
            <th>Delete</th>
            </thead>
            <tbody id="tableRooms">
            @csrf
            @php
                $i=1;
            @endphp
            @foreach($rooms as $r)

                <tr>
                    <td>{{$i}}</td>
                    <td>{{$r->name}}</td>
                    <td>{{$r->size}}</td>
                    <td>{{$r->max_persons}}</td>
                    <td>{{$r->beds}}</td>
                    <td>{{$r->price}}</td>
                    <td>{{$r->available_rooms}}</td>
                    <td>@if($r->created_at) {{date("d:m:Y,  G:i",strtotime($r->created_at))}} @else / @endif</td>
                    <td>@if($r->updated_at) {{date("d:m:Y,  G:i",strtotime($r->updated_at))}} @else / @endif</td>
                    <td><input name="featured" value="{{$r->id}}" class="featuredRooms" type="checkbox" @if($r->featured) checked @endif ></td>
                    <td><a href="{{$r->urlEdit}}"  class="btn btn-info waves-effect btn-xs"><i class="material-icons">Edit</i></a></td>
                    <td><a href="#" data-id="{{$r->id}}"  class="btn btn-danger waves-effect btn-xs deleteRoom"><i class="material-icons">Delete</i></a></td>

                </tr>
                @php
                    $i++;
                @endphp
            @endforeach
            </tbody>

        </table>
    </div>
</div>
