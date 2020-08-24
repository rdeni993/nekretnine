<?php 

// Set Namespace
namespace App\Controllers;

// Default Controller
use CodeIgniter\Controller;

/**
 * 
 * This is administrators homepage
 * and only administrators can
 * view this... 
 * 
 * ===============================
 * 
 * 
 */

 class Admin extends Controller{

    // Page Name: Dashboard
    // --------------------
    //
    // Page Description:
    //
    // Administrator Dashboard
    // place where everythin happens.. 
    //
    public function index(){

        // Every Admin must be logged in
        // and have admin priv..
        $session    = session();
        $user_login = $session->get('logged_in');
        $user_data  = $session->get('logged_data');

        if( !$user_login || $user_data->user_role != 'admin' ){
            return redirect()->to(site_url('user/login'));
        }

        // We need two models
        // here... 
        $props = model('PropertyModel');
        $users = model('UserModel');

        # Render #
        return view('admin/dashboard', [
            
            'header'   => view('admin/header'),
            'menu'     => view('admin/main_menu'),
            'nav'      => view('admin/navigation'),
            'footer'   => view('admin/footer'),
            'all_props'=> $props->all_props(),
            'last_five_props' => $props->first_five_props(),
            'prop_rent' => $props->get_props('rent_type'),
            'prop_type' => $props->get_props('property_type'),
            'user_count' => $users->all_users(0),
            'users'      => $users->all_users_inv(0),
            'all_images' => $props->all_images()
        
        ]);

    }

    // Page Name: Property Control
    // --------------------
    //
    // Page Description:
    //
    // Control Property
    // Add or remove
    public function property(){

        // Every Admin must be logged in
        // and have admin priv..
        $session    = session();
        $user_login = $session->get('logged_in');
        $user_data  = $session->get('logged_data');

        if( !$user_login || $user_data->user_role != 'admin' ){
            return redirect()->to(site_url('user/login'));
        }

        # Models #
        $prop_model = model('PropertyModel');

        # Error Handler #
        $error_handler = false;
        $success_handler = false;

        $errors = [
            "1e" => "Cannot Access to Service Direct",
            "2e" => "Cannot Add Empty Field",
            "3e" => "Something is wrong with Database Connection",
            "4e" => "Error Occured! Undefined!"
        ];

        $success = [

            "1e" => "Property Type is added to Database! It is available now.."

        ];

        # Check For Error #
        if( @$this->request->getGet('error') ){ 
            if( array_key_exists($this->request->getGet('error'), $errors) ){
                $error_handler = $errors[$this->request->getGet('error')];
            } else {
                $error_handler = $errors['4e'];
            }
        }

        # Check For Response #
        if( @$this->request->getGet('success') ){ 
            if( array_key_exists($this->request->getGet('success'), $success) ){
                $success_handler = $success[$this->request->getGet('success')];
            } else {
                $error_handler = $errors['4e'];
            }
        }

        # Render #
        return view('admin/dashboard/property', [
            
            'header'     => view('admin/header'),
            'menu'       => view('admin/main_menu'),
            'nav'        => view('admin/navigation'),
            'footer'     => view('admin/footer'),
            'error'      => $error_handler ? $error_handler : false,
            'success'    => $success_handler ? $success_handler : false,
            'properties' => $prop_model->get_props("property_type")

        ]);

    }

    
    // Page Name: Rent Control
    // --------------------
    //
    // Page Description:
    //
    // Control Rent
    // Add or remove

    public function rent(){

        // Every Admin must be logged in
        // and have admin priv..
        $session    = session();
        $user_login = $session->get('logged_in');
        $user_data  = $session->get('logged_data');

        if( !$user_login || $user_data->user_role != 'admin' ){
            return redirect()->to(site_url('user/login'));
        }

        # Models #
        $prop_model = model('PropertyModel');

        # Error Handler #
        $error_handler = false;
        $success_handler = false;

        $errors = [
            "1e" => "Cannot Access to Service Direct",
            "2e" => "Cannot Add Empty Field",
            "3e" => "Something is wrong with Database Connection",
            "4e" => "Error Occured! Undefined!"
        ];

        $success = [

            "1e" => "Rent Type is added to Database! It is available now.."

        ];

        # Check For Error #
        if( @$this->request->getGet('error') ){ 
            if( array_key_exists($this->request->getGet('error'), $errors) ){
                $error_handler = $errors[$this->request->getGet('error')];
            } else {
                $error_handler = $errors['4e'];
            }
        }

        # Check For Response #
        if( @$this->request->getGet('success') ){ 
            if( array_key_exists($this->request->getGet('success'), $success) ){
                $success_handler = $success[$this->request->getGet('success')];
            } else {
                $error_handler = $errors['4e'];
            }
        }

        # Render #
        return view('admin/dashboard/rent', [
            
            'header'     => view('admin/header'),
            'menu'       => view('admin/main_menu'),
            'nav'        => view('admin/navigation'),
            'footer'     => view('admin/footer'),
            'error'      => $error_handler ? $error_handler : false,
            'success'    => $success_handler ? $success_handler : false,
            'properties' => $prop_model->get_props("rent_type")

        ]);

    }

    
    // Page Name: Custom Fields Control
    // ---------------------------------
    //
    // Page Description:
    //
    // Control Custom Additional Fields
    // Add or remove

    public function custom(){

        // Every Admin must be logged in
        // and have admin priv..
        $session    = session();
        $user_login = $session->get('logged_in');
        $user_data  = $session->get('logged_data');

        if( !$user_login || $user_data->user_role != 'admin' ){
            return redirect()->to(site_url('user/login'));
        }

        # Models #
        $prop_model = model('PropertyModel');

        # Error Handler #
        $error_handler = false;
        $success_handler = false;

        $errors = [
            "1e" => "Cannot Access to Service Direct",
            "2e" => "Cannot Add Empty Field",
            "3e" => "Something is wrong with Database Connection",
            "4e" => "Error Occured! Undefined!"
        ];

        $success = [

            "1e" => "Element added to Database! It is available now.."

        ];

        # Check For Error #
        if( @$this->request->getGet('error') ){ 
            if( array_key_exists($this->request->getGet('error'), $errors) ){
                $error_handler = $errors[$this->request->getGet('error')];
            } else {
                $error_handler = $errors['4e'];
            }
        }

        # Check For Response #
        if( @$this->request->getGet('success') ){ 
            if( array_key_exists($this->request->getGet('success'), $success) ){
                $success_handler = $success[$this->request->getGet('success')];
            } else {
                $error_handler = $errors['4e'];
            }
        }

        # Render #
        return view('admin/dashboard/custom', [
            
            'header'     => view('admin/header'),
            'menu'       => view('admin/main_menu'),
            'nav'        => view('admin/navigation'),
            'footer'     => view('admin/footer'),
            'error'      => $error_handler ? $error_handler : false,
            'success'    => $success_handler ? $success_handler : false,
            'properties' => $prop_model->get_props("customs_type")

        ]);

    }

    
    // Page Name: User Control Page
    // ---------------------------------
    //
    // Page Description:
    //
    // Control Custom Additional Users
    // Add or remove
    public function users(){

        // Every Admin must be logged in
        // and have admin priv..
        $session    = session();
        $user_login = $session->get('logged_in');
        $user_data  = $session->get('logged_data');

        if( !$user_login || $user_data->user_role != 'admin' ){
            return redirect()->to(site_url('user/login'));
        }

        # load users model
        $users = model("UserModel");
        # user list
        $user_list = false;
        # Set limit & offset
        $limit = 1;
        $offset = 0;
        $current_p = 0;

        if( @$this->request->getGet('page') ){
            // Check is page valid it cannot be 0
            if( $this->request->getGet('page') == 0 ){
                $offset = 0;
            } else {
                $offset = ( ( $this->request->getGet('page') - 1 ) * 50 );
                $current_p = $this->request->getGet('page');
            }
        }

        # Render #
        return view('admin/dashboard/users', [
            
            'header'     => view('admin/header'),
            'menu'       => view('admin/main_menu'),
            'nav'        => view('admin/navigation'),
            'footer'     => view('admin/footer'),
            'user_list'  => $users->all_users($offset),
            'current_p'  => $current_p,
            'next_page'  => $current_p + 1,
            'prev_page'  => $current_p - 1

        ]);
    }

    
    // Page Name: Properties
    // ---------------------------------
    //
    // Page Description:
    //
    // Control and Watch Added Properties
    public function properties(){

        // Every Admin must be logged in
        // and have admin priv..
        $session    = session();
        $user_login = $session->get('logged_in');
        $user_data  = $session->get('logged_data');

        if( !$user_login || $user_data->user_role != 'admin' ){
            return redirect()->to(site_url('user/login'));
        }

        # load users model
        $props = model("PropertyModel");
        # user list
        $user_list = false;
        # Set limit & offset
        $limit = 1;
        $offset = 0;
        $current_p = 0;

        if( @$this->request->getGet('page') ){
            // Check is page valid it cannot be 0
            if( $this->request->getGet('page') == 0 ){
                $offset = 0;
            } else {
                $offset = ( ( $this->request->getGet('page') - 1 ) * 50 );
                $current_p = $this->request->getGet('page');
            }
        }

        # Render #
        return view('admin/dashboard/properties', [
            
            'header'     => view('admin/header'),
            'menu'       => view('admin/main_menu'),
            'nav'        => view('admin/navigation'),
            'footer'     => view('admin/footer'),
            'props'      => $props->list_props($offset),
            'current_p'  => $current_p,
            'next_page'  => $current_p + 1,
            'prev_page'  => $current_p - 1

        ]);
    }


    
    // Page Name: Reports
    // ---------------------------------
    //
    // Page Description:
    //
    // Control and Watch Added Reports
    public function reports(){

        // Every Admin must be logged in
        // and have admin priv..
        $session    = session();
        $user_login = $session->get('logged_in');
        $user_data  = $session->get('logged_data');

        if( !$user_login || $user_data->user_role != 'admin' ){
            return redirect()->to(site_url('user/login'));
        }

        # load users model
        $props = model("PropertyModel");
        $report = model("ReportModel");
        # user list
        $user_list = false;
        # Set limit & offset
        $limit = 1;
        $offset = 0;
        $current_p = 0;

        if( @$this->request->getGet('page') ){
            // Check is page valid it cannot be 0
            if( $this->request->getGet('page') == 0 ){
                $offset = 0;
            } else {
                $offset = ( ( $this->request->getGet('page') - 1 ) * 50 );
                $current_p = $this->request->getGet('page');
            }
        }

        # Render #
        return view('admin/dashboard/reports', [
            
            'header'     => view('admin/header'),
            'menu'       => view('admin/main_menu'),
            'nav'        => view('admin/navigation'),
            'footer'     => view('admin/footer'),
            'props'      => $props->list_props($offset),
            'reports'    => $report->get_active_joined(),
            'ereports'   => $report->get_all(),
            'current_p'  => $current_p,
            'next_page'  => $current_p + 1,
            'prev_page'  => $current_p - 1

        ]);
    }

 }