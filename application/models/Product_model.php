<?php

class Product_model extends CI_Model {


    public function __construct()

    {

        $this->load->database();

    }


    public function get_all_product_count()
    {
         $this->db->select('*');
         $this->db->from('product');
         $query = $this->db->get();
         return $query->num_rows(); 
         
     }
    
    public function get_all_product($limit, $start)
    {
         $this->db->select('*');
         $this->db->from('product');
         $this->db->limit($limit, $start);
         $query = $this->db->get();
         return $query->result();
         
     }
    
    public function get_product_by_slug($slug)
    {
         $this->db->select('*');
         $this->db->from('product');
         $this->db->where('product_slug', $slug);
         $query = $this->db->get();
         return $query->result();
         
     }
    
    
}

?>