<?php $this->layout('layout', ['title' => 'Mon compte']) ?>

<?php $this->start('main_content') ?>
<section id="MyAccount">

    <div class="row">

        <!-- Champs de Connexion -->
        <div class="col-xs-12 col-lg-6 r-p r-m">
            <h2>Déjà inscrit ?</h2>

            <form action="<?= $this->url('login') ?>" method="post" class="form" id="login-form">

                <div class="form-group <?php if (isset($error['login_email'])) { echo 'has-error'; } ?>">
                    <label for="">Adresse email</label>
                    <input type="email" name="login_email" value="<?= htmlentities($email); ?>" class="form-control" required="required" data-min="2" data-max="64" maxlength="64" autocomplete="off" />

                    <span class="help-block" <?php if (empty($error['login_email'])) { echo 'style="display: none"'; } ?>>
                        <?php if (isset($error['login_email'])) { echo $error['login_email']; } ?>
                    </span>
                </div>

                <div class="form-group <?php if (isset($error['login_password'])) { echo 'has-error'; } ?>">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="login_password" class="form-control" required="required" autocomplete="off" />

                    <span class="help-block" <?php if (empty($error['login_password'])) { echo 'style="display: none"'; } ?>>
                        <?php if (isset($error['login_password'])) { echo $error['login_password']; } ?>
                    </span>
                </div>

                <input type="submit" value="Se connecter" class="btn btn-primary" />
            </form>
        </div>

        <!-- Champs d'inscription -->
        <div class="col-xs-12 col-lg-6 r-p r-m">
            <h2>Créer mon compte</h2>

            <form action="<?= $this->url('register') ?>" method="post" class="form" id="register-form">
                <div class="form-group <?php if (isset($error['register_email'])) { echo 'has-error'; } ?>">
                    <label for="email">Adresse email*</label>

                    <input type="email" name="register_email" id="register_email" value="<?= htmlentities($email); ?>" class="form-control" required="required" />
                    <span class="help-block" <?php if (empty($error['register_email'])) { echo 'style="display: none"'; } ?>>
                        <?php if (isset($error['register_email'])) { echo $error['register_email']; } ?>
                    </span>
                </div>

                <div class="form-group <?php if (isset($error['register_password'])) { echo 'has-error'; } ?>">
                    <label for="password">Mot de passe*</label>

                    <input type="password" name="register_password" id="password" class="form-control" required="required" data-min="6" data-max="16" maxlength="16" />
                    <span class="help-block" <?php if (empty($error['register_password'])) { echo 'style="display: none"'; } ?>>
                        <?php if (isset($error['register_password'])) { echo $error['register_password']; } ?>
                    </span>
                </div>

                <div class="form-group <?php if (isset($error['register_password'])) { echo 'has-error'; } ?>">
                    <label for="register_password_verif">Vérification du mot de passe*</label>

                    <input type="password" name="register_password_verif"  id="register_password_verif" class="form-control" required="required" data-min="6" data-max="16" maxlength="16" />
                </div>

                <div class="form-group <?php if (isset($error['firstname'])) { echo 'has-error'; } ?>">
                    <label for="firstname">Prénom*</label>

                    <input type="text" name="firstname"  id="firstname" value="<?= htmlentities($firstname); ?>"  class="form-control" required="required" data-min="2" data-max="16" maxlength="16" />
                    <span class="help-block" <?php if (empty($error['firstname'])) { echo 'style="display: none"'; } ?>>
                        <?php if (isset($error['firstname'])) { echo $error['firstname']; } ?>
                    </span>
                </div>

                <div class="form-group <?php if (isset($error['lastname'])) { echo 'has-error'; } ?>">
                    <label for="lastname">Nom de famille*</label>

                    <input type="text" name="lastname"  id="lastname" value="<?= htmlentities($lastname); ?>"  class="form-control" required="required" data-min="2" data-max="16" maxlength="16" />
                    <span class="help-block" <?php if (empty($error['lastname'])) { echo 'style="display: none"'; } ?>>
                        <?php if (isset($error['lastname'])) { echo $error['lastname']; } ?>
                    </span>
                </div>

                <input type="submit" value="S'inscrire" class="btn btn-primary" />

            </form>

        </div>
    </div>
</section>
<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
    <script src="<?= $this->assetUrl('js/forms.js') ?>"></script>
<?php $this->stop('js') ?>
