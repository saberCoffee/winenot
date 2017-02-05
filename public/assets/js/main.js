$(function() {
	//-- Start : Transitions via les ancres --//
	function anchors() {
		// Ce premier script assure une transition fluide lors d'un clic sur une ancre (plutôt qu'une transition instantanée)
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

	    // Ce second script n'affichera le lien "go to top" qu'après avoir scrollé jusqu'à un certain niveau
	    var wineMonth = $("#WineMonth").offset().top - 50;
	    $(window).scroll(function() {
	        if($(window).scrollTop() > wineMonth) { // Une fois qu'on dépasse la catégorie "Vins du mois"...
	            $("#goto-top").fadeIn(); // ... On affiche le lien
	        } else { // Une fois qu'on repasse au-dessus de la catégorie, on le cache à nouveau
	            $("#goto-top").fadeOut();
	        }
	    });
	}
	//-- End : Transitions via les ancres  --//

	//-- Start : Carousel (Homepage) --//
	function carousel() {
		$('#Carousel').carousel({
			interval: 5000
		});
	}
	//-- End : Carousel (Homepage) --//

    function initJS() {
		anchors();
		// carousel();
	}

	initJS();
});
