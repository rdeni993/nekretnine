<?php namespace App\Controllers;

use CodeIgniter\Controller;

class Faq extends Controller{
    public function index(){

		# Render #
		return view("faq", [
			'header'           => view("admin/header",[
				'site_title'   => "Najčešća pitanja | " . $GLOBALS['site_title'],
				'meta_tags'	   => [
					'url'      => site_url(),
					'title'    => $GLOBALS['site_title'] . ' | ' . 'Često postavljena pitanja',
					'desc'     => $GLOBALS['meta_desc'],
					'image'    => base_url() . '/public/assets/img/avatars/64_1.png'
				]
			]),
			'footer'           => view("admin/footer"),
			'navigation'       => view("navigation", [
                'active_item' => 'faq'
			])
		]);
    }
}