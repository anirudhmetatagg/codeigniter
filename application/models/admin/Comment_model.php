<?php

class Comment_model extends CI_Model {


    public function __construct()

    {

        $this->load->database();

    }


    
    public function get_comment_count()
    {
         $this->db->select('*');
         $this->db->from('comments');
         $query = $this->db->get();
         return $query->num_rows(); 
         
     }
        
    public function get_comment($limit, $start)
    {
         $this->db->select('*');
         $this->db->from('comments');
         $this->db->limit($limit, $start);
         $query = $this->db->get();
         return $query->result();
         
     }
    
     public function get_comment_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('comments');
		$this->db->where('comment_id', $id);
		$query = $this->db->get();
		return $query->result();
    }
    
    public function get_comment_search_count($search)
    {
         $this->db->like('comment_author', $search);
         $this->db->or_like('comment_content',$search);
         $this->db->or_like('comment_date',$search);
         $this->db->or_like('blog.blog_title',$search);
         $this->db->join('blog','comments.comment_post_id = blog.blog_id');
         $query = $this->db->get('comments');
         return $query->num_rows(); 
         
     }

    public function get_comment_search($limit, $start,$search)
    {
         $this->db->like('comment_author', $search);
         $this->db->or_like('comment_content',$search);
         $this->db->or_like('comment_date',$search);
         $this->db->or_like('blog.blog_title',$search);
         $this->db->join('blog','comments.comment_post_id = blog.blog_id');
         $this->db->limit($limit, $start);
         $query = $this->db->get('comments');
         return $query->result(); 
        
        
    } 
    
    public function update_comment_status($comment_id,$comment_status){

        $this->db->set('comment_approved', $comment_status);
        $this->db->where('comment_id', $comment_id);
		$this->db->update('comments'); 
		$restore_update = array();
		if($restore_update !== 0){
			return true;
		}else{
			return false;
		}
    }
    
    function update_comment($id, $datastore)
    {
		$this->db->where('comment_id', $id);
		$this->db->update('comments', $datastore);
		$report = array();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}
       
    

}

?>