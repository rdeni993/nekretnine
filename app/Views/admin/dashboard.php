<!-- Like Every other HTML website lets go
     with functional Header --> 
<?php echo $header; ?>
<!-- At the top add main navbar -->
<?php echo $menu; ?>

<!-- Main Part of dashboard page -->
<!-- is this.. create part -->
<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-lg-3"><?php echo $nav; ?></div>
        <div class="col-lg-9">
            <div class="dashboard-item bg-light p-5">
                <div class="row">

                    <div class="col-lg-12 text-center">
                        <div class="card my-4">
                            <div class="card-header"><h4><i class="fa fa-wheel"></i> Statistika stranice</h4></div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <b class="text-primary">Korisnici</b>
                                        <h1 class="my-5"><?php echo sizeof($user_count); ?></h1>
                                    </div>
                                    <div class="col-lg-4">
                                        <b class="text-primary">Oglasi</b>
                                        <h1 class="my-5"><?php echo sizeof($all_props); ?></h1>
                                    </div>
                                    <div class="col-lg-4">
                                        <b class="text-primary">Slike</b>
                                        <h1 class="my-5"><?php echo sizeof($all_images); ?></h1>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4><i class="fa fa-tv"></i> Poslednji oglasi</h4>
                            </div>
                            <div class="card-body">
                                <?php if(sizeof($all_props)): ?>
                                    <b class="text-success">Aktivnih oglasa: <?php echo sizeof($all_props); ?></b>
                                    <table class="table my-3">
                                    <?php foreach($last_five_props as $prop): ?>
                                    <tr>
                                        <td><?php echo $prop->property_ID; ?></td>
                                        <td><?php echo $prop->property_title; ?></td>
                                        <td><?php echo $prop->property_doc; ?></td>
                                    </tr>
                                    <?php endforeach;?>
                                    </table>
                                <?php else: ?>
                                    <b class="text-danger">Aktivnih oglasa: nema</b>
                                <?php endif; ?>
                            </div>
                            <div class="card-footer"><a class="btn btn-link" href="<?php echo site_url('admin/properties'); ?>">Kontrola nekretnina</a></div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-header">
                                <h4>Tipovi najma</h4>
                            </div>
                            <div class="card-body">
                                <div class="btn-group-vertical">
                                    <?php foreach($prop_rent as $rent): ?>
                                        <button class="btn text-left"><?php echo $rent->type; ?></button>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="card-footer"><a class="btn btn-link" href="<?php echo site_url('admin/rent'); ?>">Dodaj još</a></div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-header">
                                <h4>Tipovi nekretnina</h4>
                            </div>
                            <div class="card-body">
                                <div class="btn-group-vertical">
                                    <?php foreach($prop_type as $rent): ?>
                                        <button class="btn text-left"><?php echo $rent->type; ?></button>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="card-footer"><a class="btn btn-link" href="<?php echo site_url('admin/property'); ?>">Dodaj još</a></div>
                        </div>
                    </div>
                    <div class="col-sm-12 my-5">
                        <h4><i class="fa fa-settings my-2"></i> Prijave korisnika [Poslednjih 50]</h4>
                        <table class="table"> 
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Ime i prezime</th>
                                    <th>E-mail</th>
                                    <th>Aktiviran</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(@$users): ?>
                                <?php foreach($users as $user): ?>
                                <tr>
                                    <td><?php echo $user->user_ID; ?></td>
                                    <td><?php echo $user->user_name; ?></td>
                                    <td><?php echo $user->user_email; ?></td>
                                    <td><?php if($user->user_activate == 1 ){ echo "Aktiviran!"; }else{ echo "Nije Aktiviran"; } ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        <?php # Check For Property # ?>
        </div>
    </div>
</div>
<!-- EOF part-->

<!-- Finish website with footer -->
<?php echo $footer; ?>