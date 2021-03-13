<div class="col-md-8">
    <div class="card strpied-tabled-with-hover">
        <div class="card-header ">
            <h4 class="card-title">Table posts</h4>
            <p class="card-category">All active posts</p>
        </div>
        <div class="card-body table-full-width table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                <th>No.</th>
                <th>Title</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>Author</th>
                <th>Update</th>
                <th>Delete</th>
                </thead>
                <tbody id="tablePosts">
                @php
                    $i=1;
                @endphp
                @foreach($posts as $p)

                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$p->title}}</td>
                        <td>{{date("d-m-Y",$p->created_at)}}</td>
                        <td>@if($p->updated_at) {{date("d-m-Y",$p->updated_at)}} @else / @endif</td>
                        <td>{{$p->firstName}} {{$p->lastName}}</td>
                        <td><a href="{{ route("posts.edit",$p->post_id) }}"  class="btn btn-info waves-effect btn-xs"><i class="material-icons">Edit</i></a></td>
                        <td><a href="#" data-id="{{$p->post_id}}"  data-token="{{ csrf_token() }}" class="btn btn-danger waves-effect btn-xs deletePost"><i class="material-icons">Delete</i></a></td>
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

