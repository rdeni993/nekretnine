<!-- Include Important Headers -->
<?php echo $header; ?>
<!-- Main Navigation -->
<?php echo $navigation; ?>

<!-- Default Layout 3-9 -->
<div class="container basic-font">
    <div class="row mt-5">
        <div class="col-lg-3">
            <div class="in-page-nav">
                <ul>
                    <li><i class="fa fa-angle-right"></i> Dodaj oglas</li>
                    <li><i class="fa fa-angle-right"></i><a href="#" class="open-form-button active" data-id="basic-form-info">Osnovne informacije</a></li>
                    <li><i class="fa fa-angle-right"></i><a href="#" class="open-form-button" data-id="describe-form-info">Dodatne informacije</a></li>
                    <li><i class="fa fa-angle-right"></i><a href="#" class="open-form-button" data-id="image-form-info">Dodaj slike</a></li>
                </ul>
            </div>
        </div>
        <?php if(@$user_reg): ?>
        <?php if($user_data->user_activate == 0): ?>
        <div class="col-lg-9 in-page prop-content bg-light pt-3">
            <div class="bg-light p-3">
                <div class="alert">
                    Vaš nalog je kreiran ali ga niste potvrdili! Molimo da pogledate svoj E-mail i slijedite upustva iz E-maila. 
                    U slučaju da niste dobili E-mail pogledajte Vaš Spam ili nas kontaktirajte...
                </div>
            </div>
        </div>
        <?php else: ?>
        <div class="col-lg-9 in-page prop-content bg-light pt-3">
            <?php if($error): ?>
                <div class="alert alert-danger">Somethings is wrong with database connection! Please Contact Administrator!!!</div>
            <?php else: ?>
            <div class="bg-light p-3">
                <form id="main-article-form" action="<?php echo site_url('adminservice/add_article'); ?>" enctype="multipart/form-data" method="POST">
                    <!-- HIDDEN FIELDS -->
                    <input type="hidden" name="article_proposed" value="true" />
                    
                    <div class="row new-article basic-font">
                        <div class="col-sm-12">
                            <h4 class="text-center">Dodaj oglas</h4>
                            <hr>
                        </div>
                        <div class="basic-form-info col-lg-12">
                            <div class="row">

                                <div class="col-lg-12 my-3">
                                    <label>Naziv Oglasa</label>
                                    <input class="form-control" type="text" name="property_title" placeholder="primjer: Prodajem Dvosoban Stan" />
                                </div>
                                <div class="col-lg-4 my-3">
                                    <label>Tip Nekretnine</label>
                                    <select name="property_type" class="form-control" id="prop_type">
                                        <?php if(@$prop_types): ?>
                                            <?php foreach($prop_types as $prop): ?>
                                                <option value="<?php echo $prop->ID; ?>"><?php echo $prop->type; ?></option>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <option value="0">(Prazno)</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="col-lg-4 my-3">
                                    <label>Tip Najma Nekretnine</label>
                                    <select name="property_rent" class="form-control" id="rent_type">
                                        <?php if(@$rent_types): ?>
                                            <?php foreach($rent_types as $prop): ?>
                                                <option value="<?php echo $prop->ID; ?>"><?php echo $prop->type; ?></option>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <option value="0">(Prazno)</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="col-lg-4 my-3">
                                    <label>Lokacija Nekretnine</label>
                                    <input class="form-control" type="text" name="property_location" placeholder="eg. Herceg Novi" />
                                </div>
                                <div class="col-lg-4 my-3 border p-4">
                                    <label>Dodatne opcije</label>
                                    <br>
                                    <br>
                                    <?php if(@$custom_types): ?>
                                        <ul class="add-article-list">
                                        <?php foreach($custom_types as $custom): ?>
                                            <li><input class="mr-2" type="checkbox" name="custom[]" value="<?php echo $custom->type; ?>" /> <?php echo $custom->type; ?></li>
                                        <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-4 my-3">                                   
                                    <label>Cijena</label> 
                                    <input class="form-control" type="number" name="property_price" placeholder="eg. 650€" />
                                </div>
                                <div class="col-lg-4 my-3">
                                    <label>Površina nekretnine</label>
                                    <input class="form-control" type="number" name="property_size" value="1" placeholder="eg. 1000m²" />
                                </div>

                            </div>
                        </div>
                        <div class="describe-form-info col-lg-12">
                            <div class="form-group p-4">
                                <label>Određeni dio grada</label>
                                <input type="text" class="form-control" name="property_prec_location" id="#" placeholder="Dio grada gdje se nalazi nekretnine" />
                            </div>
                            <div class="form-group p-4">
                                <label>Opiši nekretninu</label>
                                <textarea class="form-control" name="property_description" id="prop_desc" cols="30" rows="10" placeholder="Kratak opis..."></textarea>
                            </div>
                        </div>
                        <div class="image-form-info col-lg-12 bg-white">                      
                            <div class="form-group p-4">
                                <label>Dodaj Slike</label>
                                <input class="form-control my-3" type="file" name="property_images[]" accept=".jpg,.png" multiple />
                                <input class="form-control my-3" type="file" name="property_images[]" accept=".jpg,.png" multiple />
                                <input class="form-control my-3" type="file" name="property_images[]" accept=".jpg,.png" multiple />
                                <input class="form-control my-3" type="file" name="property_images[]" accept=".jpg,.png" multiple />
                                <input class="form-control my-3" type="file" name="property_images[]" accept=".jpg,.png" multiple />
                                <input class="form-control my-3" type="file" name="property_images[]" accept=".jpg,.png" multiple />
                                <input class="form-control my-3" type="file" name="property_images[]" accept=".jpg,.png" multiple />
                                <input class="form-control my-3" type="file" name="property_images[]" accept=".jpg,.png" multiple />
                                <input class="form-control my-3" type="file" name="property_images[]" accept=".jpg,.png" multiple />
                                <input class="form-control my-3" type="file" name="property_images[]" accept=".jpg,.png" multiple />
                                <div class="more-images"></div>
                                <!--<button class="btn btn-primary mt-4" id="add_more_imgs"><i class="fa fa-plus"></i> Dodaj još slika...</button>-->
                            </div>
                        </div>
                        <div class="col-lg-12"> 
                        <div class="text-right">
                            <hr>
                            <button class="btn btn-primary display-in-mob"><i class="fa fa-star-half"></i> Još mogućnosti</button>
                            <button class="btn btn-success"><i class="fa fa-handshake-o"></i> Post Article</button>
                        </div>
                        </div>
                    </div>
                </form>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        <?php else: ?>
        <div class="col-lg-9 in-page prop-content bg-light pt-3">
            <div class="bg-light p-3">
                <div class="alert text-center m-4">
                    <h4><i class="fa fa-warning mb-4"></i> Potreban Vam je Nalog</h4>
                    Kako bi ste koristili uslugu kreiranja oglasa morate biti prijavljeni na naš sistem!
                    <br>
                    Ako nemate naloga molimo da ga <a class="btn btn-link" href="<?php echo site_url('user/register') ?>">Izradite ovdje</a>
                    ili da se <a class="btn btn-link" href="<?php echo site_url('user/login') ?>">Prijavite</a> ukoliko već imate nalog.
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<!-- Include Important Footer -->
<?php echo $footer; ?>