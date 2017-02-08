<?php $this->layout('layout_dashboard', ['title' => 'Votre discussion avec bob']) ?>

<?php $this->start('main_content') ?>
<div class="container">

    <p><a href="<?= $this->url('inbox') ?>" class="back-to-prev">Revenir à la messagerie</a></p>

    <section id="thread">

        <form action="<?= $this->url('inbox_thread', ['id' => $token]) ?>" method="post">
            <div class="form-group">
                <input type="hidden" name="subject" value="<?= $subject ?>">
                <textarea name="content" data-min="5" data-max="1000" required="required"></textarea>
                <span class="help-block" style="display: none"></span>
            </div>
            <input type="submit" value="Envoyer un message" />
        </form>

        <?php
        foreach ($messages as $message):
        ?>
            <div class="row">
                <div class="col-avatar">
                    <img src="<?= $this->assetUrl('img/prod-placeholders/' . $message['classe'] . '.jpg') ?>" alt="Avatar_<?= $message['firstname'] . ' ' . $message['lastname'] ?>" class="avatar">
                </div>

                <div class="col-message">
                    <p class="<?= $message['classe'] ?>">
                        <?= nl2br($message['content']) ?>
                    </p>
                </div>
            </div>
        <?php
        endforeach;
        ?>

    </section>
</div>
<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
    <script src="<?= $this->assetUrl('js/forms.js') ?>" type="text/javascript"></script>
<?php $this->stop('js') ?>
