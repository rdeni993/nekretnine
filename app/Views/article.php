<!--
    $props holding all properties
 -->
<!-- Include Header -->
<?php echo $header; ?>

<!-- Include Main Navigation-->
<?php echo $navigation; ?>
<!-- EOF Main Navigation-->

<!-- BODY -->
<div class="container basic-font bg-white p-0">
            
    <!-- Update 1 -->
        <div class="row m-0 mt-3 display-in-mob p-0">

            <div class="col-lg-12 mt-3 mobile-top">
                <!-- This Page need Carousel -->
                <div class="mobile-page-carousel p-0">
                    <div class="mobile-nested-carousel p-0">
                        <div id="carouselExampleControls2" class="carousel slide" data-ride="carousel">
                            <!-- slider -->
                            <div class="carousel-inner">
                                <?php $first_slide = true; ?>
                                <?php if(@$prop_imgs): ?>
                                    <?php $img_size = sizeof($prop_imgs); ?>
                                    <?php for( $i = 0; $i < $img_size; $i++ ): ?>      
                                    <div class="carousel-item <?php if($i == 0){ echo 'active'; } ?>">
                                        <img class="d-block w-100" src="<?php echo $prop_imgs[$i]->image_path; ?>" alt="slide">
                                    </div>
                                    <?php endfor; ?>
                                <?php endif; ?>
                            </div>
                            <!-- Move arrows -->
                            <a class="carousel-control-prev" href="#carouselExampleControls2" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls2" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                    </div>
                    </div>
                </div>
                <!-- EOF CAROUSEL -->
            </div>

            <div class="col-lg-12 mobile-article-basic-data">
                <?php $doc = strtotime($current_article->property_doc); ?>
                <small class="text-secondary"><?php echo date("d. M. Y", $doc); ?></small>
                <h4><?php echo esc($current_article->property_title); ?></h4>
                <h1 class=""><b><?php echo esc($current_article->property_price); ?></b> €</h1>
            </div>

            <div class="col-lg-12 mobile-article-basic-info mt-1">
                <table class="">
                    <tr>
                        <td><?php echo esc($current_prop_tp[0]->type); ?></td>
                        <td class="text-left"><?php echo esc($current_rent_tp[0]->type); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo esc($current_article->property_location); ?></td>
                        <td class="text-left"><?php echo esc($current_article->property_size); ?></td>
                    </tr>
                    <tr>
                        <td><a class="user-profile-open" href="<?php echo site_url('user/profile/') . $user_pub->user_ID; ?>"><?php echo esc($user_pub->user_name); ?></a></td>
                        <td class="text-left">
                            <?php if($user_pub->user_mobile != "none"): ?>
                                <?php echo esc($user_pub->user_mobile); ?>
                            <?php else: ?>
                                <?php echo "Nema Telefona"; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="col-lg-12 mobile-call-button text-center">
                <div class="btn-group">
                    <a class="btn" href="tel:38761336384"><i class="fa fa-mobile"></i> Pozovi</a>
                    <a class="btn share-btn" href="#"><i class="fa fa-share-alt"></i> Podjeli</a>
                </div>
            </div>

        </div>
    <!-- EOF Update -->






    <!-- ######################################## -->
    <!-- #########            ################### -->
    <!-- ######## ############ ################## -->
    <!-- ######## ############ ################## -->
    <!-- ######## ############ ################## -->
    <!-- ######## # ### #### # ################## -->
    <!-- ######## # ### #### # ################## -->
    <!-- ######## # ### #### # ################## -->
    <!-- ######## ############ ################## -->
    <!-- #########           #################### -->
    <!-- ######################################## -->


    <div class="row mt-5 p-0 m-0">    
        <div class="col-lg-12 bg-white in-page basic-font">
            <div class="row art-view user-dashboard m-0 p-4">

                <div class="col-lg-12 hide-in-mob">
                    <h3 class="text-left art-view-header"><?php echo esc($current_article->property_title); ?></h3>
                    <hr>
                </div>


                <div class="col-lg-8 basic-font">
                
                    <!-- ARTICLE PART -->

                    <div class="article-part">
                        <div class="card hide-in-mob">
                            <div class="card-header">Osnovne informacije</div>
                            <div class="card-body">
                                <div class="row article-desc m-0 p-0">
                                    <div class="col-sm-4">
                                        <p>Vrsta nekretnine</p>
                                        <h1><?php echo esc($current_prop_tp[0]->type); ?></h1>
                                    </div>
                                    <div class="col-sm-4">
                                        <p>Vrsta oglasa</p>
                                        <h1><?php echo esc($current_rent_tp[0]->type); ?></h1>
                                    </div>
                                    <div class="col-sm-4">
                                        <p>Lokacija</p>
                                        <h1><?php echo esc($current_article->property_location); ?></h1>
                                    </div>
                                    <div class="col-lg-12">
                                        <hr>
                                        <div class="bg-light text-dark text-strong p-3 my-3">
                                            <p>Cijena</p>
                                            <h2><b><?php echo esc($current_article->property_price); ?> €</b></h2>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">

                                        <div class="input-group my-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Telefon</span>
                                            </div>
                                            <input type="text" name="user_name" aria-label="First name" value="<?php echo $user_pub->user_mobile; ?>" class="form-control bg-white text-right" disabled/>
                                        </div>

                                        <div class="input-group my-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Datum objave</span>
                                            </div>
                                            <?php $dt = strtotime($current_article->property_doc); ?>
                                            <input type="text" name="user_name" aria-label="First name" value="<?php echo date("d. M Y", $dt); ?>" class="form-control bg-white text-right" disabled/>
                                        </div>

                                        <div class="input-group my-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Veličina nekretnine</span>
                                            </div>
                                            <input type="text" name="user_name" aria-label="First name" value="<?php echo $current_article->property_size; ?>m²" class="form-control bg-white text-right" disabled/>
                                        </div>

                                        <?php $custom = json_decode($current_article->property_custom); ?>
                                        <?php if(@$custom): ?>
                                        <?php foreach( $custom as $add ): ?>
                                        <div class="input-group my-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><?php echo $add; ?></span>
                                            </div>
                                            <input type="text" name="user_name" aria-label="First name" value="Da" class="form-control bg-white text-right" disabled/>
                                        </div>
                                        <?php endforeach; ?>
                                        <?php endif; ?>    

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card my-3">
                            <div class="card-body">
                                <div class="row p-0">
                                    <div class="col-lg-12 my-2">
                                        <b>Detaljan Opis</b>
                                        <br><hr>
                                        <?php if(!empty($current_article->property_description)): ?>
                                        <div><?php echo esc($current_article->property_description); ?></div>
                                        <?php else: ?>
                                        <div>Nema opisa</div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="article-part my-3">
                        <div class="card">
                            <div class="card-header hide-in-mob">Podaci o autoru</div>
                            <div class="card-body">
                                <table class="card-body-table hide-in-mob">
                                    <tr>
                                        <td><img src="<?php echo base_url() . '/public/assets/img/avatars/' . $user_pub->user_avatar; ?>" alt="user-logo" /></td>
                                        <td><h3><a href="<?php echo site_url('user/profile/' . $user_pub->user_ID ); ?>" class="btn btn-link"><?php echo $user_pub->user_name; ?></a></h3></td>
                                    </tr>
                                </table>
                                <h5 class="text-left display-in-mob">Autor oglasa: <a class="user-profile-open"  href="<?php echo site_url('user/profile/' . $user_pub->user_ID ); ?>"><?php echo $user_pub->user_name; ?></a></h5>
                            </div>
                        </div>
                    </div>

                    <div class="article-part my-3">
                    <div class="card mb-4">
                        <div class="card-header">Prijavi neispravnosti</div>
                        <?php if($userdata_s): ?>
                        <div class="card-body">
                            <p><small>
                                Ukoliko smatrate da ovaj oglas ne odgovara opisu, da postoji indicija na njegove neispravnosti 
                                molimo Vas da ga prijavite kao lažan a naši administratori će Vas uskoro kontaktirati putem E-maila na profilu.
                            </small></p>
                            <a href="<?php echo site_url('adminservice/report_profile/' . $current_article->property_ID . '/' . urlencode($current_article->property_title) ); ?>" class="btn btn-danger form-control">Prijavi oglas</a>
                        </div>
                        <?php else: ?>
                            <div class="card-body">
                                <p><small>Morate biti <a href="<?php echo site_url('user'); ?>">prijavljeni</a> kako bi koristili ovu uslugu!</small></p>
                            </div>
                        <?php endif; ?>
                    </div>
                    </div>
                
                </div>
                <div class="col-lg-4 article-prop-imgs">
                    
                    <div class="card mb-3">
                        <div class="card-body">
                            <a class="btn share-btn" href="#"><i class="fa fa-share-alt"></i> Podjeli</a>
                        </div>
                    </div>

                    <?php if(@$prop_imgs): ?>
                        <?php foreach($prop_imgs as $img): ?>
                            <img src="<?php echo $img->image_path; ?>" alt="prop-img" class="img img-thumbnail" />
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- This Page need Carousel -->
<div class="page-carousel">
    <div class="nested-carousel">
        <div class="nested-carousel-close">
            <button class="btn basic-font"><i class="fa fa-remove"></i></button>
        </div>
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <!-- slider -->
            <div class="carousel-inner">
                <?php $first_slide = true; ?>
                <?php if(@$prop_imgs): ?>
                    <?php $img_size = sizeof($prop_imgs); ?>
                    <?php for( $i = 0; $i < $img_size; $i++ ): ?>      
                    <div class="carousel-item <?php if($i == 0){ echo 'active'; } ?>">
                        <img class="d-block w-100" src="<?php echo $prop_imgs[$i]->image_path; ?>" alt="slide">
                    </div>
                    <?php endfor; ?>
                <?php endif; ?>
            </div>
            <!-- Move arrows -->
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
    </div>
    </div>
</div>

<!-- EOF BODY --> 

<!-- Include Footer-->
<?php echo $footer; ?>