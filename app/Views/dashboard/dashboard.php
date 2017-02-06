<?php $this->layout('layout_dashboard', ['title' => 'Espace membre']) ?>

<?php $this->start('main_content') ?>
<h1>WineNot<span>Accueil</span></h1>

<article>
    <h2>Les producteurs de WineNot</h2>

    <img src="<?= $this->assetUrl('img/dashboard/home-winemakers.jpg') ?>" alt="Producteurs" class="img-responsive" />

    <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </p>
</article>
<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
    <script src="<?= $this->assetUrl('js/main.js') ?>" type="text/javascript"></script>
<?php $this->stop('js') ?>
