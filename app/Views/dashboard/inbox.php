<?php $this->layout('layout_dashboard', ['title' => 'Votre messagerie']) ?>

<?php $this->start('main_content') ?>
<section>
    <h2>Bienvenue sur votre messagerie. <span>Vous avez (<strong><?= $count_unread_messages ?></strong>) fils de discussion en cours.</span></h2>

<?php debug($messages) ?>

    <div class="container-fluid">
    	<table class="table table-bordered">
        <?php foreach ($messages as $message): ?>
        <tr>
            <td>Photo</td>
            <td>
                <?php if (!empty($message['firstname'])): ?>
                    <?= $message['firstname'] . ' ' . $message['lastname'] ?>
                <?php else: ?>
                    Invité
                <?php endif; ?>
            </td>
            <td>
                <strong><?= $message['subject'] ?></strong>
                <br />
                <?= $message['content'] ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    </div>
</section>
<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
<script src="<?= $this->assetUrl('js/forms.js') ?>"></script>
<?php $this->stop('js') ?>
