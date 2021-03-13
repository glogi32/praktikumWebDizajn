
	$("#login").on("click",openNav);
    $("#btnCancel").on("click",closeNav);

    $("#signup").on("click",openNav2);
	$("#btnCancel2").on("click",closeNav2);
	
	$("#addNew").on("click",openNavInsert);
    $("#btnCancelAdd").on("click",closeNavInsert);
    
    $("#addNewCar").on("click",openNavInsertCar);
    $("#btnCancelAddCar").on("click",closeNavInsertCar);

    $("#addNewPost").on("click",openNavInsertPost);
    $("#btnCancelAddPost").on("click",closeNavInsertPost);



    refreshUsers();
    refreshCars();
    refreshReservation();

    $(document).on("click",".update-user",function(e){
        e.preventDefault();
  
        let id = $(this).data("id");
  
        $.ajax({
          url : "index.php?page=get-one-user",
          method : "GET",
          dataType : "json",
          data : {
            id : id
          },
          
          success : function(data){
            openNavInsert();
            fillFromUpdate(data);
          },
          error : function(xhr,status,error){
            if(xhr.status == 500){
                alert("Greska na serveru")
                console.log(error.statusTekst);
            }
            if(xhr.status == 404){
                alert('Izabrani korisnik ne postoji!');
                console.log(error.statusTekst);
            }
            else{
                console.log(status);
                console.log(error);
                console.log(xhr);
                console.warn(xhr.responseText);
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
            url : "index.php?page=insert-user",
            method : "POST",
            dataType : "json",
            data : {
                ime:  $("#tbFnameU").val(),
                prezime:  $("#tbLnameU").val(),
                email:  $("#tbE_mailU").val(),
                sifra: $("#tbPasswordU").val(),
                uloga_id : valueDDL,
                send : true
            },
            success : function(data){
            
            console.log(data);
            alert(data.uspesan_insert);
            refreshUsers();
            clearFormUpdate();
            closeNavInsert();
            },
            error : function(xhr,status,error){

            if(xhr.status == 500){
                alert("Greska na serveru")
                console.log(error.statusTekst);
            }
            else if(xhr.status == 422){
                alert('Greska pri unosu podataka!');
                console.log(error.statusTekst);
                console.warn(xhr.responseText);
                console.log(xhr.responseJSON);
                let html = '<ul>';
                for(let p of xhr.responseJSON){
                    html+=`<li>${p}</li>`;
                }
                html+=`</ul>`;

                $("#feedback").html(html);
            }

            }
        })
    }
    else{
        console.log("2")
        $.ajax({
        url : "index.php?page=update-user",
        method : "POST",
        dataType : "json",
        data : {
            id:  $("#tbHiddenU").val(),
            ime:  $("#tbFnameU").val(),
            prezime:  $("#tbLnameU").val(),
            email:  $("#tbE_mailU").val(),
            sifra: $("#tbPasswordU").val(),
            uloga_id : valueDDL,
            send : true
        },
        success : function(data){
        alert("Uspesan update!");
        
        
        refreshUsers();
        clearFormUpdate();
        closeNavInsert();
        
        },
        error : function(xhr,status,error){

        if(xhr.status == 500){
            alert("Greska na serveru")
            console.log(error.statusTekst);
        }
        else if(xhr.status == 422){
            alert('Greska pri unosu podataka!');
            console.log(error.statusTekst);
            console.warn(xhr.responseText);
            console.log(xhr.responseJSON);
            let html = '<ul>';
            for(let p of xhr.responseJSON){
                html+=`<li>${p}</li>`;
            }
            html+=`</ul>`;

            $("#feedback").html(html);
        }

        }
    })
    }
    })


    $(document).on("click",".delete-user",function(e){
    e.preventDefault();

    let id = $(this).data("id");
    $.ajax({
        url : "index.php?page=delete-user",
        method : "POST",
        dataType : "json",
        data : {
        id : id
        },
        success : function(data){
            console.log(data);
            console.log("success");
            alert("Korisnik uspesno izbrisan!");
            refreshUsers();
        },
        error : function(xhr,status,error){
        if(xhr.status == 500){
            alert("Greska na serveru")
            console.log(error.statusTekst);
        }
        else if(xhr.status == 404){
            alert('Izabrani korisnik ne postoji!');
            console.log(error.statusTekst);
        }
        }
    });
    
    })

    $(document).on("click",".delete-car",function(e){
        e.preventDefault();

        let id = $(this).data("id");

        $.ajax({
            url : "index.php?page=delete-car",
            method : "POST",
            data : {
                id : id
            },
            success : function(){
                alert("Automobil uspesno izbrisan!");
                refreshCars();
            },
            error : function(xhr,status,error){
                if(xhr.status == 500){
                    alert("Greska na serveru")
                    console.log(error.statusTekst);
                }
                else if(xhr.status == 404){
                    alert('Izabrani automobil ne postoji!');
                    console.log(error.statusTekst);
                }
            }
        })
    })

    $(document).on("click",".delete-rezervation",function(e){
        e.preventDefault();

        let id = $(this).data("id");
        
        $.ajax({
            url : "index.php?page=delete-rezervation",
            method : "POST",
            data : {
                id : id
            },
            success : function(){
                alert("Rezervacija uspesno izbrisana!");
                refreshReservation();
            },
            error : function(xhr,status,error){
                if(xhr.status == 500){
                    alert("Greska na serveru")
                    console.log(error.statusTekst);
                }
                else if(xhr.status == 404){
                    alert('Izabrana rezervacija ne postoji!');
                    console.log(error.statusTekst);
                }
            }
        })
    })
    
    $(document).on("click",".linkPag",function(e){
        e.preventDefault();
  
        let pageCars = $(this).data("id");

        $.ajax({
            url : "index.php?page=carsPagination",
            method : "GET",
            data : {
                pageCars : pageCars
            },
            dataType : "json",
            success : function(data){
                printCars(data);
            },
            error : function(xhr,status,error){
                console.log(status);
                console.log(error);
                if(xhr.status == 500){
                    alert("Greska na serveru")
                    console.log(error.statusTekst);
                }
            }
        })
    })

    $("#tbSearch").on("keyup",function(){
        let tekst = $(this).val();

        $.ajax({
            url : "index.php?page=find-posts",
            method : "GET",
            dataType : "json",
            data : {
                tekst : tekst
            },
            success : function(data){
                printPosts(data);
            },
            error : function(xhr,status,error){
                if(xhr.status == 500){
                    alert("Greska na serveru")
                    console.log(error.statusTekst);
                } 
                if(xhr.status == 404){
                    alert("Greska pri dohvatanju postova")
                    console.log(error.statusTekst);
                }
            }
        })
    })

    

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
$   ("#mySidenavInsert").css("display","flex");
}

