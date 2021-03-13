<div id="mySidenav" class="sidenav" >
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <form id="formaLogin" action="index.php?page=login" method="POST">
      <div class="container2">
          <h1>Login</h1>
          <p>Please fill in this form to login.</p>
          <hr>
      
          <label for="email"><b>Email</b></label>
          <input type="text" id="tbEmail" placeholder="Enter Email" name="email" />
      
          <label for="psw"><b>Password</b></label>
          <input type="text" id="tbPass" placeholder="Enter Password" name="psw" />
         
          <div class="clearfix">
              <input type="button" id="btnCancel" class="cancelbtn" value="Cancel" />
              <input type="submit" id="btnLogin" name="btnLogin" class="loginbtn"  value="Login"/>
          </div>
          <ul>
          <?php
            if(isset($_SESSION["error_login"])):
              foreach($_SESSION["error_login"] as $e):
          ?>
            <li><?= $e ?></li>
              <?php endforeach; ?>
            <?php endif; ?>
          </ul>
          <?php if(isset($_SESSION["user"])){
             var_dump($_SESSION["user"]);
          } ?>
      </div>
    </form>
</div>
<div id="mySidenav2" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav2()">&times;</a>
    <form id="formaSignUp" action="index.php?page=signup" method="POST" enctype="multipart/form-data">
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
            <input type="text" id="tbPassword" placeholder="Enter Password" name="pass" />
        
            <label for="img"><b>Image</b></label>
            <input type="file" id="fileImg" placeholder="Insert picture" name="fimg" />

            <label for="pass"><b>About you</b></label>
            <textarea type="text" id="tbPassword" placeholder="Tell us something about you" name="about" rows="5" cols="10"></textarea>
            
            <div id="feedback">
            </br>
            <ul>
              <?php
                if(isset($_SESSION['signup_errors'])):
                  foreach($_SESSION['signup_errors'] as $e): ?>
                    <li><?= $e ?></li>
                  <?php endforeach; ?>
                  
              <?php $_SESSION['signup_errors'] = null ?>
              <?php endif; ?>
            </ul> 
            </div>
            <div class="clearfix">
                <input type="button" id="btnCancel2" class="cancelbtn" value="Cancel" />
                <input type="submit" id="btnLogin2" name="btnSignUp" class="loginbtn" value="Sign up" />
            </div>
        </div>
    </form>
    
</div>

<?php
  if(isset($_SESSION["signup"])): ?>
    <script>alert("<?= $_SESSION['signup'] ?>")</script>
    <?php $_SESSION["signup"] = null; ?>
<?php endif; ?>
  
<footer class="site-footer">
        <div class="container">
          <div class="row">
            <div class="col-lg-3">
              <h2 class="footer-heading mb-4">About Us</h2>
                  <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
            </div>
            <div class="col-lg-8 ml-auto">
              <div class="row">
                <div class="col-lg-3">
                  <h2 class="footer-heading mb-4">Quick Links</h2>
                  <ul class="list-unstyled">
                    <li><a href="index.php?page=about">Home</a></li>
                    <li><a href="index.php?page=services">Services</a></li>
                    <li><a href="index.php?page=cars">Cars</a></li>
                    <li><a href="index.php?page=about">About</a></li>
                    <li><a href="index.php?page=blog">Blog</a></li>
                    <a href="DokumentacijaPHP2-1.pdf">Dokumentacija</a></li>
                  </ul>
                </div>
                <div class="col-lg-3">
                  <h2 class="footer-heading mb-4">Quick Links</h2>
                  <ul class="list-unstyled">
                    <li><a href="index.php?page=about">Home</a></li>
                    <li><a href="index.php?page=services">Services</a></li>
                    <li><a href="index.php?page=cars">Cars</a></li>
                    <li><a href="index.php?page=about">About</a></li>
                    <li><a href="index.php?page=blog">Blog</a></li>
                  </ul>
                </div>
                <div class="col-lg-3">
                  <h2 class="footer-heading mb-4">Quick Links</h2>
                  <ul class="list-unstyled">
                    <li><a href="index.php?page=about">Home</a></li>
                    <li><a href="index.php?page=services">Services</a></li>
                    <li><a href="index.php?page=cars">Cars</a></li>
                    <li><a href="index.php?page=about">About</a></li>
                    <li><a href="index.php?page=blog">Blog</a></li>
                  </ul>
                </div>
                <div class="col-lg-3">
                  <h2 class="footer-heading mb-4">Quick Links</h2>
                  <ul class="list-unstyled">
                    <li><a href="index.php?page=about">Home</a></li>
                    <li><a href="index.php?page=services">Services</a></li>
                    <li><a href="index.php?page=cars">Cars</a></li>
                    <li><a href="index.php?page=about">About</a></li>
                    <li><a href="index.php?page=blog">Blog</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="row pt-5 mt-5 text-center">
            <div class="col-md-12">
              <div class="border-top pt-5">
                <p>
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
              Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart text-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
              </p>
              </div>
            </div>

          </div>
        </div>
      </footer>

    </div>

    <script src="public/vendor/js/jquery-3.3.1.min.js"></script>
    <script src="public/vendor/js/popper.min.js"></script>
    <script src="public/vendor/js/bootstrap.min.js"></script>
    <script src="public/vendor/js/owl.carousel.min.js"></script>
    <script src="public/vendor/js/jquery.sticky.js"></script>
    <script src="public/vendor/js/jquery.waypoints.min.js"></script>
    <script src="public/vendor/js/jquery.animateNumber.min.js"></script>
    <script src="public/vendor/js/jquery.fancybox.min.js"></script>
    <script src="public/vendor/js/jquery.easing.1.3.js"></script>
    <script src="public/vendor/js/bootstrap-datepicker.min.js"></script>
    <script src="public/vendor/js/aos.js"></script>
    <script src="public/vendor/js/main.js"></script>
    <script src="public/vendor/js/myscript.js"></script>
    

  </body>

</html>