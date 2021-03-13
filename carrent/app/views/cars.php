
<div class="site-section bg-light">
      <div class="container">
        <div class="row" id="cars">
          <?php
          foreach($data["allCars"] as $c): 
          ?>
          <div class="col-lg-4 col-md-6 mb-4" data-id="<?= $c->auto_id ?>">
            <div class="item-1">
                <a href="#"><img src="<?= $c->slika ?>" alt="Image" class="img-fluid"></a>
                <div class="item-1-contents">
                  <div class="text-center">
                  <h3><a href="#"><?= $c->naziv ?></a></h3>
                  <div class="rating">
                    <?php for($i=0 ; $i<$c->ocena ; $i++):   ?>
                    <span class="icon-star text-warning"></span>
                    <?php endfor; ?>
                  </div>
                  <div class="rent-price"><span>$<?= $c->cena ?>/</span>day</div>
                  </div>
                  <ul class="specs">
                    <li>
                      <span>Doors</span>
                      <span class="spec"><?= $c->vrata ?></span>
                    </li>
                    <li>
                      <span>Seats</span>
                      <span class="spec"><?= $c->sedista ?></span>
                    </li>
                    <li>
                      <span>Lugage</span>
                      <span class="spec"><?= $c->prtljag ?></span>
                    </li>
                    <li>
                      <span>Transmision</span>
                      <span class="spec"><?= $c->menjac ?></span>
                    </li>
                    <li>
                      <span>Minium age</span>
                      <span class="spec"><?= $c->starost ?></span>
                    </li>
                  </ul>
                  <div class="d-flex action">
                    <a href="index.php?page=checkout&idC=<?=$c->auto_id?>" class="btn btn-primary">Rent Now</a>
                  </div>
                </div>
              </div>
          </div>
          <?php endforeach; ?>


          
        </div>
        <div class="col-12">
            <?php
              if(isset($data['numOfLinks'])):
                for($i=1; $i<=$data['numOfLinks'];$i++):
            ?>
            <a href="#" data-id="<?=$i?>" class="p-3 linkPag"><?= $i ?></a>
            <?php endfor; ?>
              <?php endif; ?>
          </div>
      </div>
    </div>

    <div class="container site-section mb-5">
      <div class="row justify-content-center text-center">
        <div class="col-7 text-center mb-5">
          <h2>How it works</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo assumenda, dolorum necessitatibus eius earum voluptates sed!</p>
        </div>
      </div>
      <div class="how-it-works d-flex">
        <div class="step">
          <span class="number"><span>01</span></span>
          <span class="caption">Time &amp; Place</span>
        </div>
        <div class="step">
          <span class="number"><span>02</span></span>
          <span class="caption">Car</span>
        </div>
        <div class="step">
          <span class="number"><span>03</span></span>
          <span class="caption">Details</span>
        </div>
        <div class="step">
          <span class="number"><span>04</span></span>
          <span class="caption">Checkout</span>
        </div>
        <div class="step">
          <span class="number"><span>05</span></span>
          <span class="caption">Done</span>
        </div>

      </div>
    </div>