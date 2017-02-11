<?php $this->layout('layout_dashboard', ['title' => $product['name'] . ' ' . $product['millesime']]) ?>
<?php $this->start('main_content') ?>



		<section class="ficheProduit active">
			<div class="row">
				<div class="col-md-4">
 					<div class="produitImg">
						<img src="<?= $this->assetUrl('img/vinBouteille.jpg') ?>">
					</div>
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
		 							<td><?= $product['winemaker']['firstname'] . ' ' . $product['winemaker']['lastname'] 	?></td>
		 						</tr>
		 						<tr>
		 							<td><strong>Prix :</strong></td>
		 							<td><?= $product['price'] ?></td>
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
