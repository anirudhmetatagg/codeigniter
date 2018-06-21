<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();        
        $this->load->model('Login_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('text');
        $this->load->helper("file");
	    $this->load->library('session');
        $this->load->library("pagination");
    }
	
	public function index()
	{
        
        $this->load->view('login');
        
	}
    
    function __encrip_password($password) {
        return md5($password);
    }
    
    public function login_check()
        
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            
            $this->form_validation->set_rules('user_name', 'Email Address', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_error_delimiters('<a class="close" data-dismiss="alert">×</a>');
            
               
		    if ($this->form_validation->run())
            {
                $user_name = $this->input->post('user_name');
                $passwordInDb = $this->input->post('password');
                $password = $this->__encrip_password($this->input->post('password'));
                $is_valid = $this->Login_model->validate($user_name, $password);
                
                if($is_valid)
                {
                    $data = array(
                        'front_user_email' => $user_name,
                        'front_user_name' => $is_valid->first_name,
                        'front_user_id' => $is_valid->id,
                        'front_user_role' => $is_valid->role,
                        'front_is_logged_in' => true
                    );
                    $this->session->set_userdata($data);
                    redirect(base_url());
                }
                else
                {
                    $data['message_error'] = TRUE;
                    $this->load->view('login', $data);	
                }
			  
            }
        }
         
        
        $this->load->view('login');
    }
    
    function logout()
	{
        $this->session->unset_userdata('front_user_email');
        $this->session->unset_userdata('front_user_name');
        $this->session->unset_userdata('front_user_id');
        $this->session->unset_userdata('front_user_role');
        $this->session->unset_userdata('front_is_logged_in');
		//$this->session->sess_destroy();
		redirect(base_url().'login');
	}
    
}
