<footer class="footer">
    <div class="container-fluid">
        <nav>
            <ul class="footer-menu">
                @foreach($menu as $m)
                    <li class="@if(request()->routeIs($m->route)) active @endif"><a href="{{url($m->route)}}">{{$m->name}}</a></li>
                @endforeach
                @if(session()->has("user"))
                    <li class="@if(request()->routeIs("/reservations")) active @endif"><a href="{{route("reservations")}}">Reservations</a></li>
                    @if(session("user")->role->id == 1)
                        <li class="@if(request()->routeIs("users.index")) active @endif"><a href="{{route("users.index")}}">Admin</a></li>
                    @endif
                @endif

            </ul>
            <p class="copyright text-center">
                ©
                <script>
                    document.write(new Date().getFullYear())
                </script>
                <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
            </p>
        </nav>
    </div>
</footer>
