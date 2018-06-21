<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('home_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('text');
        $this->load->helper("file");
	    $this->load->library('session');
        $this->load->library("pagination");
    }

	
	public function index()
	{
        
        $data['our_blogs'] = $this->home_model->get_our_blog();
        $data['our_products'] = $this->home_model->get_our_product();
        $data['page_title'] = 'Web Shoppe';
        $this->load->view('home',$data);
        
	}
    
}
