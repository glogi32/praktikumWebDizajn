<div class="card strpied-tabled-with-hover">
    <div class="card-header ">
        <h4 class="card-title">Table users</h4>
        <p class="card-category">All properties</p>
    </div>
    <div class="card-body table-full-width table-responsive">
        <table class="table table-hover table-striped">
            <thead>
            <th>No.</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Last updated</th>
            <th>Update</th>
            <th>Delete</th>
            </thead>
            <tbody id="tableUsers">
            @php
                $i=1;
            @endphp
            @foreach($users as $u)

                <tr>
                    <td>{{$i}}</td>
                    <td>{{$u->firstName}}</td>
                    <td>{{$u->lastName}}</td>
                    <td>{{$u->email}}</td>
                    <td>{{$u->name}}</td>
                    <td>@if($u->updated_at) {{date("d:m:Y,  G:i",$u->updated_at)}} @else / @endif</td>
                    <td><a href="{{ route('users.edit',  $u->user_id) }}"  class="btn btn-info waves-effect btn-xs"><i class="material-icons">Edit</i></a></td>
                    <td><a href="{{ route('users.destroy',$u->user_id) }}" data-id="{{$u->user_id}}"  class="btn btn-danger waves-effect btn-xs deleteUser"><i class="material-icons">Delete</i></a></td>
                    @csrf
                </tr>
                @php
                    $i++;
                @endphp
            @endforeach
            </tbody>

        </table>
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

