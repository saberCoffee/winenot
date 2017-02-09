<?php $this->layout('layout_dashboard', ['title' => 'Mon profil']) ?>
<?php $this->start('main_content') ?>

<section id="profile">
	<div class="container-fluid">
		<div class="row">
			<?php if ($user['id'] == $_SESSION['user']['id']): ?>
				<h2>Mon profil</h2>
			<?php else: ?>
				<h2>Profil de <?= $user['firstname'] . ' ' . $user['lastname'] ?></h2>
			<?php endif; ?>

			<aside class="col-md-3">
				<p class="user-infos">
					<img src="<?= $this->assetUrl('img/prod-placeholders/row1.jpg') ?>" alt="Avatar_<?= $user['firstname'] . ' ' . $user['lastname'] ?>" class="avatar">
					<br />
					<span class="user-name"><?= $user['firstname'] . ' ' . $user['lastname'] ?></span>
					<br />
					<span class="user-registerdate">Membre depuis <?= $register_date ?></span>
				</p>
			</aside>

			<div class="col-md-9">
				<?php if ($user['id'] == $_SESSION['user']['id']): ?>
					<p>
						Ces informations ne sont pas accessibles par les autres membres.
					</p>
					<ul>
						<li>Adresse e-mail : <?= $user['email'] ?></li>
						<li>Adresse : <?= $user['address'] ?></li>
						<li>Code Postal : <?= $user['postcode'] ?></li>
					</ul>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
    <script src="<?= $this->assetUrl('js/forms.js') ?>"></script>
<?php $this->stop('js') ?>
