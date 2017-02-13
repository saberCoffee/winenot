<?php $this->layout('layout_dashboard', ['title' => $product['name'] . ' ' . $product['millesime']]) ?>
<?php $this->start('main_content') ?>
<!-- <div class="container">
	<div class="row">
		<div class="cadre">
			<p>Nom : <?= $product['name'] ?></p>
			<p>Cépage : <?= $product['cepage'] ?></p>
			<p>Millésime : <?= $product['millesime'] ?></p>
			<p>Région : <?= $product['region'] ?></p>
			<p>Producteur : <?= $product['winemaker_id'] ?></p>
			<p>Prix : <?= $product['price'] ?></p>
			<p>Stock : <?= $product['stock'] ?></p>
			<p>Reviews : <?= $product['reviews_id'] ?></p>
		</div>
	</div>
</div> -->

<?php debug($product['winemaker']) ?>

<section class="ficheProduit active">

	<ul class="fil-arianne">
		<li><a href="<?= $this->url('products') ?>">Retourner à nos vins</a></li>
	</ul>

	<div class="row">
		<div class="col-md-4">
			<div class="produitImg">
				<img src="<?= $this->assetUrl('content/photos/products/' . $product['photo']) ?>" alt="<?= $product['name'] ?>" />
			</div>
			<!--<img src="<?= $this->assetUrl('img/dashboard/favorite.png') ?>" class="img-favorite">-->
		</div>
		<div class="col-md-8">
			<div class="tableau">
				<table class="table table-striped" >
					<tbody>
 						<tr>
 						   <td><strong>Nom :</strong></td>
 						   <td><?= $product['name'] ?></td>
 						</tr>

 						<tr>
 						  	<td><strong>Cépage :</strong></td>
 						  	<td><?= $product['cepage'] ?></td>
 						</tr>

 						<tr>
 						  	<td><strong>Millésime :</strong></td>
 						  	<td><?= $product['millesime'] ?></td>
 						</tr>

 						<tr>
 						  	<td><strong>Région :</strong></td>
 						  	<td><?= $product['region'] ?></td>
 						</tr>

 						<tr>
 							<td><strong>Producteur :</strong></td>
 							<td><i class="fa fa-user" aria-hidden="true"></i> <a href="<?= $this->url('winemaker_profile', ['id' => $product['winemaker']['id']])?>"><?= $product['winemaker']['firstname'] . ' ' . $product['winemaker']['lastname'] ?></a></td>
 						</tr>
 						<tr>
 							<td><strong>Prix :</strong></td>
 							<td><?= $product['price'] ?>€</td>
 						</tr>
 						<tr>
 							<td><strong>Stock :</strong></td>
 							<td><?= $product['stock'] ?></td>
 						</tr>
 						<tr>
 						  	<td><strong>Reviews :</strong></td>
 						    <td><?= $product['reviews_id'] ?></td>
 						</tr>
					</tbody>
		  		</table>
	  		</div>
			</div>
		</div>
</section>

<!-- <?php
debug($product);

?> -->

<?php $this->stop('main_content') ?>
