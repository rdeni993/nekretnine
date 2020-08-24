<!-- Lets Create a NavbarNavigation --> 
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container-fluid">
        <!-- Site Navbar Brand -->
        <a href="<?php echo site_url('admin'); ?>" class="navbar-brand">Dashboard</a>
        <!-- Button For mobile -->
        <button class="navbar-toggler" data-toggle="collapse" data-target="#cmsNavbar">
            <i class="navbar-toggler-icon"></i>
        </button>
        <!-- Links -->
        <div class="navbar-collapse collapse justify-content-between" id="cmsNavbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="<?php echo site_url(); ?>" class="nav-link"><i class="fa fa-eye"></i> View Site</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo site_url('user/logout'); ?>" class="nav-link"><i class="fa fa-sign-in"></i> Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>