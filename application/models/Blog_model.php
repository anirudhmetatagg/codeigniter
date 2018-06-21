<?php

class Blog_model extends CI_Model {


    public function __construct()

    {

        $this->load->database();

    }


    public function get_all_blog_count()
    {
         $this->db->select('*');
         $this->db->from('blog');
         $query = $this->db->get();
         return $query->num_rows(); 
         
     }
    
    public function get_all_blog($limit, $start)
    {
         $this->db->select('*');
         $this->db->from('blog');
         $this->db->limit($limit, $start);
         $query = $this->db->get();
         return $query->result();
         
     }
    
    public function get_blog_by_slug($slug)
    {
         $this->db->select('*');
         $this->db->from('blog');
         $this->db->where('blog_slug', $slug);
         $query = $this->db->get();
         return $query->result();
         
     }
    
    public function insert_comment($data)
    {
        $this->db->set('comment_date', "NOW()", FALSE);
		$insert = $this->db->insert('comments', $data);
	    return $insert;
	}
    
    public function get_all_blog_comment($blog_id)
    {
         $this->db->select('*');
         $this->db->from('comments');
         $this->db->where('comment_post_id', $blog_id);
         $this->db->where('comment_parent', 0);
         $this->db->where('comment_approved', 1);
         $query = $this->db->get();
         return $query->result();
         
     }
    
     public function get_parent_blog_comment($blog_id,$comment_id)
    {
         $this->db->select('*');
         $this->db->from('comments');
         $this->db->where('comment_post_id', $blog_id);
         $this->db->where('comment_parent', $comment_id);
         $this->db->where('comment_approved', 1);
         $query = $this->db->get();
         return $query->result();
         
     }
    
    
}

?>