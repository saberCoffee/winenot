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
	<link rel="stylesheet" href="<?= $this->assetUrl('css/dashboard/style.css') ?>" />
</head>

<body class="dashboard">

    <div class="container-fluid" id="top">
        <div class="row">
            <header>
                <nav>
                    <ul>
                        <li><a href="#">Messages</a></li>
                        <li><a href="#">F.A.Q</a></li>
                        <li><a href="#"><?= $_SESSION['user']['firstname'] . ' ' . $_SESSION['user']['lastname'] ?></a></li>
                    </ul>
                </nav>
            </header>
        </div>

        <div class="row">
            <div class="col-lg-2 r-p r-m col-aside">
                <aside>
                    <nav>
                        <ul>
                            <!--<li><a href="">
								Logo + Lien homepage</a>
							</li>-->
                            <li <?php echo ($w_current_route == 'dashboard') ? 'class="current"' : '' ?>>
								<a href="<?= $this->url('dashboard') ?>">Accueil</a>
							</li>
                            <li>
								<a href="<?= $this->url('mag') ?>">Le mag</a>
							</li>
                            <li>
								<a href="#"> Trouver un producteur</a>
							</li>
                            <li <?php echo ($w_current_route == 'wishlist') ? 'class="current"' : '' ?>>
								<a href="<?= $this->url('wishlist') ?>">Favoris</a>
							</li>
                            <li>
								<a href="#">Reviews</a>
							</li>

                            <li class="winemaker-link" <?php echo ($w_current_route == 'newWineMaker') ? 'class="current"' : '' ?>>
								<a href="<?= $this->url('newWineMaker') ?>">Devenir producteur</a>
							</li>
                            <li class="winemaker-link">
								<a href="#">Mon profil</a></li>
                            <li class="winemaker-link">
								<a href="#">Mes produits</a>
							</li>

                            <li class="admin-link">
								<a href="#">Gérer le mag</a></li>
                            <li class="admin-link">
								<a href="#">Gérer les membres</a>
							</li>
                            <li class="admin-link">
								<a href="#">Gérer les producteurs</a>
							</li>
                        </ul>
                    </nav>
                </aside>
            </div>

            <div class="col-lg-10 r-p r-m">
                <main>
                    <?= $this->section('main_content') ?>
                </main>
            </div>

		</div><!-- Fin de la row bootstrap -->
	</div><!-- Fin du container bootstrap -->

	<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="<?= $this->assetUrl('js/bootstrap.min.js') ?>"></script>
	<?= $this->section('js') ?>
</body>
</html>
