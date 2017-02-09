<?php $this->layout('layout_dashboard', ['title' => $profile]) ?>
<?php $this->start('main_content') ?>

<div class="container-fluid">
	<section id="profile" class="section-with-panels">

		<ul class="tabs">
			<li id="view-profile" class="active"><?= $profile ?></li>
			<?php if ($is_owner): ?><li id="edit-profile">Modifier mes informations</li><?php endif; ?>
		</ul>

		<section class="view-profile active">
			<div class="row">
				<div class="col-md-3">
					<aside>
						<p class="user-infos">
							<img src="<?= $this->assetUrl('img/prod-placeholders/row1.jpg') ?>" alt="Avatar_<?= $user['firstname'] . ' ' . $user['lastname'] ?>" class="avatar">
							<br />
							<span class="user-name"><?= $user['firstname'] . ' ' . $user['lastname'] ?></span>
							<br />
							<span class="user-registerdate">Membre depuis <?= $register_date ?></span>
						</p>
					</aside>
				</div>

				<div class="col-md-9">
					<section>
						<?php if ($is_owner): ?>
							<p>
								Ces informations ne sont pas accessibles aux autres utilisateurs.
							</p>
							<dl>
								<dt>Adresse e-mail</dt><dd><?= $user['email'] ?></dd>
								<dt>Adresse</dt><dd><?= $user['address'] ?></dd>
								<dt>Ville</dt><dd><?= $user['city'] ?></dd>
								<dt>Code Postal</dt><dd><?= $user['postcode'] ?></dd>
							</dl>
							<p class="info">Tant que vous n'aurez pas renseigné toutes ces informations, vous ne pourrez pas entrer en contact avec un producteur !</p>
						<?php else: ?>
							<p>
								Les informations de cet utilisateur sont privées.
							</p>
						<?php endif; ?>
					</section>
				</div>
			</div>
		</section>

		<section class="edit-profile active">
			<form action="<?= $this->url('user_profile', ['id' => $user['id']]) ?>" method="post">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group <?php if (isset($error['email'])) { echo 'has-error'; } ?>">
							<label for="">Email</label>
							<input type="email" name="email" value="<?= $email; ?>"  class="form-control  <?php if (isset($error['login_email'])) { echo 'has-error'; } ?>" 	required />
							<span class="help-block" <?php if (empty($error['email'])) { echo 'style="display: none"'; } ?>>
								<?php if (isset($error['email'])) { echo $error['email']; } ?>
							</span>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group <?php if (isset($error['password'])) { echo 'has-error'; } ?>">
							<label for="">Mot de passe</label>
							<input type="password" name="password"  class="form-control" required="required" data-min="6" 	data-max="16" maxlength="16"/>
							<span class="help-block" <?php if (empty($error['password'])) { echo 'style="display: none"'; } ?>>
								<?php if (isset($error['password'])) { echo $error['password']; } ?>
							</span>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group <?php if (isset($error['password_verif'])) { echo 'has-error'; } ?>">
							<label for="password_verif">Vérification du mot de passe</label>
							<input type="password" name="password_verif"  id="password_verif" class="form-control" required="required" data-min="6" 	data-max="16" maxlength="16" />
							<span class="help-block" <?php if (empty($error['password_verif'])) { echo 'style="display: none"'; } ?>>
								<?php if (isset($error['password_verif'])) { echo $error['password_verif']; } ?>
							</span>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<div class="form-group <?php if (isset($error['address'])) { echo 'has-error'; } ?>">
							<label for="">Adresse</label>
							<input type="text" name="address" value="<?= $address; ?>" class="form-control" />
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<label for="postcode">Code postal</label>
							<input type="text" name="postcode" id="postcode" class="form-control" maxlength="5" autocomplete="off" />
							<span class="help-block" <?php if (empty($error['postcode'])) { echo 'style="display: none"'; } ?>>
								<?php if (isset($error['postcode'])) { echo $error['postcode']; } ?>
							</span>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group city-input">
							<label for="city">Ville</label>
							<input type="text" name="city" id="city" required="required" class="form-control" autocomplete="off" />
							<span class="help-block" <?php if (empty($error['city'])) { echo 'style="display: none"'; } ?>>
								<?php if (isset($error['city'])) { echo $error['city']; } ?>
							</span>
						</div>
					</div>
				</div>

				<div class="row">
					<input type="submit" value="Mettre à jour"  class="btn btn-default"/>
				</div>

				<?php if (!empty($_COOKIE['successMsg'])) { ?>
				<div class="alert alert-success" role="alert"><?= $_COOKIE['successMsg'] ?></div>
				<?php } ?>
			</form>
		</section>
	</section>
</div>
<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
<script src="<?= $this->assetUrl('js/forms.js') ?>" type="text/javascript"></script>
<script src="<?= $this->assetUrl('js/geolocalisation.js') ?>" type="text/javascript"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-S88NjyaazTh3Dmyfht4fsAKRli5v5gI&callback=initGeolocalisation" async defer></script>
<?php $this->stop('js') ?>
