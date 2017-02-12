<?php $this->layout('layout_dashboard', ['title' => 'Tous nos vins']) ?>
<?php $this->start('main_content') ?>

<section id="products">
    <div class="container">
    <div class="row">
    <?php foreach ($products as $product): ?>
        <div class="col-md-4">
            <div class="flip-container">
                <div class="flipper">
                    <div class="front">
                        <img width="200" src="<?= $this->assetUrl('content/photos/products/' . $product['photo']) ?>" alt="<?= $product['name'] ?>">
                        <div class="nameWineBottle">
                            <p><?= $product['name'] ?><br />Vin <?= $product['couleur'] ?></p>
                        </div>
                    </div>

                    <a href="<?= $this->url('dashboard_product', ['name' => $product['clean_name'], 'id' => $product['id']]) ?>"><div class="back">
                        <p>
                            <?= $product['description'] ?>
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

<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
    <script src="<?= $this->assetUrl('js/forms.js') ?>"></script>
<?php $this->stop('js') ?>
