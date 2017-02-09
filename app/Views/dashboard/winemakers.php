<?php $this->layout('layout_dashboard', ['title' => 'Tous nos producteurs']) ?>
<?php $this->start('main_content') ?>

<div id="onglet" class="container">
	<ul class="tab">
		<li class="active">Ajouter un producteur</li>
		<li>Liste des producteurs</li>
	</ul>
	<section class="addProducer">
		<form action="" method="post" class="winemakers">
			<input type="hidden" name="id" value="<?= $members['id']; ?>" />
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
				<div class="col-md-4">
					<label for="">Siren</label>
					<input type="number" value="" name="siren" placeholder="sinen" class="form-control" />
				</div>
				<div class="col-md-4">
					<label for="">domain</label>
					<input type="text" value="" name="domain" placeholder="domain"  class="form-control"/>
				</div>
				<div class="col-md-4">
					<label for="">N° Téléphone</label>
					<input type="number" value="" name="tel" placeholder="numéro de téléphone" class="form-control" />
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<input type="submit" value="ajouter"  class="btn btn-default"/>
				</div>
			</div>
		</form>
	</section>


	<section class="member-list">
	<table border="1" class="table table-striped">
		<tr>
			<th>Siren</th>
			<th>Domain</th>
			<th>Adresse</th>
			<th>Viille</th>
			<th>Code Postale</th>
			<th>N° Téléphone</th>
			<th></th>
		</tr>
	<?php foreach ($winemakers as $winemaker) : ?>
		<tr>
			<td><?= $winemaker['siren'];?></td>
			<td><?= $winemaker['domain'];?></td>
			<td><?= $winemaker['address'];?></td>
			<td><?= $winemaker['city'];?></td>
			<td><?= $winemaker['postcode']?></td>
			<td><?= $winemaker['tel']?></td>
			<td class="action"><!--
			 --><a href="<?= $this->url('winemakers', ['id' => $winemaker['winemakers_id']]) ?>"><img width="20" src="<?= $this->assetUrl('img/dashboard/user.png') ?>" alt="modifier"></a><!--<!--
			 --><a href="<?= $this->url('winemakers', ['id' => $winemaker['winemakers_id']]) ?>"><img width="20" src="<?= $this->assetUrl('img/dashboard/edit.png') ?>" alt="modifier"></a><!--
			 --><a href="<?= $this->url('winemakers', ['id' => $winemaker['winemakers_id']]) ?>"><img width="20" src="<?= $this->assetUrl('img/dashboard/delete.png') ?>" alt="supprimer"></a>
			</td>
		</tr>
	<?php endforeach;?>
	</table>
	</section>
</div>


<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
    <script src="<?= $this->assetUrl('js/forms.js') ?>"></script>
    <script src="<?= $this->assetUrl('js/dashboard.js') ?>"></script>

<?php $this->stop('js') ?>
