<div class="card strpied-tabled-with-hover">
    <div class="card-header ">
        <h4 class="card-title">Table posts</h4>
    </div>
    <div class="card-body table-full-width table-responsive">
        <table class="table table-hover table-striped" >
            <thead>
                <th>No.</th>
                <th>Author</th>
                <th>Role</th>
                <th>Title</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>Featured</th>
                <th>Update</th>
                <th>Delete</th>
            </thead>
            <tbody id="tableRooms">
            @csrf
            @php
                $i=1;
            @endphp
                @foreach($posts as $p)

                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$p->user->first_name}} {{$p->user->last_name}}</td>
                        <td>{{$p->user->role->name}}</td>
                        <td>{{$p->title}}</td>
                        <td>@if($p->created_at) {{date("d:m:Y,  G:i",strtotime($p->created_at))}} @else / @endif</td>
                        <td>@if($p->updated_at) {{date("d:m:Y,  G:i",strtotime($p->updated_at))}} @else / @endif</td>
                        <td><input name="featured" value="{{$p->id}}" class="featuredPosts" type="checkbox" @if($p->featured) checked @endif ></td>
                        <td><a href="{{$p->urlEdit}}"  class="btn btn-info waves-effect btn-xs"><i class="material-icons">Edit</i></a></td>
                        <td><a href="#" data-id="{{$p->id}}"  class="btn btn-danger waves-effect btn-xs deletePost"><i class="material-icons">Delete</i></a></td>

                    </tr>
                    @php
                        $i++;
                    @endphp
                @endforeach
            </tbody>

        </table>
    </div>
</div>
