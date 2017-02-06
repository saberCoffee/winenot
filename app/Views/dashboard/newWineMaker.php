<?php $this->layout('layout_dashboard', ['title' => 'Devenir producteur']) ?>

<?php $this->start('main_content') ?>
<h1>Devenir producteur</h1>


	<section class="registerNewWineMaker">	
		<form>
			<div class="form-group">
				<label for="siren">Numéro de SIREN (9 chiffres)</label>
				<input type="text" name="siren" class="form-control">
			</div>
			<div class="form-group">
				<label for="area">Région</label>
				<select name="area" class="form-control" >
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
			</div>
			<div class="form-group">
				<label for="adress">Adresse</label>
				<input type="text" name="adress" class="form-control">
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="city">Ville</label>
						<input type="text" name="city" class="form-control"	>
					</div>
				</div>
				<div class="col-md-4 col-md-offset-4">
					<div class="form-group">
						<label for="cp">Code postal</label>
						<input type="text" name="cp" class="form-control">
					</div>
				</div>
			</div>
			
			<div>
				<input type="submit" class="btn btn-default" value="Inscription">
			</div>
			<a href=""><p>Supprimer votre compte</p></a>
		</form>
	</section>

<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
    <script src="<?= $this->assetUrl('js/main.js') ?>" type="text/javascript"></script>
<?php $this->stop('js') ?>
