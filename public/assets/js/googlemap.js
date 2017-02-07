 	function initMap() {

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
			},  {
				"featureType": "road.highway",
				elementType: "labels",
				stylers:[
					{visibility: "off"
						}
				]
			}
		];

		var image = 'assets/img/grapes.png';

		var mapOptions = {
			zoom: 6,
			center: new google.maps.LatLng(47.081012, 2.398781999999983),
			styles: styleArray,
			scrollwheel: false,
			types: ['(cities)'],
			componentRestrictions: {country: "fr"},
            types: ["(regions)"]
		};

		var map = new google.maps.Map(document.getElementById('map'),
		mapOptions);

		var input = /** @type {!HTMLInputElement} */(
		document.getElementById('pac-input'));

		var autocomplete = new google.maps.places.Autocomplete(input, mapOptions);
		autocomplete.bindTo('bounds', map);

		var infowindow = new google.maps.InfoWindow();

		/* Requete Ajax qui récupère des données de latitude et longitude en json pour faire afficher des producteurs en marqueur */
		$.ajax({
			url: "http://localhost/winenot/public/latlng",
			type: "GET",
			dataType: 'json', // selon le retour attendu
			success: function (response) {

				for(var i in response) {

					 var marker = new google.maps.Marker({
						 	position : new google.maps.LatLng(response[i].lat, response[i].lng),
						    map: map,
						  	icon: image
					 });				
				}
			}
		});


		autocomplete.addListener('place_changed', function() {
			infowindow.close();
			marker.setVisible(false);
			var place = autocomplete.getPlace();
			if (!place.geometry) {
				window.alert("Autocomplete's returned place contains no geometry");
				return;
			}

			// If the place has a geometry, then present it on a map.
			if (place.geometry.viewport) {
				map.fitBounds(place.geometry.viewport);
			} else {
				map.setCenter(place.geometry.location);
				map.setZoom(17);  // Why 17? Because it looks good.
			}
			marker.setIcon(/** @type {google.maps.Icon} */({
				// url: place.icon,
				size: new google.maps.Size(71, 71),
				origin: new google.maps.Point(0, 0),
				anchor: new google.maps.Point(17, 34),
				scaledSize: new google.maps.Size(35, 35),
			}));
			marker.setPosition(place.geometry.location);
			marker.setVisible(true);

			var address = '';
			if (place.address_components) {
				address = [
				(place.address_components[0] && place.address_components[0].short_name || ''),
				(place.address_components[1] && place.address_components[1].short_name || ''),
				(place.address_components[2] && place.address_components[2].short_name || '')
				].join(' ');
			}

			infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
			infowindow.open(map, marker);
		});
	}


// 	function geocodeAddress(geocoder, resultsMap) {
// 		var image = 'assets/img/grapes.png';

// 		var address = 'paris';

// 		geocoder.geocode({'address': address}, function (results, status){
// 			if (status == google.maps.GeocoderStatus.OK) {
// 			resultsMap.setCenter(results[0].geometry.location);
// 			var marker = new google.laps.Marker({
// 				map: resultsMap,
// 				position: results[0].geometry.location
// 				});
// 				} else {
// 					 alert("Geocode was not successful for the following reason: " + status);
// 				}
// 		})

// 	}
