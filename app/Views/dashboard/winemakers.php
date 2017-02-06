<?php $this->layout('layout_dashboard', ['title' => 'Tous nos producteurs']) ?>
<?php $this->start('main_content') ?>

<div class="container-fluid">
			<input type="hidden" name="id" value="<?= $winemakers['id']; ?>" />
	<table class="table table-bordered">
		<tr>
			<th>Siren</th>
			<th>Domain</th>
			<th>Adresse</th>
			<th>Code Postale</th>
			<th colspan="3">Action</th>
		</tr>
	<?php foreach ($winemakers as $winemaker) : ?>
		<tr>
			<td><?= $winemaker['siren'];?></td>
			<td><?= $winemaker['domain'];?></td>
			<td><?= $winemaker['adress'];?></td>
			<td><?= $winemaker['postcode']?></td>
			<td><a href="<?= $this->url('winemakers', ['id' => $winemaker['winemakers_id']]) ?>" style="color:green">Modifier</a> | <a href="<?= $this->url('winemakers', ['id' => $winemaker['winemaker_id']]) ?>">Supprimer</a></td>
			</tr>
	<?php endforeach;?>
</div>


<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
    <script src="<?= $this->assetUrl('js/forms.js') ?>"></script>
<?php $this->stop('js') ?>