$(function() {
    //-- Start : Popup "Mon compte" du dashboard --//
    function popupMyAccount() {
        $('.open-account-popup').on('click', function() {
            $(this).next('.account-popup').show();
        });

        $('body').on('click', function() {
            $('.account-popup').toggle();
        });
    }
    //-- End : Popup "Mon compte" du dashboard --//

    function initJS() {
		popupMyAccount();
	}

	initJS();
});
