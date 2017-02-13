<?php $this->layout('layout_dashboard', ['title' => $lang['profile']]) ?>
<?php $this->start('main_content') ?>

<section>

    <ul class="fil-arianne">
        <li><a href="<?= $this->url('winemakers') ?>">Retourner à la recherche de producteurs</a></li>
    </ul>

    <?php if (!empty($_COOKIE['successMsg'])) { ?>
    <div class="alert alert-success" role="alert"><?= $_COOKIE['successMsg'] ?></div>
    <?php } ?>

</section>

<section id="profile" class="section-with-panels">

	<ul class="tabs">
		<li id="view-profile" <?php if (empty($error)) { echo 'class="active"'; } ?>><?= $lang['profile'] ?></li>
		<?php if ($is_allowed_to_edit): ?><li id="edit-profile" <?php if (!empty($error)) { echo 'class="active"'; } ?>><?= $lang['profile_edit'] ?></li><?php endif; ?>
	</ul>

	<section class="view-profile <?php if (empty($error)) { echo 'active'; } ?>">
		<div class="row">
			<div class="col-md-3 vcenter">
				<aside class="user-infos-left">
					<p>
                        <?php if (empty($winemaker['photo'])): ?>
                            <img src="<?= $this->assetUrl('img/dashboard/user2.png') ?>" alt="Avatar_<?= $winemaker['firstname'] . ' ' . $winemaker['lastname'] ?>" class="avatar" width="150" />
                        <?php else: ?>
                            <img src="<?= $this->assetUrl('content/photos/users/' . $winemaker['photo']) ?>" alt="Avatar_<?= $winemaker['firstname'] . ' ' . $winemaker['lastname'] ?>" class="avatar" width="150" />
                        <?php endif; ?>
						<br />
						<span><?= $winemaker['firstname'] . ' ' . $winemaker['lastname'] ?></span>
						<br />
						<span>Membre depuis <?= $register_date ?></span>
					</p>
				</aside>
			</div>

			<div class="col-md-9 vcenter">
				<section class="user-infos-right">
					<dl>
						<dt>Adresse e-mail</dt><dd><?= $winemaker['email'] ?></dd>
						<dt>Adresse</dt><dd><?= $winemaker['address'] ?></dd>
                        <dt>Code Postal</dt><dd><?= $winemaker['postcode'] ?></dd>
						<dt>Ville</dt><dd><?= $winemaker['city'] ?></dd>
						<dt>Région</dt><dd><?= $winemaker['region'] ?></dd>
					</dl>

					<?php if (!$is_owner): ?>
						<p>
							Vous souhaitez discuter avec <?= $winemaker['firstname'] . ' ' . $winemaker['lastname'] ?>, et peut-être lui acheter un produit ?
						</p>
						<p>
							<a href="<?= $this->url('inbox_thread', ['id' => $winemaker['mp_token']]) ?>" class="link-contact"><i class="fa fa-comments" aria-hidden="true"></i> Contacter <?= $winemaker['firstname'] . ' ' . $winemaker['lastname'] ?></a>
						</p>
					<?php endif; ?>
				</section>
			</div>
		</div>



        <section class="view-cave">
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
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($products as $product) : ?>
                    <tr>
                        <td><a href="<?= $this->url('dashboard_product', ['name' => $product['clean_name'], 'id' => $product['id']]) ?>"><?= $product['name'];?></a></td>
                        <td><?= $product['couleur'];?></td>
                        <td><?= $product['millesime']?></td>
                        <td><?= $product['is_bio']?></td>
                        <td><?= $product['price']?></td>
                        <td><?= $product['cepage']?></td>
                        <td><?= $product['stock']?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </section>

	</section>

	<section class="edit-profile <?php if (!empty($error)) { echo 'active'; } ?>">

		<form action="<?= $this->url('winemaker_profile', ['id' => $winemaker['id']]) ?>" method="post">
    		<div class="form-group">
    			<label for="region">Région*</label>
    			<select name="region" id="region" class="form-control" required="required">
    				<option <?php if ($region == 'Alsace') { echo 'selected="selected"'; } ?> value="Alsace">Alsace</option>
    				<option <?php if ($region == 'Bourgogne') { echo 'selected="selected"'; } ?> value="Bourgogne">Bourgogne</option>
    				<option <?php if ($region == 'Bordeaux') { echo 'selected="selected"'; } ?> value="Bordeaux">Bordeaux</option>
    				<option <?php if ($region == 'Beaujolais') { echo 'selected="selected"'; } ?> value="Beaujolais">Beaujolais</option>
    				<option <?php if ($region == 'Bugey') { echo 'selected="selected"'; } ?> value="Bugey">Bugey</option>
    				<option <?php if ($region == 'Champagne') { echo 'selected="selected"'; } ?> value="Champagne">Champagne</option>
    				<option <?php if ($region == 'Corse') { echo 'selected="selected"'; } ?> value="Corse">Corse</option>
    				<option <?php if ($region == 'Jura') { echo 'selected="selected"'; } ?> value="Jura">Jura</option>
    				<option <?php if ($region == 'Languedoc') { echo 'selected="selected"'; } ?> value="Languedoc">Languedoc</option>
    				<option <?php if ($region == 'Lorraine') { echo 'selected="selected"'; } ?> value="Lorraine">Lorraine</option>
    				<option <?php if ($region == 'Loire') { echo 'selected="selected"'; } ?> value="Loire">Loire</option>
    				<option <?php if ($region == 'Provence') { echo 'selected="selected"'; } ?> value="Provence">Provence</option>
    				<option <?php if ($region == 'Roussillon') { echo 'selected="selected"'; } ?> value="Roussillon">Roussillon</option>
    				<option <?php if ($region == 'Rhône') { echo 'selected="selected"'; } ?> value="Rhône">Rhône</option>
    				<option <?php if ($region == 'Savoie') { echo 'selected="selected"'; } ?> value="Savoie">Savoie</option>
    				<option <?php if ($region == 'Sud-Ouest') { echo 'selected="selected"'; } ?> value="Sud-Ouest">Sud-Ouest</option>
    			</select>
    			<span class="help-block" <?php if (empty($error['area'])) { echo 'style="display: none"'; } ?>>
    				<?php if (isset($error['area'])) { echo $error['area']; } ?>
    			</span>
    		</div>

    		<div class="form-group">
    			<label for="adress">Adresse*</label>
    			<input type="text" name="address" id="address" value="<?= $address ?>" data-max="45" required="required" maxlength="45" class="form-control" autocomplete="off" />
    			<span class="help-block" <?php if (empty($error['address'])) { echo 'style="display: none"'; } ?>>
    				<?php if (isset($error['address'])) { echo $error['address']; } ?>
    			</span>
    		</div>

    		<div class="row">
    			<div class="col-md-4">
    				<div class="form-group">
    					<label for="postcode">Code Postal*</label>
    					<input type="text" name="postcode" id="postcode" value="<?= $postcode ?>" class="form-control" maxlength="5" autocomplete="off" />
    					<span class="help-block" <?php if (empty($error['postcode'])) { echo 'style="display: none"'; } ?>>
    						<?php if (isset($error['postcode'])) { echo $error['postcode']; } ?>
    					</span>
    				</div>
    			</div><!-- fin de la colonne bootstrap -->
    			<div class="col-md-4">
    				<div class="form-group">
    					<label for="city">Ville*</label>
    					<input type="text" name="city" id="city" value="<?= $city ?>" required="required" class="form-control" autocomplete="off" />
    					<span class="help-block" <?php if (empty($error['city'])) { echo 'style="display: none"'; } ?>>
    						<?php if (isset($error['city'])) { echo $error['city']; } ?>
    					</span>
    				</div>
    			</div><!-- fin de la colonne bootstrap -->
    		</div><!-- fin de la row bootstrap -->

			<div class="row">
				<input type="submit" value="Mettre à jour"  class="btn btn-default"/>
			</div>

		</form>
	</section>
</section>

<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
<script src="<?= $this->assetUrl('js/forms.js') ?>" type="text/javascript"></script>
<script src="<?= $this->assetUrl('js/geolocalisation.js') ?>" type="text/javascript"></script>
<script>

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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-S88NjyaazTh3Dmyfht4fsAKRli5v5gI&callback=initGeolocalisation" async defer></script>
<?php $this->stop('js') ?>
