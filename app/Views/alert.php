<!--
    $props holding all properties
 -->
<!-- Include Header -->
<?php echo $header; ?>

<!-- Include Main Navigation-->
<?php echo $navigation; ?>
<!-- EOF Main Navigation-->

<!-- BODY -->
<div class="container basic-font">
    <div class="row mt-5">    
        <div class="col-lg-12 bg-white in-page basic-font">
            <?php if($userdata->user_activate): ?>
            <div class="row">
                <div class="col-lg-12 p-4">
                    <h1 class="mb-4"><i class="fa fa-warning"></i> Oglas je prijavljen administratoru!</h1>
                    <p class="mt-4">Poštovani <?php echo $userdata->user_name; ?>!</p>
                    <p>Uspješno ste prijavili oglas "" kao neistinit ili kao oglas koji krši naš pravilnik! Administratori će u narednom
                        periodu pregledati vašu prijavu i utvrditi da li je pomenuti oglas zaista nepravilan i da li postoje
                        razlozi za njegovo uklanjanje. Takođe Budite spremni da će Vas administrator kontaktirati što prije 
                        bude moguće koristeći e-mail koji ste naveli na profilu.
                    </p>
                    <p>Lijep pozdrav,</p>
                </div>
                <div class="col-lg-6 p-4">
                    <div class="card">
                        <div class="card-header">Prijava nekretnine</div>
                        <div class="card-body">
                            <h4><?php echo $article[0]->property_title; ?></h4>
                            <p>Cijena: <?php echo $article[0]->property_price; ?></p>
                            <p>Lokacija: <?php echo $article[0]->property_location; ?></p>
                            <?php if($userdata->user_role == 'admin'): ?>
                                <div class="alert alert-warning">Identifikator <b><?php echo $article[0]->property_ID; ?></b></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 p-4">
                    <div class="card">
                        <div class="card-header">Podaci o korisniku</div>
                        <div class="card-body">
                            <h4><?php echo $userdata->user_name; ?></h4>
                            <p>E-mail: <?php echo $userdata->user_email; ?></p>
                            <p>Adresa: <?php echo $userdata->user_address; ?></p>
                            <?php if($userdata->user_role == 'admin'): ?>
                                <div class="alert alert-warning">Identifikator <b><?php echo $userdata->user_ID; ?></b></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <a class="btn btn-primary my-4 form-control" href="<?php echo site_url(); ?>">Vrati se nazad</a>
                </div>
            </div>
            <?php else: ?>
                <div class="row">
                    <div class="col-lg-12 p-4">
                        <h1 class="mb-4"><i class="fa fa-warning"></i> Oglas nije prijavljen administratoru!</h1>
                        Usluga nije moguća! Molimo da Aktivirate Vaš nalog! Ako imate problema sa e-mail aktivacijom molimo da nas 
                        kontaktirate..
                    </div>
                    <div class="col-lg-12">
                        <a class="btn btn-primary my-4 form-control" href="<?php echo site_url(); ?>">Vrati se nazad</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- EOF BODY --> 

<!-- Include Footer-->
<?php echo $footer; ?>