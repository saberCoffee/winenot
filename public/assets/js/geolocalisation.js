function initGeolocalisation() {
	var geocoder = new google.maps.Geocoder();

    $('#cp').on('focus', function() {
		$('.city-input').fadeIn(); // La première fois, on affiche le champ "Ville"
    });

	// A chaque fois qu'on tape un caractère dans le champ "Code Postal"...
	$('#cp').on('propertychange change click keyup input paste', function() {
		if ($(this).val().length == 5) { // Puis, dès qu'il y a bien 5 caractères dans le code postal, on appelle la fonction de géolocalisation
			geocodeAddress(geocoder);
		}
	});
}

function geocodeAddress(geocoder) {
	var address = $('#cp').val();

	geocoder.geocode({'address': address}, function(results, status) {
		if (status === google.maps.GeocoderStatus.OK) {
			var country = results[0].address_components[4].long_name;

			if (country == 'France') {
				var city = results[0].address_components[1].long_name;

				$('.city-input').children('input').val(city);
			} else {
				$('.city-input').children('input').val('Ville introuvable');
			}
		} else {
			$('.city-input').children('input').val('Ville introuvable');
		}
	});
}
