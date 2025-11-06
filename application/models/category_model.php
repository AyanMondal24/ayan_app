<?php
class category_model extends CI_Model{

    function __construct()
    {
        parent::__construct();
    }

    function setCategory($data){
        return $this->db->insert('category',$data);
    }

    function getCategory(){
         $this->db->select('id,name,image');
         $this->db->from('category');
         return $this->db->get()->result();
    }
}