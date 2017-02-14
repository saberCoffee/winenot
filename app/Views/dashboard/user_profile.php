<?php $this->layout('layout_dashboard', ['title' => $lang['profile']]) ?>
<?php $this->start('main_content') ?>
<?php if (!empty($_COOKIE['successMsg'])) { ?>
<section>

	<div class="alert alert-success" role="alert"><?= $_COOKIE['successMsg'] ?></div>

</section>
<?php } ?>

<div id="imageCrop-mask">
	<div></div>
</div>

<div class="container-fluid profile">
	<section id="profile" class="section-with-panels">

		<ul class="tabs">
			<li id="view-profile" <?php if (empty($error)) { echo 'class="active"'; } ?>><?= $lang['profile'] ?></li>
			<?php if ($is_allowed_to_edit): ?><li id="edit-profile" <?php if (!empty($error)) { echo 'class="active"'; } ?>><?= $lang['profile_edit'] ?></li><?php endif; ?>
		</ul>

		<section class="view-profile <?php if (empty($error)) { echo 'active'; } ?>">
			<div class="row">
				<div class="col-md-3 vcenter">
					<aside class="user-infos-left">
						<p>
							<?php if (empty($user['photo'])): ?>
								<img src="<?= $this->assetUrl('img/dashboard/user2.png') ?>" alt="Avatar_<?= $user['firstname'] . ' ' . $user['lastname'] ?>" class="avatar" width="150" />
							<?php else: ?>
								<img src="<?= $this->assetUrl('content/photos/users/' . $user['photo']) ?>" alt="Avatar_<?= $user['firstname'] . ' ' . $user['lastname'] ?>" class="avatar" width="150" />
							<?php endif; ?>
							<br />
							<span><?= $user['firstname'] . ' ' . $user['lastname'] ?></span>
							<br />
							<span>Membre depuis <?= $register_date ?></span>
						</p>
					</aside>
				</div>

				<div class="col-md-9 vcenter">
					<section class="user-infos-right">
						<?php if ($is_allowed_to_read): ?>
							<?php if ($is_owner): ?>
								<p>
									Ces informations ne sont pas accessibles aux autres utilisateurs avec qui vous n'êtes pas entré en contact.
								</p>
							<?php endif; ?>
							<dl>
								<dt>Adresse e-mail</dt><dd><?= $user['email'] ?></dd>
								<dt>Adresse</dt><dd><?= $user['address'] ?></dd>
								<dt>Code Postal</dt><dd><?= $user['postcode'] ?></dd>
								<dt>Ville</dt><dd><?= $user['city'] ?></dd>
							</dl>
						<?php else: ?>
							<p>
								Les informations de cet utilisateur sont privées.
							</p>
						<?php endif; ?>
					</section>
				</div>
			</div>

			<?php if ($is_owner): ?>
				<div class="row">
	            	<div class="col-md-10 col-md-offset-1">
						<div class="alert alert-info">
							Tant que vous n'aurez pas rempli toutes les informations de votre profil, vous ne pourrez pas entrer en contact avec un producteur.
						</div>
					</div>
				</div>
			<?php endif; ?>
		</section>

		<section class="edit-profile <?php if (!empty($error)) { echo 'active'; } ?>">
			<form action="<?= $this->url('user_profile', ['id' => $user['id']]) ?>" method="post" enctype="multipart/form-data">
				<?php if ($_SESSION['user']['role'] == 'admin'): ?>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group <?php if (isset($error['firstname'])) { echo 'has-error'; } ?>">
								<label for="firstname">Prénom</label>
								<input type="firstname" name="firstname" value="<?= $firstname; ?>"  class="form-control  <?php if (isset($error['firstname'])) { echo 'has-error'; } ?>" required="required" data-min="2" data-max="16" />
								<span class="help-block" <?php if (empty($error['firstname'])) { echo 'style="display: none"'; } ?>>
									<?php if (isset($error['firstname'])) { echo $error['firstname']; } ?>
								</span>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group <?php if (isset($error['firstname'])) { echo 'has-error'; } ?>">
								<label for="lastname">Nom de famille</label>
								<input type="lastname" name="lastname" value="<?= $lastname; ?>"  class="form-control  <?php if (isset($error['lastname'])) { echo 'has-error'; } ?>" required="required" data-min="2" data-max="16"  />
								<span class="help-block" <?php if (empty($error['lastname'])) { echo 'style="display: none"'; } ?>>
									<?php if (isset($error['lastname'])) { echo $error['lastname']; } ?>
								</span>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group <?php if (isset($error['firstname'])) { echo 'has-error'; } ?>">
								<label for="role">Rôle</label>
								<select id="role" name="role" required="required" class="form-control">
									<?php if ($user['id'] != $_SESSION['user']['id']): ?><option value="user">Utilisateur</option><?php endif; ?>
									<option value="admin" <?php if ($role == 'admin') echo 'selected="selected"' ?>>Administrateur</option>
								</select>
								<span class="help-block" <?php if (empty($error['role'])) { echo 'style="display: none"'; } ?>>
									<?php if (isset($error['role'])) { echo $error['role']; } ?>
								</span>
							</div>
						</div>
					</div>
				<?php endif; ?>

				<div class="row">
					<div class="col-md-4">
						<div class="form-group <?php if (isset($error['email'])) { echo 'has-error'; } ?>">
							<label for="email">Email</label>
							<input type="email" name="email" value="<?= $email; ?>"  class="form-control  <?php if (isset($error['email'])) { echo 'has-error'; } ?>" required="required" />
							<span class="help-block" <?php if (empty($error['email'])) { echo 'style="display: none"'; } ?>>
								<?php if (isset($error['email'])) { echo $error['email']; } ?>
							</span>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group <?php if (isset($error['password'])) { echo 'has-error'; } ?>">
							<label for="password">Mot de passe</label>
							<input type="password" name="password"  class="form-control" data-min="6" data-max="16" maxlength="16" />
							<span class="help-block" <?php if (empty($error['password'])) { echo 'style="display: none"'; } ?>>
								<?php if (isset($error['password'])) { echo $error['password']; } ?>
							</span>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group <?php if (isset($error['password_verif'])) { echo 'has-error'; } ?>">
							<label for="password_verif">Vérification du mot de passe</label>
							<input type="password" name="password_verif"  id="password_verif" class="form-control" data-min="6" data-max="16" maxlength="16" />
							<span class="help-block" <?php if (empty($error['password_verif'])) { echo 'style="display: none"'; } ?>>
								<?php if (isset($error['password_verif'])) { echo $error['password_verif']; } ?>
							</span>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<div class="form-group <?php if (isset($error['address'])) { echo 'has-error'; } ?>">
							<label for="address">Adresse</label>
							<input type="text" name="address" value="<?= $address; ?>" required="required" class="form-control" />
							<span class="help-block" <?php if (empty($error['address'])) { echo 'style="display: none"'; } ?>>
								<?php if (isset($error['address'])) { echo $error['address']; } ?>
							</span>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<label for="postcode">Code postal</label>
							<input type="text" name="postcode" value="<?= $postcode; ?>" id="postcode" class="form-control" required="required" data-min="5" data-max="5" maxlength="5" autocomplete="off" />
							<span class="help-block" <?php if (empty($error['postcode'])) { echo 'style="display: none"'; } ?>>
								<?php if (isset($error['postcode'])) { echo $error['postcode']; } ?>
							</span>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group <?php if (empty($city)) { echo 'city-input'; } ?>">
							<label for="city">Ville</label>
							<input type="text" name="city" value="<?= $city; ?>" id="city" required="required" class="form-control" autocomplete="off" />
							<span class="help-block" <?php if (empty($error['city'])) { echo 'style="display: none"'; } ?>>
								<?php if (isset($error['city'])) { echo $error['city']; } ?>
							</span>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group <?php if (isset($error['photo'])) { echo 'has-error'; } ?>">
							<div class="productPics">
								<label for="photo">Photo</label>
								<span class="help-block" <?php if (empty($error['photo'])) { echo 'style="display: none"'; } ?>>
								<?php if (isset($error['photo'])) { echo $error['photo']; } ?>
								</span>

								<span class="btn btn-default btn-file">Parcourir
									<input type="file" id="photo" name="photo" accept="image/*" />
								</span>
							</div>

							<?php if (!empty($user['photo'])): ?>
								<input type="hidden" name="currentPhoto" value="<?= $user['photo'] ?>" />
							<?php endif; ?>

							<input type="hidden" id="resizeW" name="resizeW" />
							<input type="hidden" id="resizeH" name="resizeH" />
							<input type="hidden" id="x" name="x" />
							<input type="hidden" id="y" name="y" />
							<input type="hidden" id="w" name="w" />
							<input type="hidden" id="h" name="h" />
						</div>
					</div>
				</div>
				<div class="row">
					<input type="submit" value="Mettre à jour"  class="btn btn-default"/>
				</div>

			</form>
		</section>
	</section>
</div>
<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
<script src="<?= $this->assetUrl('js/forms.js') ?>" type="text/javascript"></script>
<script src="<?= $this->assetUrl('js/geolocalisation.js') ?>" type="text/javascript"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-S88NjyaazTh3Dmyfht4fsAKRli5v5gI&callback=initGeolocalisation" async defer></script>
<script src="<?= $this->assetUrl('js/jquery.Jcrop.min.js') ?>" type="text/javascript"></script>
<script src="<?= $this->assetUrl('js/jquery.color.js') ?>" type="text/javascript"></script>
<script src="<?= $this->assetUrl('js/imageCrop.js') ?>" type="text/javascript"></script>
<?php $this->stop('js') ?>

<?php $this->start('css') ?>
<link rel="stylesheet" href="<?= $this->assetUrl('css/jquery.Jcrop.css') ?>" type="text/css">
<?php $this->stop('css') ?>
