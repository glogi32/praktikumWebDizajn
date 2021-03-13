      <div class="site-section bg-light">
        <div class="container">
          <div class="row">
            <div class="col-lg-3">
              <h3>Our Offer</h3>
              <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure nesciunt nemo vel earum maxime neque!</p>
              <p>
                <a href="#" class="btn btn-primary custom-prev">Previous</a>
                <span class="mx-2">/</span>
                <a href="#" class="btn btn-primary custom-next">Next</a>
              </p>
            </div>
            <div class="col-lg-9">
              
              <div class="nonloop-block-13 owl-carousel">
                <?php
                  foreach($data['allCars'] as $c):
                    if($c->izabrani == 1):
                ?>
                <div class="item-1">
                  <a href="#"><img src="<?=$c->slika ?>" alt="Image" class="img-fluid"></a>
                  <div class="item-1-contents">
                    <div class="text-center">
                    <h3><a href="#"><?=$c->naziv ?></a></h3>
                    <div class="rating">
                      <?php for($i=0 ; $i<$c->ocena ; $i++):   ?>
                      <span class="icon-star text-warning"></span>
                      <?php endfor; ?>
                    </div>
                    <div class="rent-price"><span>$<?=$c->cena ?>/</span>day</div>
                    </div>
                    <ul class="specs">
                      <li>
                        <span>Doors</span>
                        <span class="spec"><?=$c->vrata ?></span>
                      </li>
                      <li>
                        <span>Seats</span>
                        <span class="spec"><?=$c->sedista ?></span>
                      </li>
                      <li>
                        <span>Transmission</span>
                        <span class="spec"><?=$c->menjac ?></span>
                      </li>
                      <li>
                        <span>Minium age</span>
                        <span class="spec"><?=$c->starost ?> years</span>
                      </li>
                    </ul>
                    <div class="d-flex action">
                      <a href="index.php?page=checkout&idC=<?=$c->auto_id?>" class="btn btn-primary">Rent Now</a>
                    </div>
                  </div>
                </div>
                    <?php endif; ?>
                  <?php endforeach; ?>

                

              </div>
              
            </div>
          </div>
        </div>
      </div>

      <div class="site-section section-3" style="background-image: url('public/vendor/images/hero_2.jpg');">
        <div class="container">
          <div class="row">
            <div class="col-12 text-center mb-5">
              <h2 class="text-white">Our services</h2>
            </div>
          </div>
          <div class="row">
          <?php
            if(isset($data['services'])):
              foreach($data['services'] as $s):
                if($s->izabrani == 1):
          ?>
            <div class="col-lg-4">
              <div class="service-1">
                <span class="service-1-icon">
                  <span class="<?= $s->klasa ?>"></span>
                </span>
                <div class="service-1-contents">
                  <h3><?= $s->naziv ?></h3>
                  <p><?= $s->tekst  ?></p>
                </div>
              </div>
            </div>
                <?php endif; ?>
              <?php endforeach; ?>
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
      


      <div class="site-section bg-light">
        <div class="container">
          <div class="row justify-content-center text-center mb-5">
            <div class="col-7 text-center mb-5">
              <h2>Our Blog</h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo assumenda, dolorum necessitatibus eius earum voluptates sed!</p>
            </div>
          </div>

          <div class="row">
            <?php
              if(isset($data['featuredPosts'])):
                foreach($data['featuredPosts'] as $p):
            ?>
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="post-entry-1 h-100">
                <a href="index.php?page=blogSingle&idP=<?=$p->post_id?>">
                  <img src="<?= $p->slikaPost?>" alt="<?= $p->altPost ?>"
                  class="img-fluid">
                </a>
                <div class="post-entry-1-contents">
                  
                  <h2><a href="index.php?page=blogSingle&idP=<?=$p->post_id?>"><?=$p->naslov?></a></h2>
                  <span class="meta d-inline-block mb-3"> <?= date("F d",$p->vreme_objave)?>, <?= date("Y",$p->vreme_objave)?></span> <span class="mx-2">by</span> <a href="#"><?=$p->ime?> <?= $p->prezime?></a></span>
                  <p><?=$p->skracen_tekst?></p>
                </div>
              </div>
            </div>
                <?php endforeach; ?>
                <?php endif; ?>
          </div>
        </div>
      </div>