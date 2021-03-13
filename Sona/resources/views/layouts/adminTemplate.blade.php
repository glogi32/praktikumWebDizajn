<!DOCTYPE html>

<html lang="en">

@include("admin.fixed.head")

<body>



<div class="wrapper">
    @include("admin.fixed.sidebar")

    <div class="main-panel">
        <!-- Navbar -->
    @include("admin.fixed.nav")
        <!-- End Navbar -->
        @yield("content")
        @include("admin.fixed.footer")
    </div>

</div>
@include("admin.fixed.scripts")
</body>
<!--   Core JS Files   -->

</html>
