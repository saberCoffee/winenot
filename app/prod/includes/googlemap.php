
<div class="row">
<section id="GoogleMap">

	<!-- DIV pour barre de recherche avec autocompletion -->
	<div id="WinmakerSearch">
        <h2>Où trouver nos 500 producteurs</h2>
        <p>Trouver un producteur près de chez vous</p>
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
	<div id="map"></div>


	<script type="text/javascript"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-S88NjyaazTh3Dmyfht4fsAKRli5v5gI&libraries=places&callback=initMap" async defer></script>

</section>
</div>
