<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Myprofile extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/myprofile_model');
		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('text');
        $this->load->helper("file");
	    $this->load->library('session');
        $this->load->library("pagination");
        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }
    }
	public function index()
	{
        $id = $this->session->userdata('user_id');
        $data['page_title'] = 'Update MyProfile';
        
        
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            
               $this->form_validation->set_rules('user_fname', 'First name', ['required', 'trim', 'max_length[20]', 'strtolower', 'ucfirst'], ['required'=>"The First Name field is required."]);
                $this->form_validation->set_rules('user_lname', 'Last name', ['required', 'trim', 'max_length[20]', 'strtolower', 'ucfirst'], ['required'=>"The Last Name field is required."]);
                $this->form_validation->set_rules('user_email', 'E-mail', ['required', 'trim', 'valid_email']);
                $this->form_validation->set_error_delimiters('<a class="close" data-dismiss="alert">×</a>');   
            
                /* For profile picture */
                $file_name_logo = rand(100,10000).$_FILES['profile_pic']['name'];
                $upload_path="./assets/upload/profile"; 
                $config = array();
                $config['upload_path'] = $upload_path; 
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['encrypt_name'] = 'TRUE';
                $config['file_name'] = $file_name_logo;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload("profile_pic");



                if($_FILES['profile_pic']['name']!=''){
                    $profile_logo = $file_name_logo;
                }
                else
                {
                    $profile_logo =  $this->input->post('hidden_profile_pic');
                }
                /* End Profile picture */
            
              if($_FILES['profile_pic']['name']!=''){
            	 @unlink('./assets/upload/profile/'.$this->input->post('hidden_profile_pic'));
				}
            
            
            
            if($this->form_validation->run() !== FALSE){
               $data_to_store = array(
                    'first_name' => set_value('user_fname'),
                    'last_name' => set_value('user_lname'),
                    'admin_email' => set_value('user_email'),
                    'phone_num' => set_value('phone_num'),
                    'role' => set_value('user_role'),  
                    'profile_pic' => $profile_logo,  
                );
				
							
                if($this->myprofile_model->update_profile($id, $data_to_store) == TRUE){
					$this->session->set_flashdata('success_message', 'Profile successfully updated.');
                }else{
                    $this->session->set_flashdata('unsuccess_message', 'Somthing worng. Error!!');
                }
                redirect('admin/myprofile/');

            }
        }
        
        
        $data['myprofile'] = $this->myprofile_model->get_profile_by_id($id);
        $this->load->view('admin/myprofile/profile', $data);
       
        
	}
    
    
    /*public function update()
    {
        
        $data['page_title'] = 'Update User';
        
		$last = $this->uri->total_segments();
		$id = $this->uri->segment($last);	  
       
        
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            
               $this->form_validation->set_rules('user_fname', 'First name', ['required', 'trim', 'max_length[20]', 'strtolower', 'ucfirst'], ['required'=>"The First Name field is required."]);
                $this->form_validation->set_rules('user_lname', 'Last name', ['required', 'trim', 'max_length[20]', 'strtolower', 'ucfirst'], ['required'=>"The Last Name field is required."]);
                $this->form_validation->set_rules('user_email', 'E-mail', ['required', 'trim', 'valid_email']);
                $this->form_validation->set_rules('user_role', 'Role', ['required'], ['required'=>"The User Role field is required."]); 
                $this->form_validation->set_error_delimiters('<a class="close" data-dismiss="alert">×</a>');        
            
            if($this->form_validation->run() !== FALSE){
               $data_to_store = array(
                    
                    'first_name' => set_value('user_fname'),
                    'last_name' => set_value('user_lname'),
                    'admin_email' => set_value('user_email'),
                    'phone_num' => set_value('phone_num'),
                    'role' => set_value('user_role'),  
                );
				
							
                if($this->users_model->update_user($id, $data_to_store) == TRUE){
					$this->session->set_flashdata('success_message', 'User info successfully updated.');
                }else{
                    $this->session->set_flashdata('unsuccess_message', 'Somthing worng. Error!!');
                }
                redirect('admin/users/update/'.$id.'');

            }
        }
        
        
        $data['user'] = $this->users_model->get_user_by_id($id);
        $this->load->view('admin/users/update', $data);
    }*/
    
    
}
