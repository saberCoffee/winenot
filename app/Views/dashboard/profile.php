<?php $this->layout('layout_dashboard', ['title' => 'Mon profil']) ?>
<?php $this->start('main_content') ?>

<div class="container profile-view">
	<h2>Mon profil</h2>
	<div class="row">
	<aside class="col-md-2"><img src="#" alt="profil image" /></aside>
	<nav class="col-md-10">
		<ul>
			<li>Prénom: <?= $user['firstname'] ?></li>
			<li>Nom: 	<?= $user['lastname'] ?></li>
			<li>Adresse e-mail: <?= $user['email'] ?></li>
			<li>Adresse: <?= $user['address'] ?></li>
			<li>Code Postale: <?= $user['postcode'] ?></li>
			<li>Membre depuis: <?= $date ?></li>
		</ul>
	</nav>
	</div>
</div>

<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
    <script src="<?= $this->assetUrl('js/forms.js') ?>"></script>
<?php $this->stop('js') ?>
