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