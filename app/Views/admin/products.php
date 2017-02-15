<?php $this->layout('layout_dashboard', ['title' => 'Gérer les vins du mois']) ?>

<?php $this->start('main_content') ?>
<?php if (!empty($_COOKIE['successMsg'])) { ?>
    <section>
        <div class="alert alert-success" role="alert"><?= $_COOKIE['successMsg'] ?></div>
    </section>
<?php } ?>

<section>

    <ul class="fil-arianne">
        <li><a href="<?= $this->url('dashboard_home') ?>">Accueil</a></li>
		<li>Gérer les vins du mois</li>
    </ul>

</section>

<div class="Wineofmonth">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10">
                <form class="form" id="winesOfTheMonth" action="<?= $this->url('admin_products') ?>" method="post">
                    <h2>Gérer les vins du mois</h2>
                    <table id="winemonth" border="1" class="table table-striped">
                        <thead>
                            <tr>
                                <th class="col-sm-3">Nom</th>
                                <th class="col-sm-1">Vin du mois</th>
                                <th class="col-sm-1">Photo</th>
                                <th class="col-sm-1">Couleur</th>
                                <th class="col-sm-5">Description</th>
                            </tr>
                        </thead>


                        <tbody>
                            <?php foreach ($products as $product) : ?>
                            <tr>
                                <td><label for="<?= $product['id'] ?>"><?= $product['name'];?></label></td>
                                <td><input type="checkbox" class="wine_of_the_month" name="wine_of_the_month[]" id="<?= $product['id'] ?>" value="<?= $product['id'] ?>" <?php if ($product['checked'] == 1) { echo 'checked="checked"'; } ?> /></td>
                                <td><label for="<?= $product['id'] ?>"><img width="70" src="<?= $this->assetUrl('content/photos/products/' . $product['photo']) ?>"<?= $product['photo'];?></label></td>
                                <td><label for="<?= $product['id'] ?>"><?= $product['couleur'];?></label></td>

                                <td><?= $product['description'];?></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>


                    <span class="help-block" <?php if (empty($error)) { echo 'style="display: none"'; } ?>>
                        <?php if (isset($error)) { echo $error; } ?>
                    </span>
                <div class="row">
                        <div class="col-lg-12">
                            <div class="BtnSubmit">
                                <input type="submit" name="submit" value="Valider" class="btn btn-default"/>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
<script src="<?= $this->assetUrl('js/forms.js') ?>"></script>
<!-- fonction pour gérer le responsive du tableau producteurs du mois(winemakerofthemonth)
avec l'id #wineofmonth -->
<script type="text/javascript">
    var headertext = [],
    headers = document.querySelectorAll("#winemonth th"),
    tablerows = document.querySelectorAll("#winemonth th"),
    tablebody = document.querySelector("#winemonth tbody");

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
