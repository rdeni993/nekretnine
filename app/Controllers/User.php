<?php namespace App\Controllers;

use CodeIgniter\Controller;

/**
 * 
 * Controller for register Users
 * 
 */
class User extends Controller{

    protected $prop_model = false;

    // Index page
    // homepage
    public function index(){
        // Allow Session
        $session = session();
        $user_model = model('UserModel');
        $prop_model = model('PropertyModel');

        // Get Loged info
        if( $session->get('logged_in') === true ){
            $user_reg = true;
        } else {
            return redirect()->to(site_url('user/login'));
        }

        // Pagination 	
		# Set limit & offset
		$limit = 1;
		$offset = 0;
        $current_p = 0;
        
        $prop_owner = $session->get('logged_data');
		
		if( @$this->request->getGet('page') ){
			// Check is page valid it cannot be 0
			if( $this->request->getGet('page') == 0 ){
				$offset = 0;
			} else {
				$offset = ( ( $this->request->getGet('page') - 1 ) * 10 );
				$current_p = $this->request->getGet('page');
			}
		}
        // First Data is set using session
        $user_session_data = $session->get('logged_data');

        // Warning Messanger generator
        $warning_m = false;
        $messages = [
            "200" => "Oglas je uspjesno postavljen",
            "201" => "Podaci uspjesno izmjenjeni! Molimo da se odjavite i ponovno prijavite!",
            "403" => "Oglas nije postavljen!",
            "404" => "Neispravan pristup stranici",
            "405" => "Izmjene nije moguće napraviti"
        ];

        if( @$this->request->getGet('e_m') ){
            $warning_m = $messages[$this->request->getGet('e_m')];
        }

        # Render Page
        return view('profile', [
			'header'           => view("admin/header",[
				'site_title'   => $GLOBALS['site_title'] . ' | ' . $user_session_data->user_name,
				'meta_tags'	   => [
					'url'      => site_url(),
					'title'    => $GLOBALS['site_title'],
					'desc'     => $GLOBALS['meta_desc'],
					'image'    => base_url() . '/public/assets/img/avatars/64_1.png'
				]
			]),
			'footer'           => view("admin/footer"),
			'navigation'       => view("navigation", [
                'active_item' => 'profile'
            ]),
            'userdata'         => $user_session_data,
            'database_user'    => $user_model->get_user($user_session_data->user_ID),
            'my_props'         => $prop_model->list_my_props($prop_owner->user_ID, $offset),
            'e_m'              => $warning_m,
            'e_m_sign'         => $this->request->getGet('e_m')
		]);
    }

    // Page Where User can enter
    // register information
    public function register(){

        // Set Session
        $session = session();
        // Get Loged info
        if( $session->get('logged_in') === true ){
            $user_reg = true;
        } else {
            $user_reg = false;
        }

        $error   = false;
        $success = false;

        if( @$this->request->getGet('success') ){
            $success = true;
        }
        if( @$this->request->getGet('error') ){
            $error = true;
        }

        // Load PropertyModels
        $this->prop_model = model("PropertyModel");

        # Render Page
        return view('register', [
			'header'           => view("admin/header",[
				'site_title'   => "Izradi novi nalog | " . $GLOBALS['site_title'],
				'meta_tags'	   => [
					'url'      => site_url(),
					'title'    => $GLOBALS['site_title'],
					'desc'     => $GLOBALS['meta_desc'],
					'image'    => base_url() . '/public/assets/img/avatars/64_1.png'
				]
			]),
			'footer'           => view("admin/footer"),
			'navigation'       => view("navigation", [
                'properties' => $this->prop_model->get_props('property_type'),
                'active_item' => 'register'
			]),
			'user_navigation'  => view("user_navigation"),
			'prop_types'       => $this->prop_model->get_props('property_type'),
			'rent_types'       => $this->prop_model->get_props('rent_type'),
            'custom_types'     => $this->prop_model->get_props('customs_type'),
            'success'          => $success,
            'error'            => $error,
            'user_reg'         => $user_reg
		]);
    }

