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
                    <li><i class="fa fa-angle-right"></i> Prijava korisnika</li>
                </ul>
            </div>
        </div>
        <div class="col-lg-9 in-page prop-content bg-light pt-4">
            <?php if($error): ?>
                <div class="alert alert-danger">Korisnik nije kreiran</div>
            <?php elseif($success): ?>
                <div class="alert alert-success">Korisnik je kreiran</div>
            <?php else: ?>
            <form id="register-article-form" action="<?php echo site_url('adminservice/login_user'); ?>" method="POST">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="text-center">Prijavi se</h4>
                        <hr>
                    </div>
                    <div class="col-lg-6 my-3">
                        <label>E-mail</label>
                        <input class="form-control" type="email" name="user_email" placeholder="e.g user0123@mail.com" />
                    </div>
                    <div class="col-sm-6"></div>
                    <div class="col-lg-6 my-3">
                        <label>Lozinka</label>
                        <input class="form-control" type="password" name="user_password" placeholder="*****" />    
                    </div>
                    <?php if(@$_GET['errorl']): ?>
                    <div class="col-sm-12">
                        <div class="alert alert-danger">
                            <?php if($_GET['errorl'] == 1): ?>
                            <p>Lozinka nije tačna!</p>
                            <?php elseif($_GET['errorl'] == 2): ?>
                                <p>Upisani podaci ne odgovaraju nijednom korisniku u bazi!</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="col-lg-12 my-3 text-left">
                        <button name="user_form_submited" value="1" class="form-lg btn btn-success">Prijavi se</button>
                    </div>
                </div>
            </form>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- Include Important Footer -->
<?php echo $footer; ?>