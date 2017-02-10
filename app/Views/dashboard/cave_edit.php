<?php $this->layout('layout_dashboard', ['title' => 'Ma cave']) ?>

<?php $this->start('main_content') ?>

<?php if (!empty($_COOKIE['successMsg'])) { ?>
	<div class="alert alert-success"><?= $_COOKIE['successMsg'] ?></div>
<?php } ?>

<section class="section-with-panels">

	<ul class="tabs">
		<li id="addProduct" class="active">Éditer votre produit</li>
		<li id="stock">Mes stocks</li>
	</ul>

	<section class="addProduct active">
		<dl>
			<dt>Nom</dt><dd><?= $product['name'] ?></dd>
			<dt>Couleur</dt><dd><?= $product['couleur'] ?></dd>
			<dt>Prix</dt><dd><?= $product['price'] ?></dd>
			<dt>Millésime</dt><dd><?= $product['millesime'] ?></dd>
			<dt>Cépage</dt><dd><?= $product['cepage'] ?></dd>
		</dl>

		<form method="post" action="<?= $this->url('cave_edit', ['id' => $product['id']]) ?>">
			<div class="row">
				<div class="col-md-4 ">
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
				<div class="col-md-8">
					<div class="descriptionProduct">
						<div class="form-group <?php if (isset($error['description'])) { echo 'has-error'; } ?>">
							<label for="description">Description de votre produit*</label>
  							<textarea class="form-control"  id="description" name="description" required="required" data-max="200" maxlength="200"></textarea>
							<span class="help-block" <?php if (empty($error['description'])) { echo 'style="display: none"'; } ?>>
	                        <?php if (isset($error['description'])) { echo $error['description']; } ?>
	                   		</span>
						</div>
					</div>
				</div>

				<div class="col-md-4">
					 <div class="productPics">
						<img src="<?= $this->assetUrl('img/dashboard/pic.png'); ?>" alt="photo du produit">
						<span class="btn btn-default btn-file">Parcourir<input type="file"></span>
					</div>
				</div>
			</div>

			<div>
				<input type="submit" class="btn btn-default" value="Modifier">
			</div>
		</form>
	</section>


	<section class="stock">
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
<?php $this->stop('js') ?>
