<?php $this->layout('layout_dashboard', ['title' => 'Tous nos producteurs']) ?>
<?php $this->start('main_content') ?>

<div class="container-fluid">
	
	<form action="" method="post" class="members">
		<h2>Ajouter un producteur</h2>
		<input type="hidden" name="id" value="<?= $members['id']; ?>" />
		<div class="form-group">
			<label for="">Siren</label>
			<input type="number" value="" name="siren" placeholder="sinen" class="form-control" />
			<label for="">domain</label>
			<input type="text" value="" name="domain" placeholder="domain"  class="form-control"/>
		</div>
		<div class="form-group">
		<label for="">Adresse</label>
		<input type="text" value="" name="adress" placeholder="adresse" class="form-control" />
		<label for="">Ville</label>
		<input type="text" value="" name="city" placeholder="ville" class="form-control" />
				</div>
		<div class="form-group">
		<label for="">Code Postale</label>
		<input type="number" value="" name="postcode" placeholder="code postale" class="form-control" />
		<label for="">N° Téléphone</label>
		<input type="number" value="" name="tel" placeholder="numéro de téléphone" class="form-control" />
		<input type="submit" value="ajouter"  class="btn btn-default"/>
		</div>
	</form>
		
	<h2 class="members">Liste des producteurs</h2>
	<table class="table table-bordered">
		<tr>
			<th>Siren</th>
			<th>Domain</th>
			<th>Adresse</th>
			<th>Viille</th>
			<th>Code Postale</th>
			<th>N° Téléphone</th>
			<th colspan="3">Action</th>
		</tr>
	<?php foreach ($winemakers as $winemaker) : ?>
		<tr>
			<td><?= $winemaker['siren'];?></td>
			<td><?= $winemaker['domain'];?></td>
			<td><?= $winemaker['adress'];?></td>
			<td><?= $winemaker['city'];?></td>
			<td><?= $winemaker['postcode']?></td>
			<td><?= $winemaker['tel']?></td>
			<td class="action"><a href="<?= $this->url('winemakers', ['id' => $member['winemaker_id']]) ?>" style="color:black"><i class="fa fa-user" aria-hidden="true"></i></a> |<a href="<?= $this->url('winemakers', ['id' => $winemaker['winemakers_id']]) ?>" style="color:green"><i class="fa fa-pencil" aria-hidden="true"></i></a> | <a href="<?= $this->url('winemakers', ['id' => $winemaker['winemaker_id']]) ?>" style="color:red"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
			</tr>
	<?php endforeach;?>
</div>


<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
    <script src="<?= $this->assetUrl('js/forms.js') ?>"></script>
<?php $this->stop('js') ?>