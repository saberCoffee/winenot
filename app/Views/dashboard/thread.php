<?php $this->layout('layout_dashboard', ['title' => 'Votre discussion avec bob']) ?>

<?php $this->start('main_content') ?>
<div class="container-fluid">

    <p><a href="<?= $this->url('inbox') ?>" class="back-to-prev">Revenir à la messagerie</a></p>

    <section id="thread">

        <?php debug($messages) ?>

        <?php
        foreach ($messages as $message):
        ?>
            <p>
                <?= $message['content'] ?>
            </p>
        <?php
        endforeach;
        ?>

    </section>
</div>
<?php $this->stop('main_content') ?>
