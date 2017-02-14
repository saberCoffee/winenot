<?php $this->layout('layout_dashboard', ['title' => 'Administration des producteurs']) ?>
<?php $this->start('main_content') ?>

<section>

    <ul class="fil-arianne">
        <li><a href="<?= $this->url('dashboard_home') ?>">Accueil</a></li>
		<li>Gérer les producteurs</li>
    </ul>

</section>

<section class="section-with-panels resizeSection">
<div class="container-fluid">
	<ul class="tabs">
		<li id="addProducer" class="active">Ajouter un producteur</li>
		<li id="member-list">Liste des producteurs</li>
	</ul>

	<section class="addProducer active resizeSection">
		<form action="" method="post" class="winemakers">
			<input type="hidden" name="id" value="<?= $winemakers['id']; ?>" />
			<div class="row">
				<div class="col-md-4">
					<label for="">Adresse*</label>
					<input type="text" value="" name="adress" placeholder="" class="form-control" />
				</div>
				<div class="col-md-4">
					<label for="">Ville*</label>
					<input type="text" value="" name="city" placeholder="" class="form-control" />
				</div>
				<div class="col-md-4">
					<label for="">Code Postal*</label>
					<input type="number" value="" name="postcode" placeholder="" class="form-control" />
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<label for="">Siren*</label>
					<input type="number" value="" name="siren" placeholder="" class="form-control" />
				</div>
				<div class="col-md-4">
					<label for="">Région*</label>
					<input type="text" value="" name="domain" placeholder=""  class="form-control"/>
				</div>
				<div class="col-md-4">
					<label for="">N° Téléphone*</label>
					<input type="number" value="" name="tel" placeholder=" " class="form-control" />
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<input type="submit" value="ajouter"  class="btn btn-default"/>
				</div>
			</div>
		</form>
	</section>

	<section class="member-list resizeTable">
	<table border="1" class="table table-striped" id="winemakerList">
		<thead>
		<tr>
			<th class="col-sm-2">Prénom</th>
			<th class="col-sm-2">Nom</th>
			<th class="col-sm-1">Siren</th>
			<th class="col-sm-2">Région</th>
			<th class="col-sm-3">Adresse</th>
			<th class="col-sm-3">Ville</th>
			<th class="col-sm-1">Code Postal</th>
			<th class="col-sm-1">N° Téléphone</th>
			<th class="col-sm-1"></th>
		</tr>
		</thead>
		<tbody>
	<?php foreach ($winemakers as $winemaker) : ?>
		<tr>
			<td><?= $winemaker['firstname'];?></td>
			<td><?= $winemaker['lastname'];?></td>
			<td><?= $winemaker['siren'];?></td>
			<td><?= $winemaker['region'];?></td>
			<td><?= $winemaker['address'];?></td>
			<td><?= $winemaker['city'];?></td>
			<td><?= $winemaker['postcode']?></td>
			<td><?= $winemaker['tel']?></td>
			<td class="action"><!--
			--><a href="<?= $this->url('winemaker_profile', ['id' => $winemaker['winemaker_id']]) ?>"><img width="20" src="<?= $this->assetUrl('img/dashboard/user.png') ?>" alt="modifier"></a><!--
			 --><a href="<?= $this->url('winemakers', ['id' => $winemaker['winemaker_id']]) ?>"><img width="20" src="<?= $this->assetUrl('img/dashboard/delete.png') ?>" alt="supprimer"></a>
			</td>
		</tr>
	<?php endforeach;?>
		</tbody>
	</table>
	</section>
</div>
</section>


<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
<script src="<?= $this->assetUrl('js/forms.js') ?>"></script>
<script type="text/javascript">

	var headertext = [],
	headers = document.querySelectorAll("#winemakerList th"),
	tablerows = document.querySelectorAll("#winemakerList th"),
	tablebody = document.querySelector("#winemakerList tbody");

	for(var i = 0; i < headers.length; i++) {
	  var current = headers[i];
	  headertext.push(current.textContent.replace(/\r?\n|\r/,""));
	}
	for (var i = 0, row; row = tablebody.rows[i]; i++) {
	  for (var j = 0, col; col = row.cells[j]; j++) {
	    col.setAttribute("data-th", headertext[j]);
	  }
	}

</script>
<?php $this->stop('js') ?>
