<?php $this->layout('layout', ['title' => 'Accueil']) ?>

<?php $this->start('main_content') ?>

<a href="#top" class="goto hidden-xs anchor" id="goto-top"><span class="glyphicon glyphicon-circle-arrow-up" aria-hidden="true"></span></a>

<div class="row">
	<section id="AboutUs">
			<h2 id="AboutUsTitle">À propos</h2>
			<div class="content_aboutus">
			<p>
				Bienvenue sur WineNot, la première plateforme entièrement gratuite qui met en relation <strong>producteurs</strong> et <strong>consommateurs</strong> de vin.
			</p>
			<p>
				Tous les mois, notre équipe met en avant les meilleurs produits et producteurs de WineNot. Amateur de vin, professionnel du milieu ou simple curieux, n'attendez-plus : rejoignez-nous pour découvrir ce que nous avons à offrir !
			</p>
			<p>
				<a href="<?= $this->url('account') ;?>" class="link-register">S'inscrire</a>
			</p>
			</div>
	</section>
</div>

<div class="row">
	<section id="WineMonth">
		<h2 id="WineMonthTitle">Vins du mois</h2>

		<div class="container-fluid">
			<div class="row">
				<?php foreach ($products as $product): ?>
			        <div class="col-md-4">
			            <div class="flip-container">
			                <div class="flipper">
			                    <div class="front">
			                        <img width="200" src="<?= $this->assetUrl('content/photos/products/' . $product['photo']) ?>" alt="<?= $product['name'] ?>">
			                        <div class="nameWineBottle">
			                            <p><?= $product['name'] ?><br />Vin <?= $product['couleur'] ?></p>
			                        </div>
			                    </div>

			                    <a href="<?= $this->url('dashboard_product', ['name' => $product['clean_name'], 'id' => $product['id']]) ?>"><div class="back">
			                        <p>
			                            <?= $product['description'] ?>
			                            <div class="nameWineBottle">
			                                <p>
			                                    Produit par <strong><?= $product['winemaker']['firstname'] . ' ' . $product['winemaker']['lastname'] ?></strong>
			                                    <br />
			                                    <?= $product['price'] ?>€
			                                </p>
			                            </div>
			                        </p>
			                    </div></a>
			                </div>
			            </div>
			        </div>
			    <?php endforeach; ?>
			</div><!-- Fin de la row bootstrap -->
		</div><!-- Fin du container bootstrap -->

	</section>
</div>


