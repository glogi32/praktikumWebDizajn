@foreach($posts as $p)
    <div class="col-lg-4 col-md-6">
        <div class="single-blog-item">
            <div class="sb-pic">
                <img src="{{asset($p->src)}}" alt="{{$p->alt}}">
            </div>
            <div class="sb-text">
                <ul>
                    <li><i class="fa fa-user"></i> {{$p->firstName}} {{$p->lastName}}</li>
                    <li><i class="fa fa-clock-o"></i> {{date("d, M Y",$p->created_at)}}</li>
                </ul>
                <h4><a href="{{url("/post-single/".$p->post_id)}}">{{$p->title}}</a></h4>
            </div>
        </div>
    </div>
@endforeach
