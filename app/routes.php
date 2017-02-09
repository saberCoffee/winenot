<?php

	$w_routes = array(


		//-- Start : Pages générales --//
		['GET', '/', 'General#home', 'home'], // Index.php

        ['GET', '/account', 'General#account', 'account'], // Page pour les champs de connexion et d'inscription
		['POST', '/login', 'General#login', 'login'], // Route vers le traitement de connexion
		['GET', '/logout', 'General#logout', 'logout'], // Route vers le traitement de déconnexion
        ['POST', '/register', 'General#register', 'register'], // Route ver le traitement d'inscription

		['GET|POST', '/latlng', 'General#latlng', 'latlng'], // Route pour donner des coordonnées latitude et longitude pour afficher les producteurs sur google map

		['GET', '/mag', 'General#mag', 'mag'], // Page qui affiche des articles
		['GET', '/mag/article', 'General#article', 'article'], // Page qui affiche des articles --> Accès disponible lorsqu'on est admin
		['GET', '/mag/article/edit', 'General#article_edit', 'article_edit'], // Page qui affiche des articles --> Accès disponible lorsqu'on est admin
		['GET', '/mag/article/add', 'General#article_add', 'article_add'], // Page qui affiche des articles --> Accès disponible lorsqu'on est admin

		['GET', '/about', 'General#about', 'about'], // Page d'a propos
		['GET|POST', '/contact', 'General#contact', 'contact'], // Page du contact le site web
		['GET', '/sitemap', 'General#sitemap', 'sitemap'], // Page du Plan du site
		['GET', '/legal_notice', 'General#legal_notice', 'legal_notice'], // Page de la mention légale
		//-- End : Pages générales --//

		//-- Start : Pages Dashboard --//
		['GET', '/dashboard', 'Dashboard#dashboard', 'dashboard'], // Accueil de dashboard lorsqu'un utilisateur est loggué
		['GET', '/dashboard/wishlist', 'Dashboard#wishlist', 'wishlist'], // Page des favoris que l'utilisateur ont sauvegardé
		['GET', '/dashboard/wishlist/[a:id]', 'Dashboard#wishlist_thread', 'wishlist_thread'], // detail d'un favori


		/* Trouver un produit */
		['GET', '/dashboard/products', 'Dashboard#products', 'products'],

		/* Trouver un producteur */
		['GET', '/dashboard/winemakers', 'Dashboard#winemakers', 'winemakers'],

		/* Inbox */
		['GET', '/dashboard/inbox', 'Dashboard#inbox', 'inbox'], // Liste des fils des communications entre un utilisateur et un autre
		['GET', '/dashboard/inbox/[a:id]', 'Dashboard#inbox_thread', 'inbox_thread'], // Détails d'un fil de communication
		['POST', '/dashboard/inbox/[a:id]', 'Dashboard#inbox_posting', 'inbox_posting'], // Envoyer un nouveau message

		/* Gestion des produits par producteur */
		['GET|POST', '/dashboard/newWineMaker', 'Dashboard#newWineMaker', 'newWineMaker'], // Création d'un nouveau producteur
		['GET|POST', '/dashboard/cave', 'Dashboard#cave', 'cave'], // Affichage & gestion des produits d'un producteur
		['GET|POST', '/dashboard/cave/edit/[a:id]', 'Dashboard#cave_edit', 'cave_edit'], // Affichage & gestion des produits d'un producteur

		/* Gestion des membres & producteurs pour Admin */
		['GET', '/dashboard/admin/members', 'Admin#members', 'admin_members'], // Liste des producteurs et gestions de ces producteurs par admin
		['POST', '/dashboard/admin/members/add', 'Admin#addMember', 'admin_add_member'], // Ajouter un membre par admin
		['GET|POST', '/dashboard/admin/members/add/[a:id]', 'Admin#editMember', 'admin_edit_member'], // Liste des producteurs et gestions de ces producteurs par admin

		['GET', '/dashboard/admin/winemakers', 'Admin#winemakers', 'admin_winemakers'], // Liste des producteurs et gestions de ces producteurs par admin
		['POST', '/dashboard/admin/winemakers/add/', 'Admin#addWinemaker', 'admin_add_winemaker'], // Liste des producteurs et gestions de ces producteurs par admin
		['GET|POST', '/dashboard/admin/winemakers/edit/[a:id]', 'Admin#editWinemaker', 'admin_edit_winemaker'], // Liste des producteurs et gestions de ces producteurs par admin

		/* des profils des utilisateurs */
		['GET', '/dashboard/profile/[a:id]', 'Dashboard#profile', 'profile'], // Consulter un profil
		['GET|POST', '/dashboard/profile/config/[a:id]', 'Dashboard#profileConfig', 'profile_config'], // Page des coordonnées de l'utilisateur
		//-- End : Pages Dashboard --//



	);
