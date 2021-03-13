
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
                                include "models/slider/functions.php";

                                
                                $rezultat = get_first4_slider("samsung");
                                if(count($rezultat) == 0){
                                    echo "<script>alert('GRESKA NA SERVERU PRI DOHVATANJU PROIZVODA!!!')</script>";
                                }

                                foreach($rezultat as $r):
                                    include "views/partials/products_slider.php";
                            ?>
                                
                            <?php endforeach; ?>
                        </ul>
                        <ul>
                            <?php
                                $rezultat = get_first4_slider("apple");
                                if(count($rezultat) == 0){
                                    echo "<script>alert('GRESKA NA SERVERU PRI DOHVATANJU PROIZVODA!!!')</script>";
                                }

                                foreach($rezultat as $r):
                                    include "views/partials/products_slider.php";
                            ?>
                                
                            <?php endforeach; ?>
                        </ul>
                        <ul>
                            <?php
                                $rezultat = get_first4_slider("lg");
                                if(count($rezultat) == 0){
                                    echo "<script>alert('GRESKA NA SERVERU PRI DOHVATANJU PROIZVODA!!!')</script>";
                                }

                                foreach($rezultat as $r):
                                    include "views/partials/products_slider.php";
                            ?>
                                
                            <?php endforeach; ?>
                        </ul>
                        <ul>
                            <?php
                                $rezultat = get_first4_slider("motorola");
                                if(count($rezultat) == 0){
                                    echo "<script>alert('GRESKA NA SERVERU PRI DOHVATANJU PROIZVODA!!!')</script>";
                                }

                                foreach($rezultat as $r):
                                    include "views/partials/products_slider.php";
                            ?>
                                
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
                    $rezultat = get_products_sale();
                    if(count($rezultat) == 0){
                        echo "<script>alert('GRESKA NA SERVERU!')</script>";
                    }

                    foreach($rezultat as $r):
                        include "views/partials/products_sale.php";
                ?>
                
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
                        include "models/filters/functions.php";

                        $rez = get_all_product_types();
                        $nizClass = ["label-primary","label-success","label-danger","label-info"];
                        if(count($rez) == 0){
                            echo "<h1>Greska na serveru!</h1>";
                        }
                        foreach($rez as $r) :
                            include "views/partials/filter_type.php";
                    ?>  
                        
                        <?php endforeach; ?>
                       
                    </ul>
                </div>
                <!-- /.div -->
                <div>
                    <a href="#" class="list-group-item active list-group-item-success">Brand
                    </a>
                    <ul class="list-group">
                        <?php
                            
                            $rez=get_all_product_brands();
                            if(count($rez) == 0){
                                echo "<h1>Greska na serveru!</h1>";
                            }

                            foreach($rez as $r):
                                include "views/partials/filter_brands.php";
                        ?>
                        
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
                        <li><a href="index.php">Home</a></li>
                        <li><a href="index.php">Electronics</a></li>
                        <?php
                            if(isset($_GET["id"])){
                                
                                include "models/details/functions.php";

                                $idProizvoda = $_GET["id"];

                                $rez = get_single_product($idProizvoda);

                                
                                    
                            }
                        ?>
                        <li class="active"><?= $rez->naziv?></li>
                        <?php
                            if(isset($_SESSION["korisnik"])):
                        ?>
                        <input type="hidden" id="hdnIdKorisnika" value="<?= $_SESSION["korisnik"]->korisnik_id?>" />
                            <?php endif; ?>
                        <input type="hidden" id="hdnIdProizvoda" value="<?= $_GET["id"]?>" />
                    </ol>
                </div>
                <!-- /.div -->
                <div class="row">
                    <div class="col-md-12">
                        <div id="detaljnije-okvir">
                            <div id="slika-telefona">
                                <img src="<?= $rez->src?>" alt="<?= $rez->alt?>" />
                            </div>
                            <div id="opis-telefona">
                                <h2><?= $rez->naziv ?></h2>
                                <hr />
                                <p><i class="fas fa-mobile-alt"></i> - <?= $rez->ekran?></p>
                                <p><i class="fas fa-microchip"></i> - <?= $rez->procesor?></p>
                                <p><i class="fas fa-camera"></i> - <?= $rez->kamera?></p>
                                <p><i class="fas fa-memory"></i> - <?= $rez->ram?></p>
                                <p id="details-cena">Price:<b> <?= number_format($rez->cena,2)?>$</b></p>
                                <p><img src="assets/img/sprite.png" alt="shipment"/>&nbsp &nbsp &nbsp<b>Free shipment</b></p>
                                <p id="rating">Rating: &nbsp &nbsp  <i data-rating="1" id="s1" class="fas fa-star" aria-hidden="true"></i>
                                    <i data-rating="2" id="s2" class="fas fa-star" aria-hidden="true"></i>
                                    <i data-rating="3" id="s3" class="fas fa-star" aria-hidden="true"></i>
                                    <i data-rating="4" id="s4" class="fas fa-star" aria-hidden="true"></i>
                                    <i data-rating="5" id="s5" class="fas fa-star" aria-hidden="true"></i></p>
                                <button><i class="fas fa-cart-plus"></i>&nbsp &nbsp &nbsp<p>Add to cart</p></button>
                            </div>
                        </div>
                        <div id="komentari">
                            <p>Comments section</p>


                            <?php
                                
                                $rez = get_all_comments_products($idProizvoda);
                                
                            
                                foreach($rez as $r):
                                    include "views/partials/comments.php";
                            ?>
                            
                                <?php endforeach; ?>
                            <?php
                                if(isset($_SESSION["korisnik"])):
                                    
                            ?>
                            <div id="komentar-header-upis" class="komentar">
                                <div class="komentar-header"><p class="imeIPrezime">Send comment as <b><?=$_SESSION["korisnik"]->ime ?> <?=$_SESSION["korisnik"]->prezime ?></b></p></div>
                                <textarea id="taKomentar" placeholder="Write ur comment..."></textarea>
                                <input type="button" id="btnSendComment" class="btnKomentar" value="Send"/>
                            </div>
                                
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                
                <!-- /.div -->
                
                
                
                <!-- /.row -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>