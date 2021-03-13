window.onload = function(){
    $("#login").on("click",openNav);
    $("#btnCancel").on("click",closeNav);

    $("#signup").on("click",openNav2);
    $("#btnCancel2").on("click",closeNav2);
    $("#btnLogin2").on("click",pozovi);
    $("#btnLogin").on("click",prijava);
    refreshUsers();


    $("#addNew").on("click",openNavInsert);
    $("#btnCancelAdd").on("click",closeNavInsert);


    $(document).on("click",".update-user",function(e){
      e.preventDefault();

      let id = $(this).data("id");

      $.ajax({
        url : "models/admin/get_one_user.php",
        method : "GET",
        data : {
          id : id
        },
        dataType : "json",
        success : function(data){
          openNavInsert();

          fillFromUpdate(data);
        },
        error : function(greska,status,statusTekst){
          consolel.log("GRESKA U DOHVATANJU USERA!!!");
          console.log(greska.parseJSON);
          if(greska.status == 500){
            console.log("greska na serveru");
          }
          else if(greska.status == 400){
            alert('Niste poslali ispravno parametre!')
        }
        }
      })
    });

    $("#btnAdd").on("click",function(){
      let id = $("#tbHiddenU").val();
      var valueDDL = document.getElementById("uloge").options[document.getElementById("uloge").selectedIndex].value;
      console.log($("#tbFnameU").val())
      console.log($("#tbLnameU").val())
      console.log($("#tbE_mailU").val())
      console.log($("#tbPasswordU").val())
      console.log($("#tbHiddenU").val())
      if( id === ""){
        
        $.ajax({
          url : "models/admin/insertUser.php",
          method : "POST",
          dataType : "json",
          data : {
              ime:  $("#tbFnameU").val(),
              prezime:  $("#tbLnameU").val(),
              email:  $("#tbE_mailU").val(),
              sifra: $("#tbPasswordU").val(),
              uloga_id : valueDDL
        },
        success : function(data,status,ceoZahtev){
          console.log("USPESAN ADD");
          
          if(ceoZahtev.status == 204){
            console.log("Uspesno sacuvano");
          }

          
          refreshUsers();
          clearFormUpdate();
          closeNavInsert();
        },
        error : function(greska,status,statusTekst){
          console.log("GRESKA UPDATE KORISNIKA!");

        }
      })
      }
      else{
        $.ajax({
          url : "models/admin/updateUser.php",
          method : "POST",
          dataType : "json",
          data : {
              id:  $("#tbHiddenU").val(),
              ime:  $("#tbFnameU").val(),
              prezime:  $("#tbLnameU").val(),
              email:  $("#tbE_mailU").val(),
              sifra: $("#tbPasswordU").val(),
              uloga_id : valueDDL
        },
        success : function(data,status,ceoZahtev){
          console.log("USPESAN UPDATE/ADD");
          
          if(ceoZahtev.status == 204){
            console.log("Uspesno sacuvano");
          }

          
          refreshUsers();
          clearFormUpdate();
          closeNavInsert();
          
        },
        error : function(greska,status,statusTekst){
          console.log("GRESKA UPDATE KORISNIKA!");
          console.log(statusTekst.status);

        }
      })
      }
    })


    $(document).on("click",".delete-user",function(e){
      e.preventDefault();

      let id = $(this).data("id");

      $.ajax({
        url : "models/admin/index.php?page=delete-user",
        method : "GET",
        dataType : "json",
        data : {
          id : id
        },
        success : function(data){
          refreshUsers();
        },
        error : function(greska,status,statusTekst){
          console.log("GRESKA DELETE!!!!");
          console.log(status);
          console.log(statusTekst);
          if(greska.status == 500){
            console.log(greska.parseJSON);
            alert(greska.parseJSON.poruka);
        }
        else if(greska.status == 400){
            alert('Niste poslali ispravno parametre!')
        }
        }
      });
      
    })


    $("#btnAddNewProduct").on("click",openNavAddNewP);

    $("#btnAddNewP").on("click",addNewProduct);

    $(".filterBrand").on("click",filterByBrand);

    $(".sort").on("click",sort);

    $("#btnSendComment").on("click",sendCom);


    $("#s1").click(function(){
      $(".fa-star").css("color","black");
      $("#s1").css("color","#FFD700");
    })
    $("#s2").click(function(){
      $(".fa-star").css("color","black");
      $("#s1,#s2").css("color","#FFD700");
    })
    $("#s3").click(function(){
      $(".fa-star").css("color","black");
      $("#s1,#s2,#s3").css("color","#FFD700");
    })
    $("#s4").click(function(){
      $(".fa-star").css("color","black");
      $("#s1,#s2,#s3,#s4").css("color","#FFD700");
    })
    $("#s5").click(function(){
      $(".fa-star").css("color","black");
      $("#s1,#s2,#s3,#s4,#s5").css("color","#FFD700");
    })


    $(".fa-star").on("click",rating);

    $(".filter-cena").on("click",filterByPrice);
}

