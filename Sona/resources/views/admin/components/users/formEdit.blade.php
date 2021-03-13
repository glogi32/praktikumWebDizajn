<div class="col-md-8">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit user</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route("users.update",$user->id)}}" enctype="multipart/form-data">
                @csrf
                <input name="_method" type="hidden" value="PUT">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>First name</label>
                            <input type="text" class="form-control" placeholder="Enter first name" value="{{$user->first_name}}" name="firstName">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Last name</label>
                            <input type="text" class="form-control" placeholder="Enter last name" value="{{$user->last_name}}" name="lastName">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" class="form-control" placeholder="Enter phone" value="{{$user->phone}}" name="phone">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" placeholder="Enter email" value="{{$user->email}}" name="email">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Enter password" value="" name="password">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 pr-1">
                        <label>Roles</label>
                        <select class="form-control" name="ddlRoles">
                            @foreach($roles as $r)
                                <option value="{{$r->id}}"  @if($user->role->id == $r->id) selected @endif >{{$r->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 pr-1">
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="userImage" class="form-control" value="">
                        </div>
                    </div>
                </div>
                <div id="feedback">
                    <ul>
                        @isset($errors)
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        @endisset
                    </ul>
                </div>
                <input type="submit" class="btn btn-info btn-fill pull-right" name="btnEditUser" value="Edit user" />
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>




@if(session()->has("editError"))
    <script>
        window.onload = function () {
            demo.showNotification('top','right',4,'{{session("editError")}}')
        }
    </script>
@endif

@if(session()->has("editSuccess"))
    <script>
        window.onload = function () {
            demo.showNotification('top','right',2,'{{session("editSuccess")}}')
        }
    </script>
@endif
@if($errors->all())
    <script>
        window.onload = function () {
            demo.showNotification('top','right',4,'Error on adding user!')
        }
    </script>
@endif
