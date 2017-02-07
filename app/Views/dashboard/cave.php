<?php $this->layout('layout_dashboard', ['title' => 'Ma cave']) ?>

<?php $this->start('main_content') ?>


<section id="cave">
		<ul class="tab">
			<li>Ajout de produit</li>
			<li>Mes stocks</li>
		</ul>
	<section class="addProduct">
		<form>		
			<div class="form-group">
						<label for="product">Nom du produit</label>
						<input type="text" name="Product" class="form-control">
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="color">Couleur</label>
						<input type="text" name="color" class="form-control">
					</div>	
				</div>

				<div class="col-md-4 ">
					<div class="form-group">
						<label for="price">Prix</label>
						<input type="text" name="price" class="form-control">
					</div>
				</div>

				<div class="col-md-4 ">
					<div class="form-group">
						<label for="millesime">Millesime</label>
						<input type="text" name="millesime" class="form-control">
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="cepage">Cépage</label>
						<input type="text" name="cepage" class="form-control">
					</div>
				</div>

				<div class="col-md-4 ">
					<div class="form-group">
						<label for="stock">Stock</label>
						<input type="text" name="stock" class="form-control">
					</div>
				</div>

				<div class="col-md-4">
					<label for="bio">Vin bio</label>
					<input type="checkbox">
				</div>
			</div>

			<div class="addPics">
				<p>photo du produit</p>
				
				<img src="../assets/img/pic.png" alt="photo du produit">
				<input type="file" name="picsProduct" value="">
			</div>

			<div>
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
    <script src="<?= $this->assetUrl('js/main.js') ?>" type="text/javascript"></script>
<?php $this->stop('js') ?>
