@extends("layouts.template")

@section("title")
    Post
@endsection

@section("content")
    <!-- Blog Details Hero Section Begin -->
    <section class="blog-details-hero set-bg" data-setbg="{{asset($post->image->src)}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="bd-hero-text">
                        @foreach($post->topic as $t)
                            <span>{{$t->name}}</span>
                        @endforeach
                        <h2>{{$post->title}}</h2>
                        <ul>
                            <li class="b-time"><i class="icon_clock_alt"></i> {{date("dS F, Y",strtotime($post->created_at))}}</li>
                            <li><i class="icon_profile"></i> {{$post->user->first_name}} {{$post->user->last_name}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Hero End -->

    <!-- Blog Details Section Begin -->
    <section class="blog-details-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="blog-details-text">
                        <div>
                            {!!$post->text!!}
                        </div>
                        <div class="tag-share">
                                <div class="tags">
                                    @foreach($post->topic as $t)
                                        <a href="#">{{$t->name}}</a>
                                    @endforeach
                                </div>
                            <div class="social-share">
                                <span>Share:</span>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-tripadvisor"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-youtube-play"></i></a>
                            </div>
                        </div>
                        <div class="comment-option">
                            <h4>{{count($post->comment)}} Comments</h4>
                            @foreach($post->comment as $c)
                                <div class="single-comment-item second-comment">
                                    @if(session()->has("user"))
                                        @if(session("user")->role->id == 1)
                                            &nbsp;&nbsp;&nbsp;<a href="#" data-id="{{$c->id}}"  class="btn btn-danger waves-effect btn-xs deletePostComment"><i class="material-icons text-white">Delete</i></a>
                                        @endif
                                    @endif
                                    <div class="sc-author">
                                        <img src="{{asset($c->user->image->src)}}" alt="{{$c->user->image->alt}}">
                                    </div>

                                    <div class="sc-text">
                                        <span>{{date("dS F, Y",strtotime($c->created_at))}}</span>
                                        <h5>{{$c->user->first_name}} {{$c->user->last_name}}</h5>
                                        <p>{{$c->text}}</p>
                                    </div>
                                </div>

                            @endforeach
                        </div>
                        <div class="leave-comment">
                            <h4>Leave A Comment</h4>
                            <form action="#" class="comment-form">
                                @if(session()->has("user"))
                                <div class="row">
                                    <div class="col-lg-6">
                                        <p>Comment as: {{session("user")->first_name}} {{session("user")->last_name}}</p>
                                    </div>
                                    <div class="col-lg-12 text-center">
                                        <textarea placeholder="Messages" id="taText"></textarea>
                                        <button type="button" id="btnPostComment" class="site-btn">Send Message</button>
                                    </div>
                                </div>
                                    @csrf
                                    <input type="hidden" id="userId" name="user" value="@if(session()->has("user")){{session("user")->id}}@endif">
                                    <input type="hidden" id="postId" value="{{$post->id}}">
                                @else
                                    <h3>You must be registered to post a comment!</h3>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Section End -->

    <!-- Recommend Blog Section Begin -->
    <section class="recommend-blog-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Recommended</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($featuredPosts as $f)
                    <div class="col-md-4">
                        <div class="blog-item set-bg" data-setbg="{{asset($f->image->src)}}">
                            <div class="bi-text">
                                @foreach($f->topic as $t)
                                    <span class="b-tag">{{$t->name}}</span>
                                @endforeach
                                <h4><a href="{{route("post",$f->id)}}">{{$f->title}}</a></h4>
                                <div class="b-time"><i class="icon_clock_alt"></i> {{date("dS F, Y",strtotime($f->created_at))}}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Recommend Blog Section End -->
    @endsection
