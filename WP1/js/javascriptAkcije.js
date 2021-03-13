window.onload = function() {
    $('#strelica-header').click(function(){

        $('body').animate({
            scrollTop: 0
        }, 1000);
    });

    document.getElementById("dugme").addEventListener("click", openNav);

    dinamickiIspisDdlListe();
    dinamickiIspisCbhListe();

    document.getElementById("potvrda").addEventListener("click", provera);
    document.querySelector("#datumRodj").addEventListener("blur", function() {
        var reDatumRodjenja = /^(19[\d]{2}|20(0[\d]|1[0-8]))\-(0[1-9]|1[012])\-(0[1-9]|[12][\d]|3[01])$/;
        var godinaRodjenja = document.querySelector("#datumRodj").value.trim();
        if(reDatumRodjenja.test(godinaRodjenja)) {
            var niz = godinaRodjenja.split("-");
            var jmbg = niz[2]+niz[1]+niz[0].substr(1,3);
            document.querySelector("#jmbg").value = jmbg;
        } else {
            document.querySelector("#jmbg").value = "";
        }
    });
};
function provera() {

    var valdacija = true;
    var imePrezime = document.querySelector("#imePrezime");
    var datumRodj = document.querySelector("#datumRodj");
    var jmbg = document.querySelector("#jmbg");
    var email = document.querySelector("#email");
    var brTelefona = document.querySelector("#brTelefona");
    var nacinPlacanja = document.querySelector("#ddlNacinPlacanja");
    var nacinPlacanjaIzbor = nacinPlacanja.value;
    var chbKursevi = document.getElementsByName("chbKursevi");
    var izabraniKursevi = [];
    console.log(chbKursevi);

    var imePrezimeGreska = document.querySelector("#imePrezimeGreska");
    var datumRodjGreska = document.querySelector("#datumRodjenjaGreska");
    var jmbgGreska = document.querySelector("#jmbgGreska");
    var emailGreska = document.querySelector("#emailGreska");
    var brTelefonaGreska = document.querySelector("#brTelefonaGreska");
    var nacinPlacanjaGreska = document.querySelector("#nacinPlacanjaGreska");
    var kurseviGreska = document.querySelector("#kurseviGreska");

    var reImePrezime = /^[A-Z]{1}[a-z]+(\s[A-Z]{1}[a-z]+)+$/;
    var reDatumRodj = /^(19[\d]{2}|20(0[\d]|1[0-8]))\-(0?[1-9]|1[012])\-(0?[1-9]|[12][\d]|3[01])$/;
    var reJmbg = /^[\d]{13}$/;
    var reEmail = /^[a-z]+\.[a-z]+\.([1-9][0-9]{0,3})\.(1[0-8])\@ict\.edu\.rs$/;
    var reBrTelefona = /^06[\d]\/[\d]{3}\-[\d]{3,4}$/;

    if(imePrezime.value == ""){
        imePrezimeGreska.style.display = "block";
        imePrezimeGreska.innerHTML = "Polje ime i prezime more biti popunjeno!";
        imePrezime.style.border = "1px solid red";
        valdacija = false;
    }
    else if(!reImePrezime.test(imePrezime.value)){
        imePrezimeGreska.style.display = "block";
        imePrezimeGreska.innerHTML = "Pogresan unos!";
        imePrezime.style.border = "1px solid red";
        valdacija = false;
    }
    else{
        imePrezimeGreska.style.display = "none";
        imePrezimeGreska.innerHTML = "";
        imePrezime.style.border = "4px solid green";
        valdacija = true;
    }
    if(datumRodj.value == ""){
        datumRodjGreska.style.display = "block";
        datumRodjGreska.innerHTML = "Polje datum mora biti popunjeno!";
        datumRodj.style.border = "1px solid red";
        valdacija = false;
    }
    else if(!reDatumRodj.test(datumRodj.value)){
        datumRodjGreska.style.display = "block";
        datumRodjGreska.innerHTML = "Pogresan unos datuma!";
        datumRodj.style.border = "1px solid red";
        valdacija = false;
    }
    else{
        datumRodjGreska.style.display = "none";
        datumRodjGreska.innerHTML = "";
        datumRodj.style.border = "4px solid green";
        valdacija = true;
    }
    if(jmbg.value == ""){
        jmbgGreska.style.display = "block";
        jmbgGreska.innerHTML = "Polje jmbg mora biti popunjeno!";
        jmbg.style.border = "1px solid red";
        valdacija = false;
    }
    else if(!reJmbg.test(jmbg.value)){
        jmbgGreska.style.display = "block";
        jmbgGreska.innerHTML = "Pogresan unos jmbg!";
        jmbg.style.border = "1px solid red";
        valdacija = false;
    }
    else{
        jmbgGreska.style.display = "none";
        jmbgGreska.innerHTML = "";
        jmbg.style.border = "4px solid green";
        valdacija = true;
    }
    if(email.value == ""){
        emailGreska.style.display = "block";
        emailGreska.innerHTML = "Polje email mora biti popunjeno!";
        email.style.border = "1px solid red";
        valdacija = false;
    }
    else if(!reEmail.test(email.value)){
        emailGreska.style.display = "block";
        emailGreska.innerHTML = "Pogresan unos, email mora biti u </br> formatu ime.prezime.(broj indeksa).(godina indeksa)@ict.edu.rs";
        email.style.border = "1px solid red";
        valdacija = false;
    }
    else{
        emailGreska.style.display = "none";
        emailGreska.innerHTML = "";
        email.style.border = "4px solid green";
        valdacija = true;
    }
    if(brTelefona.value == ""){
        brTelefonaGreska.style.display = "block";
        brTelefonaGreska.innerHTML = "Polje broj telefona mora biti popunjeno!";
        brTelefona.style.border = "1px solid red";
        valdacija = false;
    }
    else if(!reBrTelefona.test(brTelefona.value)){
        brTelefonaGreska.style.display = "block";
        brTelefonaGreska.innerHTML = "Pogresan unos telefona!";
        brTelefona.style.border = "1px solid red";
        valdacija = false;
    }
    else{
        brTelefonaGreska.style.display = "none";
        brTelefonaGreska.innerHTML = "";
        brTelefona.style.border = "4px solid green";
        valdacija = true;
    }
    if(nacinPlacanjaIzbor == 0){
        nacinPlacanjaGreska.style.display = "block";
        nacinPlacanjaGreska.innerHTML = "Izaberite nacin placanja!";
        nacinPlacanja.style.border = "1px solid red";
        valdacija = false;
    }
    else{
        nacinPlacanjaGreska.style.display = "none";
        nacinPlacanjaGreska.innerHTML = "";
        nacinPlacanja.style.border = "4px solid green";
        valdacija = true;
    }
    for(let i = 0; i < chbKursevi.length;i++){
        if(chbKursevi[i].checked){
            izabraniKursevi.push(chbKursevi.value);
        }
    }
    if(izabraniKursevi.length == 0){
        kurseviGreska.style.display = "block";
        kurseviGreska.innerHTML = "Niste izabrali nijedan kurs!";
        valdacija = false;
    }
    else if(izabraniKursevi.length != 0){
        kurseviGreska.style.display = "none";
        kurseviGreska.innerHTML = "";
        valdacija = true;
    }

    if(valdacija){
        alert("")
    }

}
function dinamickiIspisDdlListe(){
    //Definisanje potrebnih promenljivih
    var smerovi, ispis;
    nacinPlacanja = ["Visa", "MasterCard", "Paypal","Skril","Bitcoin"];
    ispis = "<select id='ddlNacinPlacanja'>";
    ispis +="<option value='0'>Izaberite</option>";
    for(var i = 0; i < nacinPlacanja.length; i++){
        ispis += "<option value='" + nacinPlacanja[i] + "'>" + nacinPlacanja[i] + "</option>";
    }
    ispis += "</select>";
    document.getElementById("listaNacinPlacanja").innerHTML = ispis;
}

function dinamickiIspisCbhListe(){
    //Definisanje potrebnih promenljivih
    var kursevi, ispis;
    kursevi = ["Pranzo", "Penne All'Arrabbiata", "Stek", "Pasta All'Amatriciana" , "Pasta Alla Carbonara"];
    ispis = "";
    for(var i = 0; i < kursevi.length; i++){
        ispis += "<input type='checkbox' name='chbKursevi' value='" + kursevi[i] + "'> " + kursevi[i] + "<br/>";
    }
    document.getElementById("listaCbhKursevi").innerHTML = ispis;
}
/* Open the sidenav */
function openNav() {
    document.getElementById("mySidenav").style.width = "100%";
    document.getElementById("header").style.display = "none";
}
/* Close/hide the sidenav */
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("header").style.display = "block";
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