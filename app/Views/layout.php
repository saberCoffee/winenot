<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
	<!-- Titre dynamique affichant un titre selon la page sur laquelle on est -->
	<title><?= $this->e($title) . ' - ' . $w_site_name ?></title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="<?= $this->assetUrl('css/bootstrap.min.css') ?>" />
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?= $this->assetUrl('fonts/font-awesome-4.7.0/css/font-awesome.min.css')?> "/>
	<!-- Propre Style Sheet -->
	<link rel="stylesheet" href="<?= $this->assetUrl('css/style.css') ?>" />
</head>
<body>


<!-- BALISE ENGLOBANT TOUT LE BODY -->

	<div class="container-fluid" id="top">

		<div class="row">

			<h1>
				<a href="<?= $this->url('home') ?>"><img width="95" height="103" src="<?= $this->assetUrl('img/logo_mini_clean.png') ?>" class="logo-responsive" alt="Logo" /></a>
				WineNot
			</h1>

		</div>

		<div class="row">

			<header>
				<nav>
					<div class="row r-p r-m">
						<ul>
							<li><a href="<?= $this->url('home') ?>#AboutUs" class="anchor">À propos</a></li><!--
							--><li><a href="<?= $this->url('home') ?>#WineMonth" class="anchor">Vins du mois</a></li><!--
							--><li><a href="<?= $this->url('home') ?>#ProductMonth" class="anchor">Producteurs du mois</a></li><!--
							--><li><a href="#">Le Mag</a></li>
						</ul>

						<div class="logo">
							<a href="<?= $this->url('home') ?>"><img width="200" height="217" src="<?= $this->assetUrl('img/logo_clean.png') ?>" alt="Logo" /></a>
						</div>

						<ul>
							<li><a href="<?= $this->url('account') ?>">Mon compte</a></li>
						</ul>
					</div>
				</nav>

			</header>

		</div>

		<main>
			<?= $this->section('main_content') ?>
		</main>

		<!-- Start: Footer -->
		<footer>
			<div class="row">

				<!-- Plan du Site dans Footer -->
				<div class="col-md-4 col-xs-12">
					<h3>Plan du Site</h3>
					<ul class="sitemap">
						<li><a href="#">Nos vins</a></li>
						<li><a href="#">Nos producteurs</a></li>
						<li><a href="#">About us</a></li>
						<li><a href="#">Contact</a></li>
					</ul>
				</div>

				<!-- Réseaux Sociaux dans Footer -->
				<div class="col-md-4 col-xs-12">
					<h3>Rejoignez nous</h3>
					<ul class="sns">
						<li><a href="#"><i class="fa fa-instagram fa-3x" aria-hidden="true"></i></a></li>
						<li><a href="#"><i class="fa fa-facebook-square fa-3x" aria-hidden="true"></i></a></li>
						<li><a href="#"><i class="fa fa-twitter-square fa-3x" aria-hidden="true"></i></a></li>
						<li><a href="#"><i class="fa fa-tumblr-square fa-3x" aria-hidden="true"></i></a></li>
					</ul>
				</div>

				<!-- Contact dans Footer -->
				<div class="col-md-4 col-xs-12">
					<h3>Contactez nous</h3>
					<ul class="contact">
						<li><a href="<?= $this->url('contact') ?>">Contactez-nous</a></li>
				</div>
			</div>

			<small>"L'abus d'alcool est dangereux pour la santé, consommez avec modération"</small>
			<p class="copyright"> 2017 &copy; HérambanHwaSeonRomainThomas</p>

		</footer>
	</div>

	<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="<?= $this->assetUrl('js/bootstrap.min.js') ?>"></script>
	<?= $this->section('js') ?>
</body>
</html>
