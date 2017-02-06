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

	//-- Start : Carousel de la homepage --//
	function carouselHomepage() {
		$('#myCarousel').carousel({
		    interval: 5000
		});

		$('#carousel-text').html($('#slide-content-0').html());

		//Handles the carousel thumbnails
		$('[id^=carousel-selector-]').click( function(){
		    var id = this.id.substr(this.id.lastIndexOf("-") + 1);
		    var id = parseInt(id);
		    $('#myCarousel').carousel(id);
		});

		// When the carousel slides, auto update the text
		$('#myCarousel').on('slid.bs.carousel', function (e) {
		         var id = $('.item.active').data('slide-number');
		        $('#carousel-text').html($('#slide-content-'+id).html());
		});
	}
	//-- End : Carousel de la homepage --//

    function initJS() {
	 	anchors();
		carouselHomepage();
	}

	initJS();
});
