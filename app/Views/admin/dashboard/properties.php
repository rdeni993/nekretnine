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
            <h1 class="text-secondary"><i class="fa fa-wifi"></i> Kontrola oglasa</h1>
            <hr>

            <div class="find-prop basic-font py-4">
                <div class="row">
                    <div class="col-lg-6">
                        <h4>Pronađi nekretninu</h4>
                        <p>
                            <small>Ukucaj ID nekretnine</small>
                        </p>
                        <hr>
                        <div class="">
                            <input class="form-control my-2" type="text" name="" placeholder="tipa 9999" />
                            <button class="btn btn-success">Potraži</button>
                        </div>
                    </div>
                    <div class="col-lg-6 find-prop-din basic-font py-4">
                        <h4></h4>
                        <ul></ul>
                        <a href="" target="_blank">Otvori oglas</a>
                        <button class="btn btn-link prop-remove" data-id="">Remove Prop</button>
                    </div>
                </div>
            </div>

            <table class="table bg-dark text-light">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Autor</th>
                        <th>Datum</th>
                        <th>Opcije</th>
                    </tr>
                </thead>
                <tbody>
                <?php if($props): ?>
                    <?php foreach($props as $prop): ?>
                    <tr data-id="<?php echo $prop->property_ID; ?>">
                        <td><?php echo $prop->property_ID; ?></td>
                        <td><?php echo $prop->property_title; ?></td>
                        <td><?php echo $prop->property_owner; ?></td>
                        <td><?php echo $prop->property_doc; ?></td>
                        <td><button class="btn btn-danger prop-remove" data-id="<?php echo $prop->property_ID; ?>">Delete</button></td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
                    
                    <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="<?php echo site_url('admin/properties?page=' . $current_p ); ?>"><i class="fa fa-refresh"></i> Osvjezi</a></li>
                        <?php if($prev_page > 0): ?>
                        <li class="page-item"><a class="page-link" href="<?php echo site_url('admin/properties?page=' . $prev_page ); ?>">Prethodna</a></li>
                        <?php endif; ?>
                        <?php if( !empty($user_list) && sizeof($user_list) >= 5 ): ?>
                        <li class="page-item"><a class="page-link" href="<?php echo site_url('admin/properties?page=' . $next_page ); ?>">Sljedeca</a></li>
                        <?php endif; ?>
                    </ul>
                    </nav>
        </div>
        <!-- EOF Body -->

        </div>
    </div>
</div>
<!-- EOF part-->

<!-- Finish website with footer -->
<?php echo $footer; ?>