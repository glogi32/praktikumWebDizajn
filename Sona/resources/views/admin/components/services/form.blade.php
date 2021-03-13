<div class="card strpied-tabled-with-hover">
    <div class="card-header ">
        <h4 class="card-title">Table services</h4>
    </div>
    <div class="card-body table-full-width table-responsive">
        <table class="table table-hover table-striped">
            <thead>
            <th>No.</th>
            <th>Name</th>
            <th>Price</th>
            <th>Icon class name</th>
            <th>Featured</th>
            <th>Last updated</th>
            <th>Created at</th>
            <th>Update</th>
            <th>Delete</th>
            </thead>
            @csrf
            <tbody id="tableServices">

            @php
                $i=1;
            @endphp
            @foreach($services as $s)

                <tr>
                    <td>{{$i}}</td>
                    <td>{{$s->name}}</td>
                    <td>{{$s->price}}</td>
                    <td>{{$s->icon_class_name}}</td>
                    <td><input name="featured" value="{{$s->id}}" class="featuredServices" type="checkbox" @if($s->featured) checked @endif ></td>
                    <td>@if($s->updated_at) {{date("d:m:Y,  G:i",strtotime($s->updated_at))}} @else / @endif</td>
                    <td>@if($s->created_at) {{date("d:m:Y,  G:i",strtotime($s->created_at))}} @else / @endif</td>
                    <td><a href="{{$s->urlEdit}}"  class="btn btn-info waves-effect btn-xs"><i class="material-icons">Edit</i></a></td>
                    <td><a href="#" data-id="{{$s->id}}"  class="btn btn-danger waves-effect btn-xs deleteService"><i class="material-icons">Delete</i></a></td>

                </tr>
                @php
                    $i++;
                @endphp
            @endforeach
            </tbody>

        </table>
    </div>
</div>