    // Page Where User can enter
    // login information
    public function login(){

        // Every Admin must be logged in
        // and have admin priv..
        $session    = session();
        $user_login = $session->get('logged_in');
        $user_data  = $session->get('logged_data');

        if( $user_login ){
            return redirect()->to(site_url('user'));
        }

        $error   = false;
        $success = false;

        if( @$this->request->getGet('success') ){
            $success = true;
        }
        if( @$this->request->getGet('error') ){
            $error = true;
        }

        # Render Page
        return view('login', [
			'header'           => view("admin/header",[
				'site_title'   => "Prijavi se | " . $GLOBALS['site_title'],
				'meta_tags'	   => [
					'url'      => site_url(),
					'title'    => $GLOBALS['site_title'],
					'desc'     => $GLOBALS['meta_desc'],
					'image'    => base_url() . '/public/assets/img/avatars/64_1.png'
				]
			]),
			'footer'           => view("admin/footer"),
			'navigation'       => view("navigation", [
                'active_item' => 'login'
			]),
			/*'user_navigation'  => view("user_navigation"),*/
            'success'          => $success,
            'error'            => $error
		]);
    }

    // Activation page
    // This is page where user come using our link in e-mail
    // Important is we do not accept double activate email
    // or mails after 30 minutes.. 
    public function activate($user_hash){
        /** We need user model here */
        $user_model = model('UserModel');
        /** Check is there user profile with this hash */
        if( $user_hash ){
            // Get User ID
            $hash_data = $user_model->get_user_by_hash($user_hash);
            // Echo result
            $user_ID = $hash_data[0]->activator_user;
            // Activate USer
            if( $user_model->activate_user($user_ID) ){
                return redirect()->to(site_url('user/login'));
            } else {
                echo "User is not activated!";
            }
        } else {
            die("There is no valid hash");
        }
    }

    // Logout
    public function logout(){
        $session = session();
        $session->destroy();
        return redirect()->to(site_url('user/login'));
    }


    public function profile($user_ID){
        
        // Allow Session
        $session = session();
        $user_model = model('UserModel');
        $prop_model = model('PropertyModel');

        // Pagination 	
		# Set limit & offset
		$limit = 1;
		$offset = 0;
        $current_p = 0;
        
        $prop_owner = $session->get('logged_data');
		
		if( @$this->request->getGet('page') ){
			// Check is page valid it cannot be 0
			if( $this->request->getGet('page') == 0 ){
				$offset = 0;
			} else {
				$offset = ( ( $this->request->getGet('page') - 1 ) * 10 );
				$current_p = $this->request->getGet('page');
			}
		}
        // First Data is set using session
        $user_session_data = $session->get('logged_data');

        // Warning Messanger generator
        $warning_m = false;
        $messages = [
            "200" => "Oglas je uspjesno postavljen",
            "201" => "Podaci uspjesno izmjenjeni! Molimo da se odjavite i ponovno prijavite!",
            "403" => "Oglas nije postavljen!",
            "404" => "Neispravan pristup stranici",
            "405" => "Izmjene nije moguće napraviti"
        ];

        if( @$this->request->getGet('e_m') ){
            $warning_m = $messages[$this->request->getGet('e_m')];
        }

        $db_user = (@$user_model->get_user($user_ID)) ? : false;

        # Render Page
        return view('user', [
			'header'           => view("admin/header",[
				'site_title'   => $GLOBALS['site_title'] .' | '. $db_user->user_name,
				'meta_tags'	   => [
					'url'      => site_url(),
					'title'    => $GLOBALS['site_title'],
					'desc'     => $GLOBALS['meta_desc'],
					'image'    => base_url() . '/public/assets/img/avatars/64_1.png'
				]
			]),
			'footer'           => view("admin/footer"),
			'navigation'       => view("navigation", [
                'active_item' => 'profile'
            ]),
            'userdata'         => $user_session_data,
            'database_user'    => $db_user,
			'prop_types'       => $prop_model->get_props('property_type'),
			'rent_types'       => $prop_model->get_props('rent_type'),
            'e_m'              => $warning_m,
            'e_m_sign'         => $this->request->getGet('e_m'),
            'my_props'         => $prop_model->list_my_props($user_ID, 0)
		]);
    
    }
}