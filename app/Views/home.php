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
    <div class="col-lg-3 page-navigation">
        <div class="in-page-nav">
            <ul>
                <li><i class="fa fa-angle-right"></i> Šta nudimo</li>
                <?php if($prop_types): ?>
                    <?php foreach($prop_types as $prop): ?>
                        <li><i class="fa fa-angle-right"></i> <a href="<?php echo site_url('search?property_type=' . $prop->ID ) ?>"><?php echo $prop->type; ?></a></li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>(Prazno)</p>
                <?php endif; ?>
            </ul>
        </div>
        <div class="in-page-nav mt-5">
            <ul>
                <li><i class="fa fa-angle-right"></i> Šta vas zanima</li>
                <?php if($rent_types): ?>
                    <?php foreach($rent_types as $rent): ?>
                        <li><i class="fa fa-angle-right"></i> <a href="<?php echo site_url('search?property_rent=' . $rent->ID ) ?>"><?php echo $rent->type; ?></a></li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>(Prazno)</p>
                <?php endif; ?>
            </ul>
        </div>
        <div class="in-page-nav mt-5">
            <ul>
                <li><i class="fa fa-angle-right"></i> Lokacije</li>
                <?php if($locations): ?>
                    <?php foreach($locations as $loc): ?>
                        <li><i class="fa fa-angle-right"></i> <a href="<?php echo site_url('search?property_location=' . $loc->property_location ); ?>"><?php echo $loc->property_location; ?></a></li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>(Prazno)</p>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <div class="col-lg-9 bg-white in-page basic-font">

        <form action="<?php echo site_url('search'); ?>" METHOD="GET">
        <div class="row article-search p-4 bg-light">
            
            <div class="col-lg-12">
                <h4 class="text-center">Detaljna Pretraga</h4>
                <hr>
            </div>
            
            <div class="col-lg-4 my-3">
                <label>Vrsta nekretnine</label>
                <select name="property_type" class="form-control" <?php if(!$prop_types){ echo "disabled"; } ?>>
                    <?php if( $prop_types ): ?>
                        <?php foreach( $prop_types as $p_t ): ?>
                            <option value="<?php echo $p_t->ID; ?>"><?php echo $p_t->type; ?></option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="none">(Prazno)</option>
                    <?php endif; ?>
                </select>
            </div>
            
            <div class="col-lg-4 my-3">
                <label>Vrsta najma</label>
                <select name="property_rent" class="form-control" <?php if(!$rent_types){ echo "disabled"; } ?>>
                    <?php if( $rent_types ): ?>
                        <?php foreach( $rent_types as $p_t ): ?>
                            <option value="<?php echo $p_t->ID; ?>"><?php echo $p_t->type; ?></option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="">(Prazno)</option>
                    <?php endif; ?>
                </select>
            </div>
            
            <div class="col-lg-4 my-3">
                <label>Lokacija</label>
                <select name="property_location" class="form-control" <?php if(!$locations){ echo "disabled"; } ?>>
                    <?php if( $locations ): ?>
                        <?php foreach( $locations as $p_t ): ?>
                            <option value="<?php echo $p_t->property_location; ?>"><?php echo $p_t->property_location; ?></option>
                        <?php endforeach; ?>
                        <?php else: ?>
                            <option>(Prazno)</option>
                        <?php endif; ?>
                </select>
            </div>

            <div class="col-lg-6 my-3 prop-price-form">
                <label>Cijena</label>
                <ul>
                    <li class="text-left"><input class="form-control" type="number" name="prop_price_min" placeholder="npr. Od 0" /></li>
                    <li class="text-right"><input class="form-control" type="number" name="prop_price_max" placeholder="npr. Do 100" /></li>
                </ul>
                <small class="text-secondary">
                    Opseg cijene je između <span class="pp-min">0</span>€ i <span class="pp-max">0</span>€
                </small>
            </div>

            <div class="col-lg-6 my-3 prop-price-form">
                <label>Veličina</label>
                <ul class="text-right">
                    <li class="text-left"><input class="form-control" type="number" name="prop_size_min" placeholder="npr. Od 0" /></li>
                    <li class="text-right"><input class="form-control" type="number" name="prop_size_max" placeholder="npr. Do 100" /></li>
                </ul>
                <small class="text-secondary">
                    Opseg veličine je između <span class="ps-min">0</span>m² i <span class="ps-max">0</span>m²
                </small>
            </div>

            <div class="col-lg-12 custom-search-option">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">Dodatna pretraga</div>
                            <div class="card-body">
                            <ul class="custom-list">
                                <?php if($custom_types): ?>
                                    <?php foreach($custom_types as $c_t): ?>
                                    <li><input type="checkbox" name="custom[]" value="<?php echo $c_t->type; ?>"><span><?php echo $c_t->type; ?></span></li>
                                    <?php endforeach; ?> 
                                <?php else: ?>
                                    <p>(Prazno)</p>
                                <?php endif; ?>
                            </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label>Dio Grada</label>
                        <input class="form-control" type="text" name="property_prec_location" id="property_prec_log" placeholder="Dio grada" />
                    </div>
                </div>
            </div>

            <div class="col-lg-12 text-right">
                <hr>
                <button class="btn btn-primary more-options"><i class="fa fa-th-list"></i> Dodatna pretraga</button>
                <button class="btn btn-success"><i class="fa fa-search"></i> Pretraži</button>
            </div>

        </div>
        </form>

        <div class="row row-eq-height articles mt-5 article-list">
            <?php if($articles): ?>
                <?php foreach($articles as $article): ?>
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
            <?php else: ?>
                    <div class="alert text-center">
                        <p>(Trenutno nema odgovarajućih oglasa)</p>
                        <p><a href="<?php echo site_url('home/add_article'); ?>">Dodajte oglas!</a></p>
                    </div>
            <?php endif; ?>

            <!-- Pagination -->
            <div class="col-lg-12 text-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php if($prev_page > 0): ?>
                    <li class="page-item"><a class="page-link" href="<?php echo site_url('home?page=' . $prev_page ); ?>">Prethodna</a></li>
                    <?php endif; ?>
                    <?php if( !empty($articles) && sizeof($articles) >= 50 ): ?>
                    <li class="page-item"><a class="page-link" href="<?php echo site_url('home?page=' . $next_page ); ?>">Sljedeca</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
            </div>
        </div>

    </div>
    </div>
</div>
<!-- EOF BODY --> 

<!-- Include Footer-->
<?php echo $footer; ?>