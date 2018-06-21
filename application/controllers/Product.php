<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
    
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('product_model');
        $this->load->model('comman_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('text');
        $this->load->helper("file");
	    $this->load->library('session');
        $this->load->library("pagination");
    }

	
	public function index($offset = 0)
	{
        $config = array();
        $config["base_url"] = base_url().'product/index';
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 20;
        $config["total_rows"] = $this->product_model->get_all_product_count(); 
        $config["per_page"] = 6;
        $config["uri_segment"] = 3;
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<a class="page-numbers">';
        $config['first_tag_close'] = '</a>';
        $config['prev_link'] = '<i class="fa fa-angle-double-left"></i>';
        $config['next_link'] = '<i class="fa fa-angle-double-right"></i>';
        $config['last_tag_open'] = '<a class="page-numbers">';
        $config['last_tag_close'] = '</a>';
        $config['cur_tag_open'] = '<a href="#" class="page-numbers current">';       $config['cur_tag_close'] = '</a>';
        $config['attributes'] = array('class' => 'page-numbers');
        
        $page = $this->uri->segment(3);
        $limit_end = ($page * $config['per_page']) - $config['per_page'];
        if ($limit_end < 0){
            $limit_end = 0;
        } 
        

        $this->pagination->initialize($config);
        
        
        $data["page"] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; 
       
        
        $data['page_products'] = $this->product_model->get_all_product($config["per_page"], $limit_end);
        
        $data['pagination'] = $this->pagination->create_links();
        
        $data['page_title'] = 'All Products';
        $this->load->view('product/list',$data);
        
	}
    
    public function single()
	{
        $data['page_title'] = 'Single Product';
        
        $last = $this->uri->total_segments();
        $product_slug = $this->uri->segment($last);
        
        $data['single_product'] = $this->product_model->get_product_by_slug($product_slug); 
        
        $this->load->view('product/single',$data);
        
	}
    
    
    
}
