<?php

class Blog_model extends CI_Model {


    public function __construct()

    {

        $this->load->database();

    }


    public function insert_blog($data)
    {

		$insert = $this->db->insert('blog', $data);

	    return $insert;

	}
    
    public function get_blog_count()
    {
         $this->db->select('*');
         $this->db->from('blog');
         $query = $this->db->get();
         return $query->num_rows(); 
         
     }
        
    public function get_blog($limit, $start)
    {
         $this->db->select('*');
         $this->db->from('blog');
         $this->db->limit($limit, $start);
         $query = $this->db->get();
         return $query->result();
         
     }
    
    public function get_blog_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('blog');
		$this->db->where('blog_id', $id);
		$query = $this->db->get();
		return $query->result();
    }
    
    public function get_blog_search_count($search)
    {
         $this->db->like('blog_title', $search);
         $this->db->or_like('admin_users.first_name',$search);
         $this->db->or_like('category.category_name',$search);
         $this->db->join('admin_users','blog.author_id = admin_users.id');
         $this->db->join('category','blog.blog_category_id =  category.category_id');
         $query = $this->db->get('blog');
         return $query->num_rows(); 
         
     }

    public function get_blog_search($limit, $start,$search)
    {
         $this->db->like('blog_title', $search);
         $this->db->or_like('admin_users.first_name',$search);
         $this->db->or_like('category.category_name',$search);
         $this->db->join('admin_users','blog.author_id = admin_users.id');
         $this->db->join('category','blog.blog_category_id =  category.category_id');
         $this->db->limit($limit, $start);
         $query = $this->db->get('blog');
         return $query->result(); 
     } 
    
     function update_blog($id, $datastore)
    {
		$this->db->where('blog_id', $id);
		$this->db->update('blog', $datastore);
		$report = array();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}
    
     public function delete_blogs($id){

		$this->db->where('blog_id', $id);

		$this->db->delete('blog'); 

		$report_delete = array();

		if($report_delete !== 0){

			return true;
		}else{
			return false;
		}
    }
    
    public function getBlogTableCol($blogName, $selColName, $blogId){
        
        $q = "SELECT blog_id FROM blog WHERE blog_title = ?";
        
        $run_q = $this->db->query($q, [$blogName]);
        
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->$selColName;
            }
        }
        
        else{
            return FALSE;
        }
    }

}

?>