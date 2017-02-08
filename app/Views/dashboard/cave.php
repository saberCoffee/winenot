<?php $this->layout('layout_dashboard', ['title' => 'Ma cave']) ?>

<?php $this->start('main_content') ?>


<section id="cave">
		<ul class="tab">
			<li class="active">Ajout de produit</li>
			<li>Mes stocks</li>
		</ul>
	<section class="addProduct active">
		<form method="POST">
			<div class="form-group">
						<label for="product">Nom du produit</label>
						<input type="text" name="name" class="form-control" value="<?= $name; ?>" required="required">
						<span class="help-block" <?php if (empty($error['name'])) { echo 'style="display: none"'; } ?>>
                        <?php if (isset($error['name'])) { echo $error['name']; } ?>
                   		 </span>
			</div>

			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="color">Couleur</label>
						<select name="color" class="form-control" value="<?= $color; ?>">
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
					<div class="form-group">
						<label for="price">Prix (en euro)</label>
						<input type="text" name="price" class="form-control" value="<?= $price; ?>">
						<span class="help-block" <?php if (empty($error['price'])) { echo 'style="display: none"'; } ?>>
                        <?php if (isset($error['price'])) { echo $error['price']; } ?>
                   		 </span>
					</div>
				</div>

				<div class="col-md-4 ">
					<div class="form-group">
						<label for="millesime">Millesime</label>
						<input type="text" name="millesime" class="form-control" value="<?= $millesime; ?>">
						<span class="help-block" <?php if (empty($error['millesime'])) { echo 'style="display: none"'; } ?>>
                        <?php if (isset($error['millesime'])) { echo $error['millesime']; } ?>
                   		</span>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="cepage">Cépage</label>
						<input type="text" name="cepage" class="form-control" value="<?= $cepage; ?>">
						<span class="help-block" <?php if (empty($error['cepage'])) { echo 'style="display: none"'; } ?>>
                        <?php if (isset($error['cepage'])) { echo $error['cepage']; } ?>
                   		</span>
					</div>
				</div>

				<div class="col-md-4 ">
					<div class="form-group">
						<label for="stock">Stock</label>
						<input type="text" name="stock" class="form-control" value="<?= $stock; ?>">
						<span class="help-block" <?php if (empty($error['stock'])) { echo 'style="display: none"'; } ?>>
                        <?php if (isset($error['stock'])) { echo $error['stock']; } ?>
                   		</span>
					</div>
				</div>

				<div class="col-md-4">
					<label for="bio">Vin bio</label>
					<input type="checkbox" name="bio">
				</div>
			</div>

			<div class="addPics">
				<p>photo du produit</p>

				<img src="<?= $this->assetUrl('img/dashboard/pic.png'); ?>" alt="photo du produit">
				<input type="file" name="picsProduct" value="">
			</div>

			<div>
				<input type="hidden" name="winemaker_id" value="e3e6747f8834d39724bbde3b5b133996">
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
				  <th>Stocks</th>
				  <th></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Cabernet Sauvignon</td>
					<td>Rouge</td>
					<td>2015</td>
					<td>/</td>
					<td>4,50 €</td>
					<td><img width="20" src="<?= $this->assetUrl('img/dashboard/checked.png') ?>" alt="en stock"></td>
					<td>
						<a href="#"><img width="20" src="<?= $this->assetUrl('img/dashboard/edit.png') ?>" alt="modifier"></a>
						<a href="#"><img width="20" src="<?= $this->assetUrl('img/dashboard/delete.png') ?>" alt="supprimer"></a>
					</td>
				</tr>

				<tr>
					<td>Merlot </td>
					<td>Rosé</td>
					<td>2015</td>
					<td>/</td>
					<td>3,20 €</td>
					<td><img width="20" src="<?= $this->assetUrl('img/dashboard/unchecked.png') ?>" alt="épuisé"></td>
					<td>
						<a href="#"><img width="20" src="<?= $this->assetUrl('img/dashboard/edit.png') ?>" alt="modifier"></a>
						<a href="#"><img width="20" src="<?= $this->assetUrl('img/dashboard/delete.png') ?>" alt="supprimer"></a>
					</td>
				</tr>

				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td>
						<a href="#"><img width="20" src="<?= $this->assetUrl('img/dashboard/edit.png') ?>" alt="modifier"></a>
						<a href="#"><img width="20" src="<?= $this->assetUrl('img/dashboard/delete.png') ?>" alt="supprimer"></a>
					</td>
				</tr>

				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td>
						<a href="#"><img width="20" src="<?= $this->assetUrl('img/dashboard/edit.png') ?>" alt="modifier"></a>
						<a href="#"><img width="20" src="<?= $this->assetUrl('img/dashboard/delete.png') ?>" alt="supprimer"></a>
					</td>
				</tr>

				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td>
						<a href="#"><img width="20" src="<?= $this->assetUrl('img/dashboard/edit.png') ?>" alt="modifier"></a>
						<a href="#"><img width="20" src="<?= $this->assetUrl('img/dashboard/delete.png') ?>" alt="supprimer"></a>
					</td>
				</tr>

				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td>
						<a href="#"><img width="20" src="<?= $this->assetUrl('img/dashboard/edit.png') ?>" alt="modifier"></a>
						<a href="#"><img width="20" src="<?= $this->assetUrl('img/dashboard/delete.png') ?>" alt="supprimer"></a>
					</td>
				</tr>

				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td>
						<a href="#"><img width="20" src="<?= $this->assetUrl('img/dashboard/edit.png') ?>" alt="modifier"></a>
						<a href="#"><img width="20" src="<?= $this->assetUrl('img/dashboard/delete.png') ?>" alt="supprimer"></a>
					</td>
				</tr>

				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td>
						<a href="#"><img width="20" src="<?= $this->assetUrl('img/dashboard/edit.png') ?>" alt="modifier"></a>
						<a href="#"><img width="20" src="<?= $this->assetUrl('img/dashboard/delete.png') ?>" alt="supprimer"></a>
					</td>
				</tr>

				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td>
						<a href="#"><img width="20" src="<?= $this->assetUrl('img/dashboard/edit.png') ?>" alt="modifier"></a>
						<a href="#"><img width="20" src="<?= $this->assetUrl('img/dashboard/delete.png') ?>" alt="supprimer"></a>
					</td>
				</tr>

				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td>
						<a href="#"><img width="20" src="<?= $this->assetUrl('img/dashboard/edit.png') ?>" alt="modifier"></a>
						<a href="#"><img width="20" src="<?= $this->assetUrl('img/dashboard/delete.png') ?>" alt="supprimer"></a>
					</td>
				</tr>

				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td>
						<a href="#"><img width="20" src="<?= $this->assetUrl('img/dashboard/edit.png') ?>" alt="modifier"></a>
						<a href="#"><img width="20" src="<?= $this->assetUrl('img/dashboard/delete.png') ?>" alt="supprimer"></a>
					</td>
				</tr>

				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td>
						<a href="#"><img width="20" src="<?= $this->assetUrl('img/dashboard/edit.png') ?>" alt="modifier"></a>
						<a href="#"><img width="20" src="<?= $this->assetUrl('img/dashboard/delete.png') ?>" alt="supprimer"></a>
					</td>
				</tr>

				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td>
						<a href="#"><img width="20" src="<?= $this->assetUrl('img/dashboard/edit.png') ?>" alt="modifier"></a>
						<a href="#"><img width="20" src="<?= $this->assetUrl('img/dashboard/delete.png') ?>" alt="supprimer"></a>
					</td>
				</tr>

				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td>
						<a href="#"><img width="20" src="<?= $this->assetUrl('img/dashboard/edit.png') ?>" alt="modifier"></a>
						<a href="#"><img width="20" src="<?= $this->assetUrl('img/dashboard/delete.png') ?>" alt="supprimer"></a>
					</td>
				</tr>

				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td>
						<a href="#"><img width="20" src="<?= $this->assetUrl('img/dashboard/edit.png') ?>" alt="modifier"></a>
						<a href="#"><img width="20" src="<?= $this->assetUrl('img/dashboard/delete.png') ?>" alt="supprimer"></a>
					</td>
				</tr>

				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td>
						<a href="#"><img width="20" src="<?= $this->assetUrl('img/dashboard/edit.png') ?>" alt="modifier"></a>
						<a href="#"><img width="20" src="<?= $this->assetUrl('img/dashboard/delete.png') ?>" alt="supprimer"></a>
					</td>
				</tr>
			</tbody>
		</table>
	</section>
</section>

<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
    <script src="<?= $this->assetUrl('js/forms.js') ?>" type="text/javascript"></script>
<?php $this->stop('js') ?>
