<!-- Include Important Headers -->
<?php echo $header; ?>
<!-- Main Navigation -->
<?php echo $navigation; ?>

<!-- Default Layout 3-9 -->
<div class="container">
    <div class="row mt-5">
        <div class="col-lg-3">
            <!-- Load User Navigation Menu -->
            <?php echo $user_navigation; ?>
        </div>
        <div class="col-lg-9 prop-content bg-light pt-3">

            <div style="height: 300px; background: red;">Ovdje</div>

            <a href="#">
                <article class="card justify-content-between">
                <img class="card-img-top" src="<?php echo base_url(); ?>/assets/img/stan1.jpg" alt="" />
                <div class="card-body">
                    <h5 class="card-title text-left text-justify">PRODAJEM! Dvosoban Stan u Budvi</h5>
                    <p class="card-text text-secondary">Dvosoban stan u centru Budve. Samo 345km od plaze. </p>
                </div>
                <div class="card-footer">
                   <h1>154€</h1>
                   <hr>
                   <p class="card-text"> Dodatno 27/03/2020 u 22:35</p>
                </div>
                </article>
            </a>

            <a href="#">
                <article class="card justify-content-between">
                <img class="card-img-top" src="<?php echo base_url(); ?>/assets/img/soba1.jpg" alt="" />
                <div class="card-body">
                    <h5 class="card-title text-left text-justify">Izdajem Sobu</h5>
                    <p class="card-text text-secondary">Soba za studente... </p>
                </div>
                <div class="card-footer">
                   <h1>93€</h1>
                   <hr>
                   <p class="card-text"> Dodatno 27/03/2020 u 22:35</p>
                </div>
                </article>
            </a>

            <a href="#">
                <article class="card justify-content-between">
                <img class="card-img-top" src="<?php echo base_url(); ?>/assets/img/zemljiste.jpg" alt="" />
                <div class="card-body">
                    <h5 class="card-title text-left text-justify">Prodajem Zemljište 100m²</h5>
                    <p class="card-text text-secondary">Zemljište povoljno za gradnju kuće! </p>
                </div>
                <div class="card-footer">
                <h1>93 000€</h1>
                <hr>
                <p class="card-text"> Dodatno 27/03/2020 u 22:35</p>
                </div>
                </article>
            </a>

            <a href="#">
                <article class="card justify-content-between">
                <img class="card-img-top" src="<?php echo base_url(); ?>/assets/img/stan2.jpg" alt="" />
                <div class="card-body">
                    <h5 class="card-title text-left text-justify">Prodajem Zemljište 100m²</h5>
                    <p class="card-text text-secondary">Zemljište povoljno za gradnju kuće! </p>
                </div>
                <div class="card-footer">
                <h1>93 000€</h1>
                <hr>
                <p class="card-text"> Dodatno 27/03/2020 u 22:35</p>
                </div>
                </article>
            </a>

        </div>
        <div class="col-lg-3">c</div>
    </div>
</div>
<!-- Include Important Footer -->
<?php echo $footer; ?>