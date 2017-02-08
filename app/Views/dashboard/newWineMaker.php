<?php $this->layout('layout_dashboard', ['title' => 'Devenir producteur']) ?>

<?php $this->start('main_content') ?>
<section class="registerNewWineMaker">

	<?php if (!empty($_COOKIE['successMsg'])) { ?>
	<div class="alert alert-success"><?= $_COOKIE['successMsg'] ?></div>
	<?php } ?>

	<form action="<?= $this->url('newWineMaker') ?>" method="post">
		<div class="form-group">
			<label for="siren">Numéro de SIREN (9 chiffres)</label>
			<input type="text" name="siren" id="siren" class="form-control" data-min="9" maxlength="9" required="required" autocomplete="off" />
			<span class="help-block" <?php if (empty($error['siren'])) { echo 'style="display: none"'; } ?>>
				<?php if (isset($error['siren'])) { echo $error['siren']; } ?>
			</span>
		</div>
		<div class="form-group">
			<label for="area">Région</label>
			<select name="area" id="area" class="form-control" required="required">
				<option value="" class="test">-- Selectionnez votre région --</option>
				<option value="Alsace">Alsace</option>
				<option value="Bourgogne">Bourgogne</option>
				<option value="Bordeaux">Bordeaux</option>
				<option value="Beaujolais">Beaujolais</option>
				<option value="Bugey">Bugey</option>
				<option value="Champagne">Champagne</option>
				<option value="Corse">Corse</option>
				<option value="Jura">Jura</option>
				<option value="Languedoc">Languedoc</option>
				<option value="Lorraine">Lorraine</option>
				<option value="Loire">Loire</option>
				<option value="Provence">Provence</option>
				<option value="Roussillon">Roussillon</option>
				<option value="Rhône">Rhône</option>
				<option value="Savoie">Savoie</option>
				<option value="Sud-Ouest">Sud-Ouest</option>
			</select>
			<span class="help-block" <?php if (empty($error['area'])) { echo 'style="display: none"'; } ?>>
				<?php if (isset($error['area'])) { echo $error['area']; } ?>
			</span>
		</div>
		<div class="form-group">
			<label for="adress">Adresse</label>
			<input type="text" name="address" id="address" data-max="45" required="required" maxlength="45" class="form-control" autocomplete="off" />
			<span class="help-block" <?php if (empty($error['address'])) { echo 'style="display: none"'; } ?>>
				<?php if (isset($error['address'])) { echo $error['address']; } ?>
			</span>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label for="cp">Code postal</label>
					<input type="text" name="cp" id="cp" class="form-control" autocomplete="off" />
					<span class="help-block" <?php if (empty($error['cp'])) { echo 'style="display: none"'; } ?>>
						<?php if (isset($error['cp'])) { echo $error['cp']; } ?>
					</span>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group city-input">
					<label for="city">Ville</label>
					<input type="text" name="city" id="city" required="required" class="form-control" autocomplete="off" />
					<span class="help-block" <?php if (empty($error['city'])) { echo 'style="display: none"'; } ?>>
						<?php if (isset($error['city'])) { echo $error['city']; } ?>
					</span>
				</div>
			</div>
		</div>

		<div>
			<input type="submit" class="btn btn-default" id="submit" value="Inscription">
		</div>
		<a href=""><p>Supprimer votre compte</p></a>
	</form>
</section>

<script type="text/javascript">
function initGeolocalisation() {
	var geocoder = new google.maps.Geocoder();

	// A chaque fois qu'on tape un caractère dans le champ "Code Postal"...
	$('#cp').on('keyup', function() {
		$('.city-input').fadeIn(); // La première fois, on affiche le champ "Ville"

		if ($(this).val().length == 5) { // Puis, dès qu'il y a bien 5 caractères dans le code postal, on appelle la fonction de géolocalisation
			geocodeAddress(geocoder);
		}
	});
}

function geocodeAddress(geocoder) {
	var address = $('#cp').val();

	geocoder.geocode({'address': address}, function(results, status) {
		if (status === google.maps.GeocoderStatus.OK) {
			var country = results[0].address_components[4].long_name;

			if (country == 'France') {
				var city = results[0].address_components[1].long_name;

				$('.city-input').children('input').val(city);
			} else {
				$('.city-input').children('input').val('');
			}
		} else {
			$('.city-input').children('input').val('');
		}
	});
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-S88NjyaazTh3Dmyfht4fsAKRli5v5gI&callback=initGeolocalisation" async defer></script>

<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
    <script src="<?= $this->assetUrl('js/forms.js') ?>" type="text/javascript"></script>
<?php $this->stop('js') ?>
