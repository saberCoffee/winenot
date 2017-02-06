<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />

	<title><?= $this->e($title) . ' - ' . $w_site_name ?></title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="<?= $this->assetUrl('css/bootstrap.min.css') ?>" />
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?= $this->assetUrl('fonts/font-awesome-4.7.0/css/font-awesome.min.css')?> "/>
	<!-- Propre Style Sheet -->
	<link rel="stylesheet" href="<?= $this->assetUrl('css/style.css') ?>" />
</head>

<body>

	<div class="container-fluid" id="top">

        <header>
            <!--
                Menu de navigation horizontale :
                Messages - F.A.Q - <Prénom/Nom>
            -->
        </header>

        <aside>
            <!--
                Menu de navigation latérale :
                Accueil (du dashboard)
                Le Mag
                ______________________

                Trouver un producteur
                Mes favoris
                Mes reviews
                ______________________

                // Ne s'affiche que si on est pas encore producteur
                Devenir producteur -> Formulaire de création de profil producteur

                // Ne s'affiche que si on est producteur
                Mon profil -> Mettre à jour son profil de producuteur
                Mes produits -> Consulter ses produits, en ajouter, en supprimer
                ______________________

                // Ne s'affiche que si on est admin
                Gérer le mag
                Gérer les membres
                Gérer les producteurs                
            -->
        </aside>

        <main>
            <?= $this->section('main_content') ?>
        </main>

	</div>

	<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="<?= $this->assetUrl('js/bootstrap.min.js') ?>"></script>
	<?= $this->section('js') ?>
</body>
</html>
