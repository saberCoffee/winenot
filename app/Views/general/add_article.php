<?php $this->layout('layout', ['title' => 'Accueil']) ?>

<?php $this->start('main_content') ?>


<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
    <script src="<?= $this->assetUrl('js/main.js') ?>" type="text/javascript"></script>
<?php $this->stop('js') ?>
