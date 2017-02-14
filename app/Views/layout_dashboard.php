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

	<?= $this->section('css') ?>

	<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
	<!-- <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script> -->

</head>

<body class="dashboard">

    <div class="container-fluid" id="top">
        <div class="row hidden-sm hidden-xs">
            <header>
                <nav>
                    <ul>
                        <li <?php echo ($w_current_route == 'inbox' || $w_current_route == 'inbox_thread') ? 'class="current"' : '' ?>><a href="<?= $this->url('inbox') ?>"><i class="fa fa-comments" aria-hidden="true"></i> Messages</a></li><!--
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


		<!-- Responsive -->

		    <div class="row visible-sm visible-xs">
		          <div class="responsive-menu ">
		              <div class="dropdown">
		                <ul id="winenot-menu">
		                    <li><span>Winenot menu</span>
		                    <i class="fa fa-bars fa-2x" aria-hidden="true"></i>
		                        <ul>
		                            <li>
		                                <a href="<?= $this->url('home') ?>"><img width="50" src="<?= $this->assetUrl('img/logo_mini_clean.png'); ?>"></a>
		                            </li>
		                            <li <?php echo ($w_current_route == 'dashboard_home') ? 'class="current"' : '' ?>>
		                                <a href="<?= $this->url('dashboard_home') ?>">L'accueil</a>
		                            </li>
		                           <li>
		                                <a href="<?= $this->url('mag') ?>#lemag">Le mag</a>
		                            </li>
		                           <li <?php echo ($w_current_route == 'products') ? 'class="current"' : '' ?>>
		                                <a href="<?= $this->url('products') ?>">Tous nos vins</a>
		                            </li>
		                           <li <?php echo ($w_current_route == 'winemakers') ? 'class="current"' : '' ?>>
		                                <a href="<?= $this->url('winemakers') ?>">Trouver un producteur</a>
		                            </li>
		                           <li <?php echo ($w_current_route == 'favorites') ? 'class="current"' : '' ?>>
		                                <a href="<?= $this->url('favorites') ?>">Favoris</a>
		                            </li>

		                            <?php if ($_SESSION['user']['type'] == 0): ?>
		                                <li <?php echo ($w_current_route == 'register_winemaker') ? 'class="current"' : '' ?>>
		                                    <a href="<?= $this->url('register_winemaker') ?>">Devenir producteur</a>
		                                </li>
		                            <?php else: ?>
		                                <li <?php echo ($w_current_route == 'cave' OR $w_current_route == 'cave_edit') ? 'class="current"' : '' ?>>
		                                    <a href="<?= $this->url('cave') ?>">Gérer ma cave</a>
		                                </li>
		                            <?php endif; ?>

		                            <?php if ($_SESSION['user']['role'] == 'admin'): ?>
		                                <li class="  hidden-md">
		                                    <a href="<?= $this->url('add_article') ?>">Gérer le mag</a></li>
		                                <li <?php echo ($w_current_route == 'admin_members') ? 'class="current"' : '' ?>>
		                                    <a href="<?= $this->url('admin_members') ?>">Gérer les membres</a>
		                                </li>
		                                <li <?php echo ($w_current_route == 'admin_winemakers') ? 'class="current"' : '' ?>>
		                                    <a href="<?= $this->url('admin_winemakers') ?>">Gérer les producteurs</a>
		                                </li>
		                            <?php endif; ?>

		                            <li <?php echo ($w_current_route == 'inbox') ? 'class="current"' : '' ?>><a href="<?= $this->url('inbox') ?>">Messages</a></li><!--
		                           --><li><a href="#">F.A.Q</a></li><!--
		                            --><li><a href="<?= $this->url('user_profile', ['id' =>  $_SESSION['user']['id']]) ?>">Mon compte</a></li>
		                                    <?php if ($_SESSION['user']['type'] == 1): ?>
		                                        <li><a href="<?= $this->url('winemaker_profile', ['id' =>  $_SESSION['user']['id']]) ?>">Ma cave</a></li>
		                                    <?php endif; ?>
		                                    <li><a href="<?= $this->url('logout') ?>">Se déconnecter</a></li>
		                        </ul>
		                    </li>
		                </ul>
		            </div>
		        </div>
		    </div>

