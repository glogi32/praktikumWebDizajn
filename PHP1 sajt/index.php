<?php
    session_start();
    include "konekcija.php";
    $errors = [];
    if(isset($_POST['btnLogin'])){
		$email = $_POST['email'];
        $lozinka = md5($_POST['psw']);
        
        
        $reLozinka = "/^[a-z0-9\_-]{4,15}$/";
        
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors[] = "Email nije u dobrom formatu!";
        }

        if(!preg_match($reLozinka,$_POST['psw'])){
            $errors[] = "Lozinka nije u dobrom formatu!";
        }

        if(count($errors) > 0){
            $_SESSION['greske'] = $errors;
        }  else
        {

            $upit = "SELECT * FROM korisnici WHERE email = :email AND sifra =:sifra";

            $priprema = $konekcija->prepare($upit);
            $priprema->bindParam(':email', $email);
            $priprema->bindParam(':sifra', $lozinka);

            $rezultat = $priprema->execute();
            if($rezultat){
                if($priprema->rowCount()==1){
                    $korisnik = $priprema->fetch();
                    $_SESSION['korisnik_id'] = $korisnik->korisnik_id;
                    $_SESSION['korisnik'] = $korisnik;

                    if($_SESSION['korisnik']->uloga_id == 1){
                        header("Location: admin.php");
                    } elseif($_SESSION['korisnik']->uloga_id == 2) {
                        header("Location: index.php");
                    } elseif($_SESSION['korisnik']->uloga_id == 3){
                        header("Location: index.php");
                    }
                
                } else {
                    
                    
                    if($priprema->rowCount() == 0){
                        echo "<script>alert('NISTE REGISTROVANI!!')</script>";
                        http_response_code(401);
                    }
                }
            } else {
                echo "<script>alert('Greska na serveru!!')</script>";
                http_response_code(500);
            }
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Electronic shop</title>
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!-- Fontawesome core CSS -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
    <!--GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <!--Slide Show Css -->
    <link href="assets/ItemSlider/css/main-style.css" rel="stylesheet" />
    <!-- custom CSS here -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="assets/css/mystyle.css" rel="stylesheet" />
</head>
<body>
    <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <form id="formaLogin" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="container2">
                    <h1>Login</h1>
                    <p>Please fill in this form to login.</p>
                    <hr>
                
                    <label for="email"><b>Email</b></label>
                    <input type="text" id="tbEmail" placeholder="Enter Email" name="email" />
                
                    <label for="psw"><b>Password</b></label>
                    <input type="password"  id="tbPass" placeholder="Enter Password" name="psw" />
                    <?php 
                        foreach($errors as $error): ?>
                        <p class="errors"><b><?php echo $error ?></b></p>
                    <?php endforeach; ?>
                    <div class="clearfix">
                        <input type="button" id="btnCancel" class="cancelbtn" value="Cancel" />
                        <input type="submit" id="btnLogin" name="btnLogin" class="loginbtn"  value="Login"/>
                    </div>
                </div>
            </form>
    </div>
    <div id="mySidenav2" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav2()">&times;</a>
        <form id="formaSignUp">
            <div class="container2">
                <h1>Sign up</h1>
                <p>Please fill in this form to sign up.</p>
                <hr>
                
                <label for="fname"><b>First name</b></label>
                <input type="text" id="tbFname" placeholder="Enter first name" name="fname" />

                <label for="lname"><b>Last name</b></label>
                <input type="text" id="tbLname" placeholder="Enter last name" name="lname" />

                <label for="e_mail"><b>E-mail</b></label>
                <input type="text" id="tbE_mail" placeholder="Enter email" name="e_mail" />
            
                <label for="pass"><b>Password</b></label>
                <input type="password" id="tbPassword" placeholder="Enter Password" name="pass" />
            
                <label for="rpass"><b>Repeat Password</b></label>
                <input type="password" id="tbRpassword" placeholder="Repeat Password" name="rpass" />

                <div id="feedback"></div>
                <div class="clearfix">
                    <input type="button" id="btnCancel2" class="cancelbtn" value="Cancel" />
                    <input type="button" id="btnLogin2" name="btnSingUp" class="loginbtn" value="Sign up" />
                </div>
            </div>
        </form>
    </div>
    <div id="mySidenavAddNewP" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNavAddNewP()">&times;</a>
        <form id="formaLogin" action="insertProduct.php" method="POST" enctype="multipart/form-data">
            <div class="container2">
                <h1>Add new product</h1>
                <p>Please fill in this form to add new product.</p>
                <hr>
            
                <label for="p_name"><b>Product name</b></label>
                <input type="text" id="tbPName" placeholder="Enter product name (max 24 characters)" name="p_name" />

                <label for="price"><b>Price</b></label>
                <input type="text" id="tbPrice" placeholder="Enter price in $" name="price" />

                <label for="screen"><b>Info screen</b></label>
                <input type="text" id="tbScreen" placeholder="Enter info about screen" name="screen" />

                <label for="processor"><b>Info processor</b></label>
                <input type="text" id="tbProcessor" placeholder="Enter info about processor" name="processor" />

                <label for="camera"><b>Info camera</b></label>
                <input type="text" id="tbCamera" placeholder="Enter info about camera" name="camera" />

                <label for="ram"><b>Info ram </b></label>
                <input type="text" id="tbRam" placeholder="Enter info about ram memory" name="ram" />

                <label for="p_type"><b>Type of device</b></label>
                <select name="ddlType">
                    <option value="0">Choose</option>
                    <?php
                        $rez = executeQuery("SELECT * FROM tip");
                        if(count($rez) == 0){
                            echo "<script>alert('GRESKA NA SERVERU!!')</script>";
                        }

                        foreach($rez as $r): ?>
                            <option value="<?= $r->tip_id?>"><?= $r->naziv?></option>
                        <?php endforeach; ?>
                </select>

                <label for="brand"><b>Brands</b></label>
                <select name="ddlBrands">
                    <option value="0">Choose</option>
                    <?php
                        $rez = executeQuery("SELECT * FROM proizvodjaci");
                        var_dump($rez);
                        if(count($rez) == 0){
                            echo "<script>alert('GRESKA NA SERVERU!!')</script>";
                        }

                        foreach($rez as $r): ?>
                            <option value="<?= $r->proizvodjac_id?>"><?= $r->naziv?></option>
                        <?php endforeach; ?>
                </select>

                <label for="image"><b>Device image</b></label>
                <input type="file" id="tbImage" name="image" /> 

                <div id="errors"></div>
                
                <div class="clearfix">
                    <input type="button" id="btnCancel4" onclick="closeNavAddNewP()" class="cancelbtn" value="Cancel" />
                    <input type="submit" id="btnAddNewP" name="btnAddNewP" class="loginbtn"  value="Add"/>
                </div>
            </div>
        </form>
    </div>
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><strong>Electronics</strong> Shop</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"><i class="fas fa-shopping-cart"></i></a></li>
                    <li><a href="index.php">Home</a></li>
                    <?php 
                        if(isset($_SESSION['korisnik'])) :
                            if($_SESSION['korisnik']->uloga_id == 1) :
                    ?>
                                <li><a href="admin.php" id="admin">Admin</a></li>
                            <?php endif; ?>
                            <li><a href="logout.php" id="logout">Logout</a></li>
                            <li><a href="#"> Hello <?php echo $_SESSION['korisnik']->ime ?></a>
                            <?php else: ?>
                            <li><a href="#" id="login">Login</a></li>
                            <li><a href="#" id="signup">Signup</a></li>
                        <?php endif; ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">24x7 Support <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#"><strong>Call: </strong>+09-456-567-890</a></li>
                            <li><a href="#"><strong>Mail: </strong>info@yourdomain.com</a></li>
                            <li class="divider"></li>
                            <li><a href="#"><strong>Address: </strong>
                                <div>
                                    234, New york Street,<br />
                                    Just Location, USA
                                </div>
                            </a></li>
                        </ul>
                    </li>
                </ul>
                <form class="navbar-form navbar-right" role="search">
                    <div class="form-group">
                        <input type="text" placeholder="Enter Keyword Here ..." class="form-control">
                    </div>
                    &nbsp; 
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="well well-lg offer-box text-center">


                   Today's Offer : &nbsp; <span class="glyphicon glyphicon-cog"></span>&nbsp;40 % off  on purchase of $ 2,000 and above till 24 dec !                
              
               
                </div>
                <div class="main box-border">
                    <div id="mi-slider" class="mi-slider classSlider">
                        <ul>
                            <?php
                                $rezultat = executeQuery("SELECT p.proizvod_id AS idProizvoda, src AS src, alt AS alt, p.naziv AS nazivTel FROM proizvodi p INNER JOIN proizvodjaci pr ON p.proizvodjac_id = pr.proizvodjac_id INNER JOIN slike s ON p.proizvod_id = s.proizvod_id WHERE pr.proizvodjac_id = 2 LIMIT 0,4");
                                if(count($rezultat) == 0){
                                    echo "<script>alert('GRESKA NA SERVERU PRI DOHVATANJU PROIZVODA!!!')</script>";
                                }

                                foreach($rezultat as $r):
                            ?>
                                <li><a href="details.php?id=<?= $r->idProizvoda?>">
                                    <img src="<?= $r->src ?>" alt="<?= $r->alt?>"><h4><?= $r->nazivTel?></h4>
                                </a></li>
                            <?php endforeach; ?>
                        </ul>
                        <ul>
                            <?php
                                $rezultat = executeQuery("SELECT p.proizvod_id AS idProizvoda, src AS src, alt AS alt, p.naziv AS nazivTel FROM proizvodi p INNER JOIN proizvodjaci pr ON p.proizvodjac_id = pr.proizvodjac_id INNER JOIN slike s ON p.proizvod_id = s.proizvod_id WHERE pr.proizvodjac_id = 4 LIMIT 0,4");
                                if(count($rezultat) == 0){
                                    echo "<script>alert('GRESKA NA SERVERU PRI DOHVATANJU PROIZVODA!!!')</script>";
                                }

                                foreach($rezultat as $r):
                            ?>
                                <li><a href="details.php?id=<?= $r->idProizvoda?>">
                                    <img src="<?= $r->src ?>" alt="<?= $r->alt?>"><h4><?= $r->nazivTel?></h4>
                                </a></li>
                            <?php endforeach; ?>
                        </ul>
                        <ul>
                            <?php
                                $rezultat = executeQuery("SELECT p.proizvod_id AS idProizvoda, src AS src, alt AS alt, p.naziv AS nazivTel FROM proizvodi p INNER JOIN proizvodjaci pr ON p.proizvodjac_id = pr.proizvodjac_id INNER JOIN slike s ON p.proizvod_id = s.proizvod_id WHERE pr.proizvodjac_id = 3 LIMIT 0,4");
                                if(count($rezultat) == 0){
                                    echo "<script>alert('GRESKA NA SERVERU PRI DOHVATANJU PROIZVODA!!!')</script>";
                                }

                                foreach($rezultat as $r):
                            ?>
                                <li><a href="details.php?id=<?= $r->idProizvoda?>">
                                    <img src="<?= $r->src ?>" alt="<?= $r->alt?>"><h4><?= $r->nazivTel?></h4>
                                </a></li>
                            <?php endforeach; ?>
                        </ul>
                        <ul>
                            <?php
                                $rezultat = executeQuery("SELECT p.proizvod_id AS idProizvoda, src AS src, alt AS alt, p.naziv AS nazivTel FROM proizvodi p INNER JOIN proizvodjaci pr ON p.proizvodjac_id = pr.proizvodjac_id INNER JOIN slike s ON p.proizvod_id = s.proizvod_id WHERE pr.proizvodjac_id = 5 LIMIT 0,4");
                                if(count($rezultat) == 0){
                                    echo "<script>alert('GRESKA NA SERVERU PRI DOHVATANJU PROIZVODA!!!')</script>";
                                }

                                foreach($rezultat as $r):
                            ?>
                                <li><a href="details.php?id=<?= $r->idProizvoda?>">
                                    <img src="<?= $r->src ?>" alt="<?= $r->alt?>"><h4><?= $r->nazivTel?></h4>
                                </a></li>
                            <?php endforeach; ?>
                        </ul>
                        <nav>
                            <a href="#">Samsung</a>
                            <a href="#">Apple</a>
                            <a href="#">LG</a>
                            <a href="#">Motorola</a>
                        </nav>
                    </div>
                    
                </div>
                <br />
            </div>
            <!-- /.col -->
            
            <div class="col-md-3 text-center">
                <?php
                    $rezultat = executeQuery("SELECT * FROM proizvodi p INNER JOIN slike s ON p.proizvod_id=s.proizvod_id ORDER BY cena DESC LIMIT 0,2");
                    if(count($rezultat) == 0){
                        echo "<script>alert('GRESKA NA SERVERU!')</script>";
                    }

                    foreach($rezultat as $r):
                ?>
                <div class=" col-md-12 col-sm-6 col-xs-6 classOffer" >
                    <a href="details.php?id=<?=$r->proizvod_id?>">
                    <div class="offer-text">
                        30% off here
                    </div>
                    <div class="thumbnail product-box">
                        <img src="<?= $r->src?>" alt="<?= $r->alt ?>" />
                        <div class="caption">
                            <h3><a href="#"><?= $r->naziv ?></a></h3>
                            <p><del><?= number_format($r->cena,2)?> $  </del><strong><?= number_format($r->cena*0.7,2)?> $</strong></p>
                            <h4>LIMITED TIME OFFER</h4>
                        </div>
                    </div>
                    </a>
                </div>
                    <?php endforeach; ?>
                <!--<div class=" col-md-12 col-sm-6 col-xs-6">
                    <div class="offer-text">
                        30% off here
                    </div>
                    <div class="thumbnail product-box">
                        <img src="assets/img/dummyimg.png" alt="" />
                        <div class="caption">
                            <h3><a href="#">Samsung Galaxy </a></h3>
                            <p><a href="#">Ptional dismiss button </a></p>
                        </div>
                    </div>
                </div>-->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-3">
                <div>
                    <a href="#" class="list-group-item active">Electronics
                    </a>
                    <ul class="list-group">
                    <?php
                        $rez = executeQuery("SELECT * FROM tip");
                        $nizClass = ["label-primary","label-success","label-danger","label-info"];
                        if(count($rez) == 0){
                            echo "<h1>Greska na serveru!</h1>";
                        }
                        foreach($rez as $r) :
                    ?>  
                        <li class="list-group-item" data-id="<?= $r->tip_id?>"><?= $r->naziv?>
      <span class="label <?php echo $nizClass[array_rand($nizClass)]; ?> pull-right">234</span>
                        </li>

                        <?php endforeach; ?>
                        <!--<li class="list-group-item">Computers
                      <span class="label label-success pull-right">34</span>
                        </li>
                        <li class="list-group-item">Tablets
                         <span class="label label-danger pull-right">4</span>
                        </li>
                        <li class="list-group-item">Appliances
                             <span class="label label-info pull-right">434</span>
                        </li>
                        <li class="list-group-item">Games & Entertainment
                             <span class="label label-success pull-right">34</span>
                        </li>-->
                    </ul>
                </div>
                <!-- /.div -->
                <div>
                    <a href="#" class="list-group-item active list-group-item-success">Brand
                    </a>
                    <ul class="list-group">
                        <?php
                            $rez=executeQuery("SELECT * FROM proizvodjaci");
                            if(count($rez) == 0){
                                echo "<h1>Greska na serveru!</h1>";
                            }

                            foreach($rez as $r):
                        ?>
                        <li class="filterBrand list-group-item" data-id="<?= $r->proizvodjac_id ?>"><?= $r->naziv ?>
                            <span class="label <?php echo $nizClass[array_rand($nizClass)]; ?> pull-right">
                            <?php
                                $idProizvodjac =  $r->proizvodjac_id;

                                $rez = $konekcija->prepare("SELECT COUNT(*) AS brojProizvoda FROM proizvodi p INNER JOIN proizvodjaci pr ON pr.proizvodjac_id=p.proizvodjac_id WHERE pr.proizvodjac_id = ?");
                                $rez->bindValue(1,$idProizvodjac);

                                $rez->execute();
                                $p = $rez->fetch();

                                if($p->brojProizvoda == 0){
                                    echo "<script>alert('GRESKA NA SERVERU!')</script>";
                                }
                            ?>
                            <?= $p->brojProizvoda?></span>
                        </li>
                        <?php endforeach; ?>
                        <!--<li class="list-group-item">Women's Clothing
                             <span class="label label-success pull-right">340</span>
                        </li>
                        <li class="list-group-item">Kid's Wear
                             <span class="label label-info pull-right">735</span>
                        </li>-->

                    </ul>
                </div>
                <!-- /.div -->
                <div>
                    <a href="#" class="list-group-item active">Price
                    </a>
                    <ul class="list-group">
                        <li class="list-group-item"  ><a href="#" class="filter-cena" data-id="0-100"> < 100$</a> 
                             
                        </li>
                        <li class="list-group-item"  ><a href="#" class="filter-cena" data-id="100-200"> 100$ - 200$</a>  
                             
                        </li>
                        <li class="list-group-item" ><a href="#" class="filter-cena" data-id="200-300"> 200$ - 300$</a> 
                             
                        </li>
                        <li class="list-group-item"  ><a href="#" class="filter-cena" data-id="300-400">400$ - 500$</a>  
                             
                        </li>
                        <li class="list-group-item" ><a href="#" class="filter-cena" data-id="500-600"> 600$ - 700$ </a> 
                             
                        </li>
                        <li class="list-group-item"  ><a href="#" class="filter-cena" data-id="700-800"> 700$ - 800$</a> 
                             
                        </li>
                        <li class="list-group-item"  ><a href="#" class="filter-cena" data-id="800-10000"> > 800$ </a> 
                             
                        </li>
                    </ul>
                </div>
                <!-- /.div -->
                <div>
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-success"><a href="#">New Offer's Coming </a></li>
                        <li class="list-group-item list-group-item-info"><a href="#">New Products Added</a></li>
                        <li class="list-group-item list-group-item-warning"><a href="#">Ending Soon Offers</a></li>
                        <li class="list-group-item list-group-item-danger"><a href="#">Just Ended Offers</a></li>
                    </ul>
                </div>
                <!-- /.div -->
                <div class="well well-lg offer-box offer-colors">


                    <span class="glyphicon glyphicon-star-empty"></span>25 % off  , GRAB IT                 
              
                   <br />
                    <br />
                    <div class="progress progress-striped">
                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"
                            style="width: 70%">
                            <span class="sr-only">70% Complete (success)</span>
                            2hr 35 mins left
                        </div>
                    </div>
                    <a href="#">click here to know more </a>
                </div>
                <!-- /.div -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div>
                    <ol class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li class="active">Electronics</li>
                    </ol>
                </div>
                <!-- /.div -->
                <div class="row">
                    <div class="btn-group alg-right-pad">
                        <button type="button" class="btn btn-default"><strong>1235  </strong>items</button>
                        <div class="btn-group">
                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                                Sort Products &nbsp;
                                <span class="caret"></span>
                            </button>
                            <?php
                                if(isset($_SESSION['korisnik'])) :
                                    if($_SESSION['korisnik']->uloga_id == 3) :
                            ?>
                            <button type="button" id="btnAddNewProduct" class="btn btn-default"><strong>Add new product</strong></button>
                                <?php endif; endif; ?>
                            <ul class="dropdown-menu">
                                <li><a class="sort" href="#" data-id="asc">By Price Low</a></li>
                                <li class="divider"></li>
                                <li><a class="sort" href="#" data-id="desc">By Price High</a></li>
                                <li class="divider"></li>
                                <li><a class="sort" href="#" data-id="pop">By Popularity</a></li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row" id="proizvodi">
                    <?php
                        $page = 0;
                        if(isset($_GET["page"])){
                            $page = ($_GET["page"] -1) * 6;
                        }
                        /*$sql = "SELECT p.proizvod_id AS proizvodi, cena AS cena, naziv AS naziv,
                        ekran AS ekran, procesor AS procesor, kamera AS kamera, ram AS ram, tip_id AS tip_id,
                         proizvodjac_id AS proizvodjac, slika_id AS slika, alt AS alt, src AS src, 
                         s.proizvod_id AS proizvodi_slika,vreme_objave AS vreme FROM proizvodi p INNER JOIN slike s
                        ON p.proizvod_id=s.proizvod_id  LIMIT $page, 6";*/


                        $sql = "SELECT AVG(ocena) AS prosek,p.*, s.src AS src, s.alt AS alt FROM ocene o RIGHT OUTER JOIN proizvodi p ON o.proizvod_id=p.proizvod_id
                        INNER JOIN slike s ON p.proizvod_id=s.proizvod_id GROUP BY p.proizvod_id LIMIT $page,6";

                        $products = $konekcija->query($sql)->fetchAll();

                        if(count($products) == 0){
                            echo "<script>alert('GRESKA NA SERVERU!')</script>";
                        }
                        foreach($products as $p):
                    ?>
                    <div class="col-md-4 text-center col-sm-6 col-xs-6 stil">
                        <div class="thumbnail product-box product">
                            <img src="<?= $p->src?>" alt="<?= $p->alt?>" />
                            <div class="caption">
                                <h3><a href="#"><?= $p->naziv?></a></h3>
                                <p>Price : <strong>$ <?= number_format($p->cena,2)?></strong>  </p>
                                <p><strong><?= number_format(round($p->cena/24),2)?>$</strong> per motnth</p>
                                <p class="rating">Rating: &nbsp  
                                    <?php
                                        /*$idProizvoda = $p->proizvodi;
                                        $priprema = $konekcija->prepare("SELECT AVG(ocena) as prosek FROM proizvodi p INNER JOIN ocene o ON p.proizvod_id=o.proizvod_id WHERE o.proizvod_id = ?");
                                        $priprema->bindValue(1,$idProizvoda);
                                        $priprema->execute();

                                        $rezultat = $priprema->fetch();*/
                                        $avgOcena = $p->prosek;
                                        if($avgOcena != null){
                                            for($i = 1 ; $i <= 5 ; $i++){
                                                if($avgOcena >= 1){
                                                    echo "<i class='fas fa-star' style='color:orange;'></i>";
                                                    $avgOcena--;
                                                } else {
                                                    if($avgOcena >= 0.5){
                                                        echo "<i class='fas fa-star-half-alt' style='color:orange;'></i>";
                                                        $avgOcena -= 0.5;
                                                    }
                                                else{
                                                    echo "<i class='far fa-star'></i>";
                                                }
                                            }
                                        }
                                    }else{
                                        echo "<i class='far fa-star'></i><i class='far fa-star'></i><i class='far fa-star'></i><i class='far fa-star'></i><i class='far fa-star'></i>";
                                    }
                                    ?>
                                <p><a href="#" class="btn btn-success" role="button">Add To Cart</a>
                                <a href="details.php?id=<?= $p->proizvod_id ?>" class="btn btn-primary" data-id="<?= $p->proizvod_id ?>" role="button">See Details</a></p>
                            </div>
                        </div>
                    </div>
                        <?php endforeach; ?>
                  
                    
                </div>
                <!-- /.row -->
                <div class="row">
                    <ul class="pagination alg-right-pad">
                        <?php
                            $upit = "SELECT COUNT(*) AS brojProizvoda FROM proizvodi";

                            $rezultat = $konekcija->query($upit)->fetch();
                            $brojProizvoda = $rezultat->brojProizvoda;

                            $brojLinkova = ceil($brojProizvoda / 6);
                            $i = 1;
                            
                        ?>
                        <li><a href="index.php?page=<?= $_GET["page"]-1 ?>">&laquo;</a></li>
                        <?php for($i=1; $i <= $brojLinkova; $i++): ?>
                        <li><a href="index.php?page=<?= $i ?>"><?= $i?></a></li>                       
                        
                        <?php endfor; ?>
                        <li><a href="index.php?page=<?= $_GET["page"]+1 ?>">&raquo;</a></li>
                    </ul>
                </div>
                <!-- /.row -->
                
                <!-- /.div -->
                
                
                
                <!-- /.row -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
    <div class="col-md-12 download-app-box text-center">

        <span class="glyphicon glyphicon-download-alt"></span>Download Our Android App and Get 10% additional Off on all Products . <a href="#" class="btn btn-danger btn-lg">DOWNLOAD  NOW</a>

    </div>

    <!--Footer -->
    <div class="col-md-12 footer-box">


     
        <div class="row">
            <div class="col-md-4">
                <strong>Send a Quick Query </strong>
                <hr>
                <form>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <input type="text" class="form-control" required="required" placeholder="Name">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <input type="text" class="form-control" required="required" placeholder="Email address">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <textarea name="message" id="message" required="required" class="form-control" rows="3" placeholder="Message"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit Request</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-4">
                <strong>Our Location</strong>
                <hr>
                <p>
                     234, New york Street,<br />
                                    Just Location, USA<br />
                    Call: +09-456-567-890<br>
                    Email: info@yourdomain.com<br>
                </p>

                2014 www.yourdomain.com | All Right Reserved
            </div>
            <div class="col-md-4 social-box social">
                <strong>We are Social </strong>
                <hr>
                <a href="#"><i class="fab fa-facebook"></i></i></a>
                <a href="#"><i class="fab fa-twitter"></i></i></a>
                <a href="#"><i class="fab fa-google-plus"></i></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-pinterest"></i></a>
                
            </div>
        </div>
        <hr>
    </div>
    <!-- /.col -->
    <div class="col-md-12 end-box links">
        &copy; 2019 | &nbsp; All Rights Reserved | &nbsp; www.yourdomain.com | &nbsp; 24x7 support | &nbsp; Email us: info@yourdomain.com | <a href="DokumentacijaPHP.pdf" target="_blank" >Dokumentacija</a> | <a href="oAutoru.php">O autoru</a> 
    </div>
    <!-- /.col -->
    <!--Footer end -->
    <!--Core JavaScript file  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!--bootstrap JavaScript file  -->
    <script src="assets/js/bootstrap.js"></script>
    <!--Slider JavaScript file  -->
    <script src="assets/ItemSlider/js/modernizr.custom.63321.js"></script>
    <script src="assets/ItemSlider/js/jquery.catslider.js"></script>
    <script src="assets/js/main.js"></script>
    <script>
        $(function () {

            $('#mi-slider').catslider();

        });
		</script>
</body>
</html>
