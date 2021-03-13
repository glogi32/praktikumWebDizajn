<div class="col-md-12">
    <div class="card strpied-tabled-with-hover">
        <div class="card-header ">
            <h4 class="card-title">Table properties</h4>
            <p class="card-category">All active properties</p>
        </div>
        <div class="card-body table-full-width table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                <th>No.</th>
                <th>Name</th>
                <th>Address</th>
                <th>City</th>
                <th>Status</th>
                <th>Price</th>
                <th>Last updated</th>
                <th>Agent</th>
                <th>Type</th>
                <th>Created at</th>
                <th>Expired at</th>
                <th>Update</th>
                <th>Delete</th>
                </thead>
                <tbody id="tableProperties">
                @php
                    $i=1;
                @endphp
                @foreach($properties as $p)

                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$p->propertyName}}</td>
                        <td>{{$p->address}}</td>
                        <td>{{$p->cityName}}</td>
                        <td>{{$p->status}}</td>
                        <td>{{$p->price}}</td>
                        <td>@if($p->updatedProperty) {{date("d-m-Y,  G:i",$p->updatedProperty)}} @else / @endif</td>
                        <td>{{$p->firstName}} {{$p->lastName}}</td>
                        <td>{{$p->typeName}}</td>
                        <td>{{date("d-m-Y",$p->datePost)}}</td>
                        <td>{{date("d-m-Y",$p->dateExpired)}}</td>
                        <td><a href="{{ route("properties.edit",$p->property_id) }}"  class="btn btn-info waves-effect btn-xs"><i class="material-icons">Edit</i></a></td>
                        <td><a href="" data-id="{{$p->property_id}}"  data-token="{{ csrf_token() }}" class="btn btn-danger waves-effect btn-xs deleteProperty"><i class="material-icons">Delete</i></a></td>

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
@if(session()->has("deleteError"))
    <script>
        window.onload = function () {
            demo.showNotification('top','right',4,'{{session("deleteError")}}')
        }
    </script>
@endif

@if(session()->has("deleteSuccess"))
    <script>
        window.onload = function () {
            demo.showNotification('top','right',2,'{{session("deleteSuccess")}}')
        }
    </script>
@endif

