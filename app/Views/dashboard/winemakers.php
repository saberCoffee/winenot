<?php $this->layout('layout_dashboard', ['title' => 'Trouver un producteur']) ?>
<?php $this->start('main_content') ?>


<div class="container">
<section id="GoogleMap">
	<div id="dashboard_winmakerSearch">
        <h2>Où trouver nos 500 producteurs</h2>
        <p>Trouver un producteur</p>
        <form>
            <div class="input-group stylish-input-group">
                <input id="pac-input" type="text" class="form-control"  placeholder="Où résidez-vous ?" />
                <span class="input-group-addon">
                    <button type="submit">
                        <span class="glyphicon glyphicon-search"></span> Rechercher
                    </button>
                </span>
            </div>
        </form>
    </div>

    <!-- DIV pour google map -->
	<div id="dashboard_map"></div>
</section>
</div>
	
<div class="container winemakerInfo">
	<h2>Tous nos producteurs</h2>
	<div class="row">
	<?php foreach ($winemakers as $winemaker) { ?>
		<div class="col-md-3"><a href="#"><img class="photoProfil" src="<?= $this->assetUrl('img/prod-placeholders/row1.jpg') ?>" alt="photo profil" /><br><?= $winemaker['firstname'];?> <?=$winemaker['lastname'];?></a></div>
<?php }?>
	
	</div>
</div>
<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
 	<script src="<?= $this->assetUrl('js/gmap.js') ?>"></script>
    <script src="<?= $this->assetUrl('js/forms.js') ?>"></script>
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-S88NjyaazTh3Dmyfht4fsAKRli5v5gI&libraries=places&callback=initMap" async defer></script>
<?php $this->stop('js') ?>