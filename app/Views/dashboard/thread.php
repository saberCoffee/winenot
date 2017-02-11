<?php $this->layout('layout_dashboard', ['title' => 'Votre discussion avec ' . $users['contact']['firstname'] . ' ' .  $users['contact']['lastname']]) ?>

<?php $this->start('main_content') ?>
<div class="container">

    <section id="thread">

        <ul class="fil-arianne">
            <li><a href="<?= $this->url('inbox') ?>">Retourner à la messagerie</a></li>
            <li><a href="<?= $this->url('user_profile', ['id' => $users['contact']['token']]) ?>"><?= $users['contact']['firstname'] . ' ' .  $users['contact']['lastname'] ?></a></li>
        </ul>

        <form action="<?= $this->url('inbox_posting', ['id' => $token]) ?>" method="post">
        <?php if ($nb_messages == 0): ?>
            <div class="form-group">
                <p>
                    C'est la première vous que vous prenez contact avec <?= $users['contact']['firstname'] . ' ' .  $users['contact']['lastname'] ?>. Pensez à vous présenter, et soyez poli !
                </p>
                <label for="subject">Sujet</label>
                <input type="text" name="subject" id="subject" class="form-control" required="required" autocomplete="off" />
                <!--<select name="subject" id="subject" class="form-control" required="required" autocomplete="off">

                </select>-->
                <label for="content">Message</label>
            </div>
        <?php else: ?>
            <p>
                N'oubliez pas de respecter votre interlocuteur.
            </p>
            <label for="content">Message</label>
            <input type="hidden" name="subject" value="<?= $subject ?>">
        <?php endif; ?>
            <div class="form-group">
                <textarea name="content" data-min="5" data-max="1000" required="required" class="form-control"></textarea>
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
