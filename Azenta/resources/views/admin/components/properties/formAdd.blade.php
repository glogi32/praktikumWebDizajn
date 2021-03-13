<div class="col-md-10">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add new property</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route("properties.store")}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" placeholder="Enter property name" value="" name="Name">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Price</label>
                                <input type="number" class="form-control" placeholder="Enter price of property $" value="" name="Price">
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Adress</label><br />
                                <input type="text" class="form-control" placeholder="Enter address" value="" name="Address">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>City</label><br />
                                <select class="form-control" name="City">
                                    <option value="0">Choose...</option>
                                    @foreach($cities as $c)
                                        <option value="{{$c->city_id}}">{{$c->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Status:</label><br />
                                <input type="radio" class="" value="sale" name="Status" checked /> <label>For sale</label> &nbsp;
                                <input type="radio" class="" value="rent" name="Status" /> <label>For rent</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description</label><br />
                                <textarea rows="5" cols="85" name="Description"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Type property</label><br />
                                <select class="form-control" name="Type">
                                    <option value="0">Choose...</option>
                                    @foreach($types as $t)
                                        <option value="{{$t->type_id}}">{{$t->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Post expire at</label>
                                <input type="date" class="form-control" min="{{date('Y-m-d')}}" placeholder="Enter expire date" value="" name="DateExpire">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 pr-1">
                            <label>Surface area</label>
                            <input type="number" min="50" max="5000" class="form-control" placeholder="Enter surface area" name="Surface" />
                        </div>
                        <div class="col-md-3 pr-1">
                            <label>Rooms</label>
                            <input type="number" min="0" max="15" class="form-control" placeholder="Enter number of rooms" name="Rooms" />
                        </div>
                        <div class="col-md-3 pr-1">
                            <label>Bathrooms</label>
                            <input type="number" min="0" max="15" class="form-control" placeholder="Enter number of bathrooms" name="Bathrooms" />
                        </div>
                        <div class="col-md-3 pr-1">
                            <label>Garages</label>
                            <input type="number" min="0" max="15" class="form-control" placeholder="Enter number of garages" name="Garages" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" name="Image" class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>Front page:</label><br />
                                <input type="checkbox" name="Featured" class="" value="1"><label>Featured</label> &nbsp;
                                <input type="checkbox" name="Main" class="" value="1"><label>Main</label>
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
                    <input type="hidden" name="User" value="@if(session()->has("user")) {{session("user")->user_id}} @endif" />
                    <button type="submit" class="btn btn-info btn-fill pull-right" name="btnInsertUser">Insert property</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>


@if(session()->has("signUpError"))
    {{session("insertPropertyError")}}
    <script>
        window.onload = function () {
            demo.showNotification('top','right',2,'{{session("insertPropertyError")}}')
        }
    </script>
@endif

@if(session()->has("insertPropertySuccess"))
    <script>
        window.onload = function () {
            demo.showNotification('top','right',2,'{{session("insertPropertySuccess")}}')
        }
    </script>
@endif
@if($errors->all())
    <script>
        window.onload = function () {
            demo.showNotification('top','right',4,'Error on adding property!')
        }
    </script>
@endif
