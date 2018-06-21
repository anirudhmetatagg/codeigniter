<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/users_model');
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
        
        $config = array();
        $config["base_url"] = base_url().'admin/users/index';
        $config["total_rows"] = $this->users_model->get_users_count(); 
        $config["per_page"] = $this->config->item('per_page_admin');;
        $config["uri_segment"] = 4;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li class="paginate_button page-item">';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Previous';
        $config['prev_tag_open'] = '<li class="paginate_button page-item prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li class="paginate_button page-item">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="paginate_button page-item">';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="paginate_button page-item active"><a href="#" class="page-link">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="paginate_button page-item">';
        $config['num_tag_close'] = '</li>';
        $config['attributes'] = array('class' => 'page-link');

        $this->pagination->initialize($config);
        
        
        $data["page"] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0; 
        
        
        $data['total_entries'] = $config['total_rows'];

        $data['start_point'] = (int)$this->uri->segment(4) + 1;

        if ($this->uri->segment(4) + $config['per_page'] > $config['total_rows']) {
            $data['end_point'] = $config['total_rows'];
        } else {
            $data['end_point'] = (int)$this->uri->segment(4) + $config['per_page'];
        }
        
        
        $data['users_result'] = 'Showing '.$data['start_point'].' to '.$data['end_point'].' of '.$data['total_entries'].' Users';
        
        $data['users'] = $this->users_model->get_users($config["per_page"], $data["page"]);
        
        $data['pagination'] = $this->pagination->create_links();
        
        $data['page_title'] = 'All Users';
       
        $this->load->view('admin/users/list', $data);
        
	}
    
    public function add()
	{
        $data['page_title'] = 'Add User';
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
                $this->form_validation->set_rules('user_fname', 'First name', ['required', 'trim', 'max_length[20]', 'strtolower', 'ucfirst'], ['required'=>"The First Name field is required."]);
                $this->form_validation->set_rules('user_lname', 'Last name', ['required', 'trim', 'max_length[20]', 'strtolower', 'ucfirst'], ['required'=>"The Last Name field is required."]);
                $this->form_validation->set_rules('user_email', 'E-mail', ['trim', 'required', 'valid_email', 'is_unique[admin_users.admin_email]', 'strtolower'], ['required'=>"The Email field is required.", 'is_unique'=>'E-mail id allready exists.']);
                $this->form_validation->set_rules('password', 'Password', ['required', 'min_length[8]'], ['required'=>"Enter password"]);
                $this->form_validation->set_rules('confirm_password', 'Password Confirmation', ['required', 'matches[password]'], ['required'=>"Please confirm password"]);
                $this->form_validation->set_rules('user_role', 'Role', ['required'], ['required'=>"The User Role field is required."]); 
                $this->form_validation->set_error_delimiters('<a class="close" data-dismiss="alert">×</a>');
            
            
            if($this->form_validation->run() !== FALSE){
             
                    $user_fname = set_value('user_fname');
                    $user_lname = set_value('user_lname');
                    $user_email = set_value('user_email');
                    $phone_num = set_value('phone_num');
                    $user_role = set_value('user_role');
                    $normalPassword = set_value('password');
                    $hashedPassword = md5(set_value('password'));
                
                    $user_to_store = array(
                    'first_name' => $user_fname,
                    'last_name' => $user_lname,
                    'admin_email' => $user_email,
					'phone_num' => $phone_num,
                    'password' => $hashedPassword,
                    'normal_password' => $normalPassword,
                    'role' => $user_role,    
                    );

                    if($this->users_model->insert_user($user_to_store)){
                       $this->session->set_flashdata('success_message', 'User account successfully created.');
                    }
                    else 
                        {
                        $this->session->set_flashdata('unsuccess_message', 'Somthing worng. Error!!');
                    }
                
            }
           
        }
        
        
        
         $this->load->view('admin/users/add', $data);  
        
	}
    
    public function update()
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
    }
    
    public function users_search()
    {
        $data['page_title'] = 'Search Users';
        $search = ($this->input->post("user_name"))? $this->input->post("user_name") : "NIL";
        
      
        $search = ($this->uri->segment(4)) ? $this->uri->segment(4) : $search;

        $search = urldecode($search);
        
        // pagination settings
        $config = array();
        $config['base_url'] = site_url("admin/users/users_search/$search");
        $config['total_rows'] = $this->users_model->get_users_search_count($search);
        $config['per_page'] = $this->config->item('per_page_admin');
        $config["uri_segment"] = 5;
		$config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li class="paginate_button page-item">';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Previous';
        $config['prev_tag_open'] = '<li class="paginate_button page-item prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li class="paginate_button page-item">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="paginate_button page-item">';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="paginate_button page-item active"><a href="#" class="page-link">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="paginate_button page-item">';
        $config['num_tag_close'] = '</li>';
        $config['attributes'] = array('class' => 'page-link');
        
        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
        
        /* Showing result of total */  
        $data['total_entries'] = $config['total_rows'];

        $data['start_point'] = (int)$this->uri->segment(5) + 1;

        if ($this->uri->segment(5) + $config['per_page'] > $config['total_rows']) {
            $data['end_point'] = $config['total_rows'];
        } else {
            $data['end_point'] = (int)$this->uri->segment(5) + $config['per_page'];
        }
        
        if($data['total_entries'] && $data['end_point'] > 0){
        $data['users_result'] = 'Showing '.$data['start_point'].' to '.$data['end_point'].' of '.$data['total_entries'].' Users';
        }
        else {
            $data['users_result'] = '';
        }
        
        $data['users'] = $this->users_model->get_users_search($config['per_page'], $data['page'], $search);
       
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('admin/users/list', $data);
    }
    
    public function delete_user()
    {
        $json['status'] = 0;
      	$user_id = $this->input->post('user_id');	   
        
        if($user_id){
        $this->users_model->delete_users($user_id);
           if($this->users_model->delete_users($user_id) == TRUE){
                $json['status'] = 1;
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    
    
    
    
    
    
}
