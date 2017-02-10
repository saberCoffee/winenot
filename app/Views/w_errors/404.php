<?php
if (empty($layout)) {
    $layout = 'home';
}
?>
<?php $this->layout($layout, ['title' => 'Perdu ?']) ?>

<?php $this->start('main_content'); ?>
    <section>
<h2>404. Perdu ?</h2>
<?php if (!empty($errorMessage['dashboard'])): ?>
    <p>
        <?= $errorMessage['dashboard'] ?>
    </p>
<?php elseif(!empty($errorMessage['home'])): ?>
    <p>
        <?= $errorMessage['home'] ?>
         <a href="<?= $this->url('home') ?>">Retourner à l'accueil.</a>
    </p>
<?php endif; ?>
</section>
<?php $this->stop('main_content'); ?>
