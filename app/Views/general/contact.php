<?php $this->layout('layout', ['title' => 'Contactez Nous']) ?>

<?php $this->start('main_content') ?>

    <section class="container contact-form">
        <div class="row">
            
            <h2 id="titre-contact">Envoyez vos questions!</h2>
            <form action="<?= $this->url('contact') ?>" method="post" class="form" id="contact-form">

                <div class="form-group <?php if (isset($error['contact_objet'])) { echo 'has-error'; } ?>">
                    <label for="contact_objet">Objet : </label>
                    <select name="contact_objet" id="contact_objet">
                        <option value="Recrutement">Recrutement</option>
                        <option value="Devenir Producteur">Devenir Producteur</option>
                        <option value="Proposition">Proposition</option>
                        <option value="Dire bonjour">Dire bonjour</option>
                        <option value="Autre">Autre</option>

                    </select>

                    <span class="help-block" <?php if (empty($error['contact_objet'])) { echo 'style="display: none"'; } ?>><?= $error['contact_objet']; ?></span>
                </div>
                <div class="form-group <?php if (isset($error['contact_email'])) { echo 'has-error'; } ?>">
                    <label for="contact_email">Votre email</label>
                    <input type="email" name="contact_email" ud="contact_email" value="<?= htmlentities($email); ?>" class="form-control" required="required" data-min="2" data-max="64" maxlength="64" autocomplete="off" />

                    <span class="help-block" <?php if (empty($error['contact_email'])) { echo 'style="display: none"'; } ?>><?= $error['contact_email']; ?></span>
                </div>

                <div class="form-group <?php if (isset($error['contact_msg'])) { echo 'has-error'; } ?>">
                    <label for="contact_msg">Votre message</label>
                    <textarea name="contact_msg" class="form-control" id="contact_msg" required="required" data-min="10" data-max="1500" autocomplete="off" value=<?= htmlentities($message); ?> ></textarea>

                    <span class="help-block" <?php if (empty($error['contact_msg'])) { echo 'style="display: none"'; } ?>><?= $error['contact_mg']; ?></span>
                </div>


                <input type="submit" value="Envoyer" class="btn btn-primary" />
            </form>
        </div>

    </section>

<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
    <script src="<?= $this->assetUrl('js/forms.js') ?>"></script>
<?php $this->stop('js') ?>
