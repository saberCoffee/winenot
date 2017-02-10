
<div class="row">
<section id="GoogleMap">
	<div id="WinmakerSearch">
        <h2>Où trouver nos 500 producteurs</h2>
        <p>Trouver un producteur près de chez vous</p>
        <form>
            <div class="input-group stylish-input-group">
                <input id="pac-input" type="text" class="form-control"  placeholder="Où résidez-vous ?" />
                <span class="input-group-addon">
                    <button type="submit">
                        <span class="glyphicon glyphicon-search"></span> Rechercher
                    </button>
                </span>
            </div>
        </form>
    </div>

    <!-- DIV pour google map -->
	<div id="map"></div>


	<script type="text/javascript">

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

		var image = 'assets/img/grape2.png';

		var mapOptions = {
			zoom: 5,
			center: new google.maps.LatLng(47.081012, 2.398781999999983),
			styles: styleArray,
			scrollwheel: false,
			types: ['(cities)'],
			componentRestrictions: {country: "fr"},
            types: ["(regions)"]
		};

		var map = new google.maps.Map(document.getElementById('map'),
		mapOptions);

		var markers = [];
		
		var input = /** @type {!HTMLInputElement} */(
		document.getElementById('pac-input'));

		var autocomplete = new google.maps.places.Autocomplete(input, mapOptions);
		autocomplete.bindTo('bounds', map);

		var infowindow = new google.maps.InfoWindow();

		/* Style des marqueurs cluster */
		
		  var clusterStyles = [{
		    url:'assets/img/grape3.png',
		    height:64,
		    width:64,
		    textColor: 'white',
			textSize: 20
		  }
		  ]
		  
		  var mcOption = {
		    styles: clusterStyles
		  }
		
			
		/* Requete Ajax qui récupère des données de latitude et longitude en json pour faire afficher des producteurs en marqueur */
		
			$.ajax ({
			url: "http://localhost/winenot/public/latlng",
			type: "GET",
			dataType: 'json', // selon le retour attendu
			success: function (response) {
			  
				// Appel aux données latitude et longitude
				for(var i in response) {
					  
					var latLng = new google.maps.LatLng(response[i].lat, response[i].lng);

					var marker = new google.maps.Marker({
						 	position : latLng,
						    map: map,
						  	icon: image,
							titre: 'notre producteur: '
					 });

					 marker.addListener('click', function() {
							
						 	infowindow.setContent('<div><strong>' + this.titre + '</strong><br>' + '<div>' + this.position + '</div>');
						    infowindow.open(map, this);
						   
						  });	
					 markers.push(marker);

				 
				}

				  
				  // Ajouter une marqueur clusterer pour gérer les marqueurs.
				  var markerCluster = new MarkerClusterer(map, markers, mcOption);

			}
		});	

		// Réponsive du plan
		google.maps.event.addDomListener(window, "resize", function() {
				   var center = map.getCenter();
				   google.maps.event.trigger(map, "resize");
				   map.setCenter(center); 
				});
			

		autocomplete.addListener('place_changed', function() {
			infowindow.close();
			
			var marker = new google.maps.Marker({
			    map: map,
			    icon: image,
			    anchorPoint: new google.maps.Point(0, -29)
			  });
			  
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


	 </script>
	 	<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
	 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-S88NjyaazTh3Dmyfht4fsAKRli5v5gI&libraries=places&callback=initMap" async defer></script>


</section>
</div>