function prijava(){
    let email = $("#tbEmail").val();
    let pass = $("#tbPass").val();

    let reEmail = /^[A-Za-z0-9\_-]{3,15}@[gmail.com|hotmail.com|yahoo.com]$/;
    let rePass = /^[A-Za-z0-9\_-]{4,15}$/;

    if(!reEmail.test(email)){
      $("#tbEmail").css("border","3px solid red");
    }else{
      $("#tbEmail").css("border","3px solid green");
    }

    if(!rePass.test(pass)){
      $("#tbPass").css("border","3px solid red");
    }else{
      $("#tbPass").css("border","3px solid green");
    } 
}

function pozovi(){
    function provera(){
      let ime = $("#tbFname").val();
      let prezime = $("#tbLname").val();
      let email = $("#tbE_mail").val();
      let sifra = $("#tbPassword").val();
      let rpSifra = $("#tbRpassword").val();

      let reImePrezime = /^[A-Z][a-z]{2,15}$/;
      let reEmail = /^[A-Za-z0-9/.-]{3,20}@(gmail|hotmail|yahoo).com$/;
      let reSifra = /^[A-Za-z0-9\_-]{4,15}$/;

      if(!reImePrezime.test(ime)){
        $("#tbFname").css("border","3px solid red");
      }else{
        $("#tbFname").css("border","3px solid green");
      }

      if(!reImePrezime.test(prezime)){
        $("#tbLname").css("border","3px solid red");
      }else{
        $("#tbLname").css("border","3px solid green");
      }

      if(!reEmail.test(email)){
        $("#tbE_mail").css("border","3px solid red");
      }else{
        $("#tbE_mail").css("border","3px solid green");
      }

      if(!reSifra.test(sifra)){
        $("#tbPassword").css("border","3px solid red");
      }else{
        $("#tbPassword").css("border","3px solid green");
      }

      if(sifra != rpSifra){
        $("#tbRpassword").css("border","3px solid red");
      }else{
        $("#tbRpassword").css("border","3px solid green");
      }
    }

    function getFromData(){
      var obj ={
        ime : $("#tbFname").val(),
        prezime : $("#tbLname").val(),
        email : $("#tbE_mail").val(),
        sifra : $("#tbPassword").val(),
        send : true
      }
      return obj;
    }


    function callAjax(obj){
        $.ajax({
          url : "models/signup.php",
          method : "POST",
          dataType : "json",
          data : obj,
          success : function(data,xhr){
            alert("Uspesna registracija!!!!");
            $("#feedback").html("<h1>Uspesna registracija!</h1>");
          },
          error : function(xhr,status,error){
            console.log(xhr);
            console.log(status);
            console.log(error);
            var poruka = "Doslo je do greske";
            switch(xhr.status){
              case 404 :
                poruka = "Stranica nije pronadjena";
                break;
              case 409 : 
                poruka = "Email vec postoji";
                break;
              case 422 :
                poruka = "<ul>";
                for(let p of xhr.responseJSON){
                  poruka += "<li>"+p+"</li>";
                }
                poruka += "</ul>";
                console.log(xhr.responeText);
                break;
              case 500 : 
                poruka = "Greska na serveru!";
                break;
            }
          $("#feedback").html(poruka);
          }
        });
    }
    var fromData = getFromData();
    callAjax(fromData);
    provera();
  }
function openNav() {
    $("#mySidenav").css("display","flex");
}

function closeNav() {
  document.getElementById("mySidenav").style.display = "none";
}

function openNav2() {
  document.getElementById("mySidenav2").style.display = "flex";
}

function closeNav2() {
document.getElementById("mySidenav2").style.display = "none";
}

