<?php

class Home_model extends CI_Model {


    public function __construct()

    {

        $this->load->database();

    }


    public function get_our_blog_count()
    {
         $this->db->select('*');
         $this->db->from('blog');
         $query = $this->db->get();
         if($query->num_rows() > 0) {
             return $query->num_rows();  
            }

	}
    public function get_our_blog()
    {
         $this->db->select('*');
         $this->db->from('blog');
         $this->db->limit('3');
         //$this->db->order_by("publish_date", "desc");
         $query = $this->db->get();
         if($query->num_rows() > 0) {
             return $query->result();  
            }

	}
    
    public function get_our_product()
    {
         $this->db->select('*');
         $this->db->from('product');
         $this->db->limit('4');
         //$this->db->order_by("product_id", "desc");
         $query = $this->db->get();
         if($query->num_rows() > 0) {
             return $query->result();  
            }

	}
    
        
    

}

?>