$(function() {
    // Cette fonction boucle sur chaque champ d'un formulaire et vérifie s'il est requis. Si oui, et s'il est vide, l'utilisateur recevra un message d'erreur et le champ oublié sera mis en évidence.
    function checkIfFormIsValid(form) {
        var isValid = true;

        form.find('div.form-group').children('input, textarea, select').each(function() {
            var minCharacters = $(this).data('min');
            var maxCharacters = $(this).data('max');

            if ($(this).attr('required') == 'required') {
                console.log($(this).val());
                if ($(this).val() === '') { // ... Si le champ est vide, on ajoute une class erreur au div parent et on affiche le message d'erreur adéquat...
                    var errorMessage = 'Vous devez remplir ce champ.';
                    hasError = true;
                }  else if ($(this).val().length < minCharacters) { // ... Sinon, s'il ne rempli pas la condition "nombre de caractères minimum"...
                    var errorMessage = 'Vous devez utiliser au moins <strong>' + minCharacters + '</strong> caractères.';
                    hasError = true;
                }  else if ($(this).val().length > maxCharacters) { // ... Sinon, s'il ne rempli pas la condition "nombre de caractères maximum"...
                    var errorMessage = 'Vous ne pouvez pas utiliser plus de <strong>' + maxCharacters + '</strong> caractères.';
                    hasError = true;
                } else { // ... Sinon, s'il est rempli correctement
                    hasError = false;
                }

                errorMessage = 'JS'+errorMessage;

                if (hasError) {
                    console.log($(this).parent('div.form-group'));
                    isValid = false;

                    $(this).parent('div.form-group').addClass('has-error');
                    $(this).next('.help-block').html(errorMessage).show();
                } else {
                    $(this).parent('div.form-group').removeClass('has-error');
                    $(this).next('.help-block').hide();
                }
            }
        });

        return isValid;
    }

    $('form').submit(function(event) {
        // Pour chaque formulaire quel qu'il soit, on vérifie si les champs requis ont bien été remplis. Ce n'est qu'après ça qu'on fera les vérifications les plus poussées, propres à chaque forumaire
        // Exemples : limite de caractères, formatage, etc...
        var isValid = checkIfFormIsValid($(this));

        // Comme chaque formulaire dispose de ses propres contraintes de validation, chacun aura son propre bout de code.
        // On attribue à chaque formulaire un id unique (ex. login-form, register-form, etc) grâce auquel on pourra l'identifier.

        //-- Start : Formulaire d'inscription --
        if ($(this).attr('id') == 'register-form') {
            // On vérifie que le mot de passe et le mot de passe de vérification concordent bien
            if ($('input[name="password"]').val() != $('input[name="password_verif"]').val()) {
                var errorMessage = 'Les mots de passe ne sont pas identiques.'

                isValid = false;

                // On met en évidence les erreurs avec la classe "has-error"
                $('input[name="password"]').parent('div.form-group').addClass('has-error');
                $('input[name="password_verif"]').parent('div.form-group').addClass('has-error');

                // On affiche le message au-dessous de l'input "password"
                $('input[name="password"]').next('.help-block').html(errorMessage).show();

                // Et enfin, on vide les deux input
                $('input[name="password"]').val('');
                $('input[name="password_verif"]').val('');
            }
        }
        //-- End : Formulaire d'inscription --

        // Si le formulaire est invalide, alors on en empêche l'envoi
        if (!isValid) {
            event.preventDefault();
        }
    });
});
