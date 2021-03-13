window.onload = function() {
    $('#strelica-header').click(function(){

        $('body').animate({
            scrollTop: 0
        }, 1000);
    });


    var i = 1;
    setInterval(function() {
        if(i>2)
            i=1;
        $('#pozadina-slika').css("backgroundImage","url('slike/index/pozadina"+i++ +".jpg')");
    }, 3000);





};
window.onscroll = function() {
    scrollFunction()
};

function scrollFunction() {
    if (document.body.scrollTop > 5 || document.documentElement.scrollTop > 5) {
        document.getElementById("header").style.position = "fixed";
        document.getElementById("header").style.backgroundColor = "rgba(12, 0, 5, 0.4)";
        document.getElementById("header").style.borderBottomRightRadius = "40%";
        document.getElementById("header").style.borderBottomLeftRadius = "40%";
        document.getElementById("header").style.padding = "0%";
        var nizBojaLinkova = document.querySelectorAll(".bojaLinka");
        for (var i = 0; i < nizBojaLinkova.length; i++) {
            nizBojaLinkova[i].style.color = "beige";
        }
    }
}