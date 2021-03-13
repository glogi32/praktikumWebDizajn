<div class="col-md-7">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit post</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url("admin/posts/$post->post_id") }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="patch" />
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" placeholder="Enter post title" value="{{$post->title}}" name="Title">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Image</label><br/>
                            <input type="file" name="Image" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Content</label><br/>
                            <textarea id="summernote" class="form-control" rows="20"  name="Text">{{$post->text}}</textarea>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="idUser" value="@if(session()->has("user")) {{session("user")->user_id}} @endif">
                <div id="feedback">
                    <ul>
                        @isset($errors)
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        @endisset
                    </ul>
                </div>
                <button type="submit" class="btn btn-info btn-fill pull-right" name="btnInsertPost">Edit post</button>
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

