<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Azenta Template">
    <meta name="keywords" content="Azenta, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Azenta | @yield("title")</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset("css/bootstrap.min.css") }}" type="text/css">
    <link rel="stylesheet" href="{{ asset("css/font-awesome.min.css") }}" type="text/css">
    <link rel="stylesheet" href="{{ asset("css/elegant-icons.css")}}" type="text/css">
    <link rel="stylesheet" href="{{ asset("css/themify-icons.css")}}" type="text/css">
    <link rel="stylesheet" href="{{ asset("css/nice-select.css")}}" type="text/css">
    <link rel="stylesheet" href="{{ asset("css/jquery-ui.min.css")}}" type="text/css">
    <link rel="stylesheet" href="{{ asset("css/owl.carousel.min.css")}}" type="text/css">
    <link rel="stylesheet" href="{{ asset("css/magnific-popup.css")}}" type="text/css">
    <link rel="stylesheet" href="{{ asset("css/slicknav.min.css")}}" type="text/css">
    <link rel="stylesheet" href="{{ asset("css/style.css")}}" type="text/css">
</head>

<body>
<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>

<!-- Offcanvas Menu Section Begin -->
<div class="offcanvas-menu-overlay"></div>
<div class="canvas-open">
    <i class="icon_menu"></i>
</div>
<div class="offcanvas-menu-wrapper">
    <div class="canvas-close">
        <i class="icon_close"></i>
    </div>
    <div class="language-bar">
        <div class="language-option">
            <img src="img/flag.png" alt="">
            <span>English</span>
            <i class="fa fa-angle-down"></i>
            <div class="flag-dropdown">
                <ul>
                    <li><a href="#">English</a></li>
                    <li><a href="#">Germany</a></li>
                    <li><a href="#">China</a></li>
                </ul>
            </div>
        </div>
        <div class="property-btn">
            <a href="#" class="property-sub">Submit Property</a>
        </div>
    </div>
    <nav class="main-menu">
        <ul>
            <li><a href="./index.html">Home</a></li>
            <li><a href="./property.html">Property</a></li>
            <li><a href="./about-us.html">Agets</a></li>
            <li><a href="./blog.html">News</a></li>
            <li><a href="./property-details.html">Pages</a></li>
            <li><a href="./contact.html">Contact</a></li>
        </ul>
    </nav>
    <div class="nav-logo-right">
        <ul>
            <li>
                <i class="icon_phone"></i>
                <div class="info-text">
                    <span>Phone:</span>
                    <p>(+12) 345 6789</p>
                </div>
            </li>
            <li>
                <i class="icon_map"></i>
                <div class="info-text">
                    <span>Address:</span>
                    <p>16 Creek Ave, <span>NY</span></p>
                </div>
            </li>
            <li>
                <i class="icon_mail"></i>
                <div class="info-text">
                    <span>Email:</span>
                    <p>Info.cololib@gmail.com</p>
                </div>
            </li>
        </ul>
    </div>
</div>
<!-- Offcanvas Menu Section End -->

<!-- Header Section Begin -->
<header class="header-section">
    <div class="top-nav">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <nav class="main-menu">
                        <ul>
                            <li class="active"><a href="{{ url("/home") }}">Home</a></li>
                            <li><a href="{{ url("/properties") }}">Properties</a></li>
                            <li><a href="{{ url("/about-us") }}">About us</a></li>
                            <li><a href="{{ url("/blog") }}">Blog</a></li>
                            <li><a href="{{ url("/contact") }}">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-5">
                    <div class="top-right">
                        <div class="language-option">
                            <img src="img/flag.png" alt="">
                            <span>English</span>
                            <i class="fa fa-angle-down"></i>
                            <div class="flag-dropdown">
                                <ul>
                                    <li><a href="#">English</a></li>
                                    <li><a href="#">Germany</a></li>
                                    <li><a href="#">China</a></li>
                                </ul>
                            </div>
                        </div>
                        <a href="#" class="property-sub">Submit Property</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="nav-logo">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="logo">
                        <a href="./index.html"><img src="img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="nav-logo-right">
                        <ul>
                            <li>
                                <i class="icon_phone"></i>
                                <div class="info-text">
                                    <span>Phone:</span>
                                    <p>(+12) 345 6789</p>
                                </div>
                            </li>
                            <li>
                                <i class="icon_map"></i>
                                <div class="info-text">
                                    <span>Address:</span>
                                    <p>16 Creek Ave, <span>NY</span></p>
                                </div>
                            </li>
                            <li>
                                <i class="icon_mail"></i>
                                <div class="info-text">
                                    <span>Email:</span>
                                    <p>Info.cololib@gmail.com</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Header End -->
