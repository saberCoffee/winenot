$(function() {
    //-- Start : Popup "Mon compte" du dashboard --//
    function popupMyAccount() {
        $('.open-account-popup').on('click', function(event) {
            event.stopPropagation(); // Empêche d'afficher/cacher le popup accidentellement en cliquant sur le body en même temps que le lien
            event.preventDefault();

            $(this).next('.account-popup').toggle('blind');
        });

        $('body').on('click', function() {
            $('.account-popup').hide('blind');
        });
    }
    //-- End : Popup "Mon compte" du dashboard --//

    //-- Start : Système d'onglets --//
    function tabsSystem() {
        // Good luck Romain
    }
    //-- End : Système d'onglets --//

    function initJS() {
		popupMyAccount();
        tabsSystem();
	}

	initJS();
    //
});
