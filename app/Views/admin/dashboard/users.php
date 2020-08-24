<!-- Like Every other HTML website lets go
     with functional Header --> 
     <?php echo $header; ?>
<!-- At the top add main navbar -->
<?php echo $menu; ?>

<!-- Main Part of dashboard page -->
<!-- is this.. create part -->
<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-lg-3"><?php echo $nav; ?></div>
        <div class="col-lg-9">
      
        <!-- Body -->
        <div class="dashboard-item bg-light p-5">
            <h1 class="text-secondary"><i class="fa fa-user"></i> Kontrola korisnika</h1>
            <hr>

            <div class="row p-5">
                <div class="col-lg-12 mb-4 basic-font">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">Pretraži korisnika</div>
                                <div class="card-body">
                                    <h4 class="mb-4">Korisnika pretražite koristeći njegov ID ili E-mail</h4>
                                    <form action="admin" method="GET" id="discover_user">
                                        <input type="text" class="form-control" name="user_id" id="user_search_id" />
                                        <button class="btn btn-primary mt-3"><i class="fa fa-search"></i> Potraži</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">

                            <div class="card d-none" id="display_user_admin">
                                <div class="card-header">Podaci o korisniku</div>
                                <div class="card-body user-small-screen">
                                        <h4 class="users_user_name">Ime i Prezime</h4>
                                        <small class="text-secondary users_user_email">denis@localhost</small>
                                        <table class="table mt-3 border">
                                            <tr>
                                                <td id="user-active-status"><button class="btn btn-success">Aktivan</button></td>
                                                <td id="user-last-online"><button class="btn">23-01-2017</button></td>
                                                <td id="user-remove"><button class="btn btn-primary delete-user" data-id="0" disabled>Obriši korisnika</button></td>
                                            </tr>
                                        </table>
                                        <table class="table table-striped user-props-admin">
                                            <thead class="bg-dark text-white">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Naziv</th>
                                                    <th>Obriši</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mt-4">
                    <table class="table table-dark">
                        <thead>
                            <tr class="small">
                                <th>User ID</th>
                                <th>User Name</th>
                                <th>User E-mail</th>
                                <th>User Role</th>
                                <th>User Last Update</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if( !empty($user_list) ): ?>
                                <?php foreach($user_list as $user): ?>
                                    <tr class="user-row" data-id="<?php echo $user->user_ID; ?>">
                                        <td><?php echo $user->user_ID; ?></td>
                                        <td><?php echo $user->user_name; ?></td>
                                        <td><?php echo $user->user_email; ?></td>
                                        <td><?php echo $user->user_role; ?></td>
                                        <td><?php echo $user->user_last_update; ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-danger delete-user" data-id="<?php echo $user->user_ID; ?>" disabled><i class="fa fa-remove"></i> Obrisi</button>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="5">Nema Korisnika</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    
                    <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="<?php echo site_url('admin/users?page=' . $current_p ); ?>"><i class="fa fa-refresh"></i> Osvjezi</a></li>
                        <?php if($prev_page > 0): ?>
                        <li class="page-item"><a class="page-link" href="<?php echo site_url('admin/users?page=' . $prev_page ); ?>">Prethodna</a></li>
                        <?php endif; ?>
                        <?php if( !empty($user_list) && sizeof($user_list) >= 5 ): ?>
                        <li class="page-item"><a class="page-link" href="<?php echo site_url('admin/users?page=' . $next_page ); ?>">Sljedeca</a></li>
                        <?php endif; ?>
                    </ul>
                    </nav>

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