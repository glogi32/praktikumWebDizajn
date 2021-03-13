<div class="card strpied-tabled-with-hover">
    <div class="card-header ">
        <h4 class="card-title">Table users</h4>
    </div>
    <div class="card-body table-full-width table-responsive">
        <table class="table table-hover table-striped">
            <thead>
            <th>No.</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Role</th>
            <th>Last updated</th>
            <th>Created at</th>
            <th>Update</th>
            <th>Delete</th>
            </thead>
            @csrf
            <tbody id="tableUsers">

            @php
                $i=1;
            @endphp
            @foreach($users as $u)

                <tr>
                    <td>{{$i}}</td>
                    <td>{{$u->first_name}}</td>
                    <td>{{$u->last_name}}</td>
                    <td>{{$u->email}}</td>
                    <td>{{$u->phone}}</td>
                    <td>{{$u->role->name}}</td>
                    <td>@if($u->updated_at) {{date("d:m:Y,  G:i",strtotime($u->updated_at))}} @else / @endif</td>
                    <td>@if($u->created_at) {{date("d:m:Y,  G:i",strtotime($u->created_at))}} @else / @endif</td>
                    <td><a href="{{$u->urlEdit}}"  class="btn btn-info waves-effect btn-xs"><i class="material-icons">Edit</i></a></td>
                    <td><a href="#" data-id="{{$u->id}}"  class="btn btn-danger waves-effect btn-xs deleteUser"><i class="material-icons">Delete</i></a></td>

                </tr>
                @php
                    $i++;
                @endphp
            @endforeach
            </tbody>

        </table>
    </div>
</div>
