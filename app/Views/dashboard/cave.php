<?php $this->layout('layout_dashboard', ['title' => 'Ma cave']) ?>

<?php $this->start('main_content') ?>
<h1>Ma cave</h1>


	<section class="addProduct">
		<h2>Ajout de produit</h2>
	
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

<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
    <script src="<?= $this->assetUrl('js/main.js') ?>" type="text/javascript"></script>
<?php $this->stop('js') ?>
