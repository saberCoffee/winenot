<?php $this->layout('layout_dashboard', ['title' => 'Tous nos membres']) ?>
<?php $this->start('main_content') ?>

<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
    <script src="<?= $this->assetUrl('js/forms.js') ?>"></script>
<?php $this->stop('js') ?>