function closeNavInsert(){
    $("#mySidenavInsert").css("display","none");
    clearFormUpdate();
    
}


function openNavInsertCar(){
    $  ("#mySidenavInsertCar").css("display","flex");
}
    
function closeNavInsertCar(){
    $("#mySidenavInsertCar").css("display","none");
}

function openNavInsertPost(){
    $  ("#mySidenavInsertPost").css("display","flex");
}
    
function closeNavInsertPost(){
    $("#mySidenavInsertPost").css("display","none");
}

function refreshUsers(){
    $.ajax({
        url : "index.php?page=fill-table-users",
        method : "GET",
        dataType : "json",
        success : function(data){
            printUsers(data);
        },
        error : function(xhr,status,error){
        
        if(xhr.status == 500){
            alert("Greska pri ucitavanju korisnika!");
        }
        }
    })
}


function refreshCars(){
    $.ajax({
        url : "index.php?page=fill-table-cars",
        method : "GET",
        dataType : "json",
        success : function(data){
            printCarsAdmin(data);
        },
        error : function(xhr,status,error){
        console.log(error);
        if(xhr.status == 500){
            alert("Greska pri ucitavanju automobila!");
        }
        }
    })
}

function refreshReservation(){
    $.ajax({
        url : "index.php?page=fill-table-reservation",
        method : "GET",
        dataType : "json",
        success : function(data){
            printRezervation(data);
        },
        error : function(xhr,status,error){
        console.log(error);
        if(xhr.status == 500){
            console.log("Greska pri ucitavanju rezervacija,korisnik nije ulogovan!");
        }
        if(xhr.status == 404){
            alert("Greska pri dohvatanju  rezervacija!");
        }
        }
    })
}

