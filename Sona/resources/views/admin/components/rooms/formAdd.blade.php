<div class="col-md-8">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add room</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route("rooms.store")}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" placeholder="Enter room name" value="{{old("name")}}" name="name">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Size</label>
                            <input type="text" class="form-control" placeholder="Enter room size" value="{{old("size")}}" name="size">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Max persons</label>
                            <input type="number" class="form-control" placeholder="Enter max persons" value="{{old("maxPersons")}}" name="maxPersons">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Beds</label>
                            <input type="number" class="form-control" placeholder="Enter number of beds" value="{{old("beds")}}" name="beds">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" class="form-control" placeholder="Enter room price" value="{{old("price")}}" name="price">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea rows="7" class="form-control" placeholder="Enter room description" name="description">{{old("description")}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Available rooms</label>
                            <input type="number" class="form-control" placeholder="Enter number of available rooms" value="{{old("availableRooms")}}" name="availableRooms">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Service price percentage</label>
                            <input type="text" class="form-control" placeholder="Enter service price percentage" value="{{old("pricePercentage")}}" name="pricePercentage">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Services:</label>
                        </div>
                        <div class="row">
                            @foreach($services as $s)
                                <div class="col-md-4">
                                    <label>{{$s->name}}</label>
                                    <input type="checkbox" value="{{$s->id}}-{{$s->price}}" name="services[]">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8 pr-1">
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="roomImage" class="form-control" value="">
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
                <button type="submit" class="btn btn-info btn-fill pull-right" name="btnInsertUser">Add room</button>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>




@if(session()->has("insertRoomError"))
    <script>
        window.onload = function () {
            demo.showNotification('top','right',4,'{{session("insertRoomError")}}')
        }
    </script>
@endif

@if(session()->has("insertRoomSuccess"))
    <script>
        window.onload = function () {
            demo.showNotification('top','right',2,'{{session("insertRoomSuccess")}}')
        }
    </script>
@endif
@if($errors->all())
    <script>
        window.onload = function () {
            demo.showNotification('top','right',4,'Error on adding room!')
        }
    </script>
@endif