function openNavInsert(){
  $("#mySidenavInsert").css("display","flex");
}

function closeNavInsert(){
  $("#mySidenavInsert").css("display","none");
}

function openNavAddNewP(){
  $("#mySidenavAddNewP").css("display","flex");
}

function closeNavAddNewP(){
  $("#mySidenavAddNewP").css("display","none");
}

function refreshUsers(){
  $.ajax({
    url : "models/admin/get_all_users.php",
    method : "GET",
    dataType : "json",
    success : function(data){
      printUsers(data);
    },
    error : function(greska,status,statusTekst){
      console.log("ERROR!!!!!!!!!");
      console.log(status);
      console.log(statusTekst);
      if(greska.status == 400){
        alert("Parametri nisu ispravno uneti!")
      }
    }
  })
}

function printUsers(users){
  let html = `<tr class="bg-success">
  <th>No.</th>
  <th>First Name</th>
  <th>Last Name</th>
  <th>Role</th>
  <th>Email</th>
  <th>Update</th>
  <th>Delete</th>
</tr>`, rb = 1;
  for(let user of users){
      html += printUser(user, rb);
      rb++;
  }
  $("#table-users").html(html);
}

function printUser(user, rb){
  return `<tr>
  <td>${rb}</td>
  <td>${user.ime}</td>
  <td>${user.prezime}</td>
  <td>${user.naziv}</td>
  <td>${user.email}</td>
  <td><a href="#" class="update-user" data-id="${user.korisnik_id}"><i class="fas fa-pen"></i></a></td>
  <td><a href="#" class="delete-user" data-id="${user.korisnik_id}"><i class="fas fa-user-minus"></i></a></td>
</tr>`;
}

function fillFromUpdate(data){
  $("#tbHiddenU").val(data.korisnik_id);
  $("#tbFnameU").val(data.ime);
  $("#tbLnameU").val(data.prezime);
  $("#tbE_mailU").val(data.email);
  var ddl = document.getElementById("uloge");
  let len = ddl.options.length;
    for(let i = 0; i < len; i++)
    {
      if (ddl.options[i].innerHTML == data.naziv)
      {
        ddl.selectedIndex = i;
         break;
      }     
    }
}
function clearFormUpdate(data){
  $("#tbFname").val("");
  $("#tbLname").val("");
  $("#tbE_mail").val("");
  $("#tbHidden").val("");
}

function addNewProduct(){
  let name = $("#tbPName").val();
  let ddlType = document.getElementById("ddlType").options[document.getElementById("ddlType").selectedIndex].value;
  let img = $("#tbImage").val();
  console.log(img);
  
  if(ddlType == 0){
    $("#ddlType").css("border","3px solid red");
  }else{
    $("#ddlType").css("border","none");
  }

  if(img == ""){
    $("#tbImage").css("border","3px solid red");
  }else{
    $("#tbImage").css("border","none");
  }

  if(name.length > 24){
    $("#tbPName").css("border","3px solid red");
  }else{
    $("#tbPName").css("border","none");
  }


}



function filterByBrand(){
  let katId = $(this).data("id");
  $.ajax({
    url : "models/filters/get_all_productsByBrand.php",
    method : "GET",
    dataType : "json",
    data : {
      id : katId
    },
    success : function(data){
      printProducts(data);
    },
    error : function(greska,status,statusTekst){
      console.log("ERROR!!!!!!!!!");
      console.log(status);
      console.log(statusTekst);
      if(greska.status == 400){
        alert("Parametri nisu ispravno uneti!")
      }
    }
  })
}

