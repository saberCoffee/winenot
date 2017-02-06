<?php $this->layout('layout_dashboard', ['title' => 'Espace membre']) ?>

<?php $this->start('main_content') ?>
<h1>Espace membre</h1>
<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
    <script src="<?= $this->assetUrl('js/main.js') ?>" type="text/javascript"></script>
<?php $this->stop('js') ?>
