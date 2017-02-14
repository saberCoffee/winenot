<?php $this->layout('layout_dashboard', ['title' => 'Ma cave']) ?>

<?php $this->start('main_content') ?>
<?php if (!empty($_COOKIE['successMsg'])) { ?>
	<section>
		<div class="alert alert-success"><?= $_COOKIE['successMsg'] ?></div>
	</section>
<?php } ?>

<div id="imageCrop-mask">
	<div></div>
</div>

<section class="section-with-panels">

	<ul class="tabs">
		<li id="addProduct" class="active">Éditer votre produit</li>
		<li id="stock">Mes vins</li>
	</ul>

	<section class="addProduct active">
		<div class="row">
			<div class="col-md-3">
				<img src="<?= $this->assetUrl('content/photos/products/' . $product['photo']) ?>" alt="<?= $product['name'] ?>" width="150" />
			</div>
			<div class="col-md-9">
				<dl>
					<dt>Nom</dt><dd><?= $product['name'] ?></dd>
					<dt>Couleur</dt><dd><?= $product['couleur'] ?></dd>
					<dt>Prix</dt><dd><?= $product['price'] ?></dd>
					<dt>Millésime</dt><dd><?= $product['millesime'] ?></dd>
					<dt>Cépage</dt><dd><?= $product['cepage'] ?></dd>
				</dl>
			</div>
		</div>

		<form method="post" action="<?= $this->url('cave_edit', ['id' => $product['id']]) ?>" enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group <?php if (isset($error['price'])) { echo 'has-error'; } ?>">
						<label for="price">Prix (en euro)*</label>
						<input type="text" name="price" id="price" class="form-control" value="<?= $price; ?>" required="required">
						<span class="help-block" <?php if (empty($error['price'])) { echo 'style="display: none"'; } ?>>
                        <?php if (isset($error['price'])) { echo $error['price']; } ?>
                   		 </span>
					</div>
				</div>

				<div class="col-md-4 ">
					<div class="form-group <?php if (isset($error['stock'])) { echo 'has-error'; } ?>">
						<label for="stock">Stock*</label>
						<input type="text" name="stock" id="stock" class="form-control" value="<?= $stock; ?>" required="required">
						<span class="help-block" <?php if (empty($error['stock'])) { echo 'style="display: none"'; } ?>>
                        <?php if (isset($error['stock'])) { echo $error['stock']; } ?>
                   		</span>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-8">
					<div class="descriptionProduct">
						<div class="form-group <?php if (isset($error['description'])) { echo 'has-error'; } ?>">
							<label for="description">Description de votre produit*</label>
  							<textarea class="form-control"  id="description" name="description" required="required" data-max="200" maxlength="200"><?= $description ?></textarea>
							<span class="help-block" <?php if (empty($error['description'])) { echo 'style="display: none"'; } ?>>
	                        <?php if (isset($error['description'])) { echo $error['description']; } ?>
	                   		</span>
						</div>
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group <?php if (isset($error['photo'])) { echo 'has-error'; } ?>">
						<div class="productPics" id="productPics">
							<label for="photo">Photo de votre produit*</label>
							<span class="help-block" <?php if (empty($error['photo'])) { echo 'style="display: none"'; } ?>>
							<?php if (isset($error['photo'])) { echo $error['photo']; } ?>
							</span>

							<span class="btn btn-default btn-file">Parcourir
								<input type="file" id="photo" name="photo" accept="image/*" />
							</span>

							<?php if (!empty($product['photo'])): ?>
								<input type="hidden" name="currentPhoto" value="<?= $product['photo'] ?>" />
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
			</div>

			<div>
				<input type="submit" class="btn btn-default" value="Modifier">
			</div>
		</form>
	</section>


	<section class="stock">
		<table border="1" class="table table-striped" id="profileCave">
			<thead>
				<tr>
					<th>Produits</th>
					<th>Couleurs</th>
					<th>Millesimes</th>
					<th>Vins bio</th>
					<th>Prix</th>
					<th>Cépage</th>
					<th>Stocks</th>
					<th></th>
				</tr>
			</thead>
			<tbody>

				<?php foreach ($products as $product) : ?>
				<tr>
					<td><?= $product['name'];?></td>
					<td><?= $product['couleur'];?></td>
					<td><?= $product['millesime']?></td>
					<td><?= $product['is_bio']?></td>
					<td><?= $product['price']?></td>
					<td><?= $product['cepage']?></td>
					<td><?= $product['stock']?></td>
					<td>
						<a href="<?= $this->url('cave_edit', ['id' => $product['id']]) ?>"><img width="20" src="<?= $this->assetUrl('img/dashboard/edit.png') ?>" alt="modifier"></a>
						<a href=""><img width="20" src="<?= $this->assetUrl('img/dashboard/delete.png') ?>" alt="supprimer"></a>
					</td>
				</tr>
				<?php endforeach;?>
        	</tbody>
		</table>
	</section>
</section>

<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
<script src="<?= $this->assetUrl('js/forms.js') ?>" type="text/javascript"></script>
<script src="<?= $this->assetUrl('js/jquery.Jcrop.min.js') ?>" type="text/javascript"></script>
<script src="<?= $this->assetUrl('js/jquery.color.js') ?>" type="text/javascript"></script>
<script src="<?= $this->assetUrl('js/imageCrop.js') ?>" type="text/javascript"></script>
<script type="text/javascript">
	var headertext = [],
	headers = document.querySelectorAll("#profileCave th"),
	tablerows = document.querySelectorAll("#profileCave th"),
	tablebody = document.querySelector("#profileCave tbody");

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

<?php $this->start('css') ?>
<link rel="stylesheet" href="<?= $this->assetUrl('css/jquery.Jcrop.css') ?>" type="text/css">
<?php $this->stop('css') ?>
