<?php $this->layout('layout_dashboard', ['title' => 'Tous nos membres']) ?>
<?php $this->start('main_content') ?>

<div class="container-fluid">
	
	<form action="" method="post" class="members">
		<h2>Ajouter un utilisateur</h2>
		<input type="hidden" name="id" value="<?= $members['id']; ?>" />
		<div class="form-group">
		<label for="">Prénom</label>
		<input type="text" value="" name="firstnsame" placeholder="prénom" class="form-control" />
		<label for="">Nom</label>
		<input type="text" value="" name="lastname" placeholder="nom"  class="form-control"/>
		<label for="">Email</label>
		<input type="email" value="" name="email" placeholder="email"  class="form-control" />
		</div>
		<div class="form-group">
		<label for="">Adresse</label>
		<input type="text" value="" name="adress" placeholder="adresse" class="form-control" />
		<label for="">Ville</label>
		<input type="text" value="" name="city" placeholder="ville" class="form-control" />
		<label for="">Code Postale</label>
		<input type="number" value="" name="postcode" placeholder="code postale" class="form-control" />
		</div>
		<div class="form-group">
		<label for="">Role</label>
		<input type="number" value="" name="role" placeholder="admin ou membre"  class="form-control"/>
		<label for="">Type</label>
		<input type="number" value="" name="type" placeholder="producteur ou membre" class="form-control" />
		<input type="submit" value="ajouter"  class="btn btn-default"/>
		</div>
	</form>
		
	<h2 class="members">Liste des membres</h2>
	<table class="table table-bordered">
		<tr>
			<th>Prénom</th>
			<th>Nom</th>
			<th>Email</th>
			<th>Adresse</th>
			<th>Ville</th>
			<th>Code Postale</th>
			<th>Role</th>
			<th>Type</th>
			<th colspan="3">Action</th>
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
			<td class="action"><a href="<?= $this->url('members', ['id' => $member['id']]) ?>" style="color:black"><i class="fa fa-user" aria-hidden="true"></i></a> | <a href="<?= $this->url('members2', ['id' => $member['id']]) ?>" style="color:green"><i class="fa fa-pencil" aria-hidden="true"></i></a> | <a href="<?= $this->url('members', ['id' => $member['id']]) ?>" style="color:red"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
			</tr>
	<?php endforeach;?>
</div>


<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
    <script src="<?= $this->assetUrl('js/forms.js') ?>"></script>
<?php $this->stop('js') ?>