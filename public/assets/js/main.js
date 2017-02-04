// FONCTION CAROUSEL
$(document).ready(function()
 {
    $('#Carousel').carousel({
        interval: 5000
    })

    /*
        Script pour une transition "smooth" vers les ancres
    */
    $(".anchor").click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');

            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top
                }, 400);

                return false;
            }
        }
    });

    /*
        Script pour faire apparaître le goto-top du menu aside lorsqu'on descend
    */
    $("#goto-top").hide(); // On cache le lien goto

    var wineMonth = $("#WineMonth").offset().top - 50;
    $(window).scroll(function() {
        if($(window).scrollTop() > wineMonth) { // Une fois qu'on dépasse la catégorie "Vins du mois"...
            $("#goto-top").fadeIn(); // ... On affiche le lien
        } else { // Une fois qu'on repasse au-dessus de la catégorie, on le cache à nouveau
            $("#goto-top").fadeOut();
        }
    });
});
