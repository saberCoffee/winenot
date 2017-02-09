<?php $this->layout('layout_dashboard', ['title' => $profile]) ?>
<?php $this->start('main_content') ?>

<section id="onglet">

	<ul class="tabs">
		<li id="view-profile" class="active"><?= $profile ?></li>
		<?php if ($is_owner): ?><li id="edit-profile">Modifier mes informations</li><?php endif; ?>
	</ul>

	<section class="view-profile active">
		<div class="container-fluid">
			<div class="row">
				<aside class="profile">
					<div class="col-md-3">
						<p class="user-infos">
							<img src="<?= $this->assetUrl('img/prod-placeholders/row1.jpg') ?>" alt="Avatar_<?= $user['firstname'] . ' ' . $user['lastname'] ?>" class="avatar">
							<br />
							<span class="user-name"><?= $user['firstname'] . ' ' . $user['lastname'] ?></span>
							<br />
							<span class="user-registerdate">Membre depuis <?= $register_date ?></span>
						</p>
					</div>
				</aside>

				<div class="profile">
					<div class="col-md-9">
						<?php if ($is_owner): ?>
							<p>
								Ces informations ne sont pas accessibles aux autres membres.
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
		</div>
	</section>

	<section class="edit-profile">
		test
	</section>
</section>

<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
    <script src="<?= $this->assetUrl('js/forms.js') ?>"></script>
<?php $this->stop('js') ?>
