<div class="col-md-8">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit user</h4>
        </div>
        <div class="card-body">
            <form method="post" action="{{ url("admin/users/$user->user_id") }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="patch" />
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>First name</label>
                            <input type="text" class="form-control" placeholder="Enter first name" value="{{$user->firstName}}" name="FirstName">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Last name</label>
                            <input type="text" class="form-control" placeholder="Enter last name" value="{{$user->lastName}}" name="LastName">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" placeholder="Enter email" value="{{$user->email}}" name="Email">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Enter password" value="" name="Password">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 pr-1">
                        <label>Roles</label>
                        <select class="form-control" name="Roles">
                            @foreach($roles as $r)
                                <option value="{{$r->role_id}}"  @if($user->role_id == $r->role_id) selected @endif >{{$r->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 pr-1">
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
                <input type="submit" class="btn btn-info btn-fill pull-right" name="btnEditUser" value="Edit user"/>
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
            demo.showNotification('top','right',4,'Error on changing user!')
        }
    </script>
@endif
