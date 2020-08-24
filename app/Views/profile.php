<!-- Include Important Headers -->
<?php echo $header; ?>
<!-- Main Navigation -->
<?php echo $navigation; ?>

<!-- Default Layout 3-9 -->
<div class="container basic-font">
    <div class="row mt-5">
        <div class="col-lg-3">
            <div class="in-page-nav user-profile-switcher">
                <ul>
                    <li><i class="fa fa-angle-right"></i> Opcije korisnika</li>
                    <li><i class="fa fa-angle-right"></i> <a href="#" class="active" data-id="user-basic-info">Osnovni podaci</a></li>
                    <li><i class="fa fa-angle-right"></i> <a href="#" data-id="user-add-info">Dodatni podaci</a></li>
                    <li><i class="fa fa-angle-right"></i> <a href="#" data-id="user-articles-info">Moji oglasi</a></li>
                    <li><i class="fa fa-angle-right"></i> <a href="#" data-id="user-password-info">Promjeni lozinku</a></li>
                    <?php if($userdata->user_role == 'admin'): ?>
                    <li><i class="fa fa-angle-right"></i> <a href="<?php echo site_url('admin'); ?>" data-id="admin">Admin</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <div class="col-lg-9 in-page prop-content bg-light p-4">
            <div class="row user-dashboard">
                <div class="col-sm-12">
                    
                <?php if(@$e_m): ?>
                    <?php if(@$e_m_sign == 200): ?>
                        <div class="alert alert-success"><?php echo $e_m; ?></div>
                    <?php else: ?>
                        <div class="alert alert-danger"><?php echo $e_m; ?></div>
                    <?php endif; ?>
                <?php endif; ?>

                </div>
                <!-- Title -->
                <div class="col-lg-12 text-center">
                    <h4 class="text-center">Podaci o profilu: <?php echo $userdata->user_name; ?></h4>
                    <hr>
                </div>

                    
                <form method="POST" action="<?php echo site_url('adminservice/change_my_data') ?>">
               
                <!-- Basic User Data -->
                <div class="col-lg-12 user-dash user-basic-info">
                    <div class="bg-white text-secondary border">

                        <div class="row">
                            <!-- USER BASIC INFO -->
                            <div class="col-lg-12 p-4">

                                <div class="input-group my-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Ime Korisnika</span>
                                    </div>
                                    <input type="text" name="user_name" aria-label="First name" value="<?php echo $userdata->user_name; ?>" class="form-control">
                                </div>

                                <div class="input-group my-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">E-mail Korisnika</span>
                                    </div>
                                    <input type="text" name="user_email" aria-label="First name" value="<?php echo $userdata->user_email; ?>" class="form-control" disabled>
                                </div>

                                <div class="input-group my-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Datum kreiranja naloga</span>
                                    </div>
                                    <?php $hash_date = strtotime($userdata->user_doc); ?>
                                    <input type="text" aria-label="First name" value="<?php echo date("d. M. Y", $hash_date); ?>" class="form-control" disabled>
                                </div>

                                <div class="input-group my-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Tip naloga</span>
                                    </div>
                                    <?php 
                                        $role = '';
                                        switch($userdata->user_role){
                                            case 'user': { $role = 'Obični korisnik'; } break;
                                            case 'admin'  : { $role = 'Administrator'; } break;
                                            case 'premium': { $role = 'Plaćeni korisnik'; } break;
                                            default:{ $role = 'Obični korisnik'; }
                                        }
                                    ?>
                                    <input type="text" aria-label="First name" value="<?php echo $role; ?>" class="form-control" disabled>
                                </div>

                                <div class="input-group my-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Nalog Aktiviran</span>
                                    </div>
                                    <input type="text" aria-label="First name" value="<?php if($userdata->user_activate){ echo 'Aktiviran'; } else{ echo 'Nije aktiviran'; } ?>" class="form-control <?php if($userdata->user_activate){ echo 'bg-success text-white'; } else{ echo 'bg-warning'; } ?>" disabled>
                                </div>

                                <div class="text-right">
                                    <button class="btn btn-primary display-in-mob"><i class="fa fa-star-half"></i> Još mogućnosti</button>
                                    <button class="btn btn-success">Promjeni</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- ADD USER INFOR -->
                <div class="col-lg-12 user-dash user-add-info">
                    <div class="bg-white text-secondary border">
                        <div class="row">                            
                            <!-- ADDITIONAL USER DATA -->
                            <div class="col-lg-12 p-4">
                                <div class="input-group my-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Adresa Korisnika</span>
                                    </div>
                                    <input type="text" name="user_address" aria-label="First name" value="<?php echo $database_user->user_address; ?>" class="form-control">
                                </div>
                                <div class="input-group my-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Telefon Korisnika</span>
                                    </div>
                                    <input type="text" name="user_mobile" aria-label="First name" value="<?php echo $database_user->user_mobile; ?>" class="form-control">
                                </div>
                                <div class="text-right">
                                    <button class="btn btn-primary display-in-mob"><i class="fa fa-star-half"></i> Još mogućnosti</button>
                                    <button class="btn btn-success">Promjeni</button>
                                </div>
                            </div>
                            <!-- EOF ADDITIONAL USER DATA -->
                        </div>
                    </div>
                </div>

                
                </form>
                
                
                <!-- ADD USER ARTICLES -->
                <div class="col-lg-12 user-dash user-articles-info">
                    <div class="bg-white text-secondary border">
                        <div class="row">                            
                            <!-- USER ARTICLES INFO -->
                            <div class="col-lg-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Slika</th>
                                        <th>Title</th>
                                        <th>Datum Objave</th>
                                        <th>Status</th>
                                        <th class="text-center">Opcije</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if($my_props): ?>
                                    <?php foreach( $my_props as $prop ): ?>
                                        <tr data-id="<?php echo $prop->property_ID; ?>">
                                            <td><img src="<?php echo $prop->property_image; ?>" alt="img" /></td>
                                            <td><?php echo $prop->property_title; ?></td>
                                            <td><?php echo $prop->property_doc; ?></td>
                                            <td data-id="<?php echo $prop->property_ID; ?>"><?php if($prop->property_status == 1 ){ echo "Aktivan"; } else{ echo "Završen"; } ?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="<?php echo site_url('article/index/' . $prop->property_ID . '/' . $prop->property_title ); ?>" class="btn btn-primary">Pogledaj</a>
                                                    <button class="btn btn-light prop-finish" data-user="<?php echo $userdata->user_ID; ?>" data-id="<?php echo $prop->property_ID; ?>">Završi</button>
                                                    <button class="btn btn-light prop-remove" data-id="<?php echo $prop->property_ID; ?>">Obriši</button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                            </div>
                            <!-- EOF USER ARTUCLES INFO -->
                        </div>
                    </div>
                </div>

                
                <!-- CHANGE PASSWORD -->
                <div class="col-lg-12 user-dash user-password-info">
                    <div class="bg-white text-secondary border">
                        <div class="row">     
                            <form action="<?php echo site_url('adminservice/change_password') ?>" method="POST">                       
                            <!-- CHANGE PASSWORD -->
                            <div class="col-lg-12 m-4">
                                <label>Vaš E-mail</label>
                                <input class="form-control" placeholder="primjer mojemail@mail.com" type="email" name="user_email" />
                            </div>
                            <div class="col-lg-12 m-4">
                                <label>Stara Lozinka</label>
                                <input class="form-control" placeholder="primjer *****" type="password" name="user_old_password" />
                            </div>
                            <div class="col-lg-12 m-4">
                                <label>Nova Lozinka</label>
                                <input class="form-control" placeholder="primjer *****" type="password" name="user_password" />
                            </div>
                            <div class="col-lg-12 m-4">
                                <button class="btn btn-primary display-in-mob"><i class="fa fa-star-half"></i> Još mogućnosti</button>
                                <button class="btn btn-success">Promjeni lozinku</button>
                            </div>
                            <!-- EOF CHANGE PASSWORD -->
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Include Important Footer -->
<?php echo $footer; ?>