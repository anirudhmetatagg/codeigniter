<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/product_model');
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
        $config["base_url"] = base_url().'admin/product/index';
        $config["total_rows"] = $this->product_model->get_product_count(); 
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
        
        
        $data['products_result'] = 'Showing '.$data['start_point'].' to '.$data['end_point'].' of '.$data['total_entries'].' Products';
        
        $data['products'] = $this->product_model->get_product($config["per_page"], $data["page"]);
        
        $data['pagination'] = $this->pagination->create_links();
        
        $data['page_title'] = 'All Products';
       
        $this->load->view('admin/product/list', $data);
        
	}
    
    public function add()
	{
        $data['page_title'] = 'Add Product';
        
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            
            $this->form_validation->set_rules('product_name', 'Product Name', 'required');
            if(empty($_FILES['product_logo']['name']))
            {$this->form_validation->set_rules('product_logo', 'Product Logo', 'required');}
                $this->form_validation->set_error_delimiters('<a class="close" data-dismiss="alert">×</a>');
            
               
		    if ($this->form_validation->run())
            {
				$product_name = $this->input->post('product_name');
                
                /* For product logo */
                $product_logo_filename = rand(100,10000).$_FILES['product_logo']['name'];
                $upload_path="./assets/upload/";  
                $config = array();
                $config['upload_path'] = $upload_path; 
                $config['allowed_types'] = 'gif|jpeg|jpg|png';
                $config['encrypt_name'] = 'TRUE';
                $config['file_name'] = $product_logo_filename;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload("product_logo");
                /* End product logo */
                
                $gallery_array = array();
                $upload_ph = FALSE;
                $gallery_names = NULL;
                for($i=0; $i<count($_FILES['product_gallery']['name']); $i++) {
                    $tmpFilePath = $_FILES['product_gallery']['tmp_name'][$i];

                    if ($tmpFilePath != ""){
                        $upimg = rand(100,10000).$_FILES['product_gallery']['name'][$i];
                        $newFilePath = "./assets/upload/photo/" .$upimg;
                        $gallery_array[]=$upimg;
                            if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                                $upload_ph = TRUE;
                                $gallery_names = implode(',',$gallery_array);
                            }
                           else
                           {
                                $upload_ph = FALSE;	
                           }
                    }
                }
                
                
                $product_to_store = array(
                    'product_name' => $this->input->post('product_name'),
                    'product_logo' => $product_logo_filename,
                    'product_gallery' => $gallery_names,
					'product_description' => $this->input->post('product_description'),
                );
                
                if($this->product_model->insert_product($product_to_store)){
                   $this->session->set_flashdata('success_message', 'Product Inserted Successfully.');
		        }
                else 
                    {
                    $this->session->set_flashdata('unsuccess_message', 'Somthing worng. Error!!');
                }
               
            }
           
        }
        
         $this->load->view('admin/product/add', $data);  
        
	}
    
    public function delete()
    {
        $json['status'] = 0;
      	$product_id = $this->input->post('product_id');	   
        
        if($product_id){
        $this->product_model->delete_product($product_id);
           if($this->product_model->delete_product($product_id) == TRUE){
                $json['status'] = 1;
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    
    public function update()
    {
        
        $data['page_title'] = 'Update Product';
        
		$last = $this->uri->total_segments();
		$id = $this->uri->segment($last);	  
       
        
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            
            /* For product logo */
            $file_name_logo = rand(100,10000).$_FILES['product_logo']['name'];
            $upload_path="./assets/upload/"; 
	        $config = array();
            $config['upload_path'] = $upload_path; 
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['encrypt_name'] = 'TRUE';
			$config['file_name'] = $file_name_logo;
		
            $this->load->library('upload', $config);
			$this->upload->initialize($config);
			$this->upload->do_upload("product_logo");
			


            if($_FILES['product_logo']['name']!=''){
                $product_logo = $file_name_logo;
            }
            else
            {
                $product_logo =  $this->input->post('hidden_product_logo');
            }
            /* End Product Logo */
            
            $gallery_array = array();
            $upload_ph = FALSE;
            $gallery_names = NULL;
            for($i=0; $i<count($_FILES['product_gallery']['name']); $i++) {
                $tmpFilePath = $_FILES['product_gallery']['tmp_name'][$i];
                
                if ($tmpFilePath != ""){
                    $upimg = rand(100,10000).$_FILES['product_gallery']['name'][$i];
                    $newFilePath = "./assets/upload/photo/" .$upimg;
                    $gallery_array[]=$upimg;
                        if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                            $upload_ph = TRUE;
                            $gallery_names = implode(',',$gallery_array);
                        }
                       else
                       {
                            $upload_ph = FALSE;	
                       }
                }
            }
            
            $query = $this->db->query("SELECT * FROM product where product_id='$id'");
            $row = $query->row_array();
            
            if($row['product_gallery']!=''){
                if($gallery_names){
                    $gallery_names = ','.$gallery_names;
                }
                $inesrt_photo = $row['product_gallery'].$gallery_names;
            }
            elseif($row['product_gallery']==''){
            $inesrt_photo = $gallery_names;
            }
            else
            {
            $inesrt_photo = $row['product_gallery'];
            }
            $data=array('product_gallery'=>$inesrt_photo);
            
            $this->db->where('product_id',$id);
            $this->db->update('product',$data);
           
                $data_to_store = array(
                    
                    'product_name' => $this->input->post('product_name'),
                    'product_logo' => $product_logo,
                    //'product_gallery' => $gallery_names,
					'product_description' => $this->input->post('product_description'),
                   
                );
				
				if($_FILES['product_logo']['name']!=''){
				 @unlink('./assets/upload/'.$this->input->post('hidden_product_logo'));
				}				
                if($this->product_model->update_product($id, $data_to_store) == TRUE){
					$this->session->set_flashdata('success_message', 'Product Updated Successfully.');
                }else{
                    $this->session->set_flashdata('unsuccess_message', 'Somthing worng. Error!!');
                }
                redirect('admin/product/update/'.$id.'');


        }
        
        
        $data['product'] = $this->product_model->get_product_by_id($id);
        $this->load->view('admin/product/update', $data);
    }
    
    public function product_search()
    {
        $data['page_title'] = 'Search Products';
        $search = ($this->input->post("product_sname"))? $this->input->post("product_sname") : "NIL";
        
      
        $search = ($this->uri->segment(4)) ? $this->uri->segment(4) : $search;

        $search = urldecode($search);
        
        // pagination settings
        $config = array();
        $config['base_url'] = site_url("admin/product/product_search/$search");
        $config['total_rows'] = $this->product_model->get_product_search_count($search);
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
        $data['products_result'] = 'Showing '.$data['start_point'].' to '.$data['end_point'].' of '.$data['total_entries'].' Products';
        }
        else {
            $data['products_result'] = '';
        }
        
        $data['products'] = $this->product_model->get_product_search($config['per_page'], $data['page'], $search);
       
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('admin/product/list', $data);
    }
    
    public function trash()
	{
        
        $config = array();
        $config["base_url"] = base_url().'admin/product/trash';
        $config["total_rows"] = $this->product_model->get_trash_product_count(); 
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
        
         if($data['total_entries'] && $data['end_point'] > 0){
        $data['products_result'] = 'Showing '.$data['start_point'].' to '.$data['end_point'].' of '.$data['total_entries'].' Products';
         }
        else {
           $data['products_result'] = ''; 
        }
        
        $data['products'] = $this->product_model->get_trash_product($config["per_page"], $data["page"]);
        
        $data['pagination'] = $this->pagination->create_links();
        
        $data['page_title'] = 'Trash Products';
       
        $this->load->view('admin/product/trash', $data);
        
	}
    
    public function trash_search()
    {
        
        $search = ($this->input->post("product_sname"))? $this->input->post("product_sname") : "NIL";
        
      
        $search = ($this->uri->segment(4)) ? $this->uri->segment(4) : $search;

        $search = urldecode($search);
        
        // pagination settings
        $config = array();
        $config['base_url'] = site_url("admin/product/trash_search/$search");
        $config['total_rows'] = $this->product_model->get_trash_search_count($search);
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
        $data['products_result'] = 'Showing '.$data['start_point'].' to '.$data['end_point'].' of '.$data['total_entries'].' Products';
        }
        else {
            $data['products_result'] = '';
        }
        
        $data['products'] = $this->product_model->get_trash_search($config['per_page'], $data['page'], $search);
       
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('admin/product/trash', $data);
    }
        
    public function trash_delete()
    {
        
      	$json['status'] = 0;
		$product_id = $this->input->post('product_id');
            
        if($product_id){
            $this->product_model->trash_product($product_id);
            if($this->product_model->trash_product($product_id) == TRUE){
                $json['status'] = 1;
                
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    
    public function restore()
    {
      	$last = $this->uri->total_segments();
		$id = $this->uri->segment($last);	   
       
        $this->product_model->restore_product($id);
       
		 if($this->product_model->restore_product($id) == TRUE){
					$this->session->set_flashdata('product_delete_succmsg', 'Product Restore Successfully.');
					 redirect('admin/product/trash');
                }else{
                    $this->session->set_flashdata('product_delete_errormsg', 'Somthing worng. Error!!');
					 redirect('admin/product/trash');
                }
		
    }
    
    public function product_gallery_photo_delete()
    {
        
      	$json['status'] = 0;
		$product_id = $this->input->post('product_id');
        $photo_id = $this->input->post('photo_id');
            
        if($product_id){
            $this->product_model->gallery_photo_delete($product_id,$photo_id);
            if($this->product_model->gallery_photo_delete($product_id,$photo_id) == TRUE){
                $json['status'] = 1;
                
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    
    
   
    
    
    
    
}
