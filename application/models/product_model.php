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
        $this->db->select('p.id,p.name AS product_name,p.price,p.quantity,p.status,p.is_available,CONCAT(p.status,"/",p.is_available) AS status_combine,c.name AS category_name');
        $this->db->from('products p');
        $this->db->join('category c', 'c.id=p.category','inner');
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
        $this->db->select('p.id,p.name AS product_name,p.description,p.price,p.img,p.category,p.quantity,p.status,p.is_available,c.name AS category_name');
        $this->db->from('products p');
        $this->db->join('category c','c.id = p.category','inner');
        $this->db->where('p.id', $enc_id);
        return $this->db->get()->row();
    }
    
}
