<!--
    $props holding all properties
 -->
<!-- Include Header -->
<?php echo $header; ?>

<!-- Include Main Navigation-->
<?php echo $navigation; ?>
<!-- EOF Main Navigation-->

<div class="container basic-font mt-3 bg-white p-0">
    <div class="row user-dashboard mt-2 m-0 p-0">
        <div class="col-lg-4 text-center mt-3">                
                <!-- Desktop -->
                <?php if(!empty($database_user)): ?>
                <img src="<?php echo base_url() . '/public/assets/img/avatars/' . $database_user->user_avatar; ?>" alt="img" />
                <h2 class="mt-4"><?php echo $database_user->user_name; ?></h2>
                <?php else: ?>
                    <p>(Profil nije ispravan)</p>
                <?php endif; ?>
                <p class="mt-4"><i class="fa fa-mobile"></i> <?php echo ($database_user->user_mobile != 'none') ? $database_user->user_mobile : "Nema broja"; ?></p>
                <?php $doc = strtotime($database_user->user_last_update); ?>
                <p class="mt-4 text-secondary"><small>Zadnji put na mreži:</small><br><?php echo date("d. M Y", $doc); ?></p>
                <p>
                    <?php if(@$my_props): ?>
                        <?php echo "Trenutno oglasa: " . sizeof($my_props); ?>
                    <?php else: ?>
                        <?php echo "Trenutno nema oglasa"; ?>
                    <?php endif; ?>
                </p>
                <!-- eof desktop -->
        </div>
        <div class="col-lg-8 p-0">
            <div class="my-props-user p-0"> 
                <div class="row">
                <?php if(@$my_props): ?>
                    <?php foreach($my_props as $article): ?>
                    <div class="col-lg-6 my-4 p-4">

                    <!-- Update: All Box is linked -->
                    <div class="card article <?php if($article->property_premium == 1){ echo "article-premium"; } ?>">
                    <a class="box-link" href="<?php echo site_url('article/index/' . $article->property_ID . '/' . urlencode($article->property_title) ); ?>">
                        <div class="card-body p-0">
                            <?php if($article->property_premium == 1): ?>
                                <div class="premium-but">
                                    premium
                                </div>
                            <?php endif; ?>
                            <img class="" src="<?php echo $article->property_image; ?>" alt="prop-img" />
                            <h5 class="mt-3 mx-3"><?php echo $article->property_title; ?></h5>
                            <h1 class="text-left mx-3 text-primary"><?php echo $article->property_price; ?> €</h1>
                        </div>                            
                        <div class="row my-2 ml-1 article-details">
                                <div class="col-sm-12">
                                    <small class="text-dark"><i class="fa fa-map-marker"></i> <?php echo $article->property_location; ?></small>
                                    <small class="text-dark"><i class="fa fa-money"></i> 
                                    <?php foreach($rent_types as $rent): ?>
                                        <?php if($rent->ID == $article->property_rent): ?>
                                            <?php echo $rent->type; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    </small>
                                </div>
                            </div>
                        </a>
                        <div class="card-body text-right">
                            <div class="row">
                                <div class="col-lg-12 text-left">   
                                    <a href="<?php echo site_url('article/index/' . $article->property_ID . '/' . urlencode($article->property_title) ); ?>" class="btn btn-success text-white pull-right">Pogledaj</a>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <!-- EOF Update 1 -->


                </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- EOF BODY --> 

<!-- Include Footer-->
<?php echo $footer; ?>