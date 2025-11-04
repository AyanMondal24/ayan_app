<?php

class product_model extends CI_Model{

    function __construct()
    {
        parent::__construct();
    }

    public function setProducts($data){
        return $this->db->insert('products',$data);
    }
    public function getProducts(){
        $this->db->select('*');
        $this->db->from('products');
        return $this->db->get()->result();
    }
}
