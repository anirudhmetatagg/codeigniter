<?php

class Product_model extends CI_Model {


    public function __construct()

    {

        $this->load->database();

    }


    public function insert_product($data)
    {

		$insert = $this->db->insert('product', $data);

	    return $insert;

	}
    
    public function get_product_count()
    {
         $this->db->select('*');
         $this->db->from('product');
         $this->db->where('trash_product', '1');
         $query = $this->db->get();
         return $query->num_rows(); 
         
     }
        
    public function get_product($limit, $start)
    {
         $this->db->select('*');
         $this->db->from('product');
         $this->db->where('trash_product', '1');
         $this->db->limit($limit, $start);
         $query = $this->db->get();
         return $query->result();
         
     }
    
    public function get_trash_product_count()
    {
         $this->db->select('*');
         $this->db->from('product');
         $this->db->where('trash_product', '0');
         $query = $this->db->get();
         return $query->num_rows(); 
         
     }
        
    public function get_trash_product($limit, $start)
    {
         $this->db->select('*');
         $this->db->from('product');
         $this->db->where('trash_product', '0');
         $this->db->limit($limit, $start);
         $query = $this->db->get();
         return $query->result();
         
     }
    
    public function delete_product($id){


		$this->db->where('product_id', $id);

		$this->db->delete('product'); 

		$report_delete = array();

		if($report_delete !== 0){

			return true;
		}else{
			return false;
		}
    }
    
    public function trash_product($id){
        $this->db->set('trash_product', '0');
        $this->db->where('product_id', $id);
		$this->db->update('product'); 
		$report_update = array();
		if($report_update !== 0){
			return true;
		}else{
			return false;
		}
    }
    
    public function restore_product($id){

        $this->db->set('trash_product', '1');
        $this->db->where('product_id', $id);
		$this->db->update('product'); 
		$restore_update = array();
		if($restore_update !== 0){
			return true;
		}else{
			return false;
		}
    }

    public function get_product_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('product');
		$this->db->where('product_id', $id);
		$query = $this->db->get();
		return $query->result();
    }
    
    function update_product($id, $datastore)
    {
		$this->db->where('product_id', $id);
		$this->db->update('product', $datastore);
		$report = array();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

    public function get_product_search_count($search)
    {
         $this->db->select('*');
         $this->db->from('product');
         $this->db->where('trash_product', '1');
         $this->db->where("(`product_name` LIKE '%$search%'");
         $this->db->or_where("`product_price` LIKE '%$search%'"); 
         $this->db->or_where("`product_description` LIKE '%$search%')");
         $query = $this->db->get();
         return $query->num_rows(); 
         
     }

    public function get_product_search($limit, $start,$search)
    {
         $this->db->select('*');
         $this->db->from('product');
         $this->db->where('trash_product', '1');
         $this->db->where("(`product_name` LIKE '%$search%'");
         $this->db->or_where("`product_price` LIKE '%$search%'");
         $this->db->or_where("`product_description` LIKE '%$search%')");
         $this->db->limit($limit, $start);
         $query = $this->db->get();
         return $query->result(); 
         
     } 
    
    public function get_trash_search_count($search)
    {
         $this->db->select('*');
         $this->db->from('product');
         $this->db->where('trash_product', '0');
         $this->db->where("(`product_name` LIKE '%$search%'");
         $this->db->or_where("`product_price` LIKE '%$search%'");
         $this->db->or_where("`product_description` LIKE '%$search%')");
         $query = $this->db->get();
         return $query->num_rows(); 
      
     }
    
    public function get_trash_search($limit, $start,$search)
    {
         $this->db->select('*');
         $this->db->from('product');
         $this->db->where('trash_product', '0');
         $this->db->where("(`product_name` LIKE '%$search%'");
         $this->db->or_where("`product_price` LIKE '%$search%'");
         $this->db->or_where("`product_description` LIKE '%$search%')");
         $this->db->limit($limit, $start);
         $query = $this->db->get();
         return $query->result(); 
         
     } 
    
    public function gallery_photo_delete($product_id,$photo_id){
        
		$photopath = './assets/upload/photo/'; 
        if($photopath){
		//unlink($photopath.$photo_id);
        @unlink($photopath . $photo_id);
        }
		$query = $this->db->query("SELECT * FROM product where product_id='$product_id'");

		$row = $query->row_array();

		$photo_value = explode(',',$row['product_gallery']);
		
		$photo_output = array_diff($photo_value, array($photo_id));

		$data=array('product_gallery'=>implode(',',$photo_output));

		$this->db->where('product_id',$product_id);

		$this->db->update('product',$data);

		$query = array();

			if($query != 0){

			return true;

		}else{

			return false;

		}

	}
    
    public function getProductTableCol($productName, $selColName, $productId){
        
        $q = "SELECT product_id FROM product WHERE product_name = ?";
        
        $run_q = $this->db->query($q, [$productName]);
        
        
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