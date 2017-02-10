<?php $this->layout('layout', ['title' => 'Accueil']) ?>

<?php $this->start('main_content') ?>

<div class="row">
    <section id="lemag">
    <h2>Le Mag</h2>
        <div id="page">
            <div id="magazine-content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-padded-right">
                            <div class="row">
                                <div class="col-md-12">
                                   <div class="magazine-blog">
                                        <div class="title ">
                                            
                                            <h2>LE VIN AUX USA: PRÉDICTIONS 2017</h2>
                                            <span class="posted-on category">06 Fev 2017</span>
                                           
                                        </div>
                                        <a><img src="<?= $this->assetUrl('img/mag/blog-3.jpg') ?>" alt=""></a>
                                        <article class="blog-text ">
                                        
                                            <p><strong>Le marché du vin aux états unis se porte bien, voir très bien avec sa hausse de 2,8% en volume et 4% en valeur affichant plus de 383 millions de caisses de 9L vendues en 2016. C’est d’ailleurs la première année où le prix moyen d’une bouteille achetée dépasse les $10. Les américains, eux aussi, se mettent à payer plus pour espérer une meilleure qualité.</strong></p>

                                            <h3>Mais alors, à quoi pouvons-nous nous attendre pour 2017 ?</h3>

                                            <p>Ce qui devrait le plus influencer le marché américain de 2017 serait: le Brexit, la politique commerciale protectionisme de Donald Trump et le dollar fort.</p>

                                            <h3>Le Brexit</h3>

                                            <p>Les producteurs, marques et grandes maisons de France, Italie ou Espagne habitués à vendre aux Royaumes-Unis vont certainement d’avantage regarder vers d’autres marchés et les USA se placent en première ligne. Ce qui rendra le marché domestique plus compétitif.</p>

                                            <h3>La nouvelle politique du président américain</h3>

                                            <p>La sortie des USA du partenariat transpacific (TPP / Transpacific Partnership) par Donald Trump touche le marché du vin. Ce partenariat aurait très certainement permit de baisser les prix des vins américains vers le marché japonais et ainsi accroître l’export.</p>

											<p>Le nouveau président en place souhaite également re négocier  le
											 NAFTA (North American Free Trade Agreement, accord entre les USA, le Mexique et le Canada). Cela pourrait affecter l’industrie du vin qui a pour second marché d’exportation le Canada ($461 millions), et dont 90% des vins exportés au Canada sont Californiens.</p>

											<h3>Le niveau historiquement haut du dollar</h3>

											<p>Pénalise le marché américain sur ses exportations, en revanche cela va aider les catégories premium des vins étrangers à gagner en part de marché. Tendance établit en 2016 qui s’affirmera grâce à ce coup de pouce! Sur l’année 2016 la catégorie premium des vins étrangers affichait déjà +3,2% en volume et +3,1% en valeur (sur 12 mois de novembre 2015 à novembre 2016).</p>

											<h3>En 2016 nous avions pu aussi noter…</h3>

											<p>… La forte présence du Prosecco +25% qui représentait à lui seul 17% des bulles vendues aux usa !</p>

											<p>… Le boom du rosé, avec une augmentation des ventes de +50%, largement mené par les rosés français (62% du marché contre 30% pour les rosés américains).</p>
                                        </article>
                                    </div>
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
