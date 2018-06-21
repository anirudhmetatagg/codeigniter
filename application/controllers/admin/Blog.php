<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/blog_model');
        $this->load->model('admin/category_model');
        $this->load->model('admin/comman_model');
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
        
        
        $data['page_title'] = 'Blog Page';
        
        $config = array();
        $config["base_url"] = base_url().'admin/blog/index';
        $config["total_rows"] = $this->blog_model->get_blog_count(); 
        $config["per_page"] = $this->config->item('per_page_admin');
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
        
        /* Showing result of total */  
        $data['total_entries'] = $config['total_rows'];

        $data['start_point'] = (int)$this->uri->segment(4) + 1;

        if ($this->uri->segment(4) + $config['per_page'] > $config['total_rows']) {
            $data['end_point'] = $config['total_rows'];
        } else {
            $data['end_point'] = (int)$this->uri->segment(4) + $config['per_page'];
        }
        
        
        $data['blog_result'] = 'Showing '.$data['start_point'].' to '.$data['end_point'].' of '.$data['total_entries'].' Blogs';
        
        $data['blogs'] = $this->blog_model->get_blog($config["per_page"], $data["page"]);
        
        $data['pagination'] = $this->pagination->create_links();
       
        $this->load->view('admin/blog/list', $data);
        
	}
    
    public function add()
	{
        $data['page_title'] = 'Add Blog';
        
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            
            $this->form_validation->set_rules('blog_title', 'Blog Title', 'required');
            
            $this->form_validation->set_rules('blog_title', 'Blog Name', ['required', 'trim','max_length[80]','is_unique[blog.blog_title]'],['required'=>"The Blog Name field is required.", 'is_unique'=>'Blog name allready exists.']);
            
            if(empty($_FILES['blog_img']['name']))
            {$this->form_validation->set_rules('blog_img', 'Blog Image', 'required');}
                $this->form_validation->set_error_delimiters('<a class="close" data-dismiss="alert">×</a>');
            
               
		    if ($this->form_validation->run())
            {
				
                /* For blog image */
                $blog_img_filename = rand(100,10000).$_FILES['blog_img']['name'];
                $upload_path="./assets/upload/blogimage";  
                $config = array();
                $config['upload_path'] = $upload_path; 
                $config['allowed_types'] = 'gif|jpeg|jpg|png';
                $config['encrypt_name'] = 'TRUE';
                $config['file_name'] = $blog_img_filename;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload("blog_img");
                /* End blog logo */
                
                
                $slug = url_title($this->input->post('blog_title'), 'dash', true);
                
                $blog_to_store = array(
                    'blog_title' => $this->input->post('blog_title'),
                    'blog_slug' => $slug,
                    'blog_image' => $blog_img_filename,
                    'blog_content' => $this->input->post('blog_content'),
					'blog_category_id' => $this->input->post('blog_category_id'),
                    'author_id' => $this->input->post('author_id'),
                    'publish_date' => date('Y/m/d')
                );
                
                if($this->blog_model->insert_blog($blog_to_store)){
                   $this->session->set_flashdata('success_message', 'Blog Inserted Successfully.');
		        }
                else 
                    {
                    $this->session->set_flashdata('unsuccess_message', 'Somthing worng. Error!!');
                }   
               
            }
           
        }
        
         $data['categorylist']  = $this->category_model->get_allcategory();
         $this->load->view('admin/blog/add', $data);  
        
	}
    
    public function blog_search()
    {
        $data['page_title'] = 'Search Blogs';
        
        $search = ($this->input->post("blog_sname"))? $this->input->post("blog_sname") : "NIL";
        
        $search = ($this->uri->segment(4)) ? $this->uri->segment(4) : $search;

        $search = urldecode($search);
        
        // pagination settings
        $config = array();
        $config['base_url'] = site_url("admin/blog/blog_search/$search");
        $config['total_rows'] = $this->blog_model->get_blog_search_count($search);
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
        $data['blog_result'] = 'Showing '.$data['start_point'].' to '.$data['end_point'].' of '.$data['total_entries'].' Products';
        }
        else {
            $data['blog_result'] = '';
        }
        
        $data['blogs'] = $this->blog_model->get_blog_search($config['per_page'], $data['page'], $search);
       
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('admin/blog/list', $data);
    }
    
    public function update()
    {
        
        $data['page_title'] = 'Update Blog';
        
		$last = $this->uri->total_segments();
		$id = $this->uri->segment($last);	  
       
        
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            
            $this->form_validation->set_rules('blog_title', 'Blog Name', ['required', 'trim', 
            'callback_crosscheckBlogName['.$id.']'], ['required'=>'required']);
             $this->form_validation->set_error_delimiters('<a class="close" data-dismiss="alert">×</a>');
            
            if ($this->form_validation->run())
            {
            
            $file_name_logo = rand(100,10000).$_FILES['blog_img']['name'];
            $upload_path="./assets/upload/blogimage/"; 
	        $config = array();
            $config['upload_path'] = $upload_path; 
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['encrypt_name'] = 'TRUE';
			$config['file_name'] = $file_name_logo;
		
            $this->load->library('upload', $config);
			$this->upload->initialize($config);
			$this->upload->do_upload("blog_img");
			


            if($_FILES['blog_img']['name']!=''){
                $blog_img = $file_name_logo;
            }
            else
            {
                $blog_img =  $this->input->post('hidden_blog_img');
            }
           
            $slug = url_title($this->input->post('blog_title'), 'dash', true);
                $data_to_store = array(
                    
                    'blog_title' => $this->input->post('blog_title'),
                    'blog_slug' => $slug,                    
                    'blog_image' => $blog_img,
                    'blog_category_id' => $this->input->post('blog_category_id'),           
                    'blog_content' => $this->input->post('blog_content'),
                );
				
				if($_FILES['blog_img']['name']!=''){
				 @unlink('./assets/upload/blogimage/'.$this->input->post('hidden_blog_img'));
				}				
                if($this->blog_model->update_blog($id, $data_to_store) == TRUE){
					$this->session->set_flashdata('success_message', 'Blog Updated Successfully.');
                }else{
                    $this->session->set_flashdata('unsuccess_message', 'Somthing worng. Error!!');
                }
                redirect('admin/blog/update/'.$id.'');
            }

        }
       
        $data['categorylist']  = $this->category_model->get_allcategory();
        $data['blog'] = $this->blog_model->get_blog_by_id($id);
        $this->load->view('admin/blog/update', $data);
    }
    
    public function delete_blog()
    {
        $json['status'] = 0;
      	$blog_id = $this->input->post('blog_id');	   
        
        if($blog_id){
        $this->blog_model->delete_blogs($blog_id);
           if($this->blog_model->delete_blogs($blog_id) == TRUE){
                $json['status'] = 1;
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    
    public function crosscheckBlogName($blogName, $blogId){
        
        $blogWithName = $this->blog_model->getBlogTableCol($blogName, 'blog_id', $blogId);
        
        if(!$blogWithName || ($blogWithName == $blogId)){
            return TRUE;
        }
        
        else{
            $this->form_validation->set_message('crosscheckBlogName', 'There is an blog with this name');
                
            return FALSE;
        }
    }
    
}
