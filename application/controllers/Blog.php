<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {
    
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('blog_model');
        $this->load->model('comman_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('text');
        $this->load->helper("file");
	    $this->load->library('session');
        $this->load->library("pagination");
    }

	
	public function index()
	{
        $config = array();
        $config["base_url"] = base_url().'/blog/index';
        $config["total_rows"] = $this->blog_model->get_all_blog_count(); 
        $config["per_page"] = $this->config->item('per_page_admin');
        $config["uri_segment"] = 3;
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<a class="page-numbers">';
        $config['first_tag_close'] = '</a>';
        $config['prev_link'] = '<i class="fa fa-angle-double-left"></i>';
        
        $config['next_link'] = '<i class="fa fa-angle-double-right"></i>';
        $config['last_tag_open'] = '<a class="page-numbers">';
        $config['last_tag_close'] = '</a>';
        $config['cur_tag_open'] = '<a href="#" class="page-numbers current">';       $config['cur_tag_close'] = '</a>';
        $config['attributes'] = array('class' => 'page-numbers');

        $this->pagination->initialize($config);
        
        
        $data["page"] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; 
        
        
        $data['page_blogs'] = $this->blog_model->get_all_blog($config["per_page"], $data["page"]);
        
        $data['pagination'] = $this->pagination->create_links();
        
        $data['page_title'] = 'All Blogs';
        $this->load->view('blog/list',$data);
        
	}
    
    public function single()
	{
        $last = $this->uri->total_segments();
        $blog_slug = $this->uri->segment($last);
        $single_blogdata = $this->blog_model->get_blog_by_slug($blog_slug);
        $blog_id = $single_blogdata['0']->blog_id;
        $data['blog_comments'] = $this->blog_model->get_all_blog_comment($blog_id);
        $this->load->view('blog/single',$data);
        
	}
    
    public function comment_post()
    {
        
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            
            $this->form_validation->set_rules('comment_msg', 'Comment', 'required');
            $this->form_validation->set_error_delimiters('<a class="close" data-dismiss="alert">×</a>');
            
               
		    if ($this->form_validation->run())
            {
                $hidden_cpost_id = $this->input->post('hidden_cpost_id');
                $hidden_user_id = $this->input->post('hidden_user_id');
                if($this->input->post('hidden_comment_parentid'))
                {
                $comment_parentid = $this->input->post('hidden_comment_parentid');
                }
                else {
                   $comment_parentid = 0;  
                }
                $author_details = $this->comman_model->get_author_by_id($hidden_user_id);   
                
                $comment_store = array(
                    'comment_post_id' => $hidden_cpost_id,
                    'comment_author' => $author_details['0']->first_name,
                    'comment_author_email' => $author_details['0']->admin_email,
					'comment_content' => $this->input->post('comment_msg'),
                    'comment_approved' => 0,
                    'comment_parent' => $comment_parentid,
                    'user_id' => $hidden_user_id                 
                );
                
                if($this->blog_model->insert_comment($comment_store)){
                   $this->session->set_flashdata('success_message', 'Comment Added Successfully.');
		        }
                else 
                    {
                    $this->session->set_flashdata('unsuccess_message', 'Somthing worng. Error!!');
                }   
               
            }
           
        }
        
         $this->load->view('blog/single');
    }
    
    
}
