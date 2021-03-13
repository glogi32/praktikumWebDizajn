@extends("layouts.template")

@section("title")
    Blog
@endsection

@section("content")
    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>Blog</h2>
                        <div class="bt-option">
                            <a href="{{route("home")}}">Home</a>
                            <span>Blog Grid</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <!-- Blog Section Begin -->
    <section class="blog-section blog-page spad">
        <div class="container">
            <div class="row" id="posts">
                @foreach($posts as $p)
                    <div class="col-lg-4 col-md-6">
                        <div class="blog-item set-bg" data-setbg="{{$p->image->src}}">
                            <div class="bi-text">
                                @foreach($p->topic as $t)
                                    <span class="b-tag">{{$t->name}}</span>
                                @endforeach
                                <h4><a href="{{route("post",$p->id)}}">{{$p->title}}</a></h4>
                                <div class="b-time"><i class="icon_clock_alt"></i> {{date("dS F, Y",strtotime($p->created_at))}}</div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="col-lg-12">
                <div class="load-more">
                    <a href="#" id="loadMore" class="primary-btn">Load More</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
    @endsection
