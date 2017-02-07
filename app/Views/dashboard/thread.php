<?php $this->layout('layout_dashboard', ['title' => 'Votre discussion avec bob']) ?>

<?php $this->start('main_content') ?>
<div class="container-fluid">

    <section>

        <p><a href="<?= $this->url('inbox') ?>" class="back-to-prev">Revenir à la messagerie</a></p>

        <?php foreach ($messages as $message): ?>
        <p>

        </p>
        <?php endforeach; ?>

    </section>
</div>
<?php $this->stop('main_content') ?>
