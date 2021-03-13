<div class="site-section">
      <div class="container">
        <div class="row">
          <?php
            if(isset($data['post'])){
              $post = $data['post'][0];
              $nizPasusa = explode("/",$post->tekst);
            }
          ?>
          <div class="col-md-8 blog-content">
            <h1 class="lead"><?=$post->naslov?></h1>
            <?php
              foreach($nizPasusa as $p):
            ?>
              <p><?=$p?></p>
              <?php endforeach; ?>
            <div class="pt-5">
            </div>

            <div class="pt-5">
              <h3 class="mb-5"><?php if($data['broj_komentara']->brojKomentara != 0){ echo $data['broj_komentara']->brojKomentara;}else{echo "No";}?> Comments</h3>
              <ul class="comment-list">
                <?php if(isset($data['komentari'])): ?>
                  <?php foreach($data['komentari'] as $k): ?>
                    <li class="comment">
                      <div class="vcard bio">
                        <img src="<?= $k->slika ?>" alt="<?= $k->alt ?>">
                      </div>
                      <div class="comment-body">
                        <h3><?= $k->ime ?> <?= $k->prezime ?></h3>
                        <div class="meta"><?= date("F d,Y G:i",$k->vreme) ?></div>
                        <p><?= $k->tekst ?></p>
                        <p><a href="#" class="reply">Reply</a></p>
                      </div>
                    </li>
                  <?php endforeach; ?>
                  <?php endif; ?>
                
              </ul>
              <!-- END comment-list -->
              <?php
                if(isset($_SESSION['insert_com'])):
              ?>
                  <script>alert('<?= $_SESSION['insert_com'] ?>')</script>
                  <?php $_SESSION['insert_com'] = null; ?>
                <?php endif; ?>
              <?php if(isset($_SESSION['user'])): ?>
                <div class="comment-form-wrap pt-5">
                  <h3 class="mb-5">Leave a comment</h3>
                  <form action="index.php?page=insert-comment" method="POST" class="">
                    <input type="hidden" id="tbHiddenK" name="idK" value="<?= $_SESSION['user']->korisnik_id ?>" />
                    <input type="hidden" id="tbHiddenP" name="idP" value="<?= $_GET['idP'] ?>" />
                    <div class="form-group">
                      <label for="message">Message</label>
                      <textarea name="message" id="message" cols="30" rows="10" class="form-control" ></textarea>
                    </div>
                    <div class="form-group">
                      <input type="submit" name="btnSubmitCom" value="Post Comment" class="btn btn-primary btn-md text-white">
                    </div>

                  </form>
                </div>
              <?php else: ?>
                <p>U must be logged in to post comments!</p>
              <?php endif; ?>
            </div>

          </div>
          <div class="col-md-4 sidebar">
            
            <div class="sidebar-box">
              <img src="<?= $post->slikaKorisnik ?>" alt="<?= $post->altKorisnik ?>" class="img-fluid mb-4 w-50 rounded-circle">
              <h3 class="text-black">About The Author</h3>
              <p><?= $post->oAutoru ?></p>
             
            </div>

            
          </div>
        </div>
      </div>
    </div>