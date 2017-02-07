<?php $this->layout('layout_dashboard', ['title' => 'Tous nos membres']) ?>
<?php $this->start('main_content') ?>



<div class="container">
	<h2 class="members">Ajouter un utilisateur</h2>
	<form action="" method="post" class="members">

		<input type="hidden" name="id" value="<?= $members['id']; ?>" />
			<div class="row">
				<div class="col-md-4">
					<label for="">Prénom</label>
					<input type="text" value="" name="firstnsame" placeholder="prénom" class="form-control" />
				</div>
				<div class="col-md-4">
					<label for="">Nom</label>
					<input type="text" value="" name="lastname" placeholder="nom"  class="form-control"/>
				</div>
				<div class="col-md-4">
					<label for="">Email</label>
					<input type="email" value="" name="email" placeholder="email"  class="form-control" />
				</div>
			</div>
		<div class="row">
				<div class="col-md-4">
					<label for="">Adresse</label>
					<input type="text" value="" name="adress" placeholder="adresse" class="form-control" />
				</div>
				<div class="col-md-4">
					<label for="">Ville</label>
					<input type="text" value="" name="city" placeholder="ville" class="form-control" />
				</div>
				<div class="col-md-4">
				<label for="">Code Postale</label>
				<input type="number" value="" name="postcode" placeholder="code postale" class="form-control" />
				</div>
			</div>
		<div class="row">
			<div class="col-md-6">
				<label for="">Role</label>
				<input type="number" value="" name="role" placeholder="admin ou membre"  class="form-control"/>
			</div>
			<div class="col-md-6">
				<label for="">Type</label>
				<input type="number" value="" name="type" placeholder="producteur ou membre" class="form-control" />
			</div>
		</div>
		<div class="row">
		<div class="col-md-12">
			<input type="submit" value="ajouter"  class="btn btn-default"/>
		</div>
		</div>
	</form>

	<h2 class="members">Liste des membres</h2>
	<section class="member-list">
	<table border="1" class="table table-striped">
		<tr>
			<th>Prénom</th>
			<th>Nom</th>
			<th>Email</th>
			<th>Adresse</th>
			<th>Ville</th>
			<th>Code Postale</th>
			<th>Role</th>
			<th>Type</th>
			<th colspan="3"></th>
		</tr>
	<?php foreach ($members as $member) : ?>
		<tr>
			<td><?= $member['firstname'];?></td>
			<td><?= $member['lastname'];?></td>
			<td><?= $member['email'];?></td>
			<td><?= $member['adress']?></td>
			<td><?= $member['city']?></td>
			<td><?= $member['postcode']?></td>
			<td><?= $member['role']?></td>
			<td><?= $member['type']?></td>
			<td class="action"><!--
			--><a href="<?= $this->url('members', ['id' => $member['id']]) ?>" style="color:black"><i class="fa fa-user" aria-hidden="true"></i></a><!--
			--><a href="<?= $this->url('members2', ['id' => $member['id']]) ?>"><img width="20" src="<?= $this->assetUrl('img/dashboard/edit.png') ?>" alt="modifier"></a><!--
			--><a href="<?= $this->url('members', ['id' => $member['id']]) ?>"><img width="20" src="<?= $this->assetUrl('img/dashboard/delete.png') ?>" alt="supprimer"></a><!--
			--></td>
					</tr>
			<?php endforeach;?>

	</table>
	</section>
</div>


<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
    <script src="<?= $this->assetUrl('js/forms.js') ?>"></script>
<?php $this->stop('js') ?>
