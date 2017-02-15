<?php $this->layout('layout_dashboard', ['title' => 'Votre messagerie']) ?>

<?php $this->start('main_content') ?>
<div class="container-fluid">

    <ul class="fil-arianne">
        <li><a href="<?= $this->url('dashboard_home') ?>">Accueil</a></li>
        <li>Messagerie</li>
    </ul>

    <section class="inbox">

        <h2>Bienvenue sur votre messagerie. <span>Vous avez (<strong><?= $count_unread_messages ?></strong>) fils de discussion en cours.</span></h2>

    	<table class="table table-bordered" id="resizeInbox">
        <?php foreach ($messages as $message): ?>
            <thead>
                <th>photo</th>
                <th>nom</th>
                <th>message</th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <a href="<?= $this->url('inbox_thread', ['id' => $message['mp_token']]) ?>">
                        <?php if (empty($message['photo'])): ?>
                		<img src="<?= $this->assetUrl('img/dashboard/user2.png') ?>" alt="Avatar_<?= $message['firstname'] . ' ' . $message['lastname'] ?>" class="avatar" width="100" />
                	<?php else: ?>
                		<img src="<?= $this->assetUrl('content/photos/users/' . $message['photo']) ?>" alt="Avatar_<?= $message['firstname'] . ' ' . $message['lastname'] ?>" class="avatar" width="100" />
                	<?php endif; ?>
                        </a>
                    </td>
                    <td>
                        <a href="<?= $this->url('inbox_thread', ['id' => $message['mp_token']]) ?>">
                        <?php if (!empty($message['firstname'])): ?>
                            <?= $message['firstname'] . ' ' . $message['lastname'] ?>
                        <?php else: ?>
                            Invité
                        <?php endif; ?>
                        </a>
                    </td>
                    <td>
                        <strong><?= $message['subject'] ?></strong>
                        <br />
                        <?= $message['content'] ?>
                    </td>
                </tr>
            </tbody>
        <?php endforeach; ?>
        </table>

    </section>
</div>
<script type="text/javascript">
    var headertext = [],
    headers = document.querySelectorAll("#resizeInbox th"),
    tablerows = document.querySelectorAll("#resizeInbox th"),
    tablebody = document.querySelector("#resizeInbox tbody");

    for(var i = 0; i < headers.length; i++) {
      var current = headers[i];
      headertext.push(current.textContent.replace(/\r?\n|\r/,""));
    }
    for (var i = 0, row; row = tablebody.rows[i]; i++) {
      for (var j = 0, col; col = row.cells[j]; j++) {
        col.setAttribute("data-th", headertext[j]);
      }
    }
</script>
<?php $this->stop('js') ?>

<?php $this->start('css') ?>
<link rel="stylesheet" href="<?= $this->assetUrl('css/jquery.Jcrop.css') ?>" type="text/css">
<?php $this->stop('css') ?>
<?php $this->stop('main_content') ?>
