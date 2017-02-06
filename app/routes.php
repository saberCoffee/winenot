<?php

	$w_routes = array(

		/* Pages générales */
		['GET', '/', 'General#home', 'home'], // Index.php

        ['GET', '/account', 'General#account', 'account'], // Page pour les champs de connexion et d'inscription
		['POST', '/login', 'General#login', 'login'], // Route vers le traitement de connexion
        ['POST', '/register', 'General#register', 'register'], // Route ver le traitement d'inscription

		['GET', '/mag', 'General#mag', 'mag'], // Page qui affiche des articles
		['GET', '/mag/edit', 'General#mag_edit', 'mag_edit'], // Page qui affiche des articles --> Accès disponible lorsqu'on est admin

		['GET', '/about', 'General#about', 'about'], // Page d'a propos
		['GET|POST', '/contact', 'General#contact', 'contact'], // Page du contact le site web
		['GET', '/sitemap', 'General#sitemap', 'sitemap'], // Page du Plan du site
		['GET', '/legal_notice', 'General#legal_notice', 'legal_notice'], // Page de la mention légale

		/* Pages Dashboard */
		['GET', '/dashboard', 'Dashboard#dashboard', 'dashboard'], // Accueil de dashboard lorsqu'un utilisateur est loggué
		['GET', '/dashboard/inbox', 'Dashboard#inbox', 'inbox'], // Liste des fils des communications entre un utilisateur et un autre
		['GET', '/dashboard/inbox/[a:id]', 'Dashboard#inbox_thread', 'inbox_thread'], // Détails d'un fil de communication
		['GET', '/dashboard/wishlist', 'Dashboard#wishlist', 'wishlist'], // Page des favoris que l'utilisateur ont sauvegardé
		['GET', '/dashboard/wishlist/[a:id]', 'Dashboard#wishlist_thread', 'wishlist_thread'], // detail d'un favori
		['GET', '/dashboard/newWineMaker', 'Dashboard#newWineMaker', 'newWineMaker'], // Création d'un nouveau producteur

		/* Pages des profils des utilisateurs */
		['GET', '/profile/[a:id]', 'Profile#profile_view', 'profile_view'], // Consulter un profil
		['GET', '/profile/config', 'Profile#profile_config', 'profile_config'], // Page des coordonnées de l'utilisateur



	);
