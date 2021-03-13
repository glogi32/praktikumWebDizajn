<div class="col-md-4 text-center col-sm-6 col-xs-6 stil">
    <div class="thumbnail product-box product">
        <img src="<?= $p->src?>" alt="<?= $p->alt?>" />
        <div class="caption">
            <h3><a href="#"><?= $p->naziv?></a></h3>
            <p>Price : <strong>$ <?= number_format($p->cena,2)?></strong>  </p>
            <p><strong><?= number_format(round($p->cena/24),2)?>$</strong> per motnth</p>
            <p class="rating">Rating: &nbsp  
                <?php
                
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
            <a href="index.php?stranica=details&id=<?= $p->proizvod_id ?>" class="btn btn-primary" data-id="<?= $p->proizvod_id ?>" role="button">See Details</a></p>
        </div>
    </div>
</div>