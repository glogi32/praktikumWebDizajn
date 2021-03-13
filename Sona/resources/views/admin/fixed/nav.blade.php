<nav class="navbar navbar-expand-lg " color-on-scroll="500">
    <div class="container-fluid">
        <a class="navbar-brand" href="#pablo"> Dashboard </a>
        <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar burger-lines"></span>
            <span class="navbar-toggler-bar burger-lines"></span>
            <span class="navbar-toggler-bar burger-lines"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="nav navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link" data-toggle="dropdown">
                        <span class="d-lg-none">Dashboard</span>
                    </a>
                </li>
                <li class="dropdown nav-item">

                    <a href="{{url("/admin/messages")}}" class=" nav-link" >
                        <i class="nc-icon nc-email-85"></i>
                        @isset($newMessages)
                            @if(count($newMessages) != 0)
                                <span class="notification">{{count($newMessages)}}</span>
                            @endif
                        @endisset
                        <span class="d-lg-none">Notification</span>
                    </a>
                </li>

                <li class="nav-item"><a class="nav-link" href="{{route("logout")}}">Logout</a></li>

            </ul>
        </div>
    </div>
</nav>
