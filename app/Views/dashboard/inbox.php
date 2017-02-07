<?php $this->layout('layout_dashboard', ['title' => 'Votre messagerie']) ?>

<?php $this->start('main_content') ?>
<h2>Bienvenue sur la messagerie, vous avez (<strong><?= $count_unread_messages ?></strong>) messages non lus</h2>

<?php
debug($messages);
?>

<div class="container-fluid">
	<table class="table table-bordered">
    <?php foreach ($messages as $message): ?>
    <tr>
        <td>Photo</td>
        <td>Invité</td>
        <td>
            <strong><?= $message['subject'] ?></strong>
            <br />
            <?= $message['content'] ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
</div>
<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
<script src="<?= $this->assetUrl('js/forms.js') ?>"></script>
<?php $this->stop('js') ?>
