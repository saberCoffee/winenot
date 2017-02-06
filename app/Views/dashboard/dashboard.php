<?php $this->layout('layout_dashboard', ['title' => 'Accueil']) ?>

<?php $this->start('main_content') ?>
<article>
    <h2>Nos producteurs</h2>

    <img src="<?= $this->assetUrl('img/dashboard/home-winemakers.jpg') ?>" alt="Producteurs" class="img-responsive" />

    <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </p>

    <p>
        <a href="#">Découvrez nos producteurs</a>
    </p>
</article>

<article>
    <h2>Nos produits</h2>

    <img src="<?= $this->assetUrl('img/dashboard/home-winemakers.jpg') ?>" alt="Producteurs" class="img-responsive" />

    <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </p>

    <p>
        <a href="#">Découvrez nos produits</a>
    </p>
</article>
<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
    <script src="<?= $this->assetUrl('js/main.js') ?>" type="text/javascript"></script>
<?php $this->stop('js') ?>
