

<div class="site-section bg-light">
    <div class="sredina">
        <div class="container">
            <div class="row">
                <p id="addNew" class="addNew"><i class="fas fa-user-plus"></i> Add new user</p>
                <div class="table-responsive-sm table-responsive-md admin-tabela-okvir" id="admin-tabela-okvir">
                    <table class="table table-striped" id="table-users">
                    
                    
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="site-section bg-light">
    <div class="sredina">
        <div class="container">
            <div class="row">
                <p id="addNewCar" class="addNew"><i class="fas fa-user-plus"></i> Add new car</p>
                <div class="table-responsive-sm table-responsive-md admin-tabela-okvir" id="admin-tabela-okvir">
                    <table class="table table-striped" id="table-cars">
                    
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="site-section bg-light">
    <div class="sredina">
        <div class="container">
            <div class="row">
                <p id="addNewPost" class="addNew"><i class="fas fa-user-plus"></i> Add new post</p>
                <div class="table-responsive-sm table-responsive-md admin-tabela-okvir" id="admin-tabela-okvir">
                    <table class="table table-striped" id="table-cars">
                    
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="mySidenavInsert" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNavInsert()">&times;</a>
    <form id="formaLogin">
        <div class="container2">
            <h1>Add/Update user</h1>
            <p>Please fill in this form to add/update new user.</p>
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
                if(isset($data['roles'])):
                    foreach($data['roles'] as $r):
                ?>
                        <option value="<?= $r->uloga_id?>"><?= $r->naziv?></option>
                    <?php endforeach;?>
                <?php endif; ?>
            </select>
            <div id="feedback">
                
            </div>
            <div class="clearfix">
                <input type="button" id="btnCancelAdd" class="cancelbtn" value="Cancel" />
                <input type="button" id="btnAdd" name="btnAdd" class="loginbtn"  value="Add/Update user"/>
            </div>
        </div>
    </form>
</div>
<div id="mySidenavInsertCar" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNavInsertCar()">&times;</a>
    <form id="formaLogin" action="index.php?page=insert-car" method="POST" enctype="multipart/form-data">
        <div class="container2">
            <h1>Add new car</h1>
            <p>Please fill in this form to add new car.</p>
            <hr>

            <label for="nameCar"><b>Name</b></label>
            <input type="text" id="tbNameC" placeholder="Enter car name" name="nameCar">

            <label for="doors"><b>Doors</b></label>
            <select id="doors" name="ddlDoors">
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4" selected>4</option>
                <option value="6">5</option>
            </select>

            <label for="seats"><b>Seats</b></label>
            <select id="seats" name="ddlSeats">
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4" selected>4</option>
                <option value="6">5</option>
                <option value="6">6</option>
            </select>
        
            <label for="lugage"><b>Lugage</b></label>
            <input type="text" id="tbLugageC" placeholder="Enter lugage" name="lugage">

            <label for="price"><b>Price</b></label>
            <input type="text" id="tbPrice" placeholder="Enter price of car" name="price">

            <label for="transmision"><b>Transmision</b></label>
            <select id="transmision" name="ddlTransmision">
                <option value="manual">Manual</option>
                <option value="automatic">Automatic</option>
            </select>

            <label for="age"><b>Age</b></label>
            <input type="text" id="tbAge" placeholder="Enter age" name="age">

            <label for="rating"><b>Rating</b></label>
            <select id="rating" name="ddlRating">
                <option value="0">Choose..</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            
            <label for="cimg"><b>Image</b></label>
            <input type="file" id="fileImgCar" placeholder="Insert picture" name="cimg" />

            <label for="featured" ><b>Featured</b></label>
            <select id="featured" name="ddlFeatured">
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>

            <label for="main" ><b>Main</b></label>
            <select id="main" name="ddlMain">
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
            
            <div id="feedbackCars">
                <ul>
                <?php
                    if(isset($_SESSION['errors_carInsert'])):
                        foreach($_SESSION['errors_carInsert'] as $e):
                ?>
                <li><?= $e ?></li>
                        <?php endforeach; ?>
                        <?php $_SESSION['errors_carInsert'] = null; ?>
                    <?php endif; ?>
                </ul>
                
            </div>
            <div class="clearfix">
                <input type="button" id="btnCancelAddCar" class="cancelbtn" value="Cancel" />
                <input type="submit" id="btnAddCar" name="btnAddCar" class="loginbtn"  value="Add car"/>
            </div>
        </div>
    </form>
    <?php
    if(isset($_SESSION['insert_car'])):?>
        <script>alert("<?= $_SESSION['insert_car'] ?>")</script>
        <?php $_SESSION["insert_car"] = null; ?>
    <?php endif; ?>
</div>
<div id="mySidenavInsertPost" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNavInsertPost()">&times;</a>
    <form id="formaLogin" action="index.php?page=insert-post" method="POST" enctype="multipart/form-data">
        <div class="container2">
            <h1>Add post</h1>
            <p>Please fill in this form to add new post.</p>
            <hr>
            <input type="hidden" id="tbHiddenP" name="tbHiddenP" value="<?php if(isset($_SESSION['user']))   {echo $_SESSION['user']->korisnik_id;} else{echo "";}  ?>"/>

            <label for="title"><b>Title</b></label>
            <input type="text" id="tbTitle" placeholder="Enter title" name="title">

            <label for="textPost"><b>Text</b></label>
            <textarea id="tbTextPost" placeholder="Enter yout post.Use / for new paragraph" name="textPost" maxlength="3500" rows="6" cols="10"></textarea>

            <label for="pimg"><b>Image</b></label>
            <input type="file" id="fileImgPost" placeholder="Insert picture" name="pimg" />

            <label for="featuredPost">Featured</label>
            <select id="featured" name="ddlFeaturedPost">
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
            
            <div id="feedbackPost">
            <ul>
                <?php
                if(isset($_SESSION['errors_postInsert'])):
                        foreach($_SESSION['errors_postInsert'] as $e):
                ?>
                <li><?= $e ?></li>
                        <?php endforeach; ?>
                        <?php $_SESSION['errors_postInsert'] = null; ?>
                <?php endif; ?>
            </ul>
            </div>
            <div class="clearfix">
                <input type="button" id="btnCancelAddPost" class="cancelbtn" value="Cancel" />
                <input type="submit" id="btnAddPost" name="btnAddPost" class="loginbtn"  value="Add post"/>
            </div>
        </div>
    </form>
</div>
<?php
    if(isset($_SESSION['insert_post'])):?>
        <script>alert("<?= $_SESSION['insert_post'] ?>")</script>
        <?php $_SESSION["insert_post"] = null; ?>
    <?php endif; ?>