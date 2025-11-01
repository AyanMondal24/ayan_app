<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Product extends CI_Model
{

    function getProducts()
    {

        $this->db->select('*');
        $this->db->from('products');
        $this->db->where('status', '1');
        $this->db->limit(10);
        return $this->db->get()->result();
    }
}
