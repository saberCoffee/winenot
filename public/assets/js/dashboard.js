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

        $('.tab').css('display', 'block');
        $('.tab').click(function(event) {
            var actuel = event.target;
            if (!/li/i.test(actuel.nodeName) || actuel.className.indexOf('active') > -1) {
                return;
            }
            $(actuel).addClass('active').siblings().removeClass('active');
            setDisplay();
        });
        function setDisplay() {
            var modeAffichage;
            $('.tab li').each(function(rang) {
                modeAffichageOff = $(this).hasClass('active') ? '' : 'none';
                $('.addProduct, .addUser, .addProducer, .view-profile').eq(rang).css('display', modeAffichageOff);
                modeAffichageOn = $(this).hasClass('active') ? '' : 'block';
                $('.stock, .member-list, .edit-profile').eq(rang).css('display', modeAffichageOn);
            });
        }
    }
    //-- End : Système d'onglets --//

    //-- Start : Système d'onglets --//
    /*
        Fonctionnement :
        D'abord, créer une liste <ul> dont la classe est "tabs"
        Ensuite, y inclure X éléments de liste <li> dont l'id est "cible" : ce sont les onglets
        Ensuite, créer autant de divs qu'il y a d'onglets et leur donner l'id "panel-cible" : ce sont les panneaux
        Pour finir, penser à mettre une classe "active" à l'onglet et au panneau qu'il faut afficher par défaut

        Exemple :
        <ul class="tabs">
            <li id="viewprofile" class="active">Consulter mon profil</li>
            <li id="editprofile">Modifier mon profil</li>
        </ul>

        <section id="panel-viewprofile" class="active">
            Contenu
        </section>

        <section id="panel-editprofile">
            Contenu
        </section>
    */
    function tabsSystem() {
        $('.tabs li').on('click', function(event) {
            if ($(this).attr('class') != 'active') {
                $(this).addClass('active').siblings().removeClass('active');

                var target = $(this).attr('id');
                
                $('section.'+target).toggle();
                $('section.'+target).siblings('section').toggle();
            }
        });
    }
    //-- End : Système d'onglets --//

    function initJS() {
        $('body').addClass('jsActive');

		popupMyAccount();
        tabsSystem();
	}

	initJS();
});
