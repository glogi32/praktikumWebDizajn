<!doctype html>
<html lang="en">
  <?php
    $p = "Home";
    if(isset($_GET['page'])){
      switch($_GET['page']){
        case "home" :
          $p = "Home";
          break;
        case "chackout" :
          $p = "Checkout";
          break;
        case "about" :
          $p = "About";
          break;
        case "cars" :
          $p = "Cars";
          break;
        case "admin" :
          $p = "Admin";
          break;
        case "services" :
          $p = "Services";
          break;
        case "blog" :
          $p = "Blog";
          break;
        case "blogSingle" :
          $p = "Blog";
          break;
      }
    }
  ?>
  <head>
    <title>Car Rent &mdash; <?= $p ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=DM+Sans:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="public/vendor/fonts/icomoon/style.css">

    <link rel="stylesheet" href="public/vendor/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/vendor/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="public/vendor/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="public/vendor/css/owl.carousel.min.css">
    <link rel="stylesheet" href="public/vendor/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="public/vendor/fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="public/vendor/css/aos.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="public/vendor/css/style.css">

  </head>

  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

    
    <div class="site-wrap" id="home-section">

      <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
          <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
          </div>
        </div>
        <div class="site-mobile-menu-body"></div>
      </div>



      <header class="site-navbar site-navbar-target" role="banner">

        <div class="container">
          <div class="row align-items-center position-relative">

            <div class="col-3 ">
              <div class="site-logo">
                <a href="index.php">CarRent</a>
              </div>
            </div>

            <div class="col-7  text-right">
              

              <span class="d-inline-block d-lg-none"><a href="#" class="text-white site-menu-toggle js-menu-toggle py-5 text-white"><span class="icon-menu h3 text-white"></span></a></span>

              <?php
                if(isset($_GET['page'])){
                  $page = $_GET['page'];

                  $activeH = ($page == "home") ? "active" : "";
                  $activeS = ($page == "services") ? "active" : "";
                  $activeC = ($page == "cars") ? "active" : "";
                  $activeAB = ($page == "about") ? "active" : "";
                  $activeB = ($page == "blog") ? "active" : "";
                  $activeCH = ($page == "checkout") ? "active" : "";
                  $activeA = ($page == "admin") ? "active" : "";
                }
              ?>

              <nav class="site-navigation text-left ml-auto d-none d-lg-block" role="navigation">
                <ul class="site-menu main-menu js-clone-nav ml-auto ">
                  <li class="<?= $activeH ?>"><a href="index.php?page=home" class="nav-link">Home</a></li>
                  <li class="<?= $activeS ?>"><a href="index.php?page=services" class="nav-link">Services</a></li>
                  <li class="<?= $activeC ?>"><a href="index.php?page=cars" class="nav-link">Cars</a></li>
                  <li class="<?= $activeAB ?>"><a href="index.php?page=about" class="nav-link">About</a></li>
                  <li class="<?= $activeB ?>"><a href="index.php?page=blog" class="nav-link">Blog</a></li>
                  <li class="<?= $activeCH ?>"><a href="index.php?page=checkout" class="nav-link">Checkout</a></li>
                  <?php if(isset($_SESSION['user']) && $_SESSION['user']->uloga_id == 1): ?>
                    <li class="<?= $activeA ?>"><a href="index.php?page=admin" class="nav-link">Admin</a></li>
                  <?php endif;?>
                </ul>
                
              </nav>
              
            </div>

            <div class="col-2 text-right">
              <nav class="site-navigation text-right ml-auto d-none d-lg-block" role="navigation">
                <ul class="site-menu main-menu js-clone-nav ml-auto ">
                <?php if(!isset($_SESSION["user"])): ?>
                  <li ><a id="login" href="#" class="nav-link">Login</a></li>
                  <li ><a id="signup" href="#" class="nav-link">Sign up</a></li>
                <?php else: ?>
                  <li><a href="index.php?page=logout" class="nav-link">Logout</a></li>
                <?php endif; ?>
                
                </ul>
              </nav>
            </div>

            
          </div>
        </div>

      </header>
      
      <?php
        if(isset($data['allCars'])){      
          foreach($data['allCars'] as $c){
            if($c->pozadina == 1){
              $p = $c;
            }
          }
        }
      ?>

      <div class="ftco-blocks-cover-1">
        <div class="ftco-cover-1 overlay" style="background-image: 

          

          <?php

            if(isset($_GET['page']) && $_GET['page'] != 'home'):  ?>
              
            url('public/vendor/images/hero_2.jpg')">

          <?php else: ?>
            url('<?= $p->slika ?>')">
          <?php endif; ?>
            
          <div class="container">
          <?php
            if(isset($_GET['page'])): ?>
            <?php if($_GET['page'] == 'home'): ?>
              <div class="row align-items-center">
                <div class="col-lg-5">
                  <div class="feature-car-rent-box-1">
                    <h3><?= $p->naziv ?></h3>
                    <ul class="list-unstyled">
                      <li>
                        <span>Doors</span>
                        <span class="spec"><?= $p->vrata ?></span>
                      </li>
                      <li>
                        <span>Seats</span>
                        <span class="spec"><?= $p->sedista ?></span>
                      </li>
                      <li>
                        <span>Lugage</span>
                        <span class="spec"><?= $p->prtljag ?></span>
                      </li>
                      <li>
                        <span>Transmission</span>
                        <span class="spec"><?= $p->menjac ?></span>
                      </li>
                      <li>
                        <span>Minium age</span>
                        <span class="spec"><?= $p->starost ?></span>
                      </li>
                    </ul>
                    <div class="d-flex align-items-center bg-light p-3">
                      <span>$<?= $p->cena ?>/day</span>
                      <a href="index.php?page=checkout&idC=<?= $p->auto_id ?>" class="ml-auto btn btn-primary">Rent Now</a>
                    </div>
                  </div>
                </div>
              </div>
            <?php endif; ?>
            <?php if($_GET['page'] == 'services'): ?>
              <div class="row align-items-center justify-content-center">
                <div class="col-lg-6 text-center">
                  <h1>Our services</h1>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
              </div>
            <?php endif; ?>
            <?php if($_GET['page'] == 'cars'): ?>
                <div class="row align-items-center justify-content-center">
                  <div class="col-lg-6 text-center">
                    <h1>Our rental cars</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                  </div>
                </div>
            <?php endif; ?>
            <?php if($_GET['page'] == 'blog'): ?>
                <div class="row align-items-center justify-content-center">
                  <div class="col-lg-6 text-center">
                    <h1>Blog</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                  </div>
                </div>
            <?php endif; ?>
            <?php if($_GET['page'] == 'about'): ?>
                <div class="row align-items-center justify-content-center">
                  <div class="col-lg-6 text-center">
                    <h1>About us</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                  </div>
                </div>
              <?php endif; ?>
              <?php if($_GET['page'] == 'checkout'): ?>
                <div class="row align-items-center justify-content-center">
                  <div class="col-lg-6 text-center">
                    <h1>Checkout</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                  </div>
                </div>
              <?php endif; ?>
              <?php if($_GET['page'] == 'admin'): ?>
                <div class="row align-items-center justify-content-center">
                  <div class="col-lg-6 text-center">
                    <h1>ADMIN PAGE</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                  </div>
                </div>
              <?php endif; ?>
              <?php if($_GET['page'] == 'blogSingle'): ?>
                <?php if(isset($data['post'])): ?>
                  <div class="row align-items-center justify-content-center">
                    <div class="col-lg-6 text-center">
                      <span class="d-block mb-3 text-white" data-aos="fade-up"><?= date("F d",$data['post'][0]->vreme_objave)?>, <?= date("Y",$data['post'][0]->vreme_objave)?><span class="mx-2 text-primary">&bullet;</span> by <?=$data['post'][0]->ime?> <?=$data['post'][0]->prezime?></span>
                        <h1 class="mb-4" data-aos="fade-up" data-aos-delay="100"><?=$data['post'][0]->naslov?></h1>
                    </div>
                  </div>
                <?php endif; ?>
              <?php endif; ?>
              <?php else: ?>
                <div class="row align-items-center">
                <div class="col-lg-5">
                  <div class="feature-car-rent-box-1">
                    <h3><?= $p->naziv ?></h3>
                    <ul class="list-unstyled">
                      <li>
                        <span>Doors</span>
                        <span class="spec"><?= $p->vrata ?></span>
                      </li>
                      <li>
                        <span>Seats</span>
                        <span class="spec"><?= $p->sedista ?></span>
                      </li>
                      <li>
                        <span>Lugage</span>
                        <span class="spec"><?= $p->prtljag ?></span>
                      </li>
                      <li>
                        <span>Transmission</span>
                        <span class="spec"><?= $p->menjac ?></span>
                      </li>
                      <li>
                        <span>Minium age</span>
                        <span class="spec"><?= $p->starost ?></span>
                      </li>
                    </ul>
                    <div class="d-flex align-items-center bg-light p-3">
                      <span>$<?= $p->cena ?>/day</span>
                      <a href="index.php?page=checkout&idC=<?=$p->auto_id?>" class="ml-auto btn btn-primary">Rent Now</a>
                    </div>
                  </div>
                </div>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>