<?php $this->layout('layout_dashboard', ['title' => 'Accueil']) ?>

<?php $this->start('main_content') ?>
<article>
    <h2>Nos producteurs</h2>

    <img src="<?= $this->assetUrl('img/dashboard/home-winemakers.jpg') ?>" alt="Producteurs" class="img-responsive" />

    <p>
        La diversité du climat français associée à une infinité de terroirs, géologiquement très variés, sont particulièrement propices à la culture de la vigne et à la production de grands vins. Le vignoble français produit 3240 vins différents sur 80 départements et 16 grands vignobles. 
        Voici la liste de nos vignobles. Cliquez sur les liens pour découvrir ce qui fait la spécificité de chacun d'eux à travers leurs terroirs, cépages, histoires et cartes des vins interactives...
    </p>

    <p>
        <a href="<?= $this->url('winemakers') ?>">Découvrez nos producteurs</a>
    </p>
</article>

<article>
    <h2>Nos produits</h2>

    <img src="<?= $this->assetUrl('img/dashboard/home-products.jpg') ?>" alt="Producteurs" class="img-responsive" />

    <p>
        Parmi tous ces vignerons, certains révèlent des vins très au-dessus de la moyenne. On sent à travers leurs vins une implication, une abnégation et une passion que l'on ne parvient pas à retrouver ailleurs. Oui, ce sont des jardinier(e)s de la vigne, finalement il n'y a jamais de hasard dans le vin...
        Découvrez tout les vins de nos producteurs.
    </p>

    <p>
        <a href="<?= $this->url('products') ?>">Découvrez nos produits</a>
    </p>
</article>
<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
<?php $this->stop('js') ?>
