<?php

class unit_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function getAllUnits()
    {
        $this->db->select('short_name,min(id) as id');
        $this->db->from('product_unit');
        $this->db->group_by('short_name');
        return $this->db->get()->result();
    }
}