<!-- No Responsive -->
        <div class="row">
            <div class="col-lg-2 r-p r-m col-aside">
                <aside class="hidden-sm hidden-xs">
                    <nav>
                        <ul>
                        	<li>
							<div class="logoDashboard">
							<a href="<?= $this->url('home') ?>"><img src="<?= $this->assetUrl('img/logo_clean.png'); ?>" alt="logo winenot" /></a>
							</div>
                        	</li>
                            <li <?php echo ($w_current_route == 'dashboard_home') ? 'class="current"' : '' ?>>
								<a href="<?= $this->url('dashboard_home') ?>"><img src="<?= $this->assetUrl('img/dashboard/home-icon-silhouette.png'); ?>" alt="icone maison" />L'accueil</a>
							</li>
                            <li>
								<a href="<?= $this->url('mag') ?>#lemag"><img src="<?= $this->assetUrl('img/dashboard/icon.png'); ?>" alt="icone magazine" />Le mag</a>
							</li>
                            <li <?php echo ($w_current_route == 'products' || $w_current_route == 'dashboard_product') ? 'class="current"' : '' ?>>
								<a href="<?= $this->url('products') ?>"><img src="<?= $this->assetUrl('img/dashboard/products.png'); ?>" alt="icone vin" />Tous nos vins</a>
							</li>
                            <li <?php echo ($w_current_route == 'winemakers' || $w_current_route == 'winemaker_profile') ? 'class="current"' : '' ?>>
								<a href="<?= $this->url('winemakers') ?>"><img src="<?= $this->assetUrl('img/dashboard/gps.png'); ?>" alt="icone navigation" />Trouver un producteur</a>
							</li>
                            <li <?php echo ($w_current_route == 'favorites') ? 'class="current"' : '' ?>>
								<a href="<?= $this->url('favorites') ?>"><img src="<?= $this->assetUrl('img/dashboard/favorites-folder.png'); ?>" alt="icone favoris" />Favoris</a>
							</li>

							<?php if ($_SESSION['user']['type'] == 0): ?>
	                            <li <?php echo ($w_current_route == 'register_winemaker') ? 'class="current"' : '' ?>>
									<a href="<?= $this->url('register_winemaker') ?>"><img src="<?= $this->assetUrl('img/dashboard/team.png'); ?>" alt="icone utilisateur" />Devenir producteur</a>
								</li>
							<?php else: ?>
	                            <li <?php echo ($w_current_route == 'cave' OR $w_current_route == 'cave_edit') ? 'class="current"' : '' ?>>
									<a href="<?= $this->url('cave') ?>"><img src="<?= $this->assetUrl('img/dashboard/winery.png'); ?>" alt="icone cave à vin" />Gérer ma cave</a>
								</li>
							<?php endif; ?>

							<?php if ($_SESSION['user']['role'] == 'admin'): ?>
	                            <li>
									<a href="<?= $this->url('add_article') ?>"><img src="<?= $this->assetUrl('img/dashboard/newspaper-report.png'); ?>" alt="icone journal" />Gérer le mag</a></li>
	                            <li <?php echo ($w_current_route == 'admin_members') ? 'class="current"' : '' ?>>
									<a href="<?= $this->url('admin_members') ?>"><img src="<?= $this->assetUrl('img/dashboard/user-groups.png'); ?>" alt="icone utilisateur en groupe" />Gérer les membres</a>
								</li>
	                            <li <?php echo ($w_current_route == 'admin_winemakers') ? 'class="current"' : '' ?>>
									<a href="<?= $this->url('admin_winemakers') ?>"><img src="<?= $this->assetUrl('img/dashboard/farmer.png'); ?>" alt="icone agriculteur"/>Gérer les producteurs</a>
								</li>
	                            <li <?php echo ($w_current_route == 'admin_products') ? 'class="current"' : '' ?>>
									<a href="<?= $this->url('admin_products') ?>"><img src="<?= $this->assetUrl('img/dashboard/nav-wineofthemonth.png'); ?>">Gérer les vins du mois</a>
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
    <script src="<?= $this->assetUrl('js/winenotMenu.js') ?>"></script>
	<script src="<?= $this->assetUrl('js/dashboard.js') ?>" type="text/javascript"></script>
	<?= $this->section('js') ?>
</body>
</html>
