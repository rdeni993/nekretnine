<!-- Like Every other HTML website lets go
     with functional Header --> 
     <?php echo $header; ?>
<!-- At the top add main navbar -->
<?php echo $menu; ?>

<!-- Main Part of dashboard page -->
<!-- is this.. create part -->
<div class="container-fluid basic-font mt-3">
    <div class="row">
        <div class="col-lg-3"><?php echo $nav; ?></div>
        <div class="col-lg-9">
      
        <!-- Body -->
        <div class="dashboard-item bg-light p-5">
            <h1 class="text-secondary"><i class="fa fa-list"></i> Lista prijava</h1>
            <hr>

            <div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header"><h4>Lista aktivnih prijava</h4></div>
                            <div class="card-body">
                                <?php if(!empty($reports)): ?>
                                    <?php foreach($reports as $report): ?>
                                        <div class="card my-1 report-article-mess" data-id="<?php echo $report->report_ID; ?>">
                                            <div class="card-header" data-id="<?php echo $report->report_ID; ?>">
                                                <a href="#" data-id="<?php echo $report->report_ID; ?>"> <?php echo $report->user_name; ?> prijavljuje oglas!</a>
                                            </div>
                                            <div class="card-body" data-id="<?php echo $report->report_ID; ?>">
                                                <h4><?php echo $report->property_title; ?></h4>
                                                <p><?php echo $report->property_description; ?></p>
                                                <div class="alert alert-warning p-2">ID Vlasnika oglasa <b><?php echo $report->property_owner; ?></b></div>
                                                <div class="alert alert-warning p-2">ID Oglasa <b><?php echo $report->property_ID; ?></b></div>
                                                <a href="#" data-id="<?php echo $report->report_ID; ?>" class="btn btn-link">Označi kao riješeno</a>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="alert">
                                        Nema prijava
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card endup-reports">
                            <div class="card-header"><h4>Lista riješenih prijava</h4></div>
                            <div class="card-body">
                                <ul>
                                    <?php if(@$ereports): ?>
                                        <?php foreach($ereports as $report): ?>
                                            <li>
                                                <a href="#" data-id="<?php echo $report->report_ID; ?>"> <?php echo $report->user_name; ?> prijavljuje oglas!</a>
                                            </li>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                    <div class="alert">
                                        Nema prijava
                                    </div>
                                    <?php endif; ?>
                                </ul>
                            </div>
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