function sort(e){
  let idSort = $(this).data("id");
  e.preventDefault();
  if(idSort == "asc"){

    $.ajax({
      url : "models/filters/get_all_productsSortAsc.php",
      method : "GET",
      dataType : "json",
      data : {
        id : idSort
      },
      success : function(data){
        printProducts(data);
      },
      error : function(greska,status,statusTekst){
        console.log("ERROR!!!!!!!!!");
        console.log(status);
        console.log(statusTekst);
        if(greska.status == 400){
          alert("Parametri nisu ispravno uneti!")
        }
      }
    })

  }
  else{

    $.ajax({
    url : "models/filters/get_all_productsSortDesc.php",
    method : "GET",
    dataType : "json",
    data : {
      id : idSort
    },
    success : function(data){
      printProducts(data);
    },
    error : function(greska,status,statusTekst){
      console.log("ERROR!!!!!!!!!");
      console.log(status);
      console.log(statusTekst);
      if(greska.status == 400){
        alert("Parametri nisu ispravno uneti!")
      }
    }
  })
  }

  if(idSort == "pop"){

    $.ajax({
      url : "models/filters/get_all_productsSortPop.php",
      method : "GET",
      dataType : "json",
      data : {
        id : idSort
      },
      success : function(data){
        printProducts(data);
      },
      error : function(greska,status,statusTekst){
        console.log("ERROR!!!!!!!!!");
        console.log(status);
        console.log(statusTekst);
        if(greska.status == 400){
          alert("Parametri nisu ispravno uneti!")
        }
      }
    })

  }

}

function printProducts(products){
  let html = "";

  for(let p of products){
  html += `<div class="col-md-4 text-center col-sm-6 col-xs-6 stil">
  <div class="thumbnail product-box product">
      <img src="${p.src}" alt="${p.alt}" />
      <div class="caption">
          <h3><a href="#">${p.naziv}</a></h3>
          <p>Price : <strong>$ ${p.cena.toLocaleString()}</strong>  </p>
          <p><strong>${Math.round(p.cena/24)}.00$</strong> per motnth</p>
          <p class="rating">Rating: &nbsp`;
          let avgOcena = p.prosek;
          if(avgOcena != null){
            for(let i = 1 ; i <= 5 ; i++){
                if(avgOcena >= 1){
                    html+= "<i class='fas fa-star' style='color:orange;'></i>";
                    avgOcena--;
                } else {
                    if(avgOcena >= 0.5){
                        html+= "<i class='fas fa-star-half-alt' style='color:orange;'></i>";
                        avgOcena -= 0.5;
                    }
                else{
                    html+= "<i class='far fa-star'></i>";
                }
            }
        }
    }else{
        html+= "<i class='far fa-star'></i><i class='far fa-star'></i><i class='far fa-star'></i><i class='far fa-star'></i><i class='far fa-star'></i>";
    }
          html+=`</p>
          <p><a href="#" class="btn btn-success" role="button">Add To Cart</a>
          <a href="details.php?id=${p.proizvod_id}" class="btn btn-primary" data-id="${p.proizvod_id}" role="button">See Details</a></p>
      </div>
  </div>
</div>`;
  }
  
  $("#proizvodi").html(html);
}

function sendCom(){

  let idKorisnika = $("#hdnIdKorisnika").val();
  let tekst = $("#taKomentar").val();
  let idProizvoda = $("#hdnIdProizvoda").val();
  
  $.ajax({
    url : "models/details/insertComments.php",
    method : "POST",
    data : {
      idKorisnika : idKorisnika,
      tekst : tekst,
      idProizvoda : idProizvoda
    },
    success : function(){
      alert("Komentar uspesno poslat!");
    },
    error : function(greska,status,statusTekst){
      console.log("GRESKA!");
      console.log(status.code);
      console.log(statusTekst);
      if(greska.status == 400){
        alert("Greska pri slanju parametara!");
      }
      else if(greska.status == 500){
        alert("GRESKA NA SERVERU!");
      }
    }
  })
}

function rating(){
  let rating = $(this).data("rating");
  let idProizvoda = $("#hdnIdProizvoda").val();

  $.ajax({
    url : "models/details/insertRating.php",
    method : "GET",
    data : {
      rating : rating,
      idProizvoda : idProizvoda
    },
    success : function(){
      alert("U voted "+rating+" out of 5.");
    },
    error : function(greska,status,statusTekst){
      console.log(greska);
      console.log(status);
      console.log(statusTekst);
    }
  })
}

function filterByPrice(e){
  e.preventDefault();

  let cenaId = $(this).data("id");

  $.ajax({
    url : "models/filters/get_all_productsByPrice.php",
    method : "GET",
    dataType : "json",
    data : {
      id : cenaId
    },
    success : function(data){
      console.log(data);
      printProducts(data);
    },
    error : function(greska,status,statusTekst){
      
      console.log("ERROR!!!!!!!!!");
      console.log(greska.status);
      console.log(statusTekst);
      if(greska.status == 400){
        alert("Parametri nisu ispravno uneti!")
      }
    }
  })
}