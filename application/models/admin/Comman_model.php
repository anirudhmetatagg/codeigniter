<?php

class Comman_model extends CI_Model {


    public function __construct()

    {

        $this->load->database();

    }


    public function get_all_userdata()
    {
         $this->db->select('*');
         $this->db->from('admin_users');
         $query = $this->db->get();
         return $query->result();

	}
    
    public function get_userdata_by_id($id)
    {
         $this->db->select('*');
         $this->db->from('admin_users');
         $this->db->where('id', $id);
         $query = $this->db->get();
         return $query->result();

	}
    
    public function get_blog_search_using_author($search)
    {
         $this->db->select('*');
         $this->db->from('admin_users');
         $this->db->where("(`first_name` LIKE '%$search%')");
        //$this->db->or_where("`admin_email` LIKE '%$search%')");
         $query = $this->db->get();
         return $query->result(); 

	}    
        
    

}

?>