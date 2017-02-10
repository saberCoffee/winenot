<?php $this->layout('layout_dashboard', ['title' => 'Trouver un produit']) ?>
<?php $this->start('main_content') ?>

<?php foreach ($products as $product): ?>

<?php endforeach; ?>

<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
    <script src="<?= $this->assetUrl('js/forms.js') ?>"></script>
<?php $this->stop('js') ?>
