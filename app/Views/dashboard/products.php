<?php $this->layout('layout_dashboard', ['title' => 'Tous nos vins']) ?>
<?php $this->start('main_content') ?>

<section>
    <div class="container">
    <div class="row">
    <?php foreach ($products as $product): ?>
            <div class="col-md-4">
                <div class="flip-container">
                    <div class="flipper">
                        <div class="front">
                            <img width="200" src="<?= $this->assetUrl('/img/imgBottles/source_web_test/01.jpg') ?>" alt="<?= $product['name'] ?>">
                            <div class="nameWineBottle">
                                <p>Vin <?= $product['couleur'] ?><br /><?= $product['name'] ?></p>
                            </div>
                        </div>

                        <a href="#"><div class="back">
                            <p>
                                Servi à 16°C, ce vin d’une belle structure sera le partenaire idéal de vos planches de charcuterie, viandes rouges, plats en sauce et fromages de chèvre ou de caractère tels que le Comté…
                                <div class="nameWineBottle">
                                    <p>
                                        Produit par <strong><?= $product['winemaker']['firstname'] . ' ' . $product['winemaker']['lastname'] ?></strong>
                                        <br />
                                        <?= $product['price'] ?>€
                                    </p>
                                </div>
                            </p>
                        </div></a>
                    </div>
                </div>
            </div>
    <?php endforeach; ?>
    </div>

    </div>
</section>

<?php
debug($products);
?>

<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
    <script src="<?= $this->assetUrl('js/forms.js') ?>"></script>
<?php $this->stop('js') ?>
