<?php $this->layout('layout', ['title' => 'Le Mag']) ?>

<?php $this->start('main_content') ?>
<a href="#top" class="goto hidden-xs anchor" id="goto-top"><span class="glyphicon glyphicon-circle-arrow-up" aria-hidden="true"></span></a>

<div class="row">
    <section id="lemag">
    <h2>Le Mag</h2>
        <div id="page">
            <div class="container">
                <div class="row">
                    <div id="magazine-content">
                        <div class="col-md-12">
                            <div class="magazine-blog">
                                <div class="title ">
                                    <span class="posted-on">06 Fev 2017</span>
                                    <h3><a href="#">LE VIN AUX USA : PRÉDICTIONS 2017</a></h3>
                                    <span class="category">Article</span>
                                </div>
                                <a href="<?= $this->url('article') ?>"><img src="assets/img/mag/blog-3.jpg" alt=""></a>
                                <div class="blog-text">
                                    <p>Le marché du vin aux états unis se porte bien, voir très bien avec sa hausse de 2,8% en volume et 4% en valeur affichant plus de 383 millions de caisses de 9L vendues en 2016. C’est d’ailleurs la première année où le prix moyen d’une bouteille achetée dépasse les $10. Les américains, eux aussi, se mettent à payer plus pour espérer une meilleure qualité.</p>
                                </div>
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="magazine-blog">
                                <div id="WineMonth" style="display: none;"></div>
                                <div class="title">
                                    <span class="posted-on">15 Fev 2017</span>
                                    <h3><a href="#">Du bon vin dans mes petits plats</a></h3>
                                    <span class="category">Article</span>
                                </div>
                                <a href="#"><img src="assets/img/mag/blog-7.jpg" alt=""></a>
                                <div class="blog-text">
                                    <p>Plats délicieux et de caractère, les grands classiques de la cuisine française mijotés avec du vin.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="magazine-blog">
                                <div class="title">
                                    <span class="posted-on">30 Fev 2017</span>
                                    <h3><a href="#">Terroir : lieu de naissance du vin</a></h3>
                                    <span class="category">Article</span>
                                </div>
                                <a href="#"><img src="assets/img/mag/blog-2.jpg" alt=""></a>
                                <div class="blog-text">
                                    <p>Terroir : le mot est à la mode et on l’entend un peu partout. Il est associé dans la tradition, la gastronomie, et aux grands vins français.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="magazine-blog">
                                <div class="title">
                                    <span class="posted-on">18 Mar 2017</span>
                                    <h3><a href="#">Les meilleurs vins d’Alsace</a></h3>
                                    <span class="category">Article</span>
                                </div>
                                <a href="#"><img src="assets/img/mag/blog-1.jpg" alt=""></a>
                                <div class="blog-text">
                                    <p>L’Alsace est une région viticole, avec une diversité de terroirs et des cépages locaux donnant des vins particulièrement typés.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="magazine-blog">
                                <div class="title">
                                    <span class="posted-on">30 Mar 2017</span>
                                    <h3><a href="#">Tout savoir sur la viticulture</a></h3>
                                    <span class="category">Article</span>
                                </div>
                                <a href="#"><img src="assets/img/mag/blog-8.jpg" alt=""></a>
                                <div class="blog-text">
                                    <p>« Pour le vin, vous êtes plutôt bio ou biodynamie ? ». Vous n'avez aucune idée, cet article est pour vous !</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
    <script src="<?= $this->assetUrl('js/main.js') ?>" type="text/javascript"></script>
<?php $this->stop('js') ?>
