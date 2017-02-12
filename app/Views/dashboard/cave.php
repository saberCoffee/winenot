<?php $this->layout('layout_dashboard', ['title' => 'Gérer ma cave']) ?>

<?php $this->start('main_content') ?>
<?php if (!empty($_COOKIE['successMsg'])) { ?>
	<div class="alert alert-success"><?= $_COOKIE['successMsg'] ?></div>
<?php } ?>

<div id="imageCrop-mask">
	<div></div>
</div>

<section>
	<p>
		Dans cette section, vous pouvez ajouter de nouveaux produits à votre cave ou bien les modifier. Il n'y que vous qui y avez accès.
	</p>
	<p>
		<a href="<?= $this->url('winemaker_profile', ['id' =>  $_SESSION['user']['id']]) ?>">Consulter mon profil producteur</a>
	</p>
</section>

<section class="section-with-panels">

	<ul class="tabs">
		<li id="addProduct" class="active">Ajout de produit</li>
		<li id="stock">Mes vins</li>
	</ul>

	<section class="addProduct active">
		<form method="post" action="<?= $this->url('cave') ?>" enctype="multipart/form-data">
			<div class="form-group <?php if (isset($error['name'])) { echo 'has-error'; } ?>">
				<label for="product">Nom du produit*</label>
				<input type="text" name="name" id="name" class="form-control" value="<?= $name; ?>" data-min="3" data-max="50" required="required">
				<span class="help-block" <?php if (empty($error['name'])) { echo 'style="display: none"'; } ?>>
                <?php if (isset($error['name'])) { echo $error['name']; } ?>
           		 </span>
			</div>

			<div class="row">
				<div class="col-md-4">
					<div class="form-group <?php if (isset($error['color'])) { echo 'has-error'; } ?>">
						<label for="color">Couleur*</label>
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
						<label for="price">Prix (en euro)*</label>
						<input type="text" name="price" id="price" class="form-control" value="<?= $price; ?>" required="required">
						<span class="help-block" <?php if (empty($error['price'])) { echo 'style="display: none"'; } ?>>
                        <?php if (isset($error['price'])) { echo $error['price']; } ?>
                   		 </span>
					</div>
				</div>

				<div class="col-md-4 ">
					<div class="form-group <?php if (isset($error['millesime'])) { echo 'has-error'; } ?>">
						<label for="millesime">Millesime*</label>
						<input type="text" name="millesime" id="millesime" class="form-control" value="<?= $millesime; ?>" data-min="4" data-max="4" maxlength="4" required="required">
						<span class="help-block" <?php if (empty($error['millesime'])) { echo 'style="display: none"'; } ?>>
                        <?php if (isset($error['millesime'])) { echo $error['millesime']; } ?>
                   		</span>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<div class="form-group <?php if (isset($error['cepage'])) { echo 'has-error'; } ?>">
						<label for="cepage">Cépage*</label>
						<input type="text" name="cepage" id="cepage" class="form-control" value="<?= $cepage; ?>" data-min="3" data-max="16" required="required">
						<span class="help-block" <?php if (empty($error['cepage'])) { echo 'style="display: none"'; } ?>>
                        <?php if (isset($error['cepage'])) { echo $error['cepage']; } ?>
                   		</span>
					</div>
				</div>

				<div class="col-md-4 ">
					<div class="form-group <?php if (isset($error['stock'])) { echo 'has-error'; } ?>">
						<label for="stock">Stock*</label>
						<input type="text" name="stock" id="stock" class="form-control" value="<?= $stock; ?>" data-min="1" required="required">
						<span class="help-block" <?php if (empty($error['stock'])) { echo 'style="display: none"'; } ?>>
                        <?php if (isset($error['stock'])) { echo $error['stock']; } ?>
                   		</span>
					</div>
				</div>

				<div class="col-md-4">
					<label for="bio"><input type="radio" name="bio" id="bio">Vin bio</label>

				</div>
			</div>

			<div class="row">
				<div class="col-md-8">
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
						<label for="photo">Photo de votre produit*</label>
						<span class="help-block" <?php if (empty($error['photo'])) { echo 'style="display: none"'; } ?>>
						<?php if (isset($error['photo'])) { echo $error['photo']; } ?>
						</span>

						<input type="file" id="photo" name="photo" accept="image/*" />

						<input type="hidden" id="resizeW" name="resizeW" />
						<input type="hidden" id="resizeH" name="resizeH" />
						<input type="hidden" id="x" name="x" />
						<input type="hidden" id="y" name="y" />
						<input type="hidden" id="w" name="w" />
						<input type="hidden" id="h" name="h" />
					</div>
					<!--
					 <div class="productPics">
						<img src="<?= $this->assetUrl('img/dashboard/pic.png'); ?>" alt="photo du produit">
    					<span class="btn btn-default btn-file">Parcourir<input type="file"></span>
    				</div>-->
				</div>

			</div>

			<div>
				<input type="submit" class="btn btn-default" value="Ajouter à votre cave" />
			</div>

		</form>
	</section>

	<section class="stock">
		<table border="1" class="table table-striped">
			<thead>
				<tr class="col-sm-6">
					<th class="col-sm-6">Produits</th>
					<th class="col-sm-6">Couleurs</th>
					<th class="col-sm-6">Millesimes</th>
					<th class="col-sm-6">Vins bio</th>
					<th class="col-sm-6">Prix</th>
					<th class="col-sm-6">Cépage</th>
					<th class="col-sm-6">Stocks</th>
					<th class="col-sm-6"></th>
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
<?php $this->stop('js') ?>

<?php $this->start('css') ?>
<link rel="stylesheet" href="<?= $this->assetUrl('css/jquery.Jcrop.css') ?>" type="text/css">
<?php $this->stop('css') ?>
