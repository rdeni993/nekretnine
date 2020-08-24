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
      
        <!-- Body -->
        <div class="dashboard-item bg-light p-5">
            <h1 class="text-secondary"><i class="fa fa-money"></i> Kontrola Tipova Najma</h1>
            <hr>

            <div class="row p-5">
                <div class="col-sm-12">
                    <!-- Errors Handler -->
                    <?php if($error): ?>
                    <div class="alert alert-danger"><?php echo esc($error); ?></div>
                    <?php endif; ?>
                    <!-- Positive Answer --> 
                    <?php if($success): ?>
                    <div class="alert alert-success"><?php echo esc($success); ?></div>
                    <?php endif; ?>
                </div>
                <div class="col-sm-6">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tip Nekretnine</th>
                                <th class="text-right">Kontrola</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($properties as $prop): ?>
                                <tr data-table-id="<?php echo esc($prop->ID); ?>">
                                    <td><?php echo esc($prop->ID); ?></td>
                                    <td><?php echo esc($prop->type); ?></td>
                                    <td class="text-right"><button class="delete-prop btn btn-danger" data-id="<?php echo esc($prop->ID); ?>">Obriši</button></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">Dodaj Tip Nekretnine</div>
                        <div class="card-body">
                            <form action="<?php echo site_url('adminservice/add_property') ?>" method="POST" id="add_property">
                                <input class="form-control" type="text" name="prop_type" placeholder="e.g sell" />
                                <input type="hidden" name="db_table" value="rent_type" />
                                <input type="hidden" name="db_uri_back" value="admin/rent" />
                                <br>
                                <button class="btn btn-primary my-1" name="prop_submited" value="true"><i class="fa fa-plus"></i> Dodaj</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- EOF Body -->

        </div>
    </div>
</div>
<!-- EOF part-->

<!-- Finish website with footer -->
<?php echo $footer; ?>