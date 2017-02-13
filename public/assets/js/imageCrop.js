$(function() {
   var rootPath = 'http://winenot.alwaysdata.net/'; // Coordonnées du site en ligne
    //var rootPath = 'http://localhost/projets/WineNot/prod/public/'; // Coordonnées du site en local Thomas
    // var rootPath = 'http://localhost/winenot/public/'; // Coordonnées du site en local Romain

    var debug    = false; // à changer en true pour activer les console.log utiles

    /**
     * Cette fonction permet de déterminer les coordnnées de l'image après le crop :
     * l'utilisateur choisit la partie de l'image qui l'intéresse, et on récupère ensuite en PHP ces informations pour reconstruire l'image à partir de ces informations...
     */
    function updateCoords(c) {
        $('#x').val(c.x); // La position de l'image par rapport à l'axe X
        $('#y').val(c.y); // La position de l'image par rapport à l'axe Y
        $('#w').val(c.w); // La largeur de l'image apres crop
        $('#h').val(c.h); // La hauteur de l'image apres crop

        var width  = $('#uploaded-photo').width(); // La largeur de l'image resizée et avant crop
        var height = $('#uploaded-photo').height(); // La hauteur de l'image resizée et avant crop

        $('#resizeW').val(width);
        $('#resizeH').val(height);
    };

    /**
     *
     */
    function checkCoords() {
        if (parseInt($('#w').val())) return true;
        alert('Please select a crop region then press submit.');
        return false;
    };

    // Lorqu'on remplit l'input file pour mettre une photo
    $('input#photo').on('change', function(event) {
        $form = $('form')[0]; // On récupère les données du formulaires qu'on en verra par ajax

        if (debug) {
            console.log($form);
        }

        $('#imageCrop-mask').show(); // On affiche un masque dans lequel on mettra une preview de la photo

        $.ajax ({ // A-J-A-X !!!!!!!!!!!!
            url: rootPath + "imagecrop", // Réécrire une URL dynamique
            type: "POST",
            data: new FormData($form),
            processData: false,
            contentType: false,
            success: function (response) {
                $('#imageCrop-mask').children('div').html(response);

                $('#uploaded-photo').Jcrop({
                    onSelect: updateCoords, minSize: [300,300], aspectRatio: 1,
                });
            },
        });

        $('#imageCrop-mask').on('click', 'button', function(event) {
            if ($('#x').val() == '' && $('#y').val() == '' && $('#w').val() == '' && $('#h').val() == '') { // Oups, l'utilisateur a oublié de crop l'image !
                alert('Vous devez découper l\'image !');
            } else { // Félicitations, l'utilisateur a été malin ! Il est 02:28 et il devient difficile de commenter intelligemment !
                $('#imageCrop-mask').fadeOut(); // On peut cacher le masque
            }

            if (debug) {
                console.log('x = ' + $('#x').val());
                console.log('y = ' + $('#y').val());
                console.log('w = ' + $('#w').val());
                console.log('h = ' + $('#h').val());
            }
        });
    });

    $('#imageCrop-mask').on('click', function(event) {
        if (event.target.id === 'imageCrop-mask') {
            $(this).hide();
        }
    });

    $('#imageCrop-mask div').on('click', function(event) {
        e.stopPropagation();
    });
});
