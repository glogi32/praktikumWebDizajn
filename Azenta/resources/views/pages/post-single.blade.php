@extends("layouts/template")

@section("title")
    Post
@endsection

@section("middle")

    <!-- Blog Details Hero Section Begin -->
    <section class="blog-details-hero set-bg" data-setbg="{{asset("img/blog/blog-details-hero.jpg")}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bd-hero-text">
                        <h2>{{$post->title}}</h2>
                        <ul>
                            <li><i class="fa fa-user"></i> {{$post->firstName}} {{$post->lastName}}</li>
                            <li><i class="fa fa-clock-o"></i> {{date("d, M Y",$post->created_at)}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--  Blog Details Hero Section Begin -->

    <!-- Blog Details Section Begin -->
    <section class="blog-details-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-1 offset-lg-1">
                    <div class="blog-details-social">
                        <h6>Share</h6>
                        <div class="social-list">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-google-plus"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="blog-details-title">
                        {!! $post->text !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">

                    <div class="tag-share-option">
                        <div class="tags">
                            <a href="#">Real Estate</a>
                            <a href="#">Properties</a>
                        </div>
                        <div class="social-share">
                            <span>Share:</span>
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-google-plus"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-youtube-play"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pt-5">
                @if($comments)
                <h3 class="mb-5">{{$commentsNumber->commentsNumber}} Comments</h3>
                <ul class="comment-list">
                    @foreach($comments as $c)
                        <li class="comment">
                            <div class="vcard bio">
                                <img src="{{asset($c->src)}}" alt="{{$c->alt}}">
                            </div>
                            <div class="comment-body">
                                <h3>{{$c->firstName}} {{$c->lastName}}</h3>
                                <div class="meta">{{date("M d, Y",$c->postTime)}} at {{date("h:i",$c->postTime)}}</div>
                                <p>{{$c->text}}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <!-- END comment-list -->
                @else
                    <h3>No comments</h3>
                @endif
                <div class="row">
                    <div class="col-lg-10 offset-lg-1">
                        @if(session()->has("user"))
                            <div class="leave-comment">
                                <h4>Leave A Comment As {{session("user")->firstName}} {{session("user")->lastName}}</h4>
                                <form action="#" method="POST">
                                    @csrf
                                    <div class="row">

                                    </div>
                                    <textarea placeholder="Your message" id="text" name="Text"></textarea>
                                    <input type="hidden" name="User" id="tbUser" value="{{session("user")->user_id}}">
                                    <input type="hidden" name="Post" id="tbPost" value="{{$post->post_id}}">
                                    <button type="button" id="btnSendComment" class="site-btn">Send Message</button>
                                </form>
                            </div>
                        @else
                            <h2>U must be logged in to leave comments.</h2>
                        @endif
                    </div>
                </div>
                <br /><br /><br /><br /><br /><br /><br />
            </div>
        </div>
    </section>
    <!-- Blog Details Section End -->
@endsection
