<?php $this->layout('layout_dashboard', ['title' => $lang['profile']]) ?>
<?php $this->start('main_content') ?>

<div class="container-fluid">
	<section id="profile" class="section-with-panels">

		<ul class="tabs">
			<li id="view-profile" <?php if (empty($error)) { echo 'class="active"'; } ?>><?= $lang['profile'] ?></li>
			<?php if ($is_allowed_to_edit): ?><li id="edit-profile" <?php if (!empty($error)) { echo 'class="active"'; } ?>><?= $lang['profile_edit'] ?></li><?php endif; ?>
		</ul>

		<section class="view-profile <?php if (empty($error)) { echo 'active'; } ?>">
			<div class="row">
				<div class="col-md-3">
					<aside>
						<p class="user-infos">
							<img src="<?= $this->assetUrl('img/prod-placeholders/row1.jpg') ?>" alt="Avatar_<?= $winemaker['firstname'] . ' ' . $winemaker['lastname'] ?>" class="avatar">
							<br />
							<span><?= $winemaker['firstname'] . ' ' . $winemaker['lastname'] ?></span>
							<br />
							<span>Membre depuis <?= $register_date ?></span>
						</p>
					</aside>
				</div>

				<div class="col-md-9">
					<section>
						<dl>
							<dt>Adresse e-mail</dt><dd><?= $winemaker['email'] ?></dd>
							<dt>Adresse</dt><dd><?= $winemaker['address'] ?></dd>
                            <dt>Code Postal</dt><dd><?= $winemaker['postcode'] ?></dd>
							<dt>Ville</dt><dd><?= $winemaker['city'] ?></dd>
							<dt>Région</dt><dd><?= $winemaker['region'] ?></dd>
						</dl>
					</section>
				</div>
			</div>
		</section>

		<section class="edit-profile <?php if (!empty($error)) { echo 'active'; } ?>">
			<form action="<?= $this->url('user_profile', ['id' => $winemaker['id']]) ?>" method="post">
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
									<?php if ($winemaker['id'] != $_SESSION['user']['id']): ?><option value="user">Utilisateur</option><?php endif; ?>
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
				</div>

				<div class="row">
					 <div class="productPics">
						<img src="<?= $this->assetUrl('img/dashboard/pic.png'); ?>" alt="photo du produit">
						<span class="btn btn-default btn-file">Parcourir<input type="file"></span>
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

    <div class="container">
        <div class="row">
            <section>
                <table border="1" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Produits</th>
                            <th>Couleurs</th>
                            <th>Millesimes</th>
                            <th>Vins bio</th>
                            <th>Prix</th>
                            <th>Cépage</th>
                            <th>Stocks</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($products as $product) : ?>
                        <tr>
                            <td><a href="<?= $this->url('dashboard_product', ['name' => $product['clean_name'], 'id' => $product['id']]) ?>"><?= $product['name'];?></a></td>
                            <td><?= $product['couleur'];?></td>
                            <td><?= $product['millesime']?></td>
                            <td><?= $product['is_bio']?></td>
                            <td><?= $product['price']?></td>
                            <td><?= $product['cepage']?></td>
                            <td><?= $product['stock']?></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </section>
        </div>
    </div>
</div>
<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
<script src="<?= $this->assetUrl('js/forms.js') ?>" type="text/javascript"></script>
<script src="<?= $this->assetUrl('js/geolocalisation.js') ?>" type="text/javascript"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-S88NjyaazTh3Dmyfht4fsAKRli5v5gI&callback=initGeolocalisation" async defer></script>
<?php $this->stop('js') ?>
