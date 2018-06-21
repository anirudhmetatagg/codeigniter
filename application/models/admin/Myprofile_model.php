<?php

class Myprofile_model extends CI_Model {


    public function __construct()

    {

        $this->load->database();

    }


   
    public function get_profile_by_id($id)
    {
       	$this->db->select('*');
		$this->db->from('admin_users');
		$this->db->where('id', $id);
		$query = $this->db->get();
        return $query->result();
       
    }
    
    function update_profile($id, $datastore)
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
    

}

?>