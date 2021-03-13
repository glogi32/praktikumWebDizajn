<div class="modal fade" id="loginForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route("login") }}">
                <div class="modal-body">

                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="email" name="tbEmail" value="" aria-describedby="emailHelp"  placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="password" name="tbPassword"  placeholder="Password">
                    </div>
                    <div id="feedback">
                        @if(session("errorLogin"))
                            <div class="alert alert-danger">
                                {{session("errorLogin")}}
                            </div>
                        @endif
                        <ul>
                            @error("tbEmail")
                                <li>{{ $message }}</li>
                            @enderror
                            @error("tbPassword")
                                <li>{{ $message }}</li>
                            @enderror
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
                        <input type="text" class="form-control @error("firstName") border border-danger @enderror" id="firstName" value="{{old("firstName")}}" name="firstName" aria-describedby="emailHelp" placeholder="Enter first name">
                    </div>
                    <div class="form-group">
                        <label for="tbLastName">Last name</label>
                        <input type="text" class="form-control @error("lastName") border border-danger @enderror" id="lastName" value="{{old("lastName")}}" name="lastName" aria-describedby="emailHelp" placeholder="Enter last name">
                    </div>
                    <div class="form-group">
                        <label for="tbPhone">Phone</label>
                        <input type="text" class="form-control @error("phone") border border-danger @enderror" id="phone" name="phone" value="{{old("phone")}}" aria-describedby="emailHelp" placeholder="Enter phone in format xxx xxx xxxx">
                    </div>
                    <div class="form-group">
                        <label for="tbEmail">Email address</label>
                        <input type="email" class="form-control @error("email") border border-danger @enderror" id="emailSignUp" name="email" value="{{old("email")}}" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="tbPassword">Password</label>
                        <input type="password" class="form-control @error("password") border border-danger @enderror" id="tbPassword" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="userImage">Image</label>
                        <input type="file" class="form-control @error("userImage") border border-danger @enderror" id="userImage"  name="userImage">
                    </div>
                    <div id="feedbackSignUp">
                        @if(session("signUpError"))
                            <div class="alert alert-danger">
                                {{session("signUpError")}}
                            </div>
                        @endif
                        <ul>
                            @if($errors->any())

                                <div class="alert alert-danger">
                                    <ul>
                                    @error('firstName')
                                        <li>{{ $message }}</li>

                                    @enderror
                                    @error('lastName')
                                        <li>{{ $message }}</li>
                                    @enderror
                                    @error('phone')
                                        <li>{{ $message }}</li>
                                        @enderror
                                    @error('email')
                                        <li>{{ $message }}</li>
                                        @enderror
                                    @error('password')
                                        <li>{{ $message }}</li>
                                    @enderror
                                    @error('userImage')
                                        <li>{{ $message }}</li>
                                    @enderror
                                    </ul>
                                </div>
                            @endif

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
