<div class="col-md-8">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add service</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route("services.store")}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" placeholder="Enter service name" value="{{old("name")}}" name="name">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" class="form-control" placeholder="Enter service price" value="{{old("price")}}" name="price">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Icon class name</label>
                            <input type="text" class="form-control" placeholder="Enter icon class name" value="{{old("iconClassName")}}" name="iconClassName">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea rows="7" class="form-control" placeholder="Enter service description..." name="description">{{old("description")}}</textarea>
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
                <button type="submit" class="btn btn-info btn-fill pull-right" name="btnInsertService">Add service</button>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>




@if(session()->has("insertServiceError"))
    <script>
        window.onload = function () {
            demo.showNotification('top','right',4,'{{session("insertServiceError")}}')
        }
    </script>
@endif

@if(session()->has("insertServiceSuccess"))
    <script>
        window.onload = function () {
            demo.showNotification('top','right',2,'{{session("insertServiceSuccess")}}')
        }
    </script>
@endif
@if($errors->all())
    <script>
        window.onload = function () {
            demo.showNotification('top','right',4,'Error on adding service!')
        }
    </script>
@endif
