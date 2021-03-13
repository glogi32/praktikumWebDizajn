<div class="site-section bg-light" id="contact-section">
    <div class="site-section" id="checkout-header">
      <h3>Please insert information about your trip</h3>
    </div>
    <div class="site-section pt-0 pb-0 bg-light" id="form-checkout">
        <div class="container">
          <div class="row">
            <div class="col-12">
              
                <form class="trip-form" action="index.php?page=submit-rezervation" method="POST">
                  <div class="row align-items-center mb-4">
                    <div class="col-md-6">
                      <h3 class="m-0">Begin your trip here</h3>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-3">
                      <label for="cf-1">Where you from</label>
                      <input type="text" id="cf-1" name='pickupA' placeholder="Your pickup address" class="form-control">
                    </div>
                    <div class="form-group col-md-3">
                      <label for="cf-2">Where you go</label>
                      <input type="text" id="cf-2" name='dropoffA' placeholder="Your drop-off address" class="form-control">
                    </div>
                    <div class="form-group col-md-3">
                      <label for="cf-3">Journey date</label>
                      <input type="text" id="cf-3" name='fromD' placeholder="Your journey date" class="form-control datepicker px-3">
                    </div>
                    <div class="form-group col-md-3">
                      <label for="cf-4">Return date</label>
                      <input type="text" id="cf-4" name='toD' placeholder="Your return date " class="form-control datepicker px-3">
                    </div>
                    <input type="hidden" id="hiddenIdC" name="hiddenIdC" value="<?php if(isset($_GET['idC'])) {echo $_GET['idC'];} else{echo "";};  ?>" />
                    <input type="hidden" id="hiddenIdK" name="hiddenIdK" value="<?php if(isset($_SESSION['user']))   {echo $_SESSION['user']->korisnik_id;} else{echo "";}  ?>" />
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <input type="submit" id="btnSubmitRez" name="btnSubmitRez" value="Submit" class="btn btn-primary">
                    </div>
                    <div>
                      <ul>
                      <?php if(isset($_SESSION['checkout_errors'])): 
                        foreach($_SESSION['checkout_errors'] as $e): ?>
                          <li><?= $e ?></li>
                        <?php endforeach; ?>
                        <?php endif; ?>
                        <?php $_SESSION['checkout_errors'] = null; ?>
                      </ul>
                    </div>
                  </div>
                </form>
              </div>
          </div>
        </div>
      </div>
      <?php
        if(isset($_SESSION['checkout_id_errors'])):?>
        <script>alert("<?=$_SESSION['checkout_id_errors']?>")</script>
        <?php endif; ?>
        <?php $_SESSION['checkout_id_errors'] = null; ?>
        <div class="site-section bg-light">
    <div class="sredina">
        <div class="container">
          <h1>Rezervations</h1>
            <div class="row">
                <div class="table-responsive-sm table-responsive-md admin-tabela-okvir" id="admin-tabela-okvir">
                    <table class="table table-striped" id="table-reservation">
                    
                    
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>