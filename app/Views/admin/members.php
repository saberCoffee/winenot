<?php $this->layout('layout_dashboard', ['title' => 'Administration des membres']) ?>

<?php $this->start('main_content') ?>

<section class="section-with-panels">

	<!-- Dev Note: Ajouter à mettre dans une variable et modifier si isset id en modifier et également la valeur du bouton du submit -->
	<ul class="tabs">
		<li id="addUser" class="active">Ajouter un utilisateur</li>
		<li id="member-list">Liste des membres</li>
	</ul>

	<section class="addUser active">
		<form action="<?= $this->url('admin_add_member') ?>" method="post" class="members">
		<input type="hidden" name="id" value="<?= $members['id']; ?>" />

			<div class="row">
				<div class="col-md-4">
					<div class="form-group <?php if (isset($error['firstname'])) { echo 'has-error'; } ?>">
						<label for="">Prénom*</label>
						<input type="text" name="firstname" value="<?= $firstname; ?>" class="form-control" required />
						<span class="help-block" <?php if (empty($error['firstname'])) { echo 'style="display: none"'; } ?>>
		            	<?php if (isset($error['firstname'])) { echo $error['firstname']; } ?>
		       			</span>
		       		</div>
				</div>
				<div class="col-md-4">
					<div class="form-group <?php if (isset($error['lastname'])) { echo 'has-error'; } ?>">
						<label for="">Nom*</label>
						<input type="text" name="lastname" value="<?= $lastname; ?>"  class="form-control" required />
						<span class="help-block" <?php if (empty($error['lastname'])) { echo 'style="display: none"'; } ?>>
                		<?php if (isset($error['lastname'])) { echo $error['lastname']; } ?>
           				</span>
           			</div>
				</div>
				<div class="col-md-4">
					<div class="form-group <?php if (isset($error['email'])) { echo 'has-error'; } ?>">
						<label for="">Email*</label>
						<input type="email" name="email" value="<?= $email; ?>"  class="form-control  <?php if (isset($error['login_email'])) { echo 'has-error'; } ?>" 	required />
						<span class="help-block" <?php if (empty($error['email'])) { echo 'style="display: none"'; } ?>>
	                	    <?php if (isset($error['email'])) { echo $error['email']; } ?>
	                	</span>
	                </div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group <?php if (isset($error['password'])) { echo 'has-error'; } ?>">
						<label for="">Mot de passe*</label>
						<input type="password" name="password"  class="form-control" required="required" data-min="6" 	data-max="16" maxlength="16"/>
						<span class="help-block" <?php if (empty($error['password'])) { echo 'style="display: none"'; } ?>>
	                	    <?php if (isset($error['password'])) { echo $error['password']; } ?>
	                	</span>
	                </div>
				</div>
				<div class="col-md-4">
					<div class="form-group <?php if (isset($error['password_verif'])) { echo 'has-error'; } ?>">
	                	<label for="password_verif">Vérification du mot de passe*</label>
	                	<input type="password" name="password_verif"  id="password_verif" class="form-control" required="required" data-min="6" 	data-max="16" maxlength="16" />
	                	<span class="help-block" <?php if (empty($error['password_verif'])) { echo 'style="display: none"'; } ?>>
	                	    <?php if (isset($error['password_verif'])) { echo $error['password_verif']; } ?>
	                	</span>
	                </div>
	            </div>
				<div class="col-md-4">
					<div class="form-group <?php if (isset($error['password_verif'])) { echo 'has-error'; } ?>">
						<label for="">Role</label>
						<select name="role" id="role" class="form-control" value="<?= $role; ?>">
								<option value="user">Utilisateur</option>
								<option value="admin"  <?php if ($role == 'admin') echo 'selected' ?>>Administrateur</option>
						</select>
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
					<div class="form-group <?php if (isset($error['city'])) { echo 'has-error'; } ?>">
						<label for="">Ville</label>
						<input type="text" name="city" value="<?= $city; ?>" class="form-control" />
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group <?php if (isset($error['postcode'])) { echo 'has-error'; } ?>">
						<label for="">Code Postal</label>
						<input type="text" name="postcode" value="<?= $postcode; ?>" class="form-control" data-min="5" data-max="5" />
						<span class="help-block" <?php if (empty($error['postcode'])) { echo 'style="display: none"'; } ?>>
	                	    <?php if (isset($error['postcode'])) { echo $error['postcode']; } ?>
	                	</span>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<input type="submit" value="ajouter"  class="btn btn-default"/>
				</div>
			</div>
			
			<?php if (!empty($_COOKIE['successMsg'])) { ?>
			<div class="alert alert-success" role="alert"><?= $_COOKIE['successMsg'] ?></div>
			<?php } ?>
		</form>
	</section>

	<section class="member-list">
		<table border="1" class="table table-striped">
			<tr>
				<th>Prénom</th>
				<th>Nom</th>
				<th>Email</th>
				<th>Adresse</th>
				<th>Ville</th>
				<th>Code Postal</th>
				<th>Role</th>
				<th>Type</th>
				<th></th>
			</tr>
		<?php foreach ($members as $member) : ?>
			<tr>
				<td><?= $member['firstname'];?></td>
				<td><?= $member['lastname'];?></td>
				<td><?= $member['email'];?></td>
				<td><?= $member['address']?></td>
				<td><?= $member['city']?></td>
				<td><?= $member['postcode']?></td>
				<td><?= $member['role']?></td>
				<td><?= $member['type']?></td>
				<td class="action"><!--
				--><a href="<?= $this->url('user_profile', ['id'=> $member['id']]) ?>"><img width="20" src="<?= $this->assetUrl('img/dashboard/user.png') ?>" alt="utilisateur"></a
				--><a href="<?= $this->url('admin_members', ['id'=> $member['id']]) ?>"><img width="20" src="<?= $this->assetUrl('img/dashboard/delete.png') ?>" alt="supprimer"></a><!--
				--></td>
			</tr>
				<?php endforeach;?>

		</table>
	</section>
</section>


<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
    <script src="<?= $this->assetUrl('js/forms.js') ?>"></script>
<?php $this->stop('js') ?>
