<?php
class user_model extends CI_Model{
    function __construct()
    {
       return parent::__construct();
    }

    function add($data){
        return $this->db->insert('users',$data);
    }
    function getUserByEmail($email){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email',$email);
        return $this->db->get()->row();
    }

}