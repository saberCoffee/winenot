<?php $this->layout('layout_dashboard', ['title' => 'Ma cave']) ?>

<?php $this->start('main_content') ?>

<section id="cave">

	<?php if (!empty($_COOKIE['successMsg'])) { ?>
	<div class="alert alert-success"><?= $_COOKIE['successMsg'] ?></div>
	<?php } ?>

	<ul class="tab">
		<li class="active">Ajout de produit</li>
		<li>Mes stocks</li>
	</ul>

	<section class="addProduct active">
		<form method="post" action="<?= $this->url('cave') ?>">
			<div class="form-group <?php if (isset($error['name'])) { echo 'has-error'; } ?>">
				<label for="product">Nom du produit</label>
				<input type="text" name="name" id="name" class="form-control" value="<?= $name; ?>" data-min="3" data-max="50" required="required">
				<span class="help-block" <?php if (empty($error['name'])) { echo 'style="display: none"'; } ?>>
                <?php if (isset($error['name'])) { echo $error['name']; } ?>
           		 </span>
			</div>

			<div class="row">
				<div class="col-md-4">
					<div class="form-group <?php if (isset($error['color'])) { echo 'has-error'; } ?>">
						<label for="color">Couleur</label>
						<select name="color" id="color" class="form-control" value="<?= $color; ?>" required="required">
							<option value="">-- Selectionner --</option>
							<option value="Blanc" <?php if ($color == 'Blanc') echo 'selected' ?>>Blanc</option>
							<option value="Rosé"  <?php if ($color == 'Rosé') echo 'selected' ?>>Rosé</option>
							<option value="Rouge" <?php if ($color == 'Rouge') echo 'selected'?>>Rouge</option>
						</select>
						<span class="help-block" <?php if (empty($error['color'])) { echo 'style="display: none"'; } ?>>
                        <?php if (isset($error['color'])) { echo $error['color']; } ?>
                   		</span>
					</div>
				</div>

				<div class="col-md-4 ">
					<div class="form-group <?php if (isset($error['price'])) { echo 'has-error'; } ?>">
						<label for="price">Prix (en euro)</label>
						<input type="text" name="price" id="price" class="form-control" value="<?= $price; ?>" required="required">
						<span class="help-block" <?php if (empty($error['price'])) { echo 'style="display: none"'; } ?>>
                        <?php if (isset($error['price'])) { echo $error['price']; } ?>
                   		 </span>
					</div>
				</div>

				<div class="col-md-4 ">
					<div class="form-group <?php if (isset($error['millesime'])) { echo 'has-error'; } ?>">
						<label for="millesime">Millesime</label>
						<input type="text" name="millesime" id="millesime" class="form-control" value="<?= $millesime; ?>" data-min="4" data-max="4" required="required">
						<span class="help-block" <?php if (empty($error['millesime'])) { echo 'style="display: none"'; } ?>>
                        <?php if (isset($error['millesime'])) { echo $error['millesime']; } ?>
                   		</span>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<div class="form-group <?php if (isset($error['cepage'])) { echo 'has-error'; } ?>">
						<label for="cepage">Cépage</label>
						<input type="text" name="cepage" id="cepage" class="form-control" value="<?= $cepage; ?>" data-min="3" data-max="16" required="required">
						<span class="help-block" <?php if (empty($error['cepage'])) { echo 'style="display: none"'; } ?>>
                        <?php if (isset($error['cepage'])) { echo $error['cepage']; } ?>
                   		</span>
					</div>
				</div>

				<div class="col-md-4 ">
					<div class="form-group <?php if (isset($error['stock'])) { echo 'has-error'; } ?>">
						<label for="stock">Stock</label>
						<input type="text" name="stock" id="stock" class="form-control" value="<?= $stock; ?>" data-min="2" required="required">
						<span class="help-block" <?php if (empty($error['stock'])) { echo 'style="display: none"'; } ?>>
                        <?php if (isset($error['stock'])) { echo $error['stock']; } ?>
                   		</span>
					</div>
				</div>

				<div class="col-md-4">
					<label for="bio">Vin bio</label>
					<input type="checkbox" name="bio" id="bio">
				</div>
			</div>

			<div class="addPics">
				<p>photo du produit</p>

				<img src="<?= $this->assetUrl('img/dashboard/pic.png'); ?>" alt="photo du produit">
				<input type="file" name="picsProduct" value="">
			</div>

			<div>
			<!-- INPUT HIDDEN TEMPORAIRE -->
				<input type="hidden" name="id" value="1">
				<input type="submit" class="btn btn-default" value="Ajouter">
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
