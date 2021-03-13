window.onload = function() {
    85
    $('#strelica-header').click(function(){

        $('body').animate({
            scrollTop: 0
        }, 1000);
    });

    document.getElementById("potvrda").addEventListener("click", provera);
};
function provera() {
    var validacija = true;
    var ime = document.querySelector("#ime");
    var prezime = document.querySelector("#prezime");
    var email = document.querySelector("#email");
    var telefon = document.querySelector("#telefon");

    var greskaIme = document.querySelector("#greskaIme");
    var greskaPrezime = document.querySelector("#greskaPrezime");
    var greskaEmail = document.querySelector("#greskaEmail");
    var greskaTelefon = document.querySelector("#greskaTelefon");

    var reIme = /^[A-Z]{1}[a-z]{3,13}(\s[A-Z]{1}[a-z]+)?$/;
    var rePrezime = /^[A-Z]{1}[a-z]{3,13}(\s[A-Z]{1}[a-z]+)?$/;
    var reEmail = /((\@ict\.edu\.rs)|(\@gmail\.com))$/;
    var reTelefon = /^06[\d]\/[\d]{3}\-[\d]{3,4}$/;
    if(!reIme.test(ime.value)){
        greskaIme.style.display = "block";
        ime.style.border = "2px solid red";
        validacija = false;
    }
    else{
        greskaIme.style.display = "none";
        ime.style.border = "2px solid green";
        validacija = true;
    }
    if(!rePrezime.test(prezime.value)){
        greskaPrezime.style.display = "block";
        prezime.style.border = "2px solid red";
        validacija = false;
    }
    else{
        greskaPrezime.style.display = "none";
        prezime.style.border = "2px solid green";
        validacija = true;
    }

    if(!reEmail.test(email.value)){
        greskaEmail.style.display = "block";
        email.style.border = "2px solid red";
        validacija = false;
    }
    else{
        greskaEmail.style.display = "none";
        email.style.border = "2px solid green";
        validacija = true;
    }
    if(!reTelefon.test(telefon.value)){
        greskaTelefon.style.display = "block";
        telefon.style.border = "2px solid red";
        validacija = false;
    }
    else{
        greskaTelefon.style.display = "none";
        telefon.style.border = "2px solid green";
        validacija = true;
    }

    if (validacija){
        alert("Poruka uspesno poslata!");
    }
}
window.onscroll = function() {scrollFunction()};
function scrollFunction() {
    if (document.body.scrollTop > 5 || document.documentElement.scrollTop > 5) {
        document.getElementById("header").style.position = "fixed";
        document.getElementById("header").style.backgroundColor = "rgba(12, 0, 5,0.4)";
        document.getElementById("header").style.borderBottomRightRadius = "40%";
        document.getElementById("header").style.borderBottomLeftRadius = "40%";
        document.getElementById("header").style.padding = "0%";
        var nizBojaLinkova = document.querySelectorAll(".bojaLinka");
        for(var i = 0;i<nizBojaLinkova.length;i++){
            nizBojaLinkova[i].style.color = "beige";
        }
    }
}