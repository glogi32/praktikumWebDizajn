
<nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><strong>Electronics</strong> Shop</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"><i class="fas fa-shopping-cart"></i></a></li>
                    <li><a href="index.php?stranica=pocetna">Home</a></li>
                    <?php 
                        
                        if(isset($_SESSION['korisnik'])) :
                            if($_SESSION['korisnik']->uloga_id == 1) :
                    ?>
                                <li><a href="index.php?stranica=admin" id="admin">Admin</a></li>
                            <?php endif; ?>
                            <li><a href="models/logout.php" id="logout">Logout</a></li>
                            <li><a href="#"> Hello <?php echo $_SESSION['korisnik']->ime ?></a>
                            <?php else: ?>
                                <li><a href="#" id="login">Login</a></li>
                                <li><a href="#" id="signup">Signup</a></li>
                        <?php endif; ?>
                    <li><a href="index.php?stranica=oAutoru">O Autoru</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">24x7 Support <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#"><strong>Call: </strong>+09-456-567-890</a></li>
                            <li><a href="#"><strong>Mail: </strong>info@yourdomain.com</a></li>
                            <li class="divider"></li>
                            <li><a href="#"><strong>Address: </strong>
                                <div>
                                    234, New york Street,<br />
                                    Just Location, USA

                                </div>
                            </a></li>
                        </ul>
                    </li>
                </ul>
                <form class="navbar-form navbar-right" role="search">
                    <div class="form-group">
                        <input type="text" placeholder="Enter Keyword Here ..." class="form-control">
                    </div>
                    &nbsp; 
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>