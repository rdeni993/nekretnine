<?php 

// Set NameSpace
namespace App\Controllers;

// Set Base Controller
use CodeIgniter\Controller;

/**
 * 
 * Main File where users comes
 * first time after typing
 * domain..
 * ==================
 * 
 * 07/05/2020 22:45
 *  
 */
class Home extends Controller{

	protected $prop_model = false; 

	public function index(){

		$this->prop_model = model('PropertyModel');
				
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
		return view("home", [
			'header'           => view("admin/header",[
				'site_title'   => $GLOBALS['site_title'],
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
                'active_item' => 'home'
			]),
			'user_navigation'  => view("user_navigation"),
			'props' => $this->prop_model->all_props(),
			'prop_types' => $this->prop_model->get_props('property_type'),
			'rent_types' => $this->prop_model->get_props('rent_type'),
			'locations'  => $this->prop_model->get_locations(),
			'custom_types' => $this->prop_model->get_props('customs_type'),
			'articles' => $this->prop_model->list_props($offset),
            'current_p'  => $current_p,
            'next_page'  => $current_p + 1,
            'prev_page'  => $current_p - 1
		]);

	}

	/** Add New User Page */
	/** ================= */
	public function add_article(){
		// Session
		$session = session();
        // Get Loged info
        if( $session->get('logged_in') === true ){
            $user_reg = true;
        } else {
            $user_reg = false;
        }

		$this->prop_model = model('PropertyModel');

		// Error While adding article 
		// to database
		$error = false;

		if( @$this->request->getGet('error_ad') == 1 ){
			$error = true;
		}

		# Render #
		return view("add_article", [
			'header'           => view("admin/header",[
				'site_title'   => "Dodaj novi oglas | " . $GLOBALS['site_title'],
				'meta_tags'	   => [
					'url'      => site_url(),
					'title'    => $GLOBALS['site_title'],
					'desc'     => $GLOBALS['meta_desc'],
					'image'    => base_url() . '/public/assets/img/avatars/64_1.png'
				]
			]),
			'footer'           => view("admin/footer"),
			'navigation'       => view("navigation", [
				'properties'   => $this->prop_model->get_props('property_type'),
				'active_item'  => 'add_article'
			]),
			'user_navigation'  => view("user_navigation"),
			'prop_types'       => $this->prop_model->get_props('property_type'),
			'rent_types'       => $this->prop_model->get_props('rent_type'),
			'custom_types'     => $this->prop_model->get_props('customs_type'),
			'error'            => $error,
			'user_reg'		   => $user_reg,
			'user_data'		   => $session->get('logged_data')
		]);
	}

}