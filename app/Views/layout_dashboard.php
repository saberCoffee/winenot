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

	<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
	<!-- <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script> -->

</head>

<body class="dashboard">

    <div class="container-fluid" id="top">
        <div class="row">
            <header>
                <nav>
                    <ul>
                        <li><a href="<?= $this->url('inbox') ?>"><i class="fa fa-comments" aria-hidden="true"></i> Messages</a></li>
                        <li><a href="#"><i class="fa fa-question-circle" aria-hidden="true"></i> F.A.Q</a></li>
                        <li><a href="#" class="open-account-popup"><i class="fa fa-user" aria-hidden="true"></i> <?= $_SESSION['user']['firstname'] . ' ' . $_SESSION['user']['lastname'] ?></a>

							<div class="account-popup">
								<ul>
									<li><a href="#">Mon compte</a></li>
									<li><a href="<?= $this->url('logout') ?>">Se déconnecter</a></li>
								</ul>
							</div>
						</li>
                    </ul>
                </nav>
            </header>
        </div>

        <div class="row">
            <div class="col-lg-2 r-p r-m col-aside">
                <aside>
                    <nav>
                        <ul>
                            <li>
								<a href="<?= $this->url('home') ?>"><img src="<?= $this->assetUrl('img/dashboard/previous.png'); ?>"> Retour à la homepage</a>
							</li>
                            <li <?php echo ($w_current_route == 'dashboard') ? 'class="current"' : '' ?>>
								<a href="<?= $this->url('dashboard') ?>"><img src="<?= $this->assetUrl('img/dashboard/home-icon-silhouette.png'); ?>">L'accueil</a>
							</li>
                            <li>
								<a href="<?= $this->url('mag') ?>"><img src="<?= $this->assetUrl('img/dashboard/icon.png'); ?>">Le mag</a>
							</li>
                            <li>
								<a href="#"><img src="<?= $this->assetUrl('img/dashboard/gps.png'); ?>">Trouver un produit</a>
							</li>
                            <li>
								<a href="#"><img src="<?= $this->assetUrl('img/dashboard/gps.png'); ?>">Trouver un producteur</a>
							</li>
                            <li <?php echo ($w_current_route == 'wishlist') ? 'class="current"' : '' ?>>
								<a href="<?= $this->url('wishlist') ?>"><img src="<?= $this->assetUrl('img/dashboard/favorites-folder.png'); ?>">Favoris</a>
							</li>
                            <li>
								<a href="#"><img src="<?= $this->assetUrl('img/dashboard/customer.png'); ?>">Reviews</a>
							</li>

                            <li class="winemaker-link" <?php echo ($w_current_route == 'newWineMaker') ? 'class="current"' : '' ?>>
								<a href="<?= $this->url('newWineMaker') ?>"><img src="<?= $this->assetUrl('img/dashboard/team.png'); ?>">Devenir producteur</a>
							</li>
                            <li class="winemaker-link" <?php echo ($w_current_route == 'cave') ? 'class="current"' : '' ?>>
								<a href="<?= $this->url('cave') ?>"><img src="<?= $this->assetUrl('img/dashboard/winery.png'); ?>">Ma cave</a>
							</li>

                            <li class="admin-link">
								<a href="#"><img src="<?= $this->assetUrl('img/dashboard/newspaper-report.png'); ?>">Gérer le mag</a></li>
                            <li class="admin-link">
								<a href="<?= $this->url('members') ?>"><img src="<?= $this->assetUrl('img/dashboard/user-groups.png'); ?>">Gérer les membres</a>
							</li>
                            <li class="admin-link">
								<a href="<?= $this->url('winemakers') ?>"><img src="<?= $this->assetUrl('img/dashboard/farmer.png'); ?>">Gérer les producteurs</a>
							</li>
                        </ul>
                    </nav>
                </aside>
            </div>

            <div class="col-lg-10 r-p r-m col-main">
                <main>
					<h1><?=  $w_site_name ?><span><?= $this->e($title) ?></span></h1>

                    <?= $this->section('main_content') ?>
                </main>
            </div>

		</div><!-- Fin de la row bootstrap -->
	</div><!-- Fin du container bootstrap -->

    <script src="<?= $this->assetUrl('js/bootstrap.min.js') ?>"></script>
	<script src="<?= $this->assetUrl('js/dashboard.js') ?>" type="text/javascript"></script>
	<?= $this->section('js') ?>
</body>
</html>
