
<div class="modal fade" id="loginForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{route("login")}}">
                <div class="modal-body">

                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="email" name="tbEmail" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="password" name="tbPassword" placeholder="Password">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div id="feedback">
                        @if(session("errorLogin"))
                            <div class="alert alert-danger">
                                {{session("errorLogin")}}
                            </div>
                        @endif
                        <ul>
                            @isset($errors)
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            @endisset
                        </ul>
                    </div>

                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" name="btnLogin" value="Login" />
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="signUpForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sign up</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route("signUp")}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <label for="tbFirstName">First name</label>
                        <input type="text" class="form-control" id="firstName" name="FirstName" aria-describedby="emailHelp" placeholder="Enter first name">
                    </div>
                    <div class="form-group">
                        <label for="tbLastName">Last name</label>
                        <input type="text" class="form-control" id="lastName" name="LastName" aria-describedby="emailHelp" placeholder="Enter last name">
                    </div>
                    <div class="form-group">
                        <label for="tbEmail">Email address</label>
                        <input type="email" class="form-control" id="emailSignUp" name="Email" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="tbPassword">Password</label>
                        <input type="password" class="form-control" id="password" name="Password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="userImage">Image</label>
                        <input type="file" class="form-control" id="userImage" name="userImage">
                    </div>
                    <div id="feedbackSignUp">
                        <ul>
                            @isset($errors)
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            @endisset
                        </ul>
                    </div>
                </div>

                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" name="btnSignUp" value="Sign up" />
                </div>
            </form>
        </div>
    </div>
</div>
