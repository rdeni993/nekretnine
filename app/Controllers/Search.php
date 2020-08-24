<?php namespace App\Controllers;

use CodeIgniter\Controller;

class Search extends Controller{
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
		return view("search", [
			'header'           => view("admin/header",[
				'site_title'   => "Pretraga | " . $GLOBALS['site_title'],
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
			'articles' =>  $this->prop_model->search($this->request->getGet(), $offset),
            'current_p'  => $current_p,
            'next_page'  => $current_p + 1,
            'prev_page'  => $current_p - 1
		]);
    }
}