<body>
    <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <form id="formaLogin" action="models/login.php" method="POST">
                <div class="container2">
                    <h1>Login</h1>
                    <p>Please fill in this form to login.</p>
                    <hr>
                
                    <label for="email"><b>Email</b></label>
                    <input type="text" id="tbEmail" placeholder="Enter Email" name="email" />
                
                    <label for="psw"><b>Password</b></label>
                    <input type="text" id="tbPass" placeholder="Enter Password" name="psw" />
                    <?php 
                        foreach($errors as $error): ?>
                        <p class="errors"><b><?php echo $error ?></b></p>
                    <?php endforeach; ?>
                    <div>
                        <?php
                            if(isset($_SESSION["greske"])){
                                echo "<ul>";
                                foreach ($_SESSION["greske"] as $g){
                                    echo "<li>".$g."</li>";
                                }
                                echo "</ul>";
                            }
                        ?>
                    </div>
                    <div class="clearfix">
                        <input type="button" id="btnCancel" class="cancelbtn" value="Cancel" />
                        <input type="submit" id="btnLogin" name="btnLogin" class="loginbtn"  value="Login"/>
                    </div>
                </div>
            </form>
    </div>
    <div id="mySidenav2" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav2()">&times;</a>
        <form id="formaSignUp">
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
            
                <label for="rpass"><b>Repeat Password</b></label>
                <input type="text" id="tbRpassword" placeholder="Repeat Password" name="rpass" />

                <div id="feedback"></div>
                <div class="clearfix">
                    <input type="button" id="btnCancel2" class="cancelbtn" value="Cancel" />
                    <input type="button" id="btnLogin2" name="btnSingUp" class="loginbtn" value="Sign up" />
                </div>
            </div>
        </form>
    </div>
    <div id="mySidenavAddNewP" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNavAddNewP()">&times;</a>
        <form id="formaLogin" action="models/insertProduct.php" method="POST" enctype="multipart/form-data">
            <div class="container2">
                <h1>Add new product</h1>
                <p>Please fill in this form to add new product.</p>
                <hr>
            
                <label for="p_name"><b>Product name</b></label>
                <input type="text" id="tbPName" placeholder="Enter product name (max 24 characters)" name="p_name" />

                <label for="price"><b>Price</b></label>
                <input type="text" id="tbPrice" placeholder="Enter price in $" name="price" />

                <label for="screen"><b>Info screen</b></label>
                <input type="text" id="tbScreen" placeholder="Enter info about screen" name="screen" />

                <label for="processor"><b>Info processor</b></label>
                <input type="text" id="tbProcessor" placeholder="Enter info about processor" name="processor" />

                <label for="camera"><b>Info camera</b></label>
                <input type="text" id="tbCamera" placeholder="Enter info about camera" name="camera" />

                <label for="ram"><b>Info ram </b></label>
                <input type="text" id="tbRam" placeholder="Enter info about ram memory" name="ram" />

                <label for="p_type"><b>Type of device</b></label>
                <select name="ddlType">
                    <option value="0">Choose</option>
                    <?php
                        $rez = executeQuery("SELECT * FROM tip");
                        if(count($rez) == 0){
                            echo "<script>alert('GRESKA NA SERVERU!!')</script>";
                        }

                        foreach($rez as $r): ?>
                            <option value="<?= $r->tip_id?>"><?= $r->naziv?></option>
                        <?php endforeach; ?>
                </select>

                <label for="brand"><b>Brands</b></label>
                <select name="ddlBrands">
                    <option value="0">Choose</option>
                    <?php
                        $rez = executeQuery("SELECT * FROM proizvodjaci");
                        if(count($rez) == 0){
                            echo "<script>alert('GRESKA NA SERVERU!!')</script>";
                        }

                        foreach($rez as $r): ?>
                            <option value="<?= $r->proizvodjac_id?>"><?= $r->naziv?></option>
                        <?php endforeach; ?>
                </select>

                <label for="image"><b>Device image</b></label>
                <input type="file" id="tbImage" name="image" /> 

                <div id="errors"></div>
                
                <div class="clearfix">
                    <input type="button" id="btnCancel4" onclick="closeNavAddNewP()" class="cancelbtn" value="Cancel" />
                    <input type="submit" id="btnAddNewP" name="btnAddNewP" class="loginbtn"  value="Add"/>
                </div>
            </div>
        </form>
    </div>
    <div id="mySidenavInsert" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNavInsert()">&times;</a>
            <form id="formaLogin">
                <div class="container2">
                    <h1>Add new user</h1>
                    <p>Please fill in this form to add new user.</p>
                    <hr>
                    <input type="hidden" id="tbHiddenU" />

                    <label for="fname"><b>First name</b></label>
                    <input type="text" id="tbFnameU" placeholder="Enter first name" name="fnameUser">

                    <label for="lname"><b>Last name</b></label>
                    <input type="text" id="tbLnameU" placeholder="Enter last name" name="lnameUser">

                    <label for="e_mail"><b>E-mail</b></label>
                    <input type="text" id="tbE_mailU" placeholder="Enter email" name="e_mailUser">
                
                    <label for="pass"><b>Password</b></label>
                    <input type="text" id="tbPasswordU" placeholder="Enter Password" name="passUser">

                    <label for="uloge"><b>Role</b></label>
                    <select id="uloge">
                    <option value="0">Choose..</option>
                    <?php
                        $rez = executeQuery("SELECT * FROM uloge");
                        if(count($rez) == 0){
                            http_response_code(400);
                        }            
                        
                        foreach($rez as $r) :  ?>  
                                <option value="<?= $r->uloga_id?>"><?= $r->naziv?></option>
                         <?php endforeach;?>
                    </select>
                    <div class="clearfix">
                        <input type="button" id="btnCancelAdd" class="cancelbtn" value="Cancel" />
                        <input type="button" id="btnAdd" name="btnAdd" class="loginbtn"  value="Add user"/>
                    </div>
                </div>
            </form>
    </div>