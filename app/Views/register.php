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
                    <li><i class="fa fa-angle-right"></i> Registracija korisnika</li>
                </ul>
            </div>
        </div>
        <?php if(!$user_reg): ?>
        <div class="col-lg-9 in-page prop-content bg-light pt-4">
            <?php if($error): ?>
                <div class="alert alert-danger">Korisnik nije kreiran</div>
            <?php elseif($success): ?>
                <div class="alert alert-success">Korisnik je kreiran. Vaš nalog je spreman ali da biste objavljivali
                    oglase morate ga potvrditi koristeći Vaš E-mail..
                </div>
            <?php else: ?>
            <form id="register-article-form" action="<?php echo site_url('adminservice/register_user'); ?>" method="POST">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="text-center">Registracija korisnika</h4>
                        <hr>
                    </div>
                    <div class="col-lg-6 my-3">
                        <label>Ime korisnika</label>
                        <input class="form-control" type="text" name="user_name" placeholder="e.g Petar Petrovic" />
                    </div>
                    <div class="col-lg-6 my-3">
                        <label>E-mail</label>
                        <input class="form-control" type="email" name="user_email" placeholder="e.g user0123@mail.com" />
                    </div>
                    <div class="col-lg-6 my-3">
                        <label>Lozinka</label>
                        <input class="form-control" type="password" name="user_password" placeholder="*****" />    
                    </div>
                    <div class="col-lg-6 my-3">
                        <label>Ponovi lozinku</label>
                        <input class="form-control" type="password" name="user_password_retype" placeholder="*****" />
                    </div>
                    <div class="col-lg-12">
                    <p><small>* Napomena: Sva polju su neophodna za izradu Vašeg naloga. Dodatne opcije se nalaze unutar profila
                    i one se kontroliši sa naloga.</small></p>
                    </div>
                    <div class="col-lg-12 my-3 text-left">
                        <input type="hidden" name="user_avatar" value="64_1.png" />
                        <button name="user_form_submited" value="1" class="form-lg btn btn-success">Registriraj se</button>
                    </div>
                </div>
            </form>
            <?php endif; ?>
        </div>
        <?php else: ?>
            <div class="col-lg-9 in-page prop-content bg-light pt-4">
                <div class="alert">Već ste prijavljeni na stranicu! Dok se ne odjavite ova usluga nije moguća!</div>
                <div class="m-3">
                    <a href="<?php echo site_url('user'); ?>" class="btn btn-success"><i class="fa fa-user"></i> Otvori profil!</a>
                    <a href="<?php echo site_url('user/logout'); ?>" class="btn btn-success"><i class="fa fa-sign-out"></i> Odjavi se</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<!-- Include Important Footer -->
<?php echo $footer; ?>