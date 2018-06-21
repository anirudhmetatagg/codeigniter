<?php

class Category_model extends CI_Model {


    public function __construct()

    {

        $this->load->database();

    }


    public function insert_category($data)
    {
         $insert = $this->db->insert('category', $data);
	     return $insert;

	}
    
    public function get_category_count()
    {
         $this->db->select('*');
         $this->db->from('category');
         $query = $this->db->get();
         return $query->num_rows(); 
         
     }
        
    public function get_category($limit, $start)
    {
         $this->db->select('*');
         $this->db->from('category');
         $this->db->limit($limit, $start);
         $query = $this->db->get();
         return $query->result();
         
     }
    
    public function get_category_search_count($search)
    {
         $this->db->select('*');
         $this->db->from('category');
         $this->db->where("(`category_name` LIKE '%$search%'");
         $this->db->or_where("`category_description` LIKE '%$search%')");
         $query = $this->db->get();
         return $query->num_rows(); 
         
     }

    public function get_category_search($limit, $start,$search)
    {
         $this->db->select('*');
         $this->db->from('category');
         $this->db->where("(`category_name` LIKE '%$search%'");
         $this->db->or_where("`category_description` LIKE '%$search%')");
         $this->db->limit($limit, $start);
         $query = $this->db->get();
         return $query->result(); 
         
    } 
    
    public function get_category_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('category');
		$this->db->where('category_id', $id);
		$query = $this->db->get();
		return $query->result();
    }
    
    function update_category($id, $datastore)
    {
		$this->db->where('category_id', $id);
		$this->db->update('category', $datastore);
		$report = array();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}
    
    public function delete_categories($id){


		$this->db->where('category_id', $id);

		$this->db->delete('category'); 

		$report_delete = array();

		if($report_delete !== 0){

			return true;
		}else{
			return false;
		}
    }
    
    public function get_allcategory()
    {
        $this->db->select('category_id, category_name'); 
        $query = $this->db->get('category');
             $results =  $query->result_array();

       return array_column($results, 'category_name', 'category_id');
         
     }
    
    public function get_categoryparent_by_id($id)
    {
        $this->db->select('category_id, category_name'); 
        $this->db->where_not_in('category_id', $id); 
        $query = $this->db->get('category');
             $results =  $query->result_array();
       return array_column($results, 'category_name', 'category_id');
         
     }
    
    public function getCategoryTableCol($categoryName, $selColName, $categoryId){
        
        $q = "SELECT category_id FROM category WHERE category_name = ?";
        
        $run_q = $this->db->query($q, [$categoryName]);
        
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