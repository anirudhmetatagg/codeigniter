<?php

class Login_model extends CI_Model {

    public function __construct()

    {
        $this->load->database();
        
    }
    
    
	function validate($user_name,$password)
	{
		$this->db->where('admin_email', $user_name);
		$this->db->where('password', $password);
		$query = $this->db->get('admin_users');
		return $query->row();
	}
    
}

