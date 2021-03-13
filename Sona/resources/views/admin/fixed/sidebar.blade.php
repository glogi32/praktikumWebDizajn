<div class="sidebar" data-image="{{asset("img/sidebar-5.jpg")}}">
    <!--
Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

Tip 2: you can also add an image using data-image tag
-->
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text">
                Creative Tim
            </a>
        </div>
        <ul class="nav sidenav">
            <li>
                <div class="btn-group">
                    <a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#">
                        <i class="nc-icon nc-circle-09"></i>
                        Users
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <a href="{{route("users.index")}}" class="dropdown-item">Show users</a>
                        <a href="{{route("users.create")}}" class="dropdown-item">Add user</a>
                    </ul>
                </div>
            </li>
            <li>
                <div class="btn-group">
                    <a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#">
                        <i class="nc-icon nc-istanbul"></i>
                        Rooms
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <a href="{{route("rooms.index")}}" class="dropdown-item">Show rooms</a>
                        <a href="{{route("rooms.create")}}" class="dropdown-item">Add room</a>
                    </ul>
                </div>
            </li>
            <li>
                <div class="btn-group">
                    <a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#">
                        <i class="nc-icon nc-satisfied"></i>
                        Services
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <a href="{{route("services.index")}}" class="dropdown-item">Show services</a>
                        <a href="{{route("services.create")}}" class="dropdown-item">Add services</a>
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
                        <a href="{{route("posts.index")}}" class="dropdown-item">Show posts</a>
                        <a href="{{route("posts.create")}}" class="dropdown-item">Add post</a>
                    </ul>
                </div>
            </li>
            <li>
                <div class="btn-group">
                    <a class=" nav-link"  href="{{route("logs")}}">
                        <i class="nc-icon nc-align-center"></i>
                        Logs
                    </a>
                </div>
            </li>

        </ul>
    </div>
</div>
