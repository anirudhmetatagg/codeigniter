<?php
class Dashboard extends CI_Controller {
	
	 public function __construct()
    {
	    parent::__construct();
        $this->load->library('session');
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }
    }
	
	
	
 function index()
	{  
        $data['page_title'] = 'Dashboard';
    	$this->load->view('admin/dashboard', $data);	
	}
    
    
    
    
    
    
}