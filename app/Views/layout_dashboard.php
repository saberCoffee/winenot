<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />

	<title><?= $this->e($title) . ' - ' . $w_site_name ?></title>
	<link rel="icon" href="<?= $this->assetUrl('img/icon.ico') ?>" />
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
	<div class="logoDashboard">
		<a href="<?= $this->url('home') ?>"><img src="<?= $this->assetUrl('img/logo_clean.png'); ?>"></a>
	</div>

    <div class="container-fluid" id="top">
        <div class="row">
            <header>
                <nav>
                    <ul>
                        <li <?php echo ($w_current_route == 'inbox') ? 'class="current"' : '' ?>><a href="<?= $this->url('inbox') ?>"><i class="fa fa-comments" aria-hidden="true"></i> Messages</a></li><!--
                        --><li><a href="#"><i class="fa fa-question-circle" aria-hidden="true"></i> F.A.Q</a></li><!--
						--><li <?php echo ($w_current_route == 'user_profile') ? 'class="current"' : '' ?>><a href="#" class="open-account-popup"><i class="fa fa-user" aria-hidden="true"></i> <?= $_SESSION['user']['firstname'] . ' ' . $_SESSION['user']['lastname'] ?></a>

							<div class="account-popup">
								<ul>
									<li><a href="<?= $this->url('user_profile', ['id' =>  $_SESSION['user']['id']]) ?>">Mon compte</a></li>
									<?php if ($_SESSION['user']['type'] == 1): ?>
										<li><a href="<?= $this->url('winemaker_profile', ['id' =>  $_SESSION['user']['id']]) ?>">Ma cave</a></li>
									<?php endif; ?>
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

                        	</li>
                            <li <?php echo ($w_current_route == 'dashboard_home') ? 'class="current"' : '' ?>>
								<a href="<?= $this->url('dashboard_home') ?>"><img src="<?= $this->assetUrl('img/dashboard/home-icon-silhouette.png'); ?>">L'accueil</a>
							</li>
                            <li>
								<a href="<?= $this->url('mag') ?>#lemag"><img src="<?= $this->assetUrl('img/dashboard/icon.png'); ?>">Le mag</a>
							</li>
                            <li <?php echo ($w_current_route == 'products') ? 'class="current"' : '' ?>>
								<a href="<?= $this->url('products') ?>"><img src="<?= $this->assetUrl('img/dashboard/products.png'); ?>">Tous nos vins</a>
							</li>
                            <li <?php echo ($w_current_route == 'winemakers') ? 'class="current"' : '' ?>>
								<a href="<?= $this->url('winemakers') ?>"><img src="<?= $this->assetUrl('img/dashboard/gps.png'); ?>">Trouver un producteur</a>
							</li>
                            <li <?php echo ($w_current_route == 'wishlist') ? 'class="current"' : '' ?>>
								<a href="<?= $this->url('wishlist') ?>"><img src="<?= $this->assetUrl('img/dashboard/favorites-folder.png'); ?>">Favoris</a>
							</li>

							<?php if ($_SESSION['user']['type'] == 0): ?>
	                            <li <?php echo ($w_current_route == 'register_winemaker') ? 'class="current"' : '' ?>>
									<a href="<?= $this->url('register_winemaker') ?>"><img src="<?= $this->assetUrl('img/dashboard/team.png'); ?>">Devenir producteur</a>
								</li>
							<?php else: ?>
	                            <li <?php echo ($w_current_route == 'cave' OR $w_current_route == 'cave_edit') ? 'class="current"' : '' ?>>
									<a href="<?= $this->url('cave') ?>"><img src="<?= $this->assetUrl('img/dashboard/winery.png'); ?>">Gérer ma cave</a>
								</li>
							<?php endif; ?>

							<?php if ($_SESSION['user']['role'] == 'admin'): ?>
	                            <li>
									<a href="<?= $this->url('add_article') ?>"><img src="<?= $this->assetUrl('img/dashboard/newspaper-report.png'); ?>">Gérer le mag</a></li>
	                            <li <?php echo ($w_current_route == 'admin_members') ? 'class="current"' : '' ?>>
									<a href="<?= $this->url('admin_members') ?>"><img src="<?= $this->assetUrl('img/dashboard/user-groups.png'); ?>">Gérer les membres</a>
								</li>
	                            <li <?php echo ($w_current_route == 'admin_winemakers') ? 'class="current"' : '' ?>>
									<a href="<?= $this->url('admin_winemakers') ?>"><img src="<?= $this->assetUrl('img/dashboard/farmer.png'); ?>">Gérer les producteurs</a>
								</li>
							<?php endif; ?>
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
