<div class="sidebar" data-image="../assets/img/sidebar-5.jpg">
    <!--
Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

Tip 2: you can also add an image using data-image tag
-->
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="http://www.creative-tim.com" class="simple-text">
                Creative Tim
            </a>
        </div>
        <ul class="nav sidenav">
            @if(session("user")->role_id == 1)
                <li>
                    <div class="btn-group">
                        <a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#">
                            <i class="nc-icon nc-circle-09"></i>
                            Users
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <a href="{{url("admin/users")}}" class="dropdown-item">All users</a>
                            <a href="{{url("admin/users/create")}}" class="dropdown-item">Add user</a>
                        </ul>
                    </div>
                </li>
            @endif
            <li>
                <div class="btn-group">
                    <a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#">
                        <i class="nc-icon nc-istanbul"></i>
                        Properties
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <a href="{{url("admin/properties")}}" class="dropdown-item">All properties</a>
                        @if(session("user")->role_id == 3)
                            <a href="{{url("admin/properties/create")}}" class="dropdown-item">Add property</a>
                        @endif
                    </ul>
                </div>
            </li>
            <li>
                <div class="btn-group">
                    <a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#">
                        <i class="nc-icon nc-paper-2"></i>
                        Posts
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <a href="{{url("admin/posts")}}" class="dropdown-item">All posts</a>
                        <a href="{{url("admin/posts/create")}}" class="dropdown-item">Add post</a>
                    </ul>
                </div>
            </li>
            @if(session("user")->role_id == 1)
                <li>
                    <div class="btn-group">
                        <a class=" nav-link"  href="{{url("admin/logs")}}">
                            <i class="nc-icon nc-align-center"></i>
                            Logs
                        </a>
                    </div>
                </li>
            @endif

        </ul>
    </div>
</div>
