
$(function() {
	
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
    
    
    /*
		Script pour google map API dans le homepage
     */
    
    function initialize() {

    	  var styleArray = [
    	    {
    	      featureType: 'all',
    	      stylers: [
    	        { saturation: -80 }
    	      ]
    	    },{
    	      featureType: 'road.arterial',
    	      elementType: 'geometry',
    	      stylers: [
    	        { hue: '#00ffee' },
    	        { saturation: 50 }
    	      ]
    	    },{
    	      featureType: 'poi.business',
    	      elementType: 'labels',
    	      stylers: [
    	        { visibility: 'off' }
    	      ]
    	    }
    	  ];

    	  var mapOptions = {
    	    zoom: 6,
    	    center: new google.maps.LatLng(47.081012, 2.398781999999983),
    	    styles: styleArray,
    	    scrollwheel: false
    	  };

    	  var map = new google.maps.Map(document.getElementById('map'),
    	    mapOptions);
    	}

    	google.maps.event.addDomListener(window, 'load', initialize);
    
    /*
      Fin de Script pour google map API 
     */
    	
   
});
