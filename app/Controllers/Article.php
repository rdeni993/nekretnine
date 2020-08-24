<?php namespace App\Controllers;

use CodeIgniter\Controller;

/**
 * 
 * Open Controller
 * 
 */

class Article extends Controller{
    public function index($prop_id, $prop_title){

        // PropertyModel
        $prop_model = model('PropertyModel');
        // User Model
        $user_model = model('UserModel');

        // Sessino
        $session = session();

        // Get Current Article
        $current_article = $prop_model->ret_article($prop_id, $prop_title);


		# Render #
		return view("article", [
			'header'           => view("admin/header",[
				'site_title'   => $GLOBALS['site_title'] . ' | ' . $current_article[0]->property_title,
				'meta_tags'	   => [
					'url'      => site_url() . 'article/index/' . $current_article[0]->property_ID . '/' . urlencode($current_article[0]->property_title),
					'title'    => $GLOBALS['site_title'] . ' | ' . $current_article[0]->property_title,
					'desc'     => $current_article[0]->property_description,
					'image'    => $current_article[0]->property_image
				]
			]),
			'footer'           => view("admin/footer"),
			'navigation'       => view("navigation", [
				'properties' => $prop_model->get_props('property_type'), 
                'active_item' => 'home'
			]),
            'user_navigation'  => view("user_navigation"),
            'current_article'  => $current_article[0],
            'current_prop_tp'  => $prop_model->convert_to_prop($current_article[0]->property_type),
            'current_rent_tp'  => $prop_model->convert_to_rent($current_article[0]->property_rent),
            'user_pub'         => $user_model->get_user($current_article[0]->property_owner),
            'prop_imgs'        => $user_model->list_my_imgs($prop_id),
            'userdata_s'       => $session->get('logged_in') ? : false
		]);
    }

    // Alert For Some Unappropriate articles
    // Very important feature.....
    public function alert($prop_id, $prop_title){

        // PropertyModel
        $prop_model = model('PropertyModel');
        // User Model
        $user_model = model('UserModel');
        // Session
        $session = session();
        // Check is user logged in
        if(!$session->get('logged_in')) return redirect()->to(site_url('user'));
        // Get Current Article
        $current_article = $prop_model->ret_article($prop_id, $prop_title);

        # Render #
        return view("alert", [
            'header'           => view("admin/header"),
            'footer'           => view("admin/footer"),
            'navigation'       => view("navigation", [
            'active_item' => 'home'
            ]),
            'current_article'  => $current_article[0],
            'user_navigation'  => view("user_navigation"),
            'userdata'         => $session->get('logged_data'),
            'article'          => $current_article,
        ]);
    }
}