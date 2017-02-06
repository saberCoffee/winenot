<?php $this->layout('layout_dashboard', ['title' => 'Tous nos membres']) ?>
<?php $this->start('main_content') ?>

<div class="container-fluid">
			<input type="hidden" name="id" value="<?= $members['id']; ?>" />
	<table class="table table-bordered">
		<tr>
			<th>Prénom</th>
			<th>Nom</th>
			<th>Email</th>
			<th>Adresse</th>
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
			<td><?= $member['postcode']?></td>
			<td><?= $member['role']?></td>
			<td><?= $member['type']?></td>
			<td><a href="<?= $this->url('members', ['id' => $member['id']]) ?>" style="color:green">Modifier</a> | <a href="<?= $this->url('members', ['id' => $member['id']]) ?>">Supprimer</a></td>
			</tr>
	<?php endforeach;?>
</div>


<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
    <script src="<?= $this->assetUrl('js/forms.js') ?>"></script>
<?php $this->stop('js') ?>