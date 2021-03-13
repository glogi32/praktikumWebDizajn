
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

                        include "models/products/functions.php";

                       

                        $products = get_all_products_by_page($page);

                        if(count($products) == 0){
                            echo "<script>alert('GRESKA NA SERVERU!')</script>";
                        }
                        foreach($products as $p):
                            include "views/partials/products.php";
                    ?>
                    
                        <?php endforeach; ?>
                  
                    
                </div>
                <!-- /.row -->
                <div class="row">
                    <ul class="pagination alg-right-pad">
                        <?php
                            $brojLinkova = get_num_of_links();
                            $i = 1;
                            
                        ?>
                        <li><a href="index.php?page=<?= $page-1 ?>">&laquo;</a></li>

                        <?php for($i=1; $i <= $brojLinkova; $i++): 
                            include "views/partials/pagination_links.php";
                            ?>

                                            
                        
                        <?php endfor; ?>
                        <li><a href="index.php?page=<?= $page+1 ?>">&raquo;</a></li>
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