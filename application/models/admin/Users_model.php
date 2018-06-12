<?php

class Users_model extends CI_Model {


    public function __construct()

    {

        $this->load->database();

    }


    public function insert_user($data)
    {
        $this->db->set('created_on', "NOW()", FALSE);
		$insert = $this->db->insert('admin_users', $data);
	    if($this->db->affected_rows() > 0){
            return $this->db->insert_id();
        }
        
        else{
            return FALSE;
        }

	}
    
    public function get_users_count()
    {
         $this->db->select('*');
         $this->db->from('admin_users');
         $query = $this->db->get();
         return $query->num_rows(); 
         
     }
        
    public function get_users($limit, $start)
    {
         $this->db->select('*');
         $this->db->from('admin_users');
         $this->db->limit($limit, $start);
         $query = $this->db->get();
         return $query->result();
         
     }    
    
    public function get_users_search_count($search)
    {
         $this->db->select('*');
         $this->db->from('admin_users');
         $this->db->where("(`first_name` LIKE '%$search%'");
         $this->db->or_where("`role` LIKE '%$search%'");
         $this->db->or_where("`admin_email` LIKE '%$search%')");
         $query = $this->db->get();
         return $query->num_rows(); 
         
     }

    public function get_users_search($limit, $start,$search)
    {
         $this->db->select('*');
         $this->db->from('admin_users');
         $this->db->where("(`first_name` LIKE '%$search%'");
         $this->db->or_where("`role` LIKE '%$search%'");
         $this->db->or_where("`admin_email` LIKE '%$search%')");
         $this->db->limit($limit, $start);
         $query = $this->db->get();
         return $query->result(); 
         
     } 
    
    public function get_user_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('admin_users');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result();
    }
    
    function update_user($id, $datastore)
    {
		$this->db->where('id', $id);
		$this->db->update('admin_users', $datastore);
		$report = array();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}
    
    public function delete_users($id){
		$this->db->where('id', $id);
		$this->db->delete('admin_users'); 
		$report_delete = array();
		if($report_delete !== 0){

			return true;
		}else{
			return false;
		}
    }
    

}

?>