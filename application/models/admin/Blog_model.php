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
         $this->db->join('admin_users','blog.author_id = admin_users.id');
         $query = $this->db->get('blog');
         return $query->num_rows(); 
         
     }

    public function get_blog_search($limit, $start,$search)
    {
         $this->db->like('blog_title', $search);
         $this->db->or_like('admin_users.first_name',$search);
         $this->db->join('admin_users','blog.author_id = admin_users.id');
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
    
    /*public function get_trash_product_count()
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
 
   */

    /*public function get_trash_search_count($search)
    {
         $this->db->select('*');
         $this->db->from('product');
         $this->db->where('trash_product', '0');
         $this->db->where("(`product_name` LIKE '%$search%'");
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

	}*/

}

?>