<?php

class Comman_model extends CI_Model {


    public function __construct()

    {

        $this->load->database();

    }


    public function get_author_by_id($id)
    {
         $this->db->select('*');
         $this->db->from('admin_users');
         $this->db->where('id', $id);
         $query = $this->db->get();
         return $query->result();

	}
    

}

?>