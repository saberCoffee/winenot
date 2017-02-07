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
                $('.addProduct').eq(rang).css('display', modeAffichageOff);
                modeAffichageOn = $(this).hasClass('active') ? '' : 'block';
                $('.stock').eq(rang).css('display', modeAffichageOn);
            });
        }
    }

    //-- End : Système d'onglets --//

    function initJS() {
		popupMyAccount();
        tabsSystem();
	}

	initJS();
    //
});