function printUsers(users){
    let html = `<tr class="table-info">
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

function printCarsAdmin(cars){
    let html = `<tr class="table-info">
        <th>No.</th>
        <th>Name</th>
        <th>Doors</th>
        <th>Seats</th>
        <th>Lugage</th>
        <th>Transmision</th>
        <th>Minium age</th>
        <th>Price</th>
        <th>Delete</th>
        <th>Main</th>
    </tr>`, rb = 1;
    for(let car of cars){
        html += printCar(car, rb);
        rb++;
    }
    $("#table-cars").html(html);
    $(".carsMain").on("change",updateMain);
}

function printCar(car, rb){
    html = `<tr>
        <td>${rb}</td>
        <td>${car.naziv}</td>
        <td>${car.vrata}</td>
        <td>${car.sedista}</td>
        <td>${car.prtljag}</td>
        <td>${car.menjac}</td>
        <td>${car.starost}</td>
        <td>${car.cena}</td>
        <td><a href="#" class="delete-car" data-id="${car.auto_id}"><i class="fas fa-user-minus"></i></a></td>
        <td><input type="radio" class="carsMain" name="main" value="${car.auto_id}"`;
        if(car.pozadina == 1){
            html += `checked`;
        }
        html+=`></td>
    </tr>`;

    return html;
  }

function printRezervation(rez){
    let html = `<tr class="table-info">
        <th>No.</th>
        <th>Pickup address</th>
        <th>Drop-off address</th>
        <th>Start date</th>
        <th>Return date</th>
        <th>Model of car</th>
        <th>Price</th>
        <th>Cancel rezervation</th>
    </tr>`, rb = 1;
    for(let r of rez){
        html += printRez(r, rb);
        rb++;
    }
    $("#table-reservation").html(html);
    
}

function printRez(r, rb){
    let dateFrom = new Date(r.from_datum*1000);
    var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    let dateTo = new Date(r.to_datum*1000)
    return `<tr>
        <td>${rb}</td>
        <td>${r.pickup_adresa}</td>
        <td>${r.dropoff_adresa}</td>
        <td>${dateFrom.getDate()}.${months[dateFrom.getMonth()]}.${dateFrom.getFullYear()}</td>
        <td>${dateTo.getDate()}.${months[dateTo.getMonth()]}.${dateTo.getFullYear()}</td>
        <td>${r.naziv}</td>
        <td>${r.cena}</td>
        <td><a href="#" class="delete-rezervation" data-id="${r.id_rezervacije}"><i class="fas fa-user-minus"></i></a></td>
    </tr>`;
}

function updateMain(){
    let idC = $(this).val();
    console.log(idC);
    $.ajax({
        url : "index.php?page=update-cars",
        method : "POST",
        data : {
            idCars : idC
        },
        success : function(){
            console.log("Uspesna promena kod cars!");
            refreshCars();
        },
        error : function(xhr,status,error){
            if(xhr.status == 500){
                alert("Greska na serveru!");
            }
        }

    })
}


function fillFromUpdate(data){
    $("#tbHiddenU").val(data.korisnik_id);
    $("#tbFnameU").val(data.ime);
    $("#tbLnameU").val(data.prezime);
    $("#tbE_mailU").val(data.email);
    var ddl = document.getElementById("uloge");
    console.log(ddl);
    let len = ddl.options.length;
        for(let i = 0; i < len; i++){
            if (ddl.options[i].value == data.uloga_id)
        {
            ddl.selectedIndex = i;
            break;
        }     
    }
}

function clearFormUpdate(){
    $("#tbFnameU").val("");
    $("#tbLnameU").val("");
    $("#tbE_mailU").val("");
    $("#tbHiddenU").val("");
}

function printCars(cars){
    let html = ``;
    for(let c of cars){
        html += `<div class="col-lg-4 col-md-6 mb-4" data-id="${ c.auto_id}">
        <div class="item-1">
            <a href="#"><img src="${ c.slika }" alt="Image" class="img-fluid"></a>
            <div class="item-1-contents">
              <div class="text-center">
              <h3><a href="#">${c.naziv }</a></h3>
              <div class="rating">`;
                 for(let i=0 ; i<c.ocena ; i++){   
                html+=`<span class="icon-star text-warning"></span>&nbsp`
                 }
              html += `</div>
              <div class="rent-price"><span>$${c.cena}/</span>day</div>
              </div>
              <ul class="specs">
                <li>
                  <span>Doors</span>
                  <span class="spec">${c.vrata}</span>
                </li>
                <li>
                  <span>Seats</span>
                  <span class="spec">${c.sedista}</span>
                </li>
                <li>
                  <span>Lugage</span>
                  <span class="spec">${c.prtljag}</span>
                </li>
                <li>
                  <span>Transmision</span>
                  <span class="spec">${c.menjac}</span>
                </li>
                <li>
                  <span>Minium age</span>
                  <span class="spec">${c.starost}</span>
                </li>
              </ul>
              <div class="d-flex action">
                <a href="index.php?page=checkout&idC=${c.auto_id}" class="btn btn-primary">Rent Now</a>
              </div>
            </div>
          </div>
      </div>`;
    }
    $("#cars").html(html);
}

function printPosts(data){
    html=``;
    for(let p of data){
        let date = new Date(p.vreme_objave*1000);
        let months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        html+=`<div class="col-lg-11 col-md-3 mb-4">
        <div class="post-entry-1 h-100">
          <a href="index.php?page=blogSingle&idP=${p.post_id}">
            <img src="${p.slikaPost}" alt="${p.slikaAlt}"
            class="img-fluid">
          </a>
          <div class="post-entry-1-contents">
            
            <h2><a href="index.php?page=blogSingle&idP=${p.post_id}">${p.naslov}</a></h2>
            <span class="meta d-inline-block mb-3"> ${months[date.getMonth()]} ${date.getDay()}, ${date.getFullYear()} <span class="mx-2">by</span> <a href="#">${p.ime} ${p.prezime}</a></span>
            <p>${p.skracen_tekst}</p>
          </div>
        </div>
    </div>`;
    };
    $("#posts").html(html);
}