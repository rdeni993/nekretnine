<?php 
if(!isset($active_item)){
    $active_item = "none";
} 
$session = session();
?>
<!-- Lets Create a NavbarNavigation --> 
<nav class="view-nav p-3 basic-font">
    <div class="container">
        <div class="w w-logo no-gutters pacifico basic-color">
            <i class="fa fa-home"></i> <a class="text-dark" href="<?php echo site_url(); ?>">Nekretnine.me</a>
            <button class="open-menu"><i class="fa fa-bars"></i></button>
            <button class="open-fast mr-3"><i class="fa fa-fire"></i></button>
        </div>
        <div class="w w-search no-gutters p-0 m-0">
            <form action="<?php echo site_url('search') ?>" method="GET" class="search-form">
                <input type="text" name="s" placeholder="Pretražite oglase: npr. Dvosoban stan u Budvi" />
                <button><i class="fa fa-search"></i></button>
            </form>
        </div>
        <div class="w w-login no-gutters">
            <?php if(!$session->get('logged_in')): ?>
            <a href="<?php echo site_url('user/login'); ?>" class="basic-font basic-color">Prijavi se</a>
            <?php else: ?>
                <a href="<?php echo site_url('home/add_article'); ?>" class="btn btn-primary text-white basic-font basic-color"><i class="fa fa-plus mr-3"></i> Objavi oglas</a>
            <?php endif; ?>
        </div>
        <div class="nav-menu">
            <ul>
                <li><a class="<?php if($active_item == 'home'){ echo "active-menu-item"; } ?>" href="<?php echo site_url(); ?>"><i class="fa fa-home"></i> Početna stranica</a></li>
                <li><a class="<?php if($active_item == 'add_article'){ echo "active-menu-item"; } ?>" href="<?php echo site_url('home/add_article'); ?>">Objavi oglas</a></li>
                <li><a class="<?php if($active_item == 'register'){ echo "active-menu-item"; } ?>" href="<?php echo site_url('user/register'); ?>">Izradi nalog</a></li>
                
                <?php if($session->get('logged_in')): ?>
                <li><a class="<?php if($active_item == 'profile'){ echo "active-menu-item"; } ?>" href="<?php echo site_url('user'); ?>">Moj profil</a></li>
                <li><a href="<?php echo site_url('user/logout'); ?>">Odjavi se</a></li>
                <?php endif; ?>

            </ul>
        </div>
    </div>
</nav>