<?php

class Login extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
	    $this->load->library('session');
    }
    
	function index()
	{
        
         $data['page_title'] = 'Codeigniter Login';
         $this->load->view('admin/login', $data);  
	}
    
    function __encrip_password($password) {
        return md5($password);
    }	
    
	function login_check()
	{	
        
                $this->load->model('admin/Login_model');

                $user_name = $this->input->post('user_name');
                $passwordInDb = $this->input->post('password');
                $password = $this->__encrip_password($this->input->post('password'));
                $is_valid = $this->Login_model->validate($user_name, $password);


                if($is_valid)
                {
                    $data = array(
                        'user_name' => $user_name,
                        'admin_name' => $is_valid->first_name,
                        'user_id' => $is_valid->id,
                        'user_role' => $is_valid->role,
                        'is_logged_in' => true
                    );
                    $this->session->set_userdata($data);
                    redirect('admin/dashboard');
                }
                else
                {
                    $data['message_error'] = TRUE;
                    $this->load->view('admin/login', $data);	
                }
           
	}	

    function logout()
	{
		$this->session->sess_destroy();
		redirect('admin/login');
	}

}