<div class="row">
<section id="GoogleMap">
	<div id="WinmakerSearch">
        <h2>Où trouver nos <?= $winemakers_count ?> producteurs</h2>
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
	<div id="infoProd"></div>

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
		var image2 = 'assets/img/map-marker3.png';

		var mapOptions = {
			zoom: 5,
			center: new google.maps.LatLng(47.081012, 2.398781999999983),
			styles: styleArray,
			scrollwheel: false,
			// types: ['(cities)'],
			// componentRestrictions: {country: "fr"},
            // types: ["(regions)"]
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
			url: "http://winenot.alwaysdata.net/latlng",
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

						 	infowindow.setContent('<div><strong>' + this.titre + '</strong><br>' + this.position + '</div>');

						    infowindow.open(map, this);
						    // $('#hook').parent().parent().parent().parent().css({ "background-color": "yellow", "border-radius": "10px" });

						  });
					 markers.push(marker);

				}

				  // Ajouter une marqueur clusterer pour gérer les marqueurs.
				  var markerCluster = new MarkerClusterer(map, markers, mcOption);

			}
		});

		// Autocompletion possible avec aussi le bouton de recherche
		 var input = document.getElementById('pac-input');
		 google.maps.event.addDomListener(input, 'keydown', function(e) {
		    if (e.keyCode == 13) {
		        e.preventDefault();
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
			    icon: image2,
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

<section class="row" id="ProductMonth">
	<h2 id="ProductMonthTitle">Producteurs du mois</h2>

	<div class="container">
	    <div id="main_area">
	        <!-- Slider -->
	        <div class="row">
	            <div class="col-sm-12" id="slider">
	                <!-- Top part of the slider -->
	                <div class="row">
	                    <div class="col-sm-4" id="carousel-bounding-box" >
	                        <div class="carousel slide" id="myCarousel" >
	                            <!-- Carousel items -->
	                            <div class="carousel-inner" >
	                                <div class="active item" data-slide-number="0" >
	                                <img src="assets/img/pierre.jpg" width="100%"></div>

	                                <div class="item" data-slide-number="1">
	                                <img src="assets/img/moi.jpg" width="100%"></div>

	                                <div class="item" data-slide-number="2">
	                                <img src="assets/img/thomas.jpg" width="100%"></div>

	                                <div class="item" data-slide-number="3">
	                                <img src="assets/img/romain.jpg" width="100%"></div>

	                                <div class="item" data-slide-number="4">
	                                <img src="assets/img/hwaseon.jpg" width="100%"></div>

	                                <div class="item" data-slide-number="5">
	                                <img src="assets/img/yann.jpg" width="100%"></div>

	                                <div class="item" data-slide-number="3">
	                                <img src="assets/img/romain.jpg" width="100%"></div>

	                                <div class="item" data-slide-number="2">
	                                <img src="assets/img/thomas.jpg" width="100%"></div>

	                            </div><!-- Carousel nav -->
	                            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
	                                <span class="glyphicon glyphicon-chevron-left"></span>
	                            </a>
	                            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
	                                <span class="glyphicon glyphicon-chevron-right"></span>
	                            </a>
	                            </div>
	                    </div>

	                    <div class="col-sm-8 " id="carousel-text"></div>

	                    <div id="slide-content" style="display: none;">
	                        <div id="slide-content-0">
	                            <h3><strong>Pierre Vaneste</strong></h3>
	                            <h4>Producteur à Convention et sur le dancefloor</h4>
	                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
	                            <blockquote> <em>"Il court, il court, le furet, Le furet du bois joli..."</em>
	                           <small>Pierre Vaneste</small></blockquote></p>

	                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
	                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	                            quis nostrud exercita</p>
	                            <p class="sub-text">October 24 2014 - </p>
	                        </div>

	                        <div id="slide-content-1">
	                            <h3><strong>Héramban Minatchy</strong></h3>
	                            <h4>Producteur à La Réunion</h4>
	                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

	                            <blockquote> <em>"Un matin on défend toute la galaxie et à cinq heures, on se retrouve à siroter du darjeeling avec marie-Antoinette et sa petite soeur..."</em>
	                           <small>Héramban Minatchy</small></blockquote></p>

	                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
	                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	                            quis nostrud exercita</p>
	                            <p class="sub-text">October 24 2014 - </p>
	                        </div>

	                        <div id="slide-content-2">
	                            <h3><strong>Thomas Mion</strong></h3>
	                            <h4>Producteur à Vincennes</h4>
	                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

	                            <blockquote> <em>"Votre manque de foi me consterne..."</em>
	                           <small>Thomas Mion</small></blockquote></p>

	                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
	                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	                            quis nostrud exercita</p>

	                            <p class="sub-text">October 24 2014 - </p>
	                        </div>

	                        <div id="slide-content-3">
	                            <h3><strong>Romain Hamel</strong></h3>
	                            <h4>Producteur chez lui</h4>
	                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

	                            <blockquote> <em>"Dans mille ans, y aura plus de mecs ni de nanas. Que des branleurs. Je trouve ça génial..."</em>
	                           <small>Romain Hamel</small></blockquote></p>

	                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
	                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	                            quis nostrud exercita</p>
	                            <p class="sub-text">October 24 2014 - </p>
	                        </div>

	                        <div id="slide-content-4">
	                            <h3><strong>Hwa Seon Lecouey</strong></h3>
	                            <h4>Producteur à Séoul</h4>
	                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

	                            <blockquote> <em>"Vous êtes venu dans cette casserole ? Vous êtes plus brave que je ne pensais..."</em>
	                           <small>Hwa Seon Lecouey</small></blockquote></p>

	                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
	                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	                            quis nostrud exercita</p>
	                            <p class="sub-text">October 24 2014 -</p>
	                        </div>

	                        <div id="slide-content-5">
	                            <h3><strong>Yann Le Merrer</strong></h3>
	                            <h4>Producteur à la Retraite</h4>
	                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

	                            <blockquote> <em>"Ecoutez Thérèse. Je n'aime pas dire du mal mais effectivement elle est gentille..."</em>
	                           <small>Yann Le Merrer</small></blockquote></p>

	                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
	                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	                            quis nostrud exercita</p>
	                            <p class="sub-text">October 24 2014 - </p>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div><!--/Slider-->

	        <div class="row hidden-xs" id="slider-thumbs">

	            <!-- Bottom switcher of slider -->
	            <ul class="grayscale" class="hide-bullets">
	                <li class="col-sm-2">
	                    <a class="thumbnail" id="carousel-selector-0"><img src="assets/img/pierre.jpg" ></a>
	                </li>

	                <li class="col-sm-2">
	                    <a class="thumbnail" id="carousel-selector-1"><img src="assets/img/moi.jpg" ></a>
	                </li>

	                <li class="col-sm-2">
	                    <a class="thumbnail" id="carousel-selector-2"><img src="assets/img/thomas.jpg" ></a>
	                </li>

	                <li class="col-sm-2">
	                    <a class="thumbnail" id="carousel-selector-3"><img src="assets/img/romain.jpg" ></a>
	                </li>

	                <li class="col-sm-2">
	                    <a class="thumbnail" id="carousel-selector-4"><img src="assets/img/hwaseon.jpg" ></a>
	                </li>

	                <li class="col-sm-2">
	                    <a class="thumbnail" id="carousel-selector-5"><img src="assets/img/yann.jpg" ></a>
	                </li>

	                <li class="col-sm-2">
	                    <a class="thumbnail" id="carousel-selector-2"><img src="assets/img/thomas.jpg" ></a>
	                </li>

	                <li class="col-sm-2">
	                    <a class="thumbnail" id="carousel-selector-3"><img src="assets/img/romain.jpg" ></a>
	                </li>
	            </ul>
	        </div>
	    </div>
	</div>
</section>

<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
    <script src="<?= $this->assetUrl('js/main.js') ?>" type="text/javascript"></script>
<?php $this->stop('js') ?>
