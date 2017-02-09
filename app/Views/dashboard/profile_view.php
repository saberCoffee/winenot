<?php $this->layout('layout_dashboard', ['title' => 'Mon profil']) ?>
<?php $this->start('main_content') ?>

<div class="container profile-view">
	<h2>Votre profil</h2>
	<nav>
		<ul>
			<li>Prénom: <?= $_SESSION['user']['firstname'] ?></li>
			<li>Nom: 	<?= $_SESSION['user']['lastname'] ?></li>
			<li>Adresse e-mail: 	<?= $_SESSION['user']['email'] ?></li>
			<li>Adresse: <?= $_SESSION['user']['address'] ?></li>
			<li>Code Postale: <?= $_SESSION['user']['postcode'] ?></li>
			<li>Membre depuis: <?= $date ?></li>
		</ul>
	</nav>
	<h3 class="user-photos">Photos</h3>
	<div class="row">
		<div class="col-md-4">Photo1</div>
		<div class="col-md-4">Photo2</div>
		<div class="col-md-4">Photo3</div>
	</div>
</div>

<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
    <script src="<?= $this->assetUrl('js/forms.js') ?>"></script>
<?php $this->stop('js') ?>