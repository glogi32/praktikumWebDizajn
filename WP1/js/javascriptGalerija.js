window.onload = function() {
    $('#strelica-header').click(function(){

        $('body').animate({
            scrollTop: 0
        }, 1000);
    });

    dinamickiIspisGalerije();

    50
};
function dinamickiIspisGalerije(){
    var galerijaAmbijent = document.getElementById("galerija-content");
    var ispisElemenata = "";
    var brojac = 1;
    for(var i = 0; i<4 ; i++){
        ispisElemenata += "<div class='kolona'>";
        for(var j = 0;j < 4; j++){
            ispisElemenata += "<div class='galerija-slika'><img src='slike/galerija/galerija-slike-"+ brojac +".jpg' alt='slika ambijent "+ brojac +"'></div>";
            brojac++;
        }
        ispisElemenata += "</div>";

    }
    galerijaAmbijent.innerHTML += ispisElemenata;

    var galerijaHrana = document.getElementById("galerija-content1");
    ispisElemenata = "";
    for(var i = 0; i<4 ; i++){
        ispisElemenata += "<div class='kolona'>";
        for(var j = 0;j < 3; j++){
            ispisElemenata += "<div class='galerija-slika'><img src='slike/galerija/galerija-slike-"+ brojac +".jpg' alt='slika ambijent "+ brojac +"'></div>";
            brojac++;
        }
        ispisElemenata += "</div>";

    }
    galerijaHrana.innerHTML += ispisElemenata;

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
        for (var i = 0; i < nizBojaLinkova.length; i++) {
            nizBojaLinkova[i].style.color = "beige";
        }
    }
}