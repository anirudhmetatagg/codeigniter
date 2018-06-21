<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/comment_model');
        $this->load->model('admin/blog_model');
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
        $config["base_url"] = base_url().'admin/comment/index';
        $config["total_rows"] = $this->comment_model->get_comment_count(); 
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
        
        $data['comments_result'] = 'Showing '.$data['start_point'].' to '.$data['end_point'].' of '.$data['total_entries'].' Comments';
        
        $data['comments'] = $this->comment_model->get_comment($config["per_page"], $data["page"]);
        
        $data['pagination'] = $this->pagination->create_links();
        
        $data['page_title'] = 'All Comments';
       
        $this->load->view('admin/comment/list', $data);
        
	}
    
    public function update()
    {
        
        $data['page_title'] = 'Update Comment';
        
		$last = $this->uri->total_segments();
		$id = $this->uri->segment($last);	  
       
        
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            
                $data_to_store = array(
                    
                    'comment_author' => $this->input->post('comment_author'),
                    'comment_author_email' => $this->input->post('comment_author_email'),
                    'comment_content' => $this->input->post('comment_content'),
					'comment_approved' => $this->input->post('comment_approved'),
                   
                );
				
                if($this->comment_model->update_comment($id, $data_to_store) == TRUE){
					$this->session->set_flashdata('success_message', 'Comment Updated Successfully.');
                }else{
                    $this->session->set_flashdata('unsuccess_message', 'Somthing worng. Error!!');
                }
                redirect('admin/comment/update/'.$id.'');


        }
        
        
        $data['comment'] = $this->comment_model->get_comment_by_id($id);
        $this->load->view('admin/comment/update', $data);
    }
    
    
    
    public function comment_search()
    {
        $data['page_title'] = 'Search Comments';
        $search = ($this->input->post("comment_sname"))? $this->input->post("comment_sname") : "NIL";
        
      
        $search = ($this->uri->segment(4)) ? $this->uri->segment(4) : $search;

        $search = urldecode($search);
        
        // pagination settings
        $config = array();
        $config['base_url'] = site_url("admin/comment/comment_search/$search");
        $config['total_rows'] = $this->comment_model->get_comment_search_count($search);
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
        $data['comments_result'] = 'Showing '.$data['start_point'].' to '.$data['end_point'].' of '.$data['total_entries'].' Products';
        }
        else {
            $data['comments_result'] = '';
        }
        
        $data['comments'] = $this->comment_model->get_comment_search($config['per_page'], $data['page'], $search);
       
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('admin/comment/list', $data);
    }
    
    public function change_comment_status()
    {
        
      	$json['status'] = 0;
		$comment_id = $this->input->post('comment_id');
        $comment_status = $this->input->post('comment_status');
            
        if($comment_id){
            $this->comment_model->update_comment_status($comment_id,$comment_status);
            if($this->comment_model->update_comment_status($comment_id,$comment_status) == TRUE){
                $json['status'] = 1;
                
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }
    
    
    
    
    
    
    
}
