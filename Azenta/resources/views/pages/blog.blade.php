    @extends("layouts/template")

    @section("title")
        Blog
    @endsection

    @section("middle")
        <!-- Breadcrumb Section Begin -->
        <section class="breadcrumb-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-text">
                            <h2>Blog List</h2>
                            <div class="breadcrumb-option">
                                <a href="#"><i class="fa fa-home"></i> Home</a>
                                <span>Blog Default</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Breadcrumb Section Begin -->

        <!-- Blog Section Begin -->
        <section class="blog-section blog-page spad">
            <div class="container">
                <div class="row" id="posts">
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

                </div>
                <div class="col-lg-12">
                    <div class="loadmore">
                        <a href="#" class="primary-btn" data-page="6" id="loadMorePost">Load More</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- Blog Section End -->
    @endsection
