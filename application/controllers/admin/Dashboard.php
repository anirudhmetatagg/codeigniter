<?php
class Dashboard extends CI_Controller {
	
	 public function __construct()
    {
	    parent::__construct();
        $this->load->model('admin/comman_model'); 
        $this->load->library('session');
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }
    }
	
	
	
 function index()
	{  
        $data['user_data']= $this->comman_model->get_userdata_by_id($this->session->userdata()['user_id']);
        $data['totalblogs'] = $this->db->count_all('blog');
        $data['totalproducts'] = $this->db->count_all('product');
        $data['totalusers'] = $this->db->count_all('admin_users');
        $data['totalcomments'] = $this->db->count_all('comments');
        $data['page_title'] = 'Dashboard';
    	$this->load->view('admin/dashboard', $data);	
	}
    
    
    
    
    
    
}