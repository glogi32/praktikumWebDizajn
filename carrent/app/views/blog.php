<div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
          <div id="posts">
          <?php
            if(isset($data['posts'])):
              foreach($data['posts'] as $p):
          ?>
            <div class="col-lg-11 col-md-3 mb-4">
                <div class="post-entry-1 h-100">
                  <a href="index.php?page=blogSingle&idP=<?=$p->post_id?>">
                    <img src="<?=$p->post_slika?>" alt="<?= $p->alt ?>"
                    class="img-fluid">
                  </a>
                  <div class="post-entry-1-contents">
                    
                    <h2><a href="index.php?page=blogSingle&idP=<?=$p->post_id?>"><?=$p->naslov ?></a></h2>
                    <span class="meta d-inline-block mb-3"> <?= date("F d",$p->vreme_objave)?>, <?= date("Y",$p->vreme_objave)?> <span class="mx-2">by</span> <a href="#"><?=$p->ime?> <?= $p->prezime?></a></span>
                    <p><?=$p->skracen_tekst?></p>
                  </div>
                </div>
            </div>
              <?php endforeach; ?>
              <?php endif; ?>
            
          </div>
          <div class="col-12">
            <?php
              if(isset($data['brojLinkova'])):
                for($i=1;$i<=$data['brojLinkova'];$i++):
            ?>
            <a href="index.php?page=blog&pagePost=<?=$i?>" class="p-3"><?=$i?></a>
                <?php endfor; ?>
              <?php endif; ?>
          </div>

          </div>
          <div class="col-lg-4 sidebar">
            <div class="sidebar-box">
              <form class="search-form">
                <div class="form-group">
                  <span class="icon fa fa-search" id="search"></span>
                  <input type="text" class="form-control" id="tbSearch" name="tbSearch" placeholder="Search posts by title">
                </div>
              </form>
            </div>
            <!--<div class="sidebar-box">
              <div class="categories">
                <h3>Categories</h3>
                <li><a href="#">Creatives <span>(12)</span></a></li>
                <li><a href="#">News <span>(22)</span></a></li>
                <li><a href="#">Design <span>(37)</span></a></li>
                <li><a href="#">HTML <span>(42)</span></a></li>
                <li><a href="#">Web Development <span>(14)</span></a></li>
              </div>
            </div>-->
            
          </div>
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


    <!---->