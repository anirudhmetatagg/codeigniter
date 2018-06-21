<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
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
        
        $config = array();
        $config["base_url"] = base_url().'admin/category/index';
        $config["total_rows"] = $this->category_model->get_category_count(); 
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
        
        
        $data['categories_result'] = 'Showing '.$data['start_point'].' to '.$data['end_point'].' of '.$data['total_entries'].' Categories';
        
        $data['categories'] = $this->category_model->get_category($config["per_page"], $data["page"]);
        
        $data['pagination'] = $this->pagination->create_links();
        
        $data['page_title'] = 'All Categorys';
       
        $this->load->view('admin/category/list', $data);
        
	}
    
    public function add()
	{
        $data['page_title'] = 'Add Category';
        
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            
            $this->form_validation->set_rules('category_name', 'Category Name', 'required');
            
            $this->form_validation->set_rules('category_name', 'Category Name', ['required', 'trim','max_length[80]','is_unique[category.category_name]'],['required'=>"The Category Name field is required.", 'is_unique'=>'Category name allready exists.']);
            
            
            $this->form_validation->set_error_delimiters('<a class="close" data-dismiss="alert">×</a>');
            
               
		    if ($this->form_validation->run())
            {
				if($this->input->post('category_parent') !=''){$category_parent = $this->input->post('category_parent');}else{$category_parent = 0;}
                
                $category_to_store = array(
                    'category_name' => $this->input->post('category_name'),
                    'category_parent' => $category_parent,
                    'category_description' => $this->input->post('category_description'),
                );
                
                if($this->category_model->insert_category($category_to_store)){
                   $this->session->set_flashdata('success_message', 'Category Inserted Successfully.');
		        }
                else 
                    {
                    $this->session->set_flashdata('unsuccess_message', 'Somthing worng. Error!!');
                }
               
            }
           
        }
         $data['categoryparent']  = $this->category_model->get_allcategory();
         $this->load->view('admin/category/add', $data);  
        
	}
    
    public function update()
    {
        
        $data['page_title'] = 'Update Category';
        
		$last = $this->uri->total_segments();
		$id = $this->uri->segment($last);	  
       
        if($this->input->post('category_parent') !=''){$category_parent = $this->input->post('category_parent');}else{$category_parent = 0;}
        
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            
            $this->form_validation->set_rules('category_name', 'Category Name', ['required', 'trim', 
            'callback_crosscheckCategoryName['.$id.']'], ['required'=>'required']);
             $this->form_validation->set_error_delimiters('<a class="close" data-dismiss="alert">×</a>');
            
            if ($this->form_validation->run())
             {
                $data_to_store = array(
                    
                    'category_name' => $this->input->post('category_name'),
                    'category_parent' => $category_parent,
                    'category_description' => $this->input->post('category_description'),
                   
                );
							
                if($this->category_model->update_category($id, $data_to_store) == TRUE){
					$this->session->set_flashdata('success_message', 'Category Updated Successfully.');
                }else{
                    $this->session->set_flashdata('unsuccess_message', 'Somthing worng. Error!!');
                }
                redirect('admin/category/update/'.$id.'');
             }

        }
        
        $data['categoryparent']  = $this->category_model->get_categoryparent_by_id($id);
        $data['category'] = $this->category_model->get_category_by_id($id);
        $this->load->view('admin/category/update', $data);
    }
        
    public function category_search()
    {
        $data['page_title'] = 'Search Categories';
        $search = ($this->input->post("category_sname"))? $this->input->post("category_sname") : "NIL";
        
      
        $search = ($this->uri->segment(4)) ? $this->uri->segment(4) : $search;

        $search = urldecode($search);
        
        // pagination settings
        $config = array();
        $config['base_url'] = site_url("admin/category/category_search/$search");
        $config['total_rows'] = $this->category_model->get_category_search_count($search);
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
        $data['categories_result'] = 'Showing '.$data['start_point'].' to '.$data['end_point'].' of '.$data['total_entries'].' Categories';
        }
        else {
            $data['categories_result'] = '';
        }
        
        $data['categories'] = $this->category_model->get_category_search($config['per_page'], $data['page'], $search);
       
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('admin/category/list', $data);
    }
    
    public function delete_category()
    {
        $json['status'] = 0;
      	$cat_id = $this->input->post('cat_id');	   
        
        if($cat_id){
        $this->category_model->delete_categories($cat_id);
           if($this->category_model->delete_categories($cat_id) == TRUE){
                $json['status'] = 1;
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    
    public function crosscheckCategoryName($categoryName, $categoryId){
        
        $categoryWithName = $this->category_model->getCategoryTableCol($categoryName, 'category_id', $categoryId);
        
        if(!$categoryWithName || ($categoryWithName == $categoryId)){
            return TRUE;
        }
        
        else{
            $this->form_validation->set_message('crosscheckCategoryName', 'There is an category with this name');
                
            return FALSE;
        }
    }
    
   
    
    
    
    
}
