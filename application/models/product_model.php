<?php

class product_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function setProducts($data)
    {
        return $this->db->insert('products', $data);
    }
    public function getProducts($limit, $start)
    {
        $this->db->select('id,name,price,quantity,status,is_available,CONCAT(status,"/",is_available) AS status_combine');
        $this->db->from('products');
        $this->db->limit($limit, $start);
        $this->db->order_by('id', 'ASC');
        return $this->db->get()->result();
    }

    public function totalProducts()
    {
        return $this->db->count_all('products');
    }

    //admin single view 
    public function singleView($enc_id)
    {
         return $this->db->where('id', $enc_id)
                    ->get('products')
                    ->row();
    }
    